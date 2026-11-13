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

class LaporanPerkawinan extends BaseController
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
        $dataKematian = [];

        $kecamatan = $this->request->getVar('kecamatan');
        $kelurahan = $this->request->getVar('kelurahan');

        if($kecamatan && $kelurahan){
            $dataKematian = $this->perkawinanModel->where('kecamatan',$kecamatan)->where('kelurahan',$kelurahan)->orderBy('id','DESC')->findAll();
        }
        
        $data = [
            'title'         => 'LAPORAN PERKAWINAN',
            'menu_active'   => 'master',
            'menu_sub'      => 'laporan_perkawinan_kabkot',
            'getkecamatan'  => $this->kecamatanModel->select('kecamatan_id,kecamatan_nama')->where('kota_id',sess_region())->find(),
            'dataKematian'  => $dataKematian,
            'content'       => 'App\Views\perkawinan\kabkot\laporan_perkawinan_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }
}