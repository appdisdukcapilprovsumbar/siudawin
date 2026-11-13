<?php
namespace App\Models;
use CodeIgniter\Model;

class AuthUserAccountModel extends Model {
    protected $DBGroup = 'secondDB'; // Gunakan koneksi database kedua
    protected $table = 'auth_user_account'; // Nama tabel di database kedua
    protected $primaryKey = 'user_account_id';
    protected $allowedFields = ['group_account_id',
                                'role_access_id',
                                'region',
                                'kecamatan',
                                'kelurahan',
                                'user_account_contact',
                                'user_account_full_name',
                                'user_account_nick_name',
                                'user_account_username',
                                'user_account_password',
                                'user_account_hashing',
                                'user_account_photo',
                                'user_account_email',
                                'user_account_status',
                                'created_at',
                                'updated_at',
                                'created_by',
                                ];

    public function check_status_username($username){
        $builder = $this->db->table('auth_user_account');
        $builder->select('*');
        $builder->join('auth_role_access', 'auth_role_access.role_access_id=auth_user_account.role_access_id', 'inner');
        $builder->join('auth_group_account', 'auth_group_account.group_account_id=auth_user_account.group_account_id', 'inner');
        $builder->where('user_account_username',$username);
        $status = ['Delete'];
        $builder->whereNotIn('user_account_status', $status);
        $builder->whereIn('auth_user_account.role_access_id',[2,4,10,11]);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getAllUser(){
        $builder = $this->db->table('auth_user_account');
        $builder->whereNotIn('role_access_id',[2,3,4,5]);
        $query  = $builder->get();
        return $query->getResultArray();
    }

    public function get_password($id){
        $builder = $this->db->table('auth_user_account');
        $builder->where('user_account_id',$id);
        $query = $builder->get();
        return $query->getRow('user_account_password');
    }
    
    public function updatePassword($data_password,$id)
    {
        $builder = $this->db->table('auth_user_account');
        $builder->where('user_account_id',$id);
        $builder->update($data_password);
    }

    public function update_data($id,$data){
        $builder = $this->db->table('auth_user_account');
        $builder->where('user_account_id',$id);
        $builder->update($data);
    }
}