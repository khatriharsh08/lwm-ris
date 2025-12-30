<?php
/**
 * Waste Model
 * Manages waste category data in lwm_wasteCategories table
 * Includes search filtering by name and date range
 */

namespace App\Models;
use CodeIgniter\Model;

class WasteModel extends Model
{
    protected $table = 'lwm_wasteCategories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'description', 'is_deleted'];
    protected $useTimestamps = true;

    /**
     * Get filtered waste categories based on search criteria
     * Excludes soft-deleted records
     * 
     * @param array $filters Search filters (name, start_date, end_date)
     * @return array Matching categories
     */
    public function getFilteredWasteCategories($filters = [])
    {
        $builder = $this->builder();

        $builder->where('is_deleted', '0');

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

    /**
     * Get all active waste categories sorted alphabetically
     * 
     * @return array All non-deleted categories
     */
    public function getWasteCategory()
    {
        return $this->where('is_deleted', '0')
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }
}
