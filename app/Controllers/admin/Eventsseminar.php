<?php
/**
 * Events & Seminars Controller
 * CRUD operations for event/seminar management
 * Handles poster image uploads with cleanup on update
 * Uses soft delete pattern for data preservation
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Libraries\ActivityLogger;

class Eventsseminar extends BaseController
{
    protected $activityLogger;

    public function __construct()
    {
        $this->activityLogger = new ActivityLogger();
    }

    /**
     * List all events with optional date range filtering
     * Displays stats cards for total, completed, and upcoming events
     */
    public function index()
    {
        $data['page_title'] = 'Events & Seminars';
        $model = new EventModel();

        // Get stats for summary cards
        $data['total_events'] = $model->getTotalEvents();
        $data['total_completed_events'] = $model->getTotalCompletedEvents();
        $data['total_upcoming_events'] = $model->getTotalUpcomingEvents();
        
        // Get all events for autocomplete suggestions
        $data['all_events'] = $model->where('is_deleted', '0')->findAll();

        // Handle search/filter via POST
        if ($this->request->getMethod() === 'POST')
        {
                $searchData = [
                    'title'       => $this->request->getPost('title'),
                    'start_date' => $this->request->getPost('start_date'),
                    'end_date'   => $this->request->getPost('end_date'),
                ];
                $data['title'] = $searchData['title'];
                $data['start_date'] = $searchData['start_date'];
                $data['end_date'] = $searchData['end_date'];

                $data['events'] = $model->getFilteredEventCategories($searchData);
            } else {
                $data['events'] = $data['all_events'];
            }
        return view('admin/eventsseminar/view',$data);
    }
    
    /**
     * Display add event form
     */
    public function create()
    {
        return view('admin/eventsseminar/add');
    }

    /**
     * Store new event with poster image upload
     * Validates title, date, venue, and poster image
     */
    public function store()
    {
        $rules = [
            'title' => [
                'label' => 'Event Title',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the event title.',
                    'min_length' => 'Event title must be at least 3 characters.',
                    'max_length' => 'Event title cannot exceed 255 characters.'
                ]
            ],
            'date' => [
                'label' => 'Date and Time',
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Please select the event date and time.',
                    'valid_date' => 'Please enter a valid date and time.'
                ]
            ],
            'venue' => [
                'label' => 'Venue',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the venue.',
                    'max_length' => 'Venue cannot exceed 255 characters.'
                ]
            ],
            'poster_image' => [
                'label' => 'Poster Image',
                'rules' => 'uploaded[poster_image]|max_size[poster_image,5120]|is_image[poster_image]|mime_in[poster_image,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                'errors' => [
                    'uploaded' => 'Please upload a poster image.',
                    'max_size' => 'Poster image must be less than 5MB.',
                    'is_image' => 'Please upload a valid image file.',
                    'mime_in' => 'Only JPG, PNG, GIF, and WebP images are allowed.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle poster image upload
        $file = $this->request->getFile('poster_image');
        $newFileName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/events', $newFileName);

        $model = new EventModel();
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date'        => $this->request->getPost('date'),
            'venue'       => $this->request->getPost('venue'),
            'poster_image'=> $newFileName,
        ];

        if ($insertId = $model->insert($data)) {
            $this->activityLogger->logCreate('events', $insertId, $data['title'], $data);
            
            session()->setFlashdata('success', 'Event added successfully.');
            return redirect()->to(base_url('eventsseminar'));
        } else {
            session()->setFlashdata('error', 'Failed to add event.');
            return redirect()->back();
        }
    }

    /**
     * Display edit form for specific event
     * 
     * @param int $id Event ID
     * @throws PageNotFoundException if event not found
     */
    public function edit($id)
    {
        $model = new EventModel();
        $data['event'] = $model->where('id', $id)->where('is_deleted', '0')->first();
        
        if (empty($data['event'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the event with ID: ' . $id);
        }

        return view('admin/eventsseminar/update', $data);
    }

    /**
     * Update existing event
     * Handles optional poster image replacement with old file cleanup
     * 
     * @param int $id Event ID
     */
    public function update($id)
    {
        $model = new EventModel();
        $event = $model->find($id);

        $rules = [
            'title' => [
                'label' => 'Event Title',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the event title.',
                    'min_length' => 'Event title must be at least 3 characters.',
                    'max_length' => 'Event title cannot exceed 255 characters.'
                ]
            ],
            'date' => [
                'label' => 'Date and Time',
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Please select the event date and time.',
                    'valid_date' => 'Please enter a valid date and time.'
                ]
            ],
            'venue' => [
                'label' => 'Venue',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the venue.',
                    'max_length' => 'Venue cannot exceed 255 characters.'
                ]
            ]
        ];

        // Add poster validation only if new image uploaded
        if ($this->request->getFile('poster_image')->isValid()) {
            $rules['poster_image'] = [
                'label' => 'Poster Image',
                'rules' => 'uploaded[poster_image]|max_size[poster_image,1024]|is_image[poster_image]|mime_in[poster_image,image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                'errors' => [
                    'max_size' => 'Poster image must be less than 1MB.',
                    'is_image' => 'Please upload a valid image file.',
                    'mime_in' => 'Only JPG, PNG, GIF, and WebP images are allowed.'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'date'        => $this->request->getPost('date'),
            'venue'       => $this->request->getPost('venue'),
        ];
        
        // Handle poster image replacement
        if ($this->request->getFile('poster_image')->isValid()) {
            $file = $this->request->getFile('poster_image');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/events', $newFileName);
            $data['poster_image'] = $newFileName;

            // Remove old poster file to free up storage
            if ($event['poster_image'] && file_exists(ROOTPATH . 'public/uploads/events/' . $event['poster_image'])) {
                unlink(ROOTPATH . 'public/uploads/events/' . $event['poster_image']);
            }
        }

        $model->update($id, $data);
        
        $this->activityLogger->logUpdate('events', $id, $data['title'], $event, $data);
        
        return redirect()->to('eventsseminar')->with('success', 'Event updated successfully.');
    }

    /**
     * Soft delete an event
     * Sets is_deleted flag instead of removing record
     * 
     * @param int $id Event ID
     */
    public function delete($id)
    {
        $model = new EventModel();
        $event = $model->find($id);

        if (!$event) {
            return redirect()->to('eventsseminar')->with('error', 'Event not found.');
        }

        $model->update($id, ['is_deleted' => '1']);
        
        $this->activityLogger->logDelete('events', $id, $event['title'], $event);
        
        return redirect()->to('eventsseminar')->with('success', 'Event deleted successfully.');
    }
}
