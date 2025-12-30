<?php
/**
 * Home Model
 * Provides data for the public-facing home page
 * Retrieves events, recycling centers, and statistics for visitors
 */

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $DBGroup = 'default';

    /**
     * Get all upcoming events for public display
     */
    public function getAllUpcomingEvents()
    {
        return $this->db->table('lwm_events')
                        ->where('date >= NOW()')
                        ->where('is_deleted', '0')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Get all active recycling centers for public display
     */
    public function getAllRecyclingCenters()
    {
        return $this->db->table('lwm_recyclingcenters')
                        ->where('is_deleted', '0')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Get distinct cities for location filter dropdown
     */
    public function getAllCity()
    {
        return $this->db->table('lwm_recyclingcenters')
                        ->select('city')
                        ->where('is_deleted', '0')
                        ->distinct()
                        ->orderBy('city', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Get distinct states for location filter dropdown
     */
    public function getAllState()
    {
        return $this->db->table('lwm_recyclingcenters')
                        ->select('state')
                        ->where('is_deleted', '0')
                        ->distinct()
                        ->orderBy('state', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Filter recycling centers by city and/or state
     */
    public function filterEvent($city,$state){
        $builder = $this->db->table('lwm_recyclingcenters');
        if(!empty($city)){
            $builder->where('city',$city);
        }
        if(!empty($state)){
            $builder->where('state',$state);
        }
        return $builder->get()->getResultArray();
    }

    /**
     * Get total count of waste categories for homepage stats
     */
    public function getTotalCategories()
    {        
        return $this->db->table('lwm_wastecategories')
                        ->where('is_deleted', '0')
                        ->countAllResults(); 
    }

    /**
     * Get total count of recycling centers for homepage stats
     */
    public function getTotalRecyclingCenters()
    {       
        return $this->db->table('lwm_recyclingcenters')
                        ->where('is_deleted', '0')
                        ->countAllResults();
    }

    /**
     * Get total count of completed events for homepage stats
     */
    public function getTotalEvents()
    {       
        return $this->db->table('lwm_events')
                        ->where('date <= NOW()')
                        ->where('is_deleted', '0')
                        ->countAllResults();
    }
}
