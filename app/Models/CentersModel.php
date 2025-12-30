<?php
/**
 * Centers Model
 * Manages recycling center data in lwm_recyclingcenters table
 * Includes search filtering by name, city, and postal code
 */

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

    /**
     * Get filtered recycling centers based on search criteria
     * Excludes soft-deleted records
     * 
     * @param array $filters Search filters (name, city, postal_code)
     * @return array Matching centers
     */
    public function getFilteredCenterCategories($filters = [])
    {
        $builder = $this->builder();

        $builder->where('is_deleted', '0');

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