<?php 
 namespace App\Controllers; 
 use CodeIgniter\Controller;
 use App\Models\Login_office_model;
 use App\Models\AuthUserAccountModel;
 use App\Models\VisitorModel;
 use App\Libraries\Visitor;

class Auth extends BaseController
{
    protected $authModel;
    protected $visitorModel;

    public function __construct()
    {
        $this->authModel        = new AuthUserAccountModel();
        $this->visitorModel     = new VisitorModel();
    }
    
    public function index(){
        check_license();
        $visitor = new Visitor();
        $visitor->addHist('siudawin');

        $data = array(
            'title' => '',
        );
        return view('App\Views\login_view',$data);
    }

    public function checking_authentication(){
        $session = session();

        if (!isset($_POST['proses'])) {
            /*
            redirect to login page
            */
            return redirect()->to(base_url('logout'));
            //End
        }else{
            //validation input
            if (!$this->validate([
                'username' =>[
                    'label' => 'NIK',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],

                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                
                'captcha' => [
                    'label' => 'Captcha',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                
            ])) {
                // if field is null redirect to login  
                return redirect()->to('/')->withInput();
            
            }else{
                /*
                | filter username character
                | filter password character
                */

                $username   = $this->request->getPost('username');
                $password   = $this->request->getPost('password');
                // end

                //code captcha 
                $captcha_code = $this->request->getPost('captcah_code');
                $captcha_input = $this->request->getPost('captcha');
                // end code captcha
                
                /*
                | get status akstifasi user
                */
                $check_status_user = $this->authModel->check_status_username($username);
                // $check_status_user = $this->LoginModel->asObject()->where('user_account_username',$username)->first();
                // end
                if ($captcha_code == $captcha_input) {
                    //jika usernya ada
                    if ($check_status_user) {
                        //jika usernya aktif
                        if ($check_status_user->user_account_status == 'Active') {

                            if (password_verify($password, $check_status_user->user_account_password)) {
                                $data = [
                                    'user_account_id'           => $check_status_user->user_account_id,
                                    'role_access_id'            => $check_status_user->role_access_id,
                                    'group_account_id'          => $check_status_user->group_account_id,
                                    'user_account_full_name'    => $check_status_user->user_account_full_name,
                                    'user_account_username'     => $check_status_user->user_account_username,
                                    'user_account_hashing'      => $check_status_user->user_account_hashing,
                                    'user_account_photo'        => $check_status_user->user_account_photo,
                                    'role_access_code'          => $check_status_user->role_access_code,
                                    'role_access_name'          => $check_status_user->role_access_name,
                                    'role_access_token'         => $check_status_user->role_access_token,
                                    'group_account_code'        => $check_status_user->group_account_code,
                                    'region'                    => $check_status_user->region,
                                    'kecamatan'                 => $check_status_user->kecamatan,
                                    'kelurahan'                 => $check_status_user->kelurahan,
                                    'sess_logged_in'            => 'is_secure_authentication',
                                ];

                                $session->set($data);
                                // level admin hanya boleh bidang Sekretariat saja
                                return redirect()->to('/RedirectModules');
                                
                            }else{
                                session()->setFlashdata('respon_message', '<div class="alert alert-danger show flex items-center mt-4" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Password anda salah..! </div>');
                                return redirect()->to('/')->withInput();
                            }
                        }elseif($check_status_user->user_account_status == 'Disable' | $check_status_user->user_account_status == 'Block'){
                            session()->setFlashdata('respon_message', '<div class="alert alert-danger show flex items-center mt-4" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Status akun anda terblokir..! </div>');
                            return redirect()->to('/')->withInput();
                        }else{
                            session()->setFlashdata('respon_message', '<div class="alert alert-danger show flex items-center mt-4" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Akun anda tidak aktif ..! </div>');
                            return redirect()->to('/')->withInput();
                        }
                    }else{
                        session()->setFlashdata('respon_message', '<div class="alert alert-danger show flex items-center mt-4" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Username salah atau belum terdaftar..! </div>');
                        return redirect()->to('/')->withInput();
                    }
                }else{
                    session()->setFlashdata('respon_message', '<div class="alert alert-danger show flex items-center" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Captcha yang dimasukkan tidak sesuai..! </div>');
                    return redirect()->to('/')->withInput();
                }
            }

        }
    }
    
}
