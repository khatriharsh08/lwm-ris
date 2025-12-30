<?php 
/**
 * Waste Category Controller
 * CRUD operations for waste category management
 * Uses soft delete pattern for data preservation
 */

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\WasteModel;
use App\Libraries\ActivityLogger;

class Wastecategory extends BaseController{

	protected $activityLogger;

	public function __construct()
	{
		$this->activityLogger = new ActivityLogger();
	}

	/**
	 * List all waste categories with optional search filters
	 */
	public function index()
	{
		$data['page_title'] = 'Waste Categories';
		$model = new WasteModel();

		// Handle search/filter via POST
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
			$data['wastecategory'] = $model->where('is_deleted', '0')->findAll();
		}

		return view('admin/wastecategory/view',$data);
	}
	
	/**
	 * Display add category form
	 */
	public function add(){
		return view('admin/wastecategory/add');
	}
	
	/**
	 * Store new waste category
	 * Validates input and logs activity
	 */
	public function store(){
		$rules = [
			'name' => [
				'label' => 'Category Name',
				'rules' => 'required|min_length[3]|max_length[100]',
				'errors' => [
					'required' => 'Please enter a category name.',
					'min_length' => 'Category name must be at least 3 characters.',
					'max_length' => 'Category name cannot exceed 100 characters.'
				]
			]
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('validation', $this->validator)->with('modal', 'add');
		}
		$model = new WasteModel();
		$data = [
			'name' => $this->request->getPost('name'),
			'description' => $this->request->getPost('description'),
			'is_delete' => 0
		];

		if($insertId = $model->insert($data)){
			$this->activityLogger->logCreate('wastecategory', $insertId, $data['name'], $data);
			
			session()->setFlashdata('success', 'Category added successfully.');
			return redirect()->to(base_url('/wastecategory'));
		}else{
			session()->setFlashdata('error', 'Failed to add category.');
			return redirect()->back();
		}
	}

	/**
	 * Display edit form for specific category
	 * 
	 * @param int $id Category ID
	 */
	public function edit($id){
		$model = new WasteModel();
		$data['category'] = $model->where('id', $id)->where('is_deleted', '0')->first();
		return view('admin/wastecategory/update',$data);
	}

	/**
	 * Update existing category
	 * Validates input and logs changes with old/new values
	 * 
	 * @param int $id Category ID
	 */
	public function update($id){
		$rules = [
			'name' => [
				'label' => 'Category Name',
				'rules' => 'required|min_length[3]|max_length[100]',
				'errors' => [
					'required' => 'Please enter a category name.',
					'min_length' => 'Category name must be at least 3 characters.',
					'max_length' => 'Category name cannot exceed 100 characters.'
				]
			]
		];

		if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$model = new WasteModel();
		
		// Capture old values for activity log comparison
		$oldData = $model->find($id);
		
		$data = [
			'name' => $this->request->getPost('name'),
			'description' => $this->request->getPost('description'),
			'is_delete' => 0
		];

		$model->update($id, $data);
		
		$this->activityLogger->logUpdate('wastecategory', $id, $data['name'], $oldData, $data);
		
		return redirect()->to('wastecategory')->with('success','Category updated successfully.');

	}
	
	/**
	 * Soft delete a category
	 * Sets is_deleted flag instead of removing record
	 * 
	 * @param int $id Category ID
	 */
	public function delete($id)
	{
		$model = new WasteModel();
		$category = $model->find($id);

		if (!$category) {
			return redirect()->to('/wastecategory')->with('error', 'Category not found.');
		}

		$model->update($id, ['is_deleted' => '1']);
		
		$this->activityLogger->logDelete('wastecategory', $id, $category['name'], $category);
		
		return redirect()->to('/wastecategory')->with('success', 'Category deleted successfully.');
	}

}