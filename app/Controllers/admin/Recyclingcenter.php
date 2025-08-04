<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CentersModel;

class Recyclingcenter extends BaseController
{

    public function index()
    {
        $data['page_title'] = 'Recycling Centers';
        $model = new CentersModel();
        $data['centers'] = $model->where('is_deleted','0')->findAll();

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
			// Default load without filter
			$data['centers'] = $model->where('is_deleted', '0')->findAll();
		}

		return view('admin/recyclingcenter/view',$data);
	}

    public function create()
    {
        
        return view('admin/recyclingcenter/add');
    }


    public function store()
    {
       
        $rules = [
            'name'         => 'required|min_length[3]|max_length[255]',
            'address'      => 'required|max_length[255]',
            'city'         => 'required|max_length[100]',
            'state'        => 'required|max_length[100]',
            'email'        => 'permit_empty|valid_email|max_length[255]',
            'phone_number' => 'permit_empty|max_length[20]'
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
        ];

        if ($model->insert($data)) {
            session()->setFlashdata('success', 'Recycling center added successfully.');
            return redirect()->to('recyclingcenter');
        } else {
            session()->setFlashdata('error', 'Failed to add recycling center.');
            return redirect()->back();
        }
    }

   
    public function edit($id)
    {
        $model = new CentersModel();
        
        $data['center'] = $model->where('id', $id)->where('is_deleted', '0')->first();
        
        if (empty($data['center'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the recycling center with ID: ' . $id);
        }

       
        return view('admin/recyclingcenter/update', $data);
    }

   
    public function update($id)
    {
        $model = new CentersModel();
        $data = [
            'name'         => $this->request->getPost('name'),
            'address'      => $this->request->getPost('address'),
            'city'         => $this->request->getPost('city'),
            'state'        => $this->request->getPost('state'),
            'postal_code'  => $this->request->getPost('postal_code'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email'        => $this->request->getPost('email'),
        ];

        $model->update($id, $data);
        return redirect()->to('recyclingcenter')->with('success', 'Recycling center updated successfully.');
    }

    public function delete($id)
    {
        $model = new CentersModel();
        $center = $model->find($id);

        if (!$center) {
            return redirect()->to('recyclingcenter')->with('error', 'Recycling center not found.');
        }

        
        $model->update($id, ['is_deleted' => '1']);
        return redirect()->to('recyclingcenter')->with('success', 'Recycling center deleted successfully.');
    }
}
