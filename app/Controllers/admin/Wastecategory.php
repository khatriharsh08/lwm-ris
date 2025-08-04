<?php 

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\WasteModel;

class Wastecategory extends BaseController{

	public function index()
{
    $data['page_title'] = 'Waste Categories';
    $model = new WasteModel();

    if ($this->request->getMethod() === 'POST')
	{
			$searchData = [
				'name'       => $this->request->getPost('name'),
				'start_date' => $this->request->getPost('start_date'),
				'end_date'   => $this->request->getPost('end_date'),
			];
			$data['name'] = $searchData['name'];
			$data['start_date'] = $searchData['start_date'];
			$data['end_date'] = $searchData['end_date'];

			$data['wastecategory'] = $model->getFilteredWasteCategories($searchData);
		} else {
			// Default load without filter
			$data['wastecategory'] = $model->where('is_deleted', '0')->findAll();
		}

		return view('admin/wastecategory/view',$data);
	}
	
	public function add(){
		return view('admin/wastecategory/add');
	}
	
	public function store(){
		 $validation = \Config\Services::validation();

    $rules = [
        'name'        => 'required|min_length[3]|max_length[100]',
        'description' => 'required|min_length[5]|max_length[255]'
    ];

    if (! $this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $this->validator)->with('modal', 'add');
    }
		$model = new WasteModel();
		$data = [
			'name' => $this->request->getPost('name'),
			'description' => $this->request->getPost('description'),
			'is_delete' => 0
		];

		if($model->insert($data)){
			session()->setFlashdata('success', 'Category added successfully.');
			return redirect()->to(base_url('/wastecategory'));
		}else{
			session()->setFlashdata('error', 'Failed to add category.');
			return redirect()->back();
		}
	}

	public function edit($id){
		$model = new WasteModel();
		$data['category'] = $model->where('id', $id)->where('is_deleted', '0')->first();
		// echo "<pre>"; print_r($data['category']); die();
		return view('admin/wastecategory/update',$data);
	}

	public function update($id){
		$model = new WasteModel();
		$data = [
			'name' => $this->request->getPost('name'),
			'description' => $this->request->getPost('description'),
			'is_delete' => 0
		];

		$model->update($id,$data);
		return redirect()->to('wastecategory')->with('success','Category updated successfully.');

	}
	public function delete($id)
	{
		$model = new WasteModel();
		$category = $model->find($id);

		if (!$category) {
			return redirect()->to('/wastecategory')->with('error', 'Category not found.');
		}

		$model->update($id, ['is_deleted' => '1']);
		return redirect()->to('/wastecategory')->with('success', 'Category deleted successfully.');
	}

}


?>