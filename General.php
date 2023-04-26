<?php
namespace App\Models;

use CodeIgniter\Model;

class General extends Model
{
	public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
	
	function insert_update_qry($table="", $data=array(), $id=0)
	{
		$builder = $this->db->table($table);
		if($id)
		{
			$builder->set($data);
			$builder->where('id',$id);
			$builder->update();
			return true;
		} else {
			$builder->insert($data);
			return true;
		}
	}
	
	
	function get_table($table){
		$builder = $this->db->table($table);
		return $builder->get();
	}

}