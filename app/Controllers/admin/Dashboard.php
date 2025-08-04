<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new DashboardModel();

        $data['waste_category_count'] = $model->getTotalCategories();
        $data['recycling_center_count'] = $model->getTotalRecyclingCenters();
        $data['events_count'] = $model->getTotalEvents();
        $data['get_in_touch_requests_count'] = $model->getTotalGetInTouchRequests();


        // session_destroy();
        return view('admin/dashboard', $data);
    }
}

?>