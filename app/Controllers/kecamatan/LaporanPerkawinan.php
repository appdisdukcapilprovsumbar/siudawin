<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\kecamatan;
  
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

        $tahun = $this->request->getVar('tahun') ?? null; 
        $bulan = $this->request->getVar('bulan') ?? null;

        $judulBulan = ($bulan != null) ? strtoupper(get_mouth_olny($bulan)) : '';
        $judulTahun = ($tahun != null) ? $tahun : '';

        $kabkot = $this->kabkotModel->where('kota_id',sess_region())->first();
        $kec    = $this->kecamatanModel->where('kecamatan_id',sess_kecamatan())->first();

        $title = 'LAPORAN PERKAWINAN ' . $judulBulan . ' ' . $judulTahun .' '.strtoupper($kec['kecamatan_nama']).'';
        
        $data = [
            'title'         => $title,
            'menu_active'   => 'master',
            'menu_sub'      => 'laporan_perkawinan_kec',
            'getkec'        => $this->kelurahanModel->select('kelurahan_id,kelurahan_nama')->where('kecamatan_id',$kec['kecamatan_id'])->find(),
            'tahun'         => $tahun,
            'bulan'         => $bulan,
            'content'       => 'App\Views\perkawinan\kecamatan\laporan_perkawinan_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }
}