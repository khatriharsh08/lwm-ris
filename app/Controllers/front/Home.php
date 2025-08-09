<?php 
namespace App\Controllers\Front;
use App\Controllers\BaseController;

use App\Models\HomeModel;
use App\Models\ContactMessageModel;
use App\Models\CentersModel;
use App\Models\WasteModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new HomeModel();
        $centerModel = new CentersModel();
        $wasteList = new WasteModel();
 
        $data['upcoming_events'] = $model->getAllUpcomingEvents();
        $data['cities'] = $model->getAllCity();
        $data['states'] = $model->getAllState();
        $data['recycling_centers'] = $model->getAllRecyclingCenters();

        $data['waste_types'] = $wasteList->getWasteCategory();

        $data['waste_category_count'] = $model->getTotalCategories();
        $data['recycling_center_count'] = $model->getTotalRecyclingCenters();
        $data['events_count'] = $model->getTotalEvents();

        return view('front/home', $data);
    }

    public function sendMessage()
    {
        $model = new ContactMessageModel();
        $wasteCategories = $this->request->getPost('waste_categories');
        $jsonWaste = json_encode($wasteCategories); // encode as JSON
        $data = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'mobile'   => $this->request->getPost('mobile'),
            'subject' => $this->request->getPost('subject'),
            'waste_categories' =>   $jsonWaste,
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

    public function get_category_wise_product()
    {
        $city  = $this->request->getPost('cityName') ?? '';
        $state = $this->request->getPost('stateName') ?? '';
        $model = new HomeModel();

        $data['all_recycling_centers'] = $model->filterEvent($city,$state);
        $html = view('/front/sections/recycling_centers', $data);
        if (!empty($data['all_recycling_centers'])) {
            $data = [
                'status' => 1,
                'msg'    => 'Successfully retrieved records',
                'html'   => $html
            ];
        } else {
            $data = [
                'status' => 0,
                'msg'    => 'No records found',
                'html'   => ''
            ];
        }

        return $this->response->setJSON($data);
    }
}

?>