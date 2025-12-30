<?php
/**
 * Recycling Center Controller
 * CRUD operations for recycling center management
 * Includes search filtering by name, city, and postal code
 * Uses soft delete pattern for data preservation
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CentersModel;
use App\Libraries\ActivityLogger;

class Recyclingcenter extends BaseController
{
    protected $activityLogger;

    public function __construct()
    {
        $this->activityLogger = new ActivityLogger();
    }

    /**
     * List all recycling centers with optional search filters
     * Provides dropdown data for city and postal code filters
     */
    public function index()
    {
        $data['page_title'] = 'Recycling Centers';
        $model = new CentersModel();
        
        // Get all active centers for dropdown filters
        $allCenters = $model->where('is_deleted', '0')->findAll();
        $data['all_centers'] = $allCenters;
        $data['all_cities'] = array_unique(array_column($allCenters, 'city'));
        $data['all_postal_codes'] = array_unique(array_column($allCenters, 'postal_code'));
        sort($data['all_cities']);
        sort($data['all_postal_codes']);

        // Handle search/filter via POST
        if ($this->request->getMethod() === 'POST')
        {
			$searchData = [
				'name'       => $this->request->getPost('name'),
				'city'      => $this->request->getPost('city'),
				'postal_code'=> $this->request->getPost('postal_code'),
			];
			$data['name'] = $searchData['name'];
			$data['city'] = $searchData['city'];
			$data['postal_code'] = $searchData['postal_code'];

			$data['centers'] = $model->getFilteredCenterCategories($searchData);
		} else {
			$data['centers'] = $allCenters;
		}

		return view('admin/recyclingcenter/view',$data);
	}

    /**
     * Display add center form
     */
    public function create()
    {        
        return view('admin/recyclingcenter/add');
    }

    /**
     * Store new recycling center
     * Validates all required fields and logs activity
     */
    public function store()
    {
        $rules = [
            'name' => [
                'label' => 'Center Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the center name.',
                    'min_length' => 'Center name must be at least 3 characters.',
                    'max_length' => 'Center name cannot exceed 255 characters.'
                ]
            ],
            'waste_categories' => [
                'label' => 'Waste Categories',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the waste categories.',
                    'min_length' => 'Waste categories must be at least 3 characters.',
                    'max_length' => 'Waste categories cannot exceed 255 characters.'
                ]
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the address.',
                    'max_length' => 'Address cannot exceed 255 characters.'
                ]
            ],
            'city' => [
                'label' => 'City',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the city.',
                    'max_length' => 'City cannot exceed 100 characters.'
                ]
            ],
            'state' => [
                'label' => 'State',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the state.',
                    'max_length' => 'State cannot exceed 100 characters.'
                ]
            ],
            'postal_code' => [
                'label' => 'Postal Code',
                'rules' => 'permit_empty|numeric|exact_length[6]',
                'errors' => [
                    'numeric' => 'Postal code must contain only digits.',
                    'exact_length' => 'Postal code must be exactly 6 digits.'
                ]
            ],
            'phone_number' => [
                'label' => 'Phone Number',
                'rules' => 'permit_empty|numeric|exact_length[10]',
                'errors' => [
                    'numeric' => 'Phone number must contain only digits.',
                    'exact_length' => 'Phone number must be exactly 10 digits.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[255]',
                'errors' => [
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 255 characters.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CentersModel();
        $data = [
            'name'         => $this->request->getPost('name'),
            'address'      => $this->request->getPost('address'),
            'city'         => $this->request->getPost('city'),
            'state'        => $this->request->getPost('state'),
            'postal_code'  => $this->request->getPost('postal_code'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email'        => $this->request->getPost('email'),
            'waste_categories' => $this->request->getPost('waste_categories'),
        ];

        if ($insertId = $model->insert($data)) {
            $this->activityLogger->logCreate('recyclingcenter', $insertId, $data['name'], $data);
            
            session()->setFlashdata('success', 'Recycling center added successfully.');
            return redirect()->to('recyclingcenter');
        } else {
            session()->setFlashdata('error', 'Failed to add recycling center.');
            return redirect()->back();
        }
    }

    /**
     * Display edit form for specific center
     * 
     * @param int $id Center ID
     * @throws PageNotFoundException if center not found
     */
    public function edit($id)
    {
        $model = new CentersModel();
        
        $data['center'] = $model->where('id', $id)->where('is_deleted', '0')->first();
        
        if (empty($data['center'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the recycling center with ID: ' . $id);
        }

        return view('admin/recyclingcenter/update', $data);
    }

    /**
     * Update existing recycling center
     * Validates input and logs changes with old/new values comparison
     * 
     * @param int $id Center ID
     */
    public function update($id)
    {
        $rules = [
            'name' => [
                'label' => 'Center Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the center name.',
                    'min_length' => 'Center name must be at least 3 characters.',
                    'max_length' => 'Center name cannot exceed 255 characters.'
                ]
            ],
            'waste_categories' => [
                'label' => 'Waste Categories',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the waste categories.',
                    'min_length' => 'Waste categories must be at least 3 characters.',
                    'max_length' => 'Waste categories cannot exceed 255 characters.'
                ]
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Please enter the address.',
                    'max_length' => 'Address cannot exceed 255 characters.'
                ]
            ],
            'city' => [
                'label' => 'City',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the city.',
                    'max_length' => 'City cannot exceed 100 characters.'
                ]
            ],
            'state' => [
                'label' => 'State',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Please enter the state.',
                    'max_length' => 'State cannot exceed 100 characters.'
                ]
            ],
            'postal_code' => [
                'label' => 'Postal Code',
                'rules' => 'permit_empty|numeric|exact_length[6]',
                'errors' => [
                    'numeric' => 'Postal code must contain only digits.',
                    'exact_length' => 'Postal code must be exactly 6 digits.'
                ]
            ],
            'phone_number' => [
                'label' => 'Phone Number',
                'rules' => 'permit_empty|numeric|exact_length[10]',
                'errors' => [
                    'numeric' => 'Phone number must contain only digits.',
                    'exact_length' => 'Phone number must be exactly 10 digits.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[255]',
                'errors' => [
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 255 characters.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CentersModel();
        
        // Capture old values for activity log comparison
        $oldData = $model->find($id);
        
        $data = [
            'name'         => $this->request->getPost('name'),
            'address'      => $this->request->getPost('address'),
            'city'         => $this->request->getPost('city'),
            'state'        => $this->request->getPost('state'),
            'postal_code'  => $this->request->getPost('postal_code'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email'        => $this->request->getPost('email'),
            'waste_categories' => $this->request->getPost('waste_categories'),
        ];

        $model->update($id, $data);
        
        $this->activityLogger->logUpdate('recyclingcenter', $id, $data['name'], $oldData, $data);
        
        return redirect()->to('recyclingcenter')->with('success', 'Recycling center updated successfully.');
    }

    /**
     * Soft delete a recycling center
     * Sets is_deleted flag instead of removing record
     * 
     * @param int $id Center ID
     */
    public function delete($id)
    {
        $model = new CentersModel();
        $center = $model->find($id);

        if (!$center) {
            return redirect()->to('recyclingcenter')->with('error', 'Recycling center not found.');
        }

        $model->update($id, ['is_deleted' => '1']);
        
        $this->activityLogger->logDelete('recyclingcenter', $id, $center['name'], $center);
        
        return redirect()->to('recyclingcenter')->with('success', 'Recycling center deleted successfully.');
    }
}
