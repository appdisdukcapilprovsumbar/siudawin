<?php
namespace App\Libraries;
use App\Models\LogModel;

class LogAktifitas
{

    protected $logModel;

    public function __construct()
    {
        $this->logModel = new LogModel(); // Gunakan model untuk insert data
    }

    public function create($aktifitas)
    {
        $session = session();
        $user_id = sess_user_account() ?? 'Tidak diketahui'; // Ambil user dari session
        $data = [
            'user_id'       => $user_id,
            'nama_user'     => sess_full_name(),
            'ip'            => $this->getUserIP(),
            'ket'           => $aktifitas,
        ];

        $this->logModel->insert($data); // Gunakan query builder untuk menyimpan data
    }

    public function getUserIP()
    {
        // Coba dapatkan IP dari CodeIgniter Request
        $request = \Config\Services::request();
        $ip = $request->getIPAddress();
        
        // Jika masih UNKNOWN, coba cara manual
        if (empty($ip) || $ip == 'UNKNOWN') {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
            }
        }
        
        // Bersihkan IP jika ada multiple IP (ambil yang pertama)
        if (strpos($ip, ',') !== false) {
            $ips = explode(',', $ip);
            $ip = trim($ips[0]);
        }
        
        // Validasi IP tanpa filter tambahan agar bisa mendeteksi IP lokal
        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : 'UNKNOWN';
    }
}
