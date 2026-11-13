<?php 
/**
 * This is Dashboard Modules Controller
 */
 namespace App\Controllers; 
 
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use App\Libraries\Hash;
 use App\Libraries\LogAktifitas;
 use App\Models\LogModel;
 use App\Models\AuthUserAccountModel;


class Profil extends BaseController
{
    protected $profil_m;
    protected $log_m;
    protected $bidangModel;

    public function __construct(){
        $this->profil_m     = new AuthUserAccountModel();
        $this->log_m        = new LogAktifitas();
    }

    
    public function index() {

        $data = [
            'title'         => 'PROFIL',
            'menu_active'   => 'profil',
            'menu_sub'      => 'profil',
            'content'       => 'App\Views\profil_view',
            'profil'        => $this->profil_m->where('user_account_id',sess_user_account())->first(),
            'validation'    => \Config\Services::validation(),
        ];
        return view('App\Views\layout_admin\wrapper',$data);

    }

    public function update_profil($id){

        if ($this->request->is('post')) {
            
            $nama       = $this->request->getPost('nama');
            $kontak     = $this->request->getPost('kontak');
            $username   = $this->request->getPost('username');
            $email      = $this->request->getPost('email');

  
            $data = array(
                'user_account_full_name' => $nama,
                'user_account_contact'   => $kontak,
                'user_account_username'  => $username,
                'user_account_email'     => $email,
            );

            $this->profil_m->update_data($id,$data);
            // dd($data);
            session()->setFlashdata('respon_message', 'Data Profil Berhasil Diubah');    

            $this->log_m->create('Mengubah data porfil menjadi nama '.$nama);

            return redirect()->to('profil');
        
        }
    }

    public function update_password(){

            // code...
        if (sess_logged_in() != null) {

            $id           = $this->request->getVar('id');
            $pass_lama    = $this->request->getVar('pass_lama');
            $pass_baru    = $this->request->getVar('pass_baru');
            $ulangi_pass  = $this->request->getVar('ulangi_pass');

            $check_password = $this->profil_m->get_password(sess_user_account());
            
            if (password_verify($pass_lama, $check_password)) {
                if ($pass_baru != $ulangi_pass) {

                    session()->setFlashdata('respon_error_message', 'Password baru tidak sama dengan ulangi password ');                    
                    return redirect()->to('profil')->withInput();
    
                }else{
    
                    $data_password = array(
                        'user_account_password'   => Hash::make($pass_baru),
                        'user_account_hashing'    => Hash::hashing($pass_baru),
                    );
                    $result = $this->profil_m->updatePassword($data_password,$id);

                    $this->log_m->create('Mengubah data password atas nama '.sess_full_name());
    
                    session()->setFlashdata('respon_message', 'Berhasil ubah password');                    
                    return redirect()->to('profil')->withInput();
                    
                }

            }else{
                session()->setFlashdata('respon_error_message', 'Password lama tidak sesuai');                    
                return redirect()->to('profil')->withInput();
            }
            
            return json_encode($result);

        }else{
            session()->setFlashdata('respon_erro_message', 'Data Profil Berhasil Diubah');                    
            return redirect()->to('profil')->withInput();
        }

    }


}