<?php
/**
 * Activity Log Model
 * Manages admin activity logs in lwm_activity_logs table
 * Provides filtered retrieval and pagination for audit trail
 */

namespace App\Models;
use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'lwm_activity_logs';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'user_id',
        'user_name',
        'action',
        'module',
        'record_id',
        'record_title',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    /**
     * Get recent activity logs with pagination
     */
    public function getRecentLogs($limit = 50, $offset = 0, $filters = [])
    {
        $builder = $this->builder();
        
        if (!empty($filters['module'])) {
            $builder->where('module', $filters['module']);
        }
        
        if (!empty($filters['action'])) {
            $builder->where('action', $filters['action']);
        }
        
        if (!empty($filters['user_id'])) {
            $builder->where('user_id', $filters['user_id']);
        }
        
        if (!empty($filters['start_date'])) {
            $builder->where('created_at >=', $filters['start_date'] . ' 00:00:00');
        }
        
        if (!empty($filters['end_date'])) {
            $builder->where('created_at <=', $filters['end_date'] . ' 23:59:59');
        }
        
        return $builder->orderBy('created_at', 'DESC')
                       ->limit($limit, $offset)
                       ->get()
                       ->getResultArray();
    }

    /**
     * Count total logs for pagination
     */
    public function countLogs($filters = [])
    {
        $builder = $this->builder();
        
        if (!empty($filters['module'])) {
            $builder->where('module', $filters['module']);
        }
        
        if (!empty($filters['action'])) {
            $builder->where('action', $filters['action']);
        }
        
        if (!empty($filters['user_id'])) {
            $builder->where('user_id', $filters['user_id']);
        }
        
        if (!empty($filters['start_date'])) {
            $builder->where('created_at >=', $filters['start_date'] . ' 00:00:00');
        }
        
        if (!empty($filters['end_date'])) {
            $builder->where('created_at <=', $filters['end_date'] . ' 23:59:59');
        }
        
        return $builder->countAllResults();
    }

    /**
     * Get distinct modules for filter dropdown
     */
    public function getDistinctModules()
    {
        return $this->builder()
                    ->distinct()
                    ->select('module')
                    ->orderBy('module', 'ASC')
                    ->get()
                    ->getResultArray();
    }
}
