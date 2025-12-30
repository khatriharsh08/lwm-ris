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
        $data['waste_categories'] = $wasteList->getWasteCategory(); // For contact form dropdown

        $data['waste_category_count'] = $model->getTotalCategories();
        $data['recycling_center_count'] = $model->getTotalRecyclingCenters();
        $data['events_count'] = $model->getTotalEvents();

        return view('front/home', $data);
    }

    public function sendMessage()
    {
        // Server-side validation rules
        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your name.',
                    'min_length' => 'Name must be at least 2 characters.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your email address.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.'
                ]
            ],
            'phone_number' => [
                'label' => 'Phone Number',
                'rules' => 'required|numeric|exact_length[10]',
                'errors' => [
                    'required' => 'Please enter your phone number.',
                    'numeric' => 'Phone number must contain only digits.',
                    'exact_length' => 'Phone number must be exactly 10 digits.'
                ]
            ],
            'subject' => [
                'label' => 'Subject',
                'rules' => 'permit_empty|max_length[200]',
                'errors' => [
                    'max_length' => 'Subject cannot exceed 200 characters.'
                ]
            ],
            'message' => [
                'label' => 'Message',
                'rules' => 'required|min_length[10]|max_length[2000]',
                'errors' => [
                    'required' => 'Please enter your message.',
                    'min_length' => 'Message must be at least 10 characters.',
                    'max_length' => 'Message cannot exceed 2000 characters.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errorMessages = implode('<br>', array_values($errors));
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $errorMessages,
                'errors' => $errors
            ]);
        }

        $model = new ContactMessageModel();
        $wasteCategories = $this->request->getPost('waste_categories');
        $jsonWaste = json_encode($wasteCategories);
        $data = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'mobile'   => $this->request->getPost('phone_number'),
            'subject' => $this->request->getPost('subject'),
            'waste_categories' => $jsonWaste,
            'message' => $this->request->getPost('message'),
            'status'  => 'new'
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

    public function showdrywaste()
    {        
        return view('front/sections/pages/drywastepage');
    }

    public function showwetwaste()
    {        
        return view('front/sections/pages/wetwastepage');
    }

    public function showhazardouswaste()
    {        
        return view('front/sections/pages/hazardouswastepage');
    }
}

?>