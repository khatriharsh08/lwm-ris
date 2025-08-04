<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'lwm_events';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'description',
        'date',
        'venue',
        'poster_image',
        'is_deleted'
    ];

    protected $useTimestamps = true;

    public function getTotalEvents()
    {
        return $this->where('is_deleted', '0')
                    ->countAllResults();
    }

    public function getTotalCompletedEvents()
    {
        return $this->where('date < NOW()')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    public function getTotalUpcomingEvents()
    {
        return $this->where('date >= NOW()')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    public function getFilteredEventCategories($filters = [])
    {
        $builder = $this->builder(); // same as $this->db->table($this->table)

        $builder->where('is_deleted', '0'); // always filter out deleted rows

        if (!empty($filters['title'])) {
            $builder->like('title', $filters['title']);
        }

        if (!empty($filters['start_date'])) {
            $startDate = $filters['start_date'] . ' 00:00:00';
            $builder->where('date >=', $startDate);
        }

        if (!empty($filters['end_date'])) {
        $endDate = $filters['end_date'] . ' 23:59:59';
        $builder->where('date <=', $endDate);
    }

        $builder->orderBy('id', 'DESC');

        return $builder->get()->getResultArray();
    }
}
