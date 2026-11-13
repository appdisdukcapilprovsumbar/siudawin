<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class Login_user_model 
{
	protected $db;

    public function __construct(ConnectionInterface &$db){
        $this->db =& $db;
    }
	
	public function check_status_username($username){
		$builder = $this->db->table('auth_user_office');
		$builder->select('*');
		$builder->join('auth_role_access', 'auth_role_access.role_access_id=auth_user_office.role_access_id', 'inner');
		$builder->join('auth_group_account', 'auth_group_account.group_account_id=auth_user_office.group_account_id', 'inner');
		$builder->where('user_account_username',$username);
		$status = ['Delete'];
		$builder->whereNotIn('user_account_status', $status);
		$builder->whereIn('auth_user_office.role_access_id',[1,2,7,8,9]);
		$query = $builder->get();
		return $query->getRow();
	}	

	public function check_username($username, $password){
		$builder = $this->db->table('auth_user_office');
		$builder->where('user_account_username', $username);
		$builder->where('user_account_password', $password);
		$query = $builder->get();
		if ($query->getNumRows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

    public function delete_data($id){
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $builder->delete();
    }

    public function getUserById($id){
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $query = $builder->get();
        return $query->getRow();
    }

    public function insert_data($data){
        $builder = $this->db->table('auth_user_office');
        $builder->insert($data);
    }
	// profile

	public function get_data_profile($id){
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $query = $builder->get();
        return $query->getRow();
    } 

    public function find_img($id){
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $query = $builder->get();
        return $query->getRowArray();
    }   

    public function update_data($id,$data){
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $builder->update($data);
    }

    public function get_password($id){
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $query = $builder->get();
        return $query->getRow('user_account_password');
    }

    public function getRoleAkses(){
        $builder = $this->db->table('auth_role_access');
        $builder->select('role_access_id,role_access_code,role_access_name,role_access_token,role_access_description');
        $builder->whereNotIn('role_access_code',['root','operator','admin_kabkot','operator_kabkot','adminOpd']);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function updatePassword($data_password,$id)
    {
        $builder = $this->db->table('auth_user_office');
        $builder->where('user_account_id',$id);
        $builder->update($data_password);
    }

    public function getAllUser(){
        $builder = $this->db->table('auth_user_office');
        $builder->whereNotIn('role_access_id',[1]);
        return $builder->countAllResults();
    }
    
}