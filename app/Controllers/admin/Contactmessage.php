<?php 
/**
 * Contact Message Controller
 * Manages contact form submissions from the public website
 * Includes status management (new -> pending -> done) and filtering
 */

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ContactMessageModel;
use App\Libraries\ActivityLogger;

class contactmessage extends BaseController{

	protected $activityLogger;

	public function __construct()
	{
		$this->activityLogger = new ActivityLogger();
	}

	/**
	 * List all contact messages with optional filtering
	 * Auto-updates 'new' messages to 'pending' if they're from a previous day
	 */
	public function index(){
		$data['page_title'] = 'Contact Messages';
		$model = new ContactMessageModel();

		// Auto-update status for old 'new' messages
		$this->AutoUpdateStatus();

		// Get stats for summary cards
		$data['total_messages'] = $model->getTotalMessages();
		$data['total_new_messages'] = $model->getTotalNewMessages();
		$data['total_pending_messages'] = $model->getTotalPendingMessages();
		$data['total_done_messages'] = $model->getTotalDoneMessages();

		// Handle search/filter via POST
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

				$data['contactmessages'] = $model->getFilteredContactMessages($searchData);
			} else {
				$data['contactmessages'] = $model->where('is_deleted', '0')->orderBy('submitted_at', 'DESC')->findAll();
			}

			return view('admin/contactmessage/view',$data);
		}

	/**
	 * Update message status (new/pending/done)
	 * Logs status changes for audit trail
	 * 
	 * @param int $id Message ID
	 * @param string $status New status value
	 */
    public function setStatus($id = null, $status = null){
		if($id && ($status == 'pending' || $status == 'done' || $status == 'new')){
			$model = new ContactMessageModel();
			
			$message = $model->find($id);
			$oldStatus = $message['status'] ?? 'unknown';
			
			$model->update($id, ['status' => $status]);
			
			// Log status change for audit purposes
			$this->activityLogger->logStatusChange('contactmessage', $id, $message['subject'] ?? 'Message #'.$id, $oldStatus, $status);
		}
		return redirect()->to('/contactmessage');
	}

	/**
	 * Automatically transition 'new' messages to 'pending' status
	 * Runs on each page load - messages from previous days become 'pending'
	 */
	public function AutoUpdateStatus(){
		$model = new ContactMessageModel();
		$model->where('status', 'new')
			  ->where('submitted_at <', date('Y-m-d'))
			  ->set('status', 'pending')
			  ->update();
	}
}