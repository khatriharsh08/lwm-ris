<?php
/**
 * Contact Message Model
 * Manages contact form submissions in lwm_contactmessages table
 * Provides stats for dashboard and filtered message retrieval
 */

namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{

    protected $table = 'lwm_contactmessages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'subject', 'message', 'status', 'mobile', 'waste_categories', 'is_deleted'];

    protected $useTimestamps = false;

    public function getTotalMessages()
    {       
        return $this->where('is_deleted', '0')->countAllResults();
    }

    public function getTotalPendingMessages()
    {       
        return $this->where('status', 'pending')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    public function getTotalNewMessages()
    {
        return $this->where('status', 'new')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    public function getTotalDoneMessages()
    {
        return $this->where('status', 'done')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    public function getFilteredContactMessages($filters = [])
    {
        $builder = $this->builder();
        
        // Always exclude deleted
        $builder->where('is_deleted', '0');

        if (!empty($filters['status'])) {
            $builder->where('status',$filters['status']);
        }

        if (!empty($filters['start_date'])) {
            $startDate = $filters['start_date'] . ' 00:00:00';
            $builder->where('submitted_at >=', $startDate);
        }

        if (!empty($filters['end_date'])) {
            $endDate = $filters['end_date'] . ' 23:59:59';
            $builder->where('submitted_at <=', $endDate);
        }

        $builder->orderBy('id', 'DESC');

        return $builder->get()->getResultArray();
    }
}
