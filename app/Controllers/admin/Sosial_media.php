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

class Sosial_media extends BaseController
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
            'title'         => 'SOSIAL MEDIA',
            'menu_active'   => 'pengaturan',
            'menu_sub'      => 'sosial_media',
            'content'       => 'App\Views\admin\settings\sosial_media_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function update(){

        if ($this->request->is('post')) {

            $facebook     = $this->request->getPost('sosmed_facebook');
            $instagram    = $this->request->getPost('sosmed_instagram');
            $youtube      = $this->request->getPost('sosmed_youtube');
            $website      = $this->request->getPost('sosmed_website');

            update_row('system_config',$data = array('config_value' => $facebook),$where=array('config_key' => 'sosmed_facebook'));
            update_row('system_config',$data = array('config_value' => $instagram),$where=array('config_key' => 'sosmed_instagram'));
            update_row('system_config',$data = array('config_value' => $youtube),$where=array('config_key' => 'sosmed_youtube'));
            update_row('system_config',$data = array('config_value' => $website),$where=array('config_key' => 'sosmed_website'));

            $logData = array(
                'user_id'       => sess_user_account(),
                'nama_user'     => sess_full_name(),
                'ip'            => $this->getUserIP(),
                'ket'           => 'mengubah data pada Sosial Media', 
            );

            $this->log_m->insert($logData);

            session()->setFlashdata('respon_message', 'Data berhasil diubah');
            return redirect()->to('admin/sosial_media');
        
        }
        
    }

}
