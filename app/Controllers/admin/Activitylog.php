<?php
/**
 * Activity Log Controller
 * Displays system activity logs for admin audit trail
 * Supports filtering by module, action, user, and date range
 * Master admin only access
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;
use App\Models\UserModel;

class Activitylog extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ActivityLogModel();
    }

    /**
     * Display paginated activity logs with optional filters
     * Provides filter options for module, action, user, and date range
     */
    public function index()
    {
        $data['page_title'] = 'Activity Logs';
        
        // Collect filter parameters from query string
        $filters = [
            'module'     => $this->request->getGet('module'),
            'action'     => $this->request->getGet('action'),
            'user_id'    => $this->request->getGet('user_id'),
            'start_date' => $this->request->getGet('start_date'),
            'end_date'   => $this->request->getGet('end_date'),
        ];
        
        // Calculate pagination offset
        $perPage = 50;
        $page = (int)($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;
        
        // Fetch logs and pagination data
        $data['logs'] = $this->model->getRecentLogs($perPage, $offset, $filters);
        $data['total'] = $this->model->countLogs($filters);
        $data['pages'] = ceil($data['total'] / $perPage);
        $data['currentPage'] = $page;
        
        // Populate filter dropdown options
        $data['modules'] = $this->model->getDistinctModules();
        $data['filters'] = $filters;
        
        // Get all users for user filter dropdown
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        
        return view('admin/activitylog/view', $data);
    }
}
