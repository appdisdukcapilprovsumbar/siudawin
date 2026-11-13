<?php 

 namespace App\Controllers\admin;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Libraries\Hash;
 use App\Libraries\LogAktifitas;
 use App\Models\AuthUserAccountModel;
 use App\Models\AuthRoleAccessModel;
 use App\Models\KabkotModel;
 use App\Models\KecamatanModel;
 use App\Models\KelurahanModel;

class Account extends BaseController
{
    protected $authModel;
    protected $roleModel;
    protected $kabkotModel;
    protected $kecamatanModel;
    protected $kelurahanModel;
    protected $log_m;

    public function __construct(){
        $this->log_m            = new LogAktifitas();
        $this->authModel        = new AuthUserAccountModel();
        $this->roleModel        = new AuthRoleAccessModel();
        $this->kabkotModel      = new KabkotModel();
        $this->kecamatanModel   = new KecamatanModel();
        $this->kelurahanModel   = new KelurahanModel();
    }

    public function index() {

        $data = [
            'title'         => 'DATA USERS',
            'menu_active'   => 'users',
            'menu_sub'      => 'users',
            'role_access'   => $this->roleModel->whereIn('role_access_id',[2,4,10,11])->find(),
            'kabkot'        => $this->kabkotModel->select('kota_id,kota_nama')->where('provinsi_id',13)->find(),
            'content'       => 'App\Views\admin\data_user_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function getKecamatan(){
        $kabkot = $this->request->getVar('kabkot_id');
        $data = $this->kecamatanModel->select('kecamatan_id,kecamatan_nama')->where('kota_id',$kabkot)->find();
        return json_encode($data);
    }

    public function getKelurahan(){
        $kecamatan_id = $this->request->getVar('kecamatan_id');
        $data = $this->kelurahanModel->select('kelurahan_id,kelurahan_nama')->where('kecamatan_id',$kecamatan_id)->find();
        return json_encode($data);
    }

    public function get_data_office(){
        
        $db2 = db_connect('secondDB');

        $builder = $db2->table('auth_user_account')
                        ->select('user_account_id,
                                  user_account_full_name,
                                  user_account_username,
                                  user_account_contact,
                                  user_account_status,
                                  auth_role_access.role_access_name,
                                  region,
                                  auth_user_account.created_at')
                        ->join('auth_role_access','auth_user_account.role_access_id = auth_role_access.role_access_id','inner')
                        ->whereIn('auth_user_account.role_access_id',[2,4,10,11])
                        ->orderBy('user_account_id','DESC');
        return DataTable::of($builder)

        ->add('action', function($row){
                return '<button type="button" title="Ubah Data" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit"  onclick="edit_data('.$row->user_account_id.')"><i class="fas fa-pen"></i></button>
                <button type="button" title="Ubah Password" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#editPass"  onclick="edit_password('.$row->user_account_id.')"><i class="fas fa-lock"></i></button>
                <button type="button" title="Hapus Data" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete"  onclick="delete_data('.$row->user_account_id.')"><i class="fas fa-trash"></i></button>';
            
        }, 'last')
        ->addNumbering('nomor')
        ->hide('user_account_id')

        ->edit('user_account_status', function($row){
            if ($row->user_account_status == 'Active'){
                return '<button class="btn btn-success btn-rounded btn-xs text-white">'.($row->user_account_status).'</button>'; 
            }elseif($row->user_account_status == 'Disable'){
                return '<button class="btn btn-secondary btn-rounded btn-xs text-white">'.($row->user_account_status).'</button>'; 
            }elseif($row->user_account_status == 'Block'){
                return '<button class="btn btn-danger btn-rounded btn-xs text-white">'.($row->user_account_status).'</button>'; 
            }
        })

        ->format('created_at', function($value){
            return indonesia_date($value);
        })

        ->format('region', function($value){
            return str_replace('-', ' ', $value);
        })

        ->format('region', function($value){
            if ($value == 13) {
                return 'Provinsi Sumatera Barat';   
            }elseif($value == 1301){
                return 'Kabupaten Pesisir Selatan';
            }elseif ($value == 1302) {
                return 'Kabupaten Solok';
            }elseif ($value == 1303) {
                return 'Kabupaten Sijunjung';
            }elseif ($value == 1304) {
                return 'Kabupaten Tanah Datar';
            }elseif ($value == 1305) {
                return 'Kabupaten Padang Pariaman';
            }elseif ($value == 1306) {
                return 'Kabupaten Agam';
            }elseif ($value == 1307) {
                return 'Kabupaten Lima Puluh Kota';
            }elseif ($value == 1308) {
                return 'Kabupaten Pasaman';
            }elseif ($value == 1309) {
                return 'Kabupaten Kepulauan Mentawai';
            }elseif ($value == 1310) {
                return 'Kabupaten Dharmasraya';
            }elseif ($value == 1311) {
                return 'Kabupaten Solok Selatan';
            }elseif ($value == 1312) {
                return 'Kabupaten Pasaman Barat';
            }elseif ($value == 1371) {
                return 'Kota Padang';
            }elseif ($value == 1372) {
                return 'Kota Solok';
            }elseif ($value == 1373) {
                return 'Kota Sawahlunto';
            }elseif ($value == 1374) {
                return 'Kota Padang Panjang';
            }elseif ($value == 1375) {
                return 'Kota Bukittinggi';
            }elseif ($value == 1376) {
                return 'Kota Payakumbuh';
            }elseif ($value == 1377) {
                return 'Kota Pariaman';
            }
        })
        
        ->toJson();
    }
    // end get data auth_user_office

    public function account_insert(){
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'addLevel' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
                'addNama' => [
                    'label' => 'Nama user',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
                'addNIK' => [
                    'label' => 'NIK',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                        'numeric' => '{field} harus berupa angka',
                    ]
                ],
                'addHp' => [
                    'label' => 'NIP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
                'addPass' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],  
                'addUlangiPass' => [
                    'label' => 'Ulangi Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
            ]);

            if (!$valid) {
                
                $msg = [
                    'error' => [
                        'erroraddLevel'         => $validation->getError('addLevel'),
                        'erroraddNama'          => $validation->getError('addNama'),
                        'erroraddNIK'           => $validation->getError('addNIK'),
                        'erroraddHp'            => $validation->getError('addHp'),
                        'erroraddPass'          => $validation->getError('addPass'),
                        'erroraddUlangiPass'    => $validation->getError('addUlangiPass'),
                    ]
                ];

            }else{

                $level      = $this->request->getVar('addLevel');
                $kabkot     = $this->request->getVar('addKabkot');
                $kecamatan  = $this->request->getVar('addKecamatan');
                $kelurahan  = $this->request->getVar('addKelurahan');
                $nama       = $this->request->getVar('addNama');
                $nik        = $this->request->getVar('addNIK');
                $hp         = $this->request->getVar('addHp');
                $pass       = $this->request->getVar('addPass');
                $UlangPass  = $this->request->getVar('addUlangiPass');

                $cekNIK         = $this->authModel->check_status_username($nik);

                if ($cekNIK != null) {
                    $msg = [
                        'error' => [
                            'erroraddNIK'           => 'NIK sudah terdaftar',
                        ]
                    ];
                } else {

                    if ($pass != $UlangPass) {
                        $msg = [
                            'error' => [
                                'erroraddUlangiPass'    => 'Ulangi password harus sama dengan password',
                            ]
                        ];
                    }elseif($level == 4 && $kabkot == null){ // level Kabupaten Kota
                        $msg = [
                            'error' => [
                                'erroraddKabkot'    => 'Kabupaten & Kota wajib diisi',
                            ]
                        ];  
                    }elseif($level == 10 && $kecamatan == null){ // level Kecamatan
                        $msg = [
                            'error' => [
                                'erroraddKecamatan' => 'Kecamatan wajib diisi',
                            ]
                        ];  
                    }elseif($level == 11  && $kelurahan == null){ // level  Kelurahan
                        $msg = [
                            'error' => [
                                'erroraddKelurahan'    => 'Kelurahan wajib diisi',
                            ]
                        ];  
                    }else{
                        
                        $data = array(
                            'group_account_id'          => 1,
                            'role_access_id'            => $level,
                            'region'                    => $kabkot,
                            'kecamatan'                 => $kecamatan,
                            'kelurahan'                 => $kelurahan,
                            'user_account_full_name'    => $nama,
                            'user_account_username'     => $nik,
                            'user_account_contact'      => $hp,
                            'user_account_password'     => Hash::make($pass),
                            'user_account_hashing'      => Hash::hashing($pass),
                            'created_at'                => get_timestamp(),
                            'created_by'                => sess_user_account(),
                        );
        
                        $this->authModel->insert($data);

                        $msg = [
                            'sukses' => 'Tambah user baru berhasil'
                        ];
                        $this->log_m->create('Menambahkan data akun '.$nik);
                    }
                }

            }

            echo json_encode($msg);
        }

    }

    public function edit(){
        $id = $this->request->getVar('id');
        $data = $this->authModel->find($id);
        return json_encode($data);
    }

    public function update_account(){
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'editLevel' => [
                    'label' => 'Level',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
                'editStatus' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
                'editNama' => [
                    'label'  => 'Nama user',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
                'editKabkot' => [
                    'label'  => 'Kabupaten/Kota',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
                'editNIK' => [
                    'label' => 'NIK',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                        'numeric'  => '{field} harus berupa angka',
                    ]
                ], 
                'editHp' => [
                    'label' => 'Nomor HP/Telepon',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                        'numeric'  => '{field} harus berupa angka',
                    ]
                ],
            ]);

            if (!$valid) {
                
                $msg = [
                    'error' => [
                        'erroreditLevel'         => $validation->getError('editLevel'),
                        'erroreditStatus'        => $validation->getError('editStatus'),
                        'erroreditKabkot'        => $validation->getError('editKabkot'),
                        'erroreditNama'          => $validation->getError('editNama'),
                        'erroreditNIK'           => $validation->getError('editNIK'),
                        'erroreditHp'            => $validation->getError('editHp'),
                    ]
                ];

            }else{

                $id         = $this->request->getVar('idUser');
                $status     = $this->request->getVar('editStatus');
                $level      = $this->request->getVar('editLevel');
                $kabkot     = $this->request->getVar('editKabkot');
                $kecamatan  = $this->request->getVar('editKecamatan');
                $kelurahan  = $this->request->getVar('editKelurahan');
                $nama       = $this->request->getVar('editNama');
                $nik        = $this->request->getVar('editNIK');
                $hp         = $this->request->getVar('editHp');

                if($level == 4 && $kabkot == null){ // level Kabupaten Kota
                    $msg = [
                        'error' => [
                            'errorEditKabkot'    => 'Kabupaten & Kota wajib diisi',
                        ]
                    ]; 

                }elseif($level == 10 && $kecamatan == null){ // level Kecamatan
                    $msg = [
                        'error' => [
                            'errorEditKecamatan' => 'Kecamatan wajib diisi',
                        ]
                    ];  

                }elseif($level == 11  && $kelurahan == null){ // level  Kelurahan
                    $msg = [
                        'error' => [
                            'errorEditKelurahan'    => 'Kelurahan wajib diisi',
                        ]
                    ];  

                }else{
                
                    $data = array(
                        'user_account_status'   => $status,
                        'role_access_id'        => $level,
                        'region'                => $kabkot,
                        'kecamatan'             => $kecamatan,
                        'kelurahan'             => $kelurahan,
                        'user_account_full_name'=> $nama,
                        'user_account_username' => $nik,
                        'user_account_contact'  => $hp,
                    );

                    $this->authModel->update($id,$data);

                    $msg = [
                        'sukses' => 'Berhasil ubah Data user'
                    ];
                    $this->log_m->create('Mengubah data akun '.$nik);
                }
            }

            echo json_encode($msg);
        }
    }

    public function update_account_password(){
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            
            $valid = $this->validate([ 
                'editNewPass' => [
                    'label' => 'Password baru',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
                'editRepeatPass' => [
                    'label' => 'Ulangi password',
                    'rules' => 'required|matches[editNewPass]',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                        'matches' => '{field} tidak sama dengan password',
                    ]
                ], 
            ]);

            if (!$valid) {
                
                $msg = [
                    'error' => [
                        'erroreditNewPass'          => $validation->getError('editNewPass'),
                        'erroreditRepeatPass'       => $validation->getError('editRepeatPass'),
                    ]
                ];

            }else{

                $id         = $this->request->getVar('idUserPass');
                $passNew    = $this->request->getVar('editNewPass');
                $repeatPass = $this->request->getVar('editRepeatPass');
                    
                $data = array(
                    'user_account_password' => Hash::make($passNew),
                    'user_account_hashing'  => Hash::hashing($passNew),
                );

                $this->authModel->update($id,$data);

                $getData = $this->authModel->where('user_account_id',$id)->first();
                $this->log_m->create('Mengubah password pada akun '.$getData['user_account_username']);

                $msg = [
                    'sukses' => 'Berhasil ubah password'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function delete(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            
            $getData = $this->authModel->where('user_account_id',$id)->first();
            $this->log_m->create('Menghapus data pada akun '.$getData['user_account_username']);
                
            $this->authModel->delete($id);
            
            $msg = [
                'sukses' => "Data user berhasil dihapus",
            ];

            return json_encode($msg);
        }
    }

}
