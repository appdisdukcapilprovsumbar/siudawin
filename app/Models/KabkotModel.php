<?php
namespace App\Models;
use CodeIgniter\Model;

class KabkotModel extends Model
{
    protected $DBGroup = 'secondDB';
    protected $table = 'ref_kota';
    protected $primaryKey = 'kota_id';
    protected $allowedFields    = [
        'provinsi_id',
        'kota_nama',
    ];
    
}
