<?php 
/**
 * This is Dashboard Modules Controller
 */
 namespace App\Controllers\admin;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Libraries\LogAktifitas;
 use App\Models\LogModel;

class Profil_web extends BaseController
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
            'title'         => 'PROFIL WEBSITE',
            'menu_active'   => 'pengaturan',
            'menu_sub'      => 'profil_website',
            'content'       => 'App\Views\admin\settings\profil_webiste_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function update(){

        if ($this->request->is('post')) {

            $app_name           = $this->request->getPost('app_name');
            $app_author         = $this->request->getPost('app_author');
            $app_version        = $this->request->getPost('app_version');
            $app_year           = $this->request->getPost('app_year');
            $app_copyright      = $this->request->getPost('app_copyright');

            update_row('system_config',$data = array('config_value' => $app_name),$where=array('config_key' => 'app_name'));
            update_row('system_config',$data = array('config_value' => $app_author),$where=array('config_key' => 'app_author'));
            update_row('system_config',$data = array('config_value' => $app_copyright),$where=array('config_key' => 'app_copyright'));
            update_row('system_config',$data = array('config_value' => $app_version),$where=array('config_key' => 'app_version'));
            update_row('system_config',$data = array('config_value' => $app_year),$where=array('config_key' => 'app_year'));

            $logData = array(
                'user_id'       => sess_user_account(),
                'nama_user'     => sess_full_name(),
                'ip'            => $this->getUserIP(),
                'ket'           => 'mengubah data pada profil Website', 
            );

            $this->log_m->insert($logData);

            session()->setFlashdata('respon_message', 'Data berhasil diubah');
            return redirect()->to('admin/profil_website');
        
        }
        
    }

}
