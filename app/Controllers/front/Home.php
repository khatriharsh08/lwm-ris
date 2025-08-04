<?php 
namespace App\Controllers\Front;
use App\Controllers\BaseController;

use App\Models\HomeModel;
use App\Models\ContactMessageModel;
use App\Models\CentersModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new HomeModel();
        $centerModel = new CentersModel();

        $data['all_upcoming_events'] = $model->getAllUpcomingEvents();
        $data['all_recycling_centers'] = $model->getAllRecyclingCenters();
        $data['all_city'] = $model->getAllCity();

        
        return view('front/home', $data);
    }

    public function sendMessage()
    {
        $rules = [
            'name'    => 'required|min_length[3]|max_length[255]',
            'email'   => 'required|valid_email|max_length[255]',
            'subject' => 'required|max_length[255]',
            'message' => 'required|min_length[10]'
        ];

        $response = [];

        if (!$this->validate($rules)) {
            $response = [
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response);
        }

        $model = new ContactMessageModel();
        $data = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'status'  => 'new' // Default status for new messages
        ];

        if($model->insert($data)){
			$response = [
                'status' => 'success',
                'message' => 'Your message has been sent successfully. Thank you!'
            ];
		}else{
			$response = [
                'status' => 'error',
                'message' => 'Failed to send the message due to a server error. Please try again later.'
            ];
		}
        
        return $this->response->setJSON($response);
    }

    public function getStates()
    {
        $city = $this->request->getPost('city'); // or getVar('city') if unsure
        
        $model = new CentersModel();

        $states = $model->getStatesByCity($city);

        return $this->response->setJSON($states);
    }
}

?>