<?php
namespace App\Models;

use CodeIgniter\Model;

class BlankoModel extends Model
{
    protected $table = 'blanko';
    protected $useTimestamps = true;
    protected $primaryKey = 'blanko_id';
    protected $allowedFields    = [
        'nama',
        'stok',
        'created_at',
        'updated_at',
    ];

    public function updateStokBlanko($kabkot,$stok_blanko){
        $builder = $this->db->table($this->table);
        $builder->where('kabkot',$kabkot);
        $builder->update($stok_blanko);
    }
    
}
