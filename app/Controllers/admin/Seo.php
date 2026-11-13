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

class Seo extends BaseController
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
            'title'         => 'SEO WEBSITE',
            'menu_active'   => 'pengaturan',
            'menu_sub'      => 'seo',
            'content'       => 'App\Views\admin\settings\seo_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function update(){ 

        if ($this->request->is('post')) {

            $title          = $this->request->getPost('title');
            $description    = $this->request->getPost('description');
            $keyword        = $this->request->getPost('keyword');
            $robot          = $this->request->getPost('robot');

            update_row('system_config',$data = array('config_value' => $title),$where=array('config_key' => 'meta_title'));
            update_row('system_config',$data = array('config_value' => $description),$where=array('config_key' => 'meta_description'));
            update_row('system_config',$data = array('config_value' => $keyword),$where=array('config_key' => 'meta_keyword'));
            update_row('system_config',$data = array('config_value' => $robot),$where=array('config_key' => 'meta_robot'));

            $logData = array(
                'user_id'       => sess_user_account(),
                'nama_user'     => sess_full_name(),
                'ip'            => $this->getUserIP(),
                'ket'           => 'mengubah data pada Seo Website', 
            );

            $this->log_m->insert($logData);

            session()->setFlashdata('respon_message', 'Data berhasil diubah');
            return redirect()->to('admin/seo');
        
        }
        
    }

}
