<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\admin;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Libraries\LogAktifitas;
 use App\Models\PerkawinanModel;
 use App\Models\KabkotModel;
 use App\Models\KecamatanModel;
 use App\Models\KelurahanModel;

class Perkawinan extends BaseController
{
    protected $perkawinanModel;
    protected $log;
    protected $kabkotModel;
    protected $kecamatanModel;
    protected $kelurahanModel;

    public function __construct(){
        $this->perkawinanModel  = new PerkawinanModel();
        $this->log              = new LogAktifitas();
        $this->kabkotModel      = new KabkotModel();
        $this->kecamatanModel   = new KecamatanModel();
        $this->kelurahanModel   = new KelurahanModel();
    }

    public function index(){

        $data = [
            'title'         => 'PERKAWINAN',
            'menu_active'   => 'perkawinan',
            'menu_sub'      => '',
            'kabkot'        => $this->kabkotModel->select('kota_id,kota_nama')->where('provinsi_id',13)->find(),
            'content'       => 'App\Views\perkawinan\perkawinan_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function detail($no_pasangan){
        $data = [
            'title'         => 'DETAIL',
            'menu_active'   => 'perkawinan',
            'menu_sub'      => 'perkawinan',
            'spesifik_data' =>  $this->perkawinanModel->select('nik,nama,hub_kawin,tmp_lahir,tgl_lahir,agama,alamat,nama_ortu_ayah,nama_ortu_ibu')->where('no_pasangan',$no_pasangan)->find(),
            'base_data'     => $this->perkawinanModel->select('nama_kabkot,kecamatan_nama,kelurahan_nama,no_pasangan,tmp_akad_nikah,tgl_akad_nikah,agama_wali_nikah,nama_wali,alamat_wali,status_perkawinan,no_buku_nikah,ket')
                                                   ->join('kabkot','kabkot.kode_kabkot = perkawinan.kabkot')
                                                   ->join('ref_kecamatan','ref_kecamatan.kecamatan_id = perkawinan.kecamatan')
                                                   ->join('ref_kelurahan','ref_kelurahan.kelurahan_id = perkawinan.kelurahan')
                                                   ->where('no_pasangan',$no_pasangan)->first(),
            'content'       => 'App\Views\perkawinan\perkawinan_detail_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function getAll(){
        $db = db_connect();
        $builder = $db->table('perkawinan')
                      ->select('id,
                                nik,
                                nama,
                                hub_kawin,
                                nama_kabkot,
                                kecamatan_nama,
                                status_perkawinan,
                                no_buku_nikah,
                                no_pasangan,
                                perkawinan.created_at')
                       ->join('kabkot','kabkot.kode_kabkot = perkawinan.kabkot')
                       ->join('ref_kecamatan','ref_kecamatan.kecamatan_id = perkawinan.kecamatan')
                      ->orderBy('no_pasangan','DESC');
        return DataTable::of($builder)
        ->add('action', function($row){
            return '<a href="'.base_url('admin/perkawinan/detail/'.$row->no_pasangan).'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
            <button type="button" title="Hapus Data" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete"  onclick="deleteData('.$row->id.')"><i class="fas fa-trash"></i></button>';
        }, 'last')
        ->format('created_at', function($value){
            return indonesia_date($value);
        })

        ->format('status', function($value){
            if($value == 'Pending'){
                return '<div class="btn btn-sm btn-warning">'.$value.'<div>';
            }elseif($value == 'Approved'){
                return '<div class="btn btn-sm btn-success">'.$value.'<div>';
            }else{
                return '<div class="btn btn-sm btn-danger">Rejected<div>';
            }
        })

        ->hide('id')
        ->hide('no_pasangan')
        ->addNumbering('no')
        ->toJson(true);
    }

    public function getKecamatanByKabkot(){
        if ($this->request->isAJAX()) {
            $kabkot_id = $this->request->getVar('kota_id');
            $data = $this->kecamatanModel->select('kecamatan_id, kecamatan_nama')
                                        ->where('kota_id', $kabkot_id)
                                        ->findAll();
            return json_encode($data);
        }
    }

    public function getKelurahanByKecamatan(){
        if ($this->request->isAJAX()) {
            $kecamatan_id = $this->request->getVar('kecamatan_id');
            $data = $this->kelurahanModel->select('kelurahan_id, kelurahan_nama')
                                        ->where('kecamatan_id', $kecamatan_id)
                                        ->findAll();
            return json_encode($data);
        }
    }

    public function getById(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = $this->perkawinanModel->find($id);
            return json_encode($data);
        }
    }
    public function delete(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->perkawinanModel->delete($id);
            $msg = [
                'sukses' => "berhasil dihapus",
            ];

            return json_encode($msg);
        }
    }

    function verify(){
        
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            
            $valid = $this->validate([ 
                'verifyStatus' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ],
                

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'errorverifyStatus'  => $validation->getError('verifyStatus'),
                    ]
                ];
            }else{
                $id         = $this->request->getVar('verifyIdKematian');
                $nik        = $this->request->getVar('verifyNik');
                $status     = $this->request->getVar('verifyStatus');
                
                $data = [
                    'status'   => $status,
                ];
                
                $this->perkawinanModel->update($id,$data);
                $this->log->create('Verifikasi data kematian dengan nik : '.$nik.' '.sess_full_name());

                $msg = [
                    'sukses' => 'Berhasil'
                ];
                    
            }

            echo json_encode($msg);
        }
    }


}
