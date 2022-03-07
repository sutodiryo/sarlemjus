<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $table = '';
			
	// Count
	public function count($where = array(), $value = null) 
	{
		// Si $where est un array, la variable $valeur sera ignorée par la méthode where()
		return (int) $this->db->where($where, $value)
	                          ->from($this->table)
	                          ->count_all_results();
	}
	
	// Delete
	public function delete($where) 
	{
		if(is_integer($where)) { $where = array('id_agenda' => $where); }
		return (bool) $this->db->where($where)
	                           ->delete($this->table);
	}
	
	// Get 
	public function get($where = array(),$nb = null, $debut = null, $select = '*') 
	{
		if(is_integer($where)) { $where = array('id_agenda' => $where); }
		if($where=='') { $where = array('1' => '1'); }
		$req = $this->db->select($select)
	    	            ->from($this->table)
	        	        ->where($where)
	            	    ->limit($nb, $debut)
	                	->get();
		if ($req->num_rows()==1) { return $req->row(); }
		return $req->result();
	}
				
	// Insert
	public function insert($echappe = array(), $noechappe = array()) 
	{
		if(empty($echappe) AND empty($noechappe)) { return false; }
		//return (bool) 
		$req = $this->db->set($echappe)
	    				->set($noechappe, null, false)
	                    ->insert($this->table);
		if($req) {
			$insert_id = $this->db->insert_id();
			return  $insert_id;				
		} else {
			return false;
		}	
	}
	
	// Update
	public function update($where = array(), $echappe = array(), $noechappe = array()) {		
		if(empty($echappe) AND empty($noechappe)) { return false; }
		if(is_integer($where)) { $where = array('id_agenda' => $where); }
		return (bool) $this->db->set($echappe)
                               ->set($noechappe, null, false)
                               ->where($where)
                               ->update($this->table);
	}
	
}
