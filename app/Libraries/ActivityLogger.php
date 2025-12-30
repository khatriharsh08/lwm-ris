<?php

namespace App\Libraries;

use App\Models\ActivityLogModel;

class ActivityLogger
{
    protected $model;

    public function __construct()
    {
        $this->model = new ActivityLogModel();
    }

    /**
     * Log a create action
     */
    public function logCreate(string $module, int $recordId, string $recordTitle, array $newValues = [])
    {
        return $this->log('create', $module, $recordId, $recordTitle, null, $newValues);
    }

    /**
     * Log an update action
     */
    public function logUpdate(string $module, int $recordId, string $recordTitle, array $oldValues = [], array $newValues = [])
    {
        return $this->log('update', $module, $recordId, $recordTitle, $oldValues, $newValues);
    }

    /**
     * Log a delete action
     */
    public function logDelete(string $module, int $recordId, string $recordTitle, array $oldValues = [])
    {
        return $this->log('delete', $module, $recordId, $recordTitle, $oldValues, null);
    }

    /**
     * Log a status change action
     */
    public function logStatusChange(string $module, int $recordId, string $recordTitle, string $oldStatus, string $newStatus)
    {
        return $this->log('status_change', $module, $recordId, $recordTitle, 
            ['status' => $oldStatus], 
            ['status' => $newStatus]
        );
    }

    /**
     * Core logging method
     */
    protected function log(string $action, string $module, ?int $recordId, ?string $recordTitle, ?array $oldValues, ?array $newValues)
    {
        $session = session();
        $request = service('request');

        $data = [
            'user_id'      => $session->get('user_id') ?? 0,
            'user_name'    => $session->get('user_name') ?? 'System',
            'action'       => $action,
            'module'       => $module,
            'record_id'    => $recordId,
            'record_title' => $recordTitle,
            'old_values'   => $oldValues ? json_encode($oldValues) : null,
            'new_values'   => $newValues ? json_encode($newValues) : null,
            'ip_address'   => $request->getIPAddress(),
            'user_agent'   => substr($request->getUserAgent()->getAgentString(), 0, 255),
            'created_at'   => date('Y-m-d H:i:s')
        ];

        return $this->model->insert($data);
    }
}
