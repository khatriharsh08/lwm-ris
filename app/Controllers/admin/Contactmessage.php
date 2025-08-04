<?php 

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ContactMessageModel;

class contactmessage extends BaseController{

	public function index(){
		$data['page_title'] = 'Contact Messages';
		$model = new ContactMessageModel();

		$this->AutoUpdateStatus();

		$data['total_messages'] = $model->getTotalMessages();
		$data['total_new_messages'] = $model->getTotalNewMessages();
		$data['total_pending_messages'] = $model->getTotalPendingMessages();
		$data['total_done_messages'] = $model->getTotalDoneMessages();

		if ($this->request->getMethod() === 'POST')
		{
				$searchData = [
					'status'     => $this->request->getPost('status'),
					'start_date' => $this->request->getPost('start_date'),
					'end_date'   => $this->request->getPost('end_date'),
				];
				$data['status'] = $searchData['status'] ?? '';
				$data['start_date'] = $searchData['start_date'];
				$data['end_date'] = $searchData['end_date'];

				//echo $data['status'];die();

				$data['contactmessages'] = $model->getFilteredContactMessages($searchData);
			} else {
				// Default load without filter
				$data['contactmessages'] = $model->orderBy('submitted_at', 'DESC')->findAll();
			}

			return view('admin/contactmessage/view',$data);
		}

    public function setStatus($id = null, $status = null){
		if($id && ($status == 'pending' || $status == 'done' || $status == 'new')){
			$model = new ContactMessageModel();
			$model->update($id, ['status' => $status]);
		}
		// Redirect back to the main message list
		return redirect()->to('/contactmessage');
	}

	public function AutoUpdateStatus(){
		$model = new ContactMessageModel();
		$model->where('status', 'new')
			  ->where('submitted_at <', date('Y-m-d'))  //  date -> yyyy-mm-dd 00:00:00
			  ->set('status', 'pending')
			  ->update();
	}
}