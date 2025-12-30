<?php
/**
 * Dashboard Controller
 * Main admin dashboard displaying statistics and charts for the LWM-RIS system
 */

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    /**
     * Display admin dashboard with statistics and charts
     * 
     * Data includes:
     * - Stats cards: waste categories, recycling centers, events, pending requests
     * - Charts: contact status pie chart, monthly events bar chart, centers by city doughnut
     */
    public function index()
    {
        $model = new DashboardModel();

        // Stats cards data for top summary widgets
        $data['waste_category_count'] = $model->getTotalCategories();
        $data['recycling_center_count'] = $model->getTotalRecyclingCenters();
        $data['events_count'] = $model->getTotalEvents();
        $data['get_in_touch_requests_count'] = $model->getTotalGetInTouchRequests();

        // Chart data for visual analytics
        $data['contact_by_status'] = $model->getContactMessagesByStatus();
        $data['monthly_events'] = $model->getMonthlyEvents();
        $data['centers_by_city'] = $model->getRecyclingCentersByCity();

        return view('admin/dashboard', $data);
    }
}
