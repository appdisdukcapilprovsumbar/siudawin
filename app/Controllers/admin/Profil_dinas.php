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

class Profil_dinas extends BaseController
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
            'title'         => 'PROFIL DINAS',
            'menu_active'   => 'pengaturan',
            'menu_sub'      => 'profil_dinas',
            'content'       => 'App\Views\admin\settings\profil_dinas_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function update(){

        if ($this->request->is('post')) {

            $company_name       = $this->request->getPost('company_name');
            $company_phone      = $this->request->getPost('company_phone');
            $company_email      = $this->request->getPost('company_email');
            $company_address    = $this->request->getPost('company_address');
            $company_postcode   = $this->request->getPost('company_postcode');

            update_row('system_config',$data = array('config_value' => $company_name),$where=array('config_key' => 'company_name'));
            update_row('system_config',$data = array('config_value' => $company_phone),$where=array('config_key' => 'company_phone'));
            update_row('system_config',$data = array('config_value' => $company_email),$where=array('config_key' => 'company_email'));
            update_row('system_config',$data = array('config_value' => $company_address),$where=array('config_key' => 'company_address'));
            update_row('system_config',$data = array('config_value' => $company_postcode),$where=array('config_key' => 'company_postcode'));

            $logData = array(
                'user_id'       => sess_user_account(),
                'nama_user'     => sess_full_name(),
                'ip'            => $this->getUserIP(),
                'ket'           => 'mengubah data pada profil Dinas', 
            );

            $this->log_m->insert($logData);

            session()->setFlashdata('respon_message', 'Data berhasil diubah');
            return redirect()->to('admin/profil_dinas');
        }
        
    }

}
