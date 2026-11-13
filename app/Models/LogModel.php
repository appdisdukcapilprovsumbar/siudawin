<?php
namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_log';
    protected $allowedFields    = [
        'user_id',
        'nama_user',
        'ip',
        'ket',
        'created_at',
        'updated _at',
    ];
    
}
