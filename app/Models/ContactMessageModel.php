<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{

    protected $table = 'lwm_contactmessages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'subject', 'message', 'status'];

    protected $useTimestamps = false;

    public function getTotalMessages()
    {       
        return $this->countAllResults();
    }

    public function getTotalPendingMessages()
    {       
        return $this->where('status', 'pending')
                    ->countAllResults();
    }

    public function getTotalNewMessages()
    {
        return $this->where('status', 'new')
                    ->countAllResults();
    }

    public function getTotalDoneMessages()
    {
        return $this->where('status', 'done')
                    ->countAllResults();
    }

    public function getFilteredContactMessages($filters = [])
    {
        $builder = $this->builder(); // same as $this->db->table($this->table)

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
