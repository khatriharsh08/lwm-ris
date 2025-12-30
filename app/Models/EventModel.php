<?php
/**
 * Event Model
 * Manages events/seminars data in lwm_events table
 * Includes stats methods and search filtering
 */

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

    /**
     * Get total count of all active events
     */
    public function getTotalEvents()
    {
        return $this->where('is_deleted', '0')
                    ->countAllResults();
    }

    /**
     * Get count of events that have already occurred
     */
    public function getTotalCompletedEvents()
    {
        return $this->where('date < NOW()')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    /**
     * Get count of future/upcoming events
     */
    public function getTotalUpcomingEvents()
    {
        return $this->where('date >= NOW()')
                    ->where('is_deleted', '0')
                    ->countAllResults();
    }

    /**
     * Get filtered events based on search criteria
     * Excludes soft-deleted records
     * 
     * @param array $filters Search filters (title, start_date, end_date)
     * @return array Matching events
     */
    public function getFilteredEventCategories($filters = [])
    {
        $builder = $this->builder();

        $builder->where('is_deleted', '0');

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
