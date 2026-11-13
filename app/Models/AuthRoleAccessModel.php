<?php
namespace App\Models;
use CodeIgniter\Model;

class AuthRoleAccessModel extends Model {
    protected $DBGroup = 'secondDB'; // Gunakan koneksi database kedua
    protected $table = 'auth_role_access'; // Nama tabel di database kedua
    protected $primaryKey = 'role_access_id';
    protected $allowedFields = ['role_access_code',
                                'role_access_name',
                                'role_access_token',
                                'role_access_description',
                                'role_status',
                                'created_at',
                                'updated_at',
                                ];
}