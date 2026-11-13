<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\kelurahan;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Libraries\LogAktifitas;
 use App\Models\CeraiModel;
 use App\Models\CeraiPihakModel;
 use App\Models\KabkotModel;
 use App\Models\KecamatanModel;
 use App\Models\KelurahanModel;
 use PhpOffice\PhpSpreadsheet\Spreadsheet;
 use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cerai extends BaseController
{
    protected $CeraiModel;
    protected $CeraiPihakModel;
    protected $log;
    protected $kabkotModel;
    protected $kecamatanModel;
    protected $kelurahanModel;

    public function __construct(){
        $this->CeraiModel           = new CeraiModel();
        $this->CeraiPihakModel      = new CeraiPihakModel();
        $this->log                  = new LogAktifitas();
        $this->kabkotModel          = new KabkotModel();
        $this->kecamatanModel       = new KecamatanModel();
        $this->kelurahanModel       = new KelurahanModel();
    }

    public function index(){;
        $data = [
            'title'         => 'PERCERAIAN',
            'menu_active'   => 'master',
            'menu_sub'      => 'cerai',
            'content'       => 'App\Views\cerai\kelurahan\cerai_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    
    public function getAll(){
        $db = db_connect();
        $builder = $db->table('perceraian_pihak')
                      ->select('perceraian_pihak.id,
                                perceraian_pihak.perceraian_id,
                                kode_register,
                                jenis_pihak,
                                nik,
                                nama_lengkap,
                                agama,
                                perceraian_pihak.created_at')
                      ->join('perceraian','perceraian.id = perceraian_pihak.perceraian_id','inner') 
                      ->where('perceraian.kelurahan',sess_kelurahan())
                      ->orderBy('perceraian_pihak.perceraian_id','DESC')
                      ->orderBy("
                                CASE
                                WHEN perceraian_pihak.jenis_pihak = 'SUAMI' THEN 1
                                WHEN perceraian_pihak.jenis_pihak = 'ISTRI' THEN 2
                                ELSE 3
                            END
                        ", '', false);
        
        return DataTable::of($builder)
        ->add('action', function($row){
            return '
            <a href="'.base_url('admin/kel/cerai/detail/'.$row->perceraian_id).'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
            <a href="'.base_url('admin/kel/cerai/create?id='.$row->perceraian_id).'" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>';
        }, 'last')
        ->format('created_at', function($value){
            return indonesia_date($value);
        })
        ->hide('id')
        ->hide('perceraian_id')
        ->addNumbering('no')
        ->toJson();
    }
    
    public function create(){
        // Jika ada ?id= berarti user kembali dari step 2, load data dari DB
        $id = $this->request->getGet('id');
        $perceraian = [];
        if (!empty($id)) {
            $row = $this->CeraiModel->find($id);
            if ($row) {
                $perceraian = $row;
            }
        }

        $data = [
            'title'         => 'INPUT DATA PERCERAIAN',
            'menu_active'   => 'master',
            'menu_sub'      => 'cerai_create',
            'content'       => 'App\Views\cerai\kelurahan\cerai_create_view',
            'perceraian'    => $perceraian,
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    /**
     * AJAX: Simpan / update step 1 data perceraian
     * Mengembalikan JSON { sukses: true, id: xxx } atau { error: {...} }
     */
    public function saveStep1(){
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'status_perceraian_sebelum_cerai' => [
                    'label' => 'Status Perkawinan Sebelum Cerai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ], 
                'status_cerai_hidup' => [
                    'label' => 'Status Cerai Hidup',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ], 
                'no_kk' => [
                    'label' => 'Nomor KK',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ],
            ]);

            if (!$valid) {
                
                $msg = [
                    'error' => [
                        'err_status_perceraian_sebelum_cerai'   => $validation->getError('status_perceraian_sebelum_cerai'),
                        'err_status_cerai_hidup'              => $validation->getError('status_cerai_hidup'),
                        'err_no_kk'                             => $validation->getError('no_kk'),
                    ]
                ];

            }else{

                $kelurahan = sess_kelurahan();
                $prefix    = 'REG' . $kelurahan;

                $last = $this->CeraiModel
                            ->select('kode_register')
                            ->where('kelurahan', $kelurahan)
                            ->orderBy('id', 'DESC')
                            ->first();

                if ($last) {
                    // Ambil nomor urut setelah prefix (REG + kode_kelurahan)
                    $nomor = (int) substr($last['kode_register'], strlen($prefix));
                    $nomor++;
                } else {
                    $nomor = 1;
                }

                $kode_register = $prefix . str_pad($nomor, 4, '0', STR_PAD_LEFT);



                $id                                 = $this->request->getVar('perceraian_id');
                $status_perceraian_sebelum_cerai    = $this->request->getVar('status_perceraian_sebelum_cerai');
                $no_buku_nikah                      = $this->request->getVar('no_buku_nikah');
                $tgl_buku_nikah                     = $this->request->getVar('tgl_buku_nikah');
                $sebab_perceraian                   = $this->request->getVar('sebab_perceraian');
                $status_cerai_hidup                 = $this->request->getVar('status_cerai_hidup');
                $no_akta_cerai                      = $this->request->getVar('no_akta_cerai');
                $tgl_akta_cerai                     = $this->request->getVar('tgl_akta_cerai');
                $no_putusan_pengadilan              = $this->request->getVar('no_putusan_pengadilan');
                $tgl_putusan_pengadilan             = $this->request->getVar('tgl_putusan_pengadilan');
                $cerai_mati                         = $this->request->getVar('cerai_mati');
                $no_akta_kematian                   = $this->request->getVar('no_akta_kematian');
                $tgl_akta_kematian                  = $this->request->getVar('tgl_akta_kematian');
                $no_kk                              = $this->request->getVar('no_kk');
                $keterangan                         = $this->request->getVar('keterangan');
              
                $data = [
                    'kabkot'                            => sess_region(),
                    'kecamatan'                         => sess_kecamatan(),
                    'kelurahan'                         => sess_kelurahan(),
                    'kode_register'                     => $kode_register,
                    'status_perceraian_sebelum_cerai'   => $status_perceraian_sebelum_cerai,
                    'no_buku_nikah'                     => $no_buku_nikah,
                    'tgl_buku_nikah'                    => $tgl_buku_nikah,
                    'sebab_perceraian'                  => $sebab_perceraian,
                    'status_cerai_hidup'                => $status_cerai_hidup,
                    'no_akta_cerai'                     => $no_akta_cerai,
                    'tgl_akta_cerai'                    => $tgl_akta_cerai,
                    'no_putusan_pengadilan'             => $no_putusan_pengadilan,
                    'tgl_putusan_pengadilan'            => $tgl_putusan_pengadilan,
                    'cerai_mati'                        => $cerai_mati,
                    'no_akta_kematian'                  => $no_akta_kematian,
                    'tgl_akta_kematian'                 => $tgl_akta_kematian,
                    'no_kk'                             => $no_kk,
                    'keterangan'                        => $keterangan,
                ];

                if(!empty($id)){
                    $this->CeraiModel->update($id,$data);
                }else{
                    $this->CeraiModel->insert($data);
                    $id = $this->CeraiModel->getInsertID();
                }

                $this->log->create('Meanambah Data Perceraian oleh '.sess_role_name());
                
                $msg = [
                    'id'     => $id,
                    'sukses' => 'Disimpan'
                ];

            }

            echo json_encode($msg);
        }
    }

    public function createPihak(){
        $id = $this->request->getVar('id');
        // Pastikan id valid dan milik kelurahan ini
        $perceraian = null;
        if (!empty($id)) {
            $perceraian = $this->CeraiModel->find($id);
        }

        if (empty($perceraian)) {
            return redirect()->to('admin/kel/cerai/create');
        }

        // Load data pihak yang sudah tersimpan (jika ada), untuk isi ulang form saat kembali
        $pihakSuami = $this->CeraiPihakModel
                          ->where('perceraian_id', $id)
                          ->where('jenis_pihak', 'Suami')
                          ->first();

        $pihakIstri = $this->CeraiPihakModel
                          ->where('perceraian_id', $id)
                          ->where('jenis_pihak', 'Istri')
                          ->first();

        $data = [
            'title'         => 'INPUT DATA PIHAK PERCERAIAN',
            'menu_active'   => 'master',
            'menu_sub'      => 'cerai_create',
            'content'       => 'App\Views\cerai\kelurahan\cerai_create_pihak_view',
            'perceraian'    => $perceraian,
            'pihakSuami'    => $pihakSuami ?? [],
            'pihakIstri'    => $pihakIstri ?? [],
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }
    /**
     * AJAX: Simpan data pihak perceraian (suami & istri)
    */
    public function saveStep2(){
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'nik_suami' => [
                    'label' => 'NIK suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
                'nama_lengkap_suami' => [
                    'label' => 'Nama lengkap suami',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ], 
                'nik_istri' => [
                    'label' => 'NIK istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
                'nama_lengkap_istri' => [
                    'label' => 'Nama lengkap istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
                'nik_istri' => [
                    'label' => 'NIK istri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib diisi',
                    ]
                ],
            ]);

            if (!$valid) {
                
                $msg = [
                    'error' => [
                        'err_nik_suami'             => $validation->getError('nik_suami'),
                        'err_nama_lengkap_suami'    => $validation->getError('nama_lengkap_suami'),
                        'err_nik_istri'             => $validation->getError('nik_istri'),
                        'err_nama_lengkap_istri'    => $validation->getError('nama_lengkap_istri'),
                    ]
                ];

            }else{
                $id                                 = $this->request->getVar('perceraian_id');

                $dataPihak = [
                    
                    [
                        'perceraian_id' => $id,
                        'jenis_pihak'   => 'SUAMI',
                        'nik'           => $this->request->getPost('nik_suami'),
                        'nama_lengkap'  => $this->request->getPost('nama_lengkap_suami'),
                        'tempat_lahir'  => $this->request->getPost('tempat_lahir_suami'),
                        'tanggal_lahir' => $this->request->getPost('tanggal_lahir_suami'),
                        'agama'         => $this->request->getPost('agama_suami'),
                        'pekerjaan'     => $this->request->getPost('pekerjaan_suami'),
                        'alamat'        => $this->request->getPost('alamat_suami'),
                    ],

                    [
                        'perceraian_id' => $id,
                        'jenis_pihak'   => 'ISTRI',
                        'nik'           => $this->request->getPost('nik_istri'),
                        'nama_lengkap'  => $this->request->getPost('nama_lengkap_istri'),
                        'tempat_lahir'  => $this->request->getPost('tempat_lahir_istri'),
                        'tanggal_lahir' => $this->request->getPost('tanggal_lahir_istri'),
                        'agama'         => $this->request->getPost('agama_istri'),
                        'pekerjaan'     => $this->request->getPost('pekerjaan_istri'),
                        'alamat'        => $this->request->getPost('alamat_istri'),
                    ]

                ];

                $cekSuami = $this->CeraiPihakModel
                                ->where('perceraian_id', $id)
                                ->where('jenis_pihak', 'SUAMI')
                                ->first();

                $cekIstri = $this->CeraiPihakModel
                                ->where('perceraian_id', $id)
                                ->where('jenis_pihak', 'ISTRI')
                                ->first();

                if (!empty($cekSuami)) {
                    $this->CeraiPihakModel->update($cekSuami['id'], $dataPihak[0]);
                } else {
                    $this->CeraiPihakModel->insert($dataPihak[0]);
                }

                if (!empty($cekIstri)) {
                    $this->CeraiPihakModel->update($cekIstri['id'], $dataPihak[1]);
                } else {
                    $this->CeraiPihakModel->insert($dataPihak[1]);
                }

                $this->log->create('Meanambah Data Perceraian oleh '.sess_full_name());
                
                $msg = [
                    'id'     => $id,
                    'sukses' => 'Disimpan'
                ];

            }

            echo json_encode($msg);
        }
    }

    public function createDokumen(){
        $id = $this->request->getVar('id');

        $perceraian = null;
        if (!empty($id)) {
            $perceraian = $this->CeraiModel->find($id);
        }

        if (empty($perceraian)) {
            return redirect()->to('admin/kel/cerai/create');
        }

        $data = [
            'title'       => 'INPUT DOKUMEN PERCERAIAN',
            'menu_active' => 'master',
            'menu_sub'    => 'cerai_create',
            'content'     => 'App\Views\cerai\kelurahan\cerai_create_dokumen_view',
            'perceraian'  => $perceraian,
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

    /**
     * AJAX: Simpan dokumen (file_1, file_2) ke tabel perceraian
     * Mengembalikan JSON { sukses: '...', id: xxx } atau { error: {...} }
     */
    public function saveStep3(){
        if ($this->request->isAJAX()) {

            $id = $this->request->getPost('perceraian_id');

            // Pastikan data perceraian ada
            $perceraian = $this->CeraiModel->find($id);
            if (empty($perceraian)) {
                echo json_encode(['error' => ['err_perceraian_id' => 'Data perceraian tidak ditemukan']]);
                return;
            }

            $file1 = $this->request->getFile('file_1');
            $file2 = $this->request->getFile('file_2');

            $uploadPath = ROOTPATH . 'public/uploads/cerai/';

            $dataUpdate = [];

            // ── Proses file_1 ────────────────────────────────────────
            if ($file1 && $file1->isValid() && !$file1->hasMoved()) {
                // Hapus file lama jika ada
                if (!empty($perceraian['file_1']) && file_exists($uploadPath . $perceraian['file_1'])) {
                    unlink($uploadPath . $perceraian['file_1']);
                }
                $namaFile1 = $file1->getRandomName();
                $file1->move($uploadPath, $namaFile1);
                $dataUpdate['file_1'] = $namaFile1;
            }

            // ── Proses file_2 ────────────────────────────────────────
            if ($file2 && $file2->isValid() && !$file2->hasMoved()) {
                // Hapus file lama jika ada
                if (!empty($perceraian['file_2']) && file_exists($uploadPath . $perceraian['file_2'])) {
                    unlink($uploadPath . $perceraian['file_2']);
                }
                $namaFile2 = $file2->getRandomName();
                $file2->move($uploadPath, $namaFile2);
                $dataUpdate['file_2'] = $namaFile2;
            }

            // Update hanya jika ada file yang diupload
            if (!empty($dataUpdate)) {
                $this->CeraiModel->update($id, $dataUpdate);
            }

            $this->log->create('Menyimpan dokumen perceraian id:' . $id . ' oleh ' . sess_full_name());

            echo json_encode([
                'sukses' => 'Dokumen berhasil disimpan',
                'id'     => $id,
            ]);
        }
    }


    public function detail($id){
        $perceraian = $this->CeraiModel
                            ->join('kabkot','kabkot.kode_kabkot = perceraian.kabkot','inner')
                            ->join('ref_kecamatan','ref_kecamatan.kecamatan_id = perceraian.kecamatan','inner')
                            ->join('ref_kelurahan','ref_kelurahan.kelurahan_id = perceraian.kelurahan','inner')
                            ->find($id);

        if (empty($perceraian)) {
            return redirect()->to('admin/kel/cerai');
        }

        $pihakSuami = $this->CeraiPihakModel
                          ->where('perceraian_id', $id)
                          ->where('jenis_pihak', 'SUAMI')
                          ->first();

        $pihakIstri = $this->CeraiPihakModel
                          ->where('perceraian_id', $id)
                          ->where('jenis_pihak', 'ISTRI')
                          ->first();

        $data = [
            'title'       => 'DETAIL DATA PERCERAIAN',
            'menu_active' => 'master',
            'menu_sub'    => 'cerai',
            'content'     => 'App\Views\cerai\kelurahan\cerai_detail_view',
            'perceraian'  => $perceraian,
            'pihakSuami'  => $pihakSuami ?? [],
            'pihakIstri'  => $pihakIstri ?? [],
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

    public function delete($id){
        $getDataById = $this->CeraiModel->select('id,file_1,file_2')->where('id',$id)->first();

        $files = [
            $getDataById['file_1'],
            $getDataById['file_2']
        ];

        foreach ($files as $file) {
            $path = FCPATH . 'uploads/cerai/' . $file;

            if (!empty($file) && file_exists($path) && is_file($path)) {
                unlink($path);
            }
        }

        $this->CeraiModel->delete($getDataById['id']);

        session()->setFlashdata('message', 'Berhasil hapus data');                    
        return redirect()->to('admin/kel/cerai')->withInput();
    } 

}
