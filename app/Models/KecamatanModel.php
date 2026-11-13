<?php
namespace App\Models;
use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $DBGroup = 'secondDB';
    protected $table = 'ref_kecamatan';
    protected $primaryKey = 'kecamatan_id';
    protected $allowedFields    = [
        'kota_id',
        'kecamatan_nama',
    ];
    
}
