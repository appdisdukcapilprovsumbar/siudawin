<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\kabkot;
  
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
            'menu_active'   => 'master',
            'menu_sub'      => 'perkawinan',
            'kabkot'        => $this->kabkotModel->select('kota_id,kota_nama')->where('provinsi_id',13)->find(),
            'content'       => 'App\Views\perkawinan\kabkot\perkawinan_view',
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
                       ->where('kabkot',sess_region())
                      ->orderBy('id','DESC');
        return DataTable::of($builder)
        ->add('action', function($row){
            return '<a href="'.base_url('admin/perkawinan/detail/'.$row->no_pasangan).'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>';
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
        ->addNumbering('no')
        ->toJson(true);
    }


}
