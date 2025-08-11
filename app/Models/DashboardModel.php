<?php

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
                        ->where('status', 'unread')
                        ->countAllResults();
    }

}