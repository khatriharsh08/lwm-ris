<?php

namespace App\Models;
use CodeIgniter\Model;

class WasteModel extends Model
{
    protected $table = 'lwm_wasteCategories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'description', 'is_deleted'];
    protected $useTimestamps = true;

    public function getFilteredWasteCategories($filters = [])
    {
        $builder = $this->builder(); // same as $this->db->table($this->table)

        $builder->where('is_deleted', '0'); // always filter out deleted rows

        if (!empty($filters['name'])) {
            $builder->like('name',$filters['name']);
        }

        if (!empty($filters['start_date'])) {
            $start_date = $filters['start_date'] . ' 00:00:00';
            $builder->where('created_at >=', $start_date);
        }

        if (!empty($filters['end_date'])) {
        $endDate = $filters['end_date'] . ' 23:59:59';
        $builder->where('created_at <=', $endDate);
    }

        $builder->orderBy('id', 'DESC');

        return $builder->get()->getResultArray();
    }
}
