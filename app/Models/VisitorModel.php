<?php
namespace App\Models;
use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $DBGroup = 'secondDB';
    protected $table = 'visitor';
    protected $primaryKey = 'id';
    protected $allowedFields    = [
        'id',
        'name_app',
        'hits',
        'created_at',
        'updated_at',
    ];
    
    public function updateHits($data,$nameApp){
        $builder = $this->db->table($this->table);
        $builder->where('name_app',$nameApp);
        $builder->update($data);
    }
}
