<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;

class Eventsseminar extends BaseController
{

    public function index()
    {
        $data['page_title'] = 'Events & Seminars';
        $model = new EventModel();

        $data['total_events'] = $model->getTotalEvents();
        $data['total_completed_events'] = $model->getTotalCompletedEvents();
        $data['total_upcoming_events'] = $model->getTotalUpcomingEvents();

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
                // Default load without filter
                $data['events'] = $model->where('is_deleted', '0')->findAll();
            }
        return view('admin/eventsseminar/view',$data);
    }
    

    public function create()
    {
        return view('admin/eventsseminar/add');
    }

    public function store()
    {
        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'date'        => 'required|valid_date',
            'venue'       => 'required|max_length[255]',
            'poster_image' => [
                'label' => 'Poster Image',
                'rules' => 'uploaded[poster_image]|max_size[poster_image,5120]|is_image[poster_image]'
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

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

        if ($model->insert($data)) {
            session()->setFlashdata('success', 'Event added successfully.');
            return redirect()->to(base_url('eventsseminar/view'));
        } else {
            session()->setFlashdata('error', 'Failed to add event.');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $model = new EventModel();
        $data['event'] = $model->where('id', $id)->where('is_deleted', '0')->first();
        
        if (empty($data['event'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the event with ID: ' . $id);
        }

        return view('admin/eventsseminar/update', $data);
    }


    public function update($id)
    {
        $model = new EventModel();
        $event = $model->find($id);

        $rules = [
            'title'       => 'required|min_length[3]|max_length[255]',
            'date'        => 'required|valid_date',
            'venue'       => 'required|max_length[255]',
        ];

        if ($this->request->getFile('poster_image')->isValid()) {
            $rules['poster_image'] = 'uploaded[poster_image]|max_size[poster_image,1024]|is_image[poster_image]';
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
        
        if ($this->request->getFile('poster_image')->isValid()) {
            $file = $this->request->getFile('poster_image');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/events', $newFileName);
            $data['poster_image'] = $newFileName;

            // Delete the old image if it exists
            if ($event['poster_image'] && file_exists(ROOTPATH . 'public/uploads/events/' . $event['poster_image'])) {
                unlink(ROOTPATH . 'public/uploads/events/' . $event['poster_image']);
            }
        }

        $model->update($id, $data);
        return redirect()->to('eventsseminar')->with('success', 'Event updated successfully.');
    }


    public function delete($id)
    {
        $model = new EventModel();
        $event = $model->find($id);

        if (!$event) {
            return redirect()->to('eventsseminar')->with('error', 'Event not found.');
        }

        $model->update($id, ['is_deleted' => '1']);
        return redirect()->to('eventsseminar')->with('success', 'Event deleted successfully.');
    }
}
