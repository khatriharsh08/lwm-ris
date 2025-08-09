<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $DBGroup = 'default';

    public function getAllUpcomingEvents()
    {
        return $this->db->table('lwm_events')
                        ->where('date >= NOW()')
                        ->where('is_deleted', '0')
                        ->get()
                        ->getResultArray();
    }

    public function getAllRecyclingCenters()
    {
        return $this->db->table('lwm_recyclingcenters')
                        ->where('is_deleted', '0')
                        ->get()
                        ->getResultArray();
    }

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
                        ->where('date <= NOW()')
                        ->where('is_deleted', '0')
                        ->countAllResults();
    }
}
