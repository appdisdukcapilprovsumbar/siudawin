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

class LaporanPerkawinan extends BaseController
{
    protected $kematianModel;
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

        $kabkot     = $this->request->getVar('kabkot');
        $kecamatan  = $this->request->getVar('kecamatan');
        $kelurahan  = $this->request->getVar('kelurahan');
        $tahun      = $this->request->getVar('tahun');
        $bulan      = $this->request->getVar('bulan');
        $wl = '';
        $bulanIni = '';
        $janSampaiBulanIni = '';
        $totalKeseluruhan = '';
        $terbit = '';             
        $proses = '';            
        $belumTerbit = '';
        
        if($kabkot != null && $kecamatan == null && $kelurahan == null){
            $bulanIni           = $this->kematianModel->getJumlahBulanIniKabkot($kabkot,$tahun,$bulan);
            $janSampaiBulanIni  = $this->kematianModel->getJumlahJanSampaiBulanIniKabkot($kabkot,$tahun,$bulan);
            $totalKeseluruhan   = $this->kematianModel->getTotalKeseluruhanKabkot($kabkot);

            $terbit             = $this->kematianModel->getJumlahBulanIniKabkotTerbit($kabkot,$tahun,$bulan);
            $proses             = $this->kematianModel->getJumlahBulanIniKabkotProses($kabkot,$tahun,$bulan);
            $belumTerbit        = $this->kematianModel->getJumlahBulanIniKabkotBelumTerbit($kabkot,$tahun,$bulan);

            $row = $this->kabkotModel->where('kota_id',$kabkot)->first();
            $wl = $row['kota_nama'];
        }

        if($kabkot != null && $kecamatan != null && $kelurahan == null){

            $bulanIni           = $this->kematianModel->getJumlahBulanIniKecamatan($kecamatan,$tahun,$bulan);
            $janSampaiBulanIni  = $this->kematianModel->getJumlahJanSampaiBulanIniKecamatan($kecamatan,$tahun,$bulan);
            $totalKeseluruhan   = $this->kematianModel->getTotalKeseluruhanKecamatan($kecamatan);

            $terbit             = $this->kematianModel->getJumlahBulanIniKecamatanTerbit($kecamatan,$tahun,$bulan);
            $proses             = $this->kematianModel->getJumlahBulanIniKecamatanProses($kecamatan,$tahun,$bulan);
            $belumTerbit        = $this->kematianModel->getJumlahBulanIniKecamatanBelumTerbit($kecamatan,$tahun,$bulan);

            $row = $this->kecamatanModel->where('kecamatan_id',$kecamatan)->first();
            $wl =  strtoupper('KECAMATAN '.$row['kecamatan_nama']);
            
        }
        if($kabkot != null && $kecamatan != null && $kelurahan != null){
            $bulanIni           = $this->kematianModel->getJumlahBulanIniKelurahan($kelurahan,$tahun,$bulan);
            $janSampaiBulanIni  = $this->kematianModel->getJumlahJanSampaiBulanIniKelurahan($kelurahan,$tahun,$bulan);
            $totalKeseluruhan   = $this->kematianModel->getTotalKeseluruhanKelurahan($kelurahan);

            $terbit             = $this->kematianModel->getJumlahBulanIniKelurahanTerbit($kelurahan,$tahun,$bulan);
            $proses             = $this->kematianModel->getJumlahBulanIniKelurahanProses($kelurahan,$tahun,$bulan);
            $belumTerbit        = $this->kematianModel->getJumlahBulanIniKelurahanBelumTerbit($kelurahan,$tahun,$bulan);

            $row = $this->kelurahanModel->where('kelurahan_id',$kelurahan)->first();
            $wl = strtoupper('KELURAHAN '.$row['kelurahan_nama']);
        }
        
        $data = [
            'title'             => 'LAPORAN KEMATIAN '.$wl,
            'menu_active'       => 'laporan_perkawinan_prov',
            'menu_sub'          => 'laporan_perkawinan_prov',
            'getkabkot'         => $this->kabkotModel->select('kota_id,kota_nama')->where('provinsi_id','13')->find(),
            'dataKematian'      => $dataKematian,
            'bulanIni'          => $bulanIni,
            'janSampaiBulanIni' => $janSampaiBulanIni,
            'totalKeseluruhan'  => $totalKeseluruhan,
            'wl'                => $wl,
            'terbit'            => $terbit,        
            'proses'            => $proses, 
            'belumTerbit'       => $belumTerbit,
            'content'           => 'App\Views\perkawinan\laporan_perkawinan_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }
}