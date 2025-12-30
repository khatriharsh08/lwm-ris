<?php
/**
 * Dashboard Model
 * Provides aggregated statistics and chart data for admin dashboard
 * Retrieves counts and analytics from multiple tables
 */

namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $DBGroup = 'default';
    
    public function getTotalCategories()
    {        
        return $this->db->table('lwm_wastecategories')
                        ->where('is_deleted', '0')
                        ->countAllResults(); 
    }

  
    public function getTotalRecyclingCenters()
    {       
        return $this->db->table('lwm_recyclingcenters')
                        ->where('is_deleted', '0')
                        ->countAllResults();
    }

    public function getTotalEvents()
    {       
        return $this->db->table('lwm_events')
                        ->where('is_deleted', '0')
                        ->countAllResults();
    }

    public function getTotalGetInTouchRequests()
    {       
        return $this->db->table('lwm_contactmessages')
                        ->where('status', 'pending')
                        ->countAllResults();
    }

    /**
     * Get contact messages grouped by status for pie chart
     */
    public function getContactMessagesByStatus()
    {
        $query = $this->db->table('lwm_contactmessages')
                          ->select('status, COUNT(*) as count')
                          ->groupBy('status')
                          ->get();
        return $query->getResultArray();
    }

    /**
     * Get monthly events for bar chart (last 6 months)
     */
    public function getMonthlyEvents()
    {
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $startDate = date('Y-m-01', strtotime("-$i months"));
            $endDate = date('Y-m-t', strtotime("-$i months"));
            $monthName = date('M Y', strtotime("-$i months"));
            
            $count = $this->db->table('lwm_events')
                              ->where('is_deleted', '0')
                              ->where('date >=', $startDate)
                              ->where('date <=', $endDate)
                              ->countAllResults();
            
            $data[] = [
                'month' => $monthName,
                'count' => $count
            ];
        }
        return $data;
    }

    /**
     * Get recycling centers by city for doughnut chart (top 5)
     */
    public function getRecyclingCentersByCity()
    {
        $query = $this->db->table('lwm_recyclingcenters')
                          ->select('city, COUNT(*) as count')
                          ->where('is_deleted', '0')
                          ->groupBy('city')
                          ->orderBy('count', 'DESC')
                          ->limit(5)
                          ->get();
        return $query->getResultArray();
    }

    /**
     * Get waste categories with their names
     */
    public function getWasteCategories()
    {
        $query = $this->db->table('lwm_wastecategories')
                          ->select('name')
                          ->where('is_deleted', '0')
                          ->get();
        return $query->getResultArray();
    }
}
