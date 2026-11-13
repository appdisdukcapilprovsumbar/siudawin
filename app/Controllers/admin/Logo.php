<?php 
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use App\Libraries\LogAktifitas;
use App\Models\LogModel;

class Logo extends BaseController
{
    protected $log_m;

    public function __construct(){
        $this->log_m = new LogModel();
    }

    public function getUserIP()
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

	public function index(){
        $data = [
            'title'         => 'LOGO & BACKGROUND',
            'menu_active'   => 'pengaturan',
            'menu_sub'      => 'logo',
            'content'       => 'App\Views\admin\settings\logo_view',
        ];

        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function upload_logo(){
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'logo' => [
                    'label' => 'Upload logo',
                    'rules' => 'uploaded[logo]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]',
                    'errors' => [
                        'uploaded' => '{field} Wajib diisi',
                        'mime_in' => '{field} harus dalam bentuk gambar',
                    ]
                ], 
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'logo' => $validation->getError('logo')
                    ]
                ];
            }else{

                //cek foto
                $fotolama = get_row('system_config',array('config_key' => 'app_logo'),'config_value');

                if (file_exists('uploads/gallery/'.$fotolama)) {
                    unlink('uploads/gallery/'. $fotolama);
                }

                $filephoto = $this->request->getFile('logo');

                $fileName = $filephoto->getRandomName();

                $filephoto->move('uploads/gallery',$fileName);

                update_row('system_config',$data = array('config_value' => $fileName),$where=array('config_key' => 'app_logo'));

                $msg = [
                    'sukses' => 'Berhasil diupload'
                ];

                $logData = array(
                    'user_id'       => sess_user_account(),
                    'nama_user'     => sess_full_name(),
                    'ip'            => $this->getUserIP(),
                    'ket'           => 'mengubah Logo', 
                );

                $this->log_m->insert($logData);

            }

            echo json_encode($msg);
        }
    }
    
    
    public function upload_bg(){
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'foto_bg' => [
                    'label' => 'Upload Background',
                    'rules' => 'uploaded[foto_bg]|mime_in[foto_bg,image/png,image/jpg,image/jpeg]|is_image[foto_bg]',
                    'errors' => [
                        'uploaded' => '{field} Wajib diisi',
                        'mime_in' => '{field} harus dalam bentuk gambar',
                    ]
                ], 
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'foto_bg' => $validation->getError('foto_bg')
                    ]
                ];
            }else{

                //cek foto
                $fotolama = get_row('system_config',array('config_key' => 'app_background'),'config_value');

                if ($fotolama != null) {
                    if (file_exists('uploads/gallery/'.$fotolama)) {
                        unlink('uploads/gallery/'. $fotolama);
                    }
                }
                
                $filephoto = $this->request->getFile('foto_bg');

                $fileName = $filephoto->getRandomName();

                $filephoto->move('uploads/gallery',$fileName);

                update_row('system_config',$data = array('config_value' => $fileName),$where=array('config_key' => 'app_background'));

                $msg = [
                    'sukses' => 'Berhasil diupload'
                ];

                $logData = array(
                    'user_id'       => sess_user_account(),
                    'nama_user'     => sess_full_name(),
                    'ip'            => $this->getUserIP(),
                    'ket'           => 'mengubah Background', 
                );

                $this->log_m->insert($logData);

            }

            echo json_encode($msg);
        }
    }
    
    
    public function upload_favicon(){
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'favicon' => [
                    'label' => 'Upload Favicon',
                    'rules' => 'uploaded[favicon]|mime_in[favicon,image/png,image/jpg,image/jpeg]|is_image[favicon]',
                    'errors' => [
                        'uploaded' => '{field} Wajib diisi',
                        'mime_in' => '{field} harus dalam bentuk gambar',
                    ]
                ], 
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'favicon' => $validation->getError('favicon')
                    ]
                ];
            }else{

                //cek foto
                $fotolama = get_row('system_config',array('config_key' => 'meta_favicon'),'config_value');

                if (file_exists('uploads/gallery/'.$fotolama)) {
                    unlink('uploads/gallery/'. $fotolama);
                }
                
                $filephoto = $this->request->getFile('favicon');

                $fileName = $filephoto->getRandomName();

                $filephoto->move('uploads/gallery',$fileName);

                update_row('system_config',$data = array('config_value' => $fileName),$where=array('config_key' => 'meta_favicon'));

                $msg = [
                    'sukses' => 'Berhasil diupload'
                ];

                $logData = array(
                    'user_id'       => sess_user_account(),
                    'nama_user'     => sess_full_name(),
                    'ip'            => $this->getUserIP(),
                    'ket'           => 'mengubah Favicon', 
                );

                $this->log_m->insert($logData);

            }

            echo json_encode($msg);
        }
    }


}