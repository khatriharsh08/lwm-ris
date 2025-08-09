<?php

namespace App\Models;
use CodeIgniter\Model;

class CentersModel extends Model
{
    protected $table = 'lwm_recyclingcenters';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'address',
        'city',
        'state',
        'postal_code',
        'phone_number',
        'email',
        'waste_categories',
        'is_deleted'
    ];

    protected $useTimestamps = true;

    public function getFilteredCenterCategories($filters = [])
    {
        $builder = $this->builder(); // same as $this->db->table($this->table)

        $builder->where('is_deleted', '0'); // always filter out deleted rows

        if (!empty($filters['name'])) {
            $builder->like('name',$filters['name']);
        }

        if (!empty($filters['city'])) {
            $builder->where('city', $filters['city']);
        }

        if (!empty($filters['postal_code'])) {
            $builder->where('postal_code', $filters['postal_code']);
        }

        $builder->orderBy('id', 'DESC');

        return $builder->get()->getResultArray();
    }
    
}