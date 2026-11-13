<?php
namespace App\Models;
use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $DBGroup = 'secondDB';
    protected $table = 'ref_kelurahan';
    protected $primaryKey = 'kelurahan_id';
    protected $allowedFields    = [
        'kecamatan_id',
        'kelurahan_nama',
    ];
    
}
