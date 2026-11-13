<?php 
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

class Laporan extends BaseController
{
    protected $CeraiModel;
    protected $log;
    protected $kabkotModel;
    protected $kecamatanModel;
    protected $kelurahanModel;

    public function __construct(){
        $this->CeraiModel       = new CeraiModel();
        $this->log              = new LogAktifitas();
        $this->kabkotModel      = new KabkotModel();
        $this->kecamatanModel   = new KecamatanModel();
        $this->kelurahanModel   = new KelurahanModel();
    }

    public function index(){
        /*Ket :
            1 = Semua
            2 = Tercatat
            3 = Tidak Tercatat 
        */
        $Export  = $this->request->getVar('export');
        $jenis   = $this->request->getVar('jenis');
        $awal    = $this->request->getVar('awal');
        $akhir   = $this->request->getVar('akhir');
        $rows    = [];
        $wilayah = [];

        if (!empty($jenis) && !empty($awal) && !empty($akhir)) {

            $db      = db_connect();
            $builder = $db->table('perceraian_pihak')
                          ->select('
                              perceraian_pihak.nik,
                              perceraian_pihak.nama_lengkap,
                              perceraian_pihak.tempat_lahir,
                              perceraian_pihak.tanggal_lahir,
                              perceraian_pihak.jenis_pihak,
                              perceraian_pihak.agama,
                              perceraian_pihak.pekerjaan,
                              perceraian_pihak.alamat,
                              perceraian.status_perceraian_sebelum_cerai,
                              perceraian.no_buka_nikah,
                              perceraian.tgl_buku_nikah,
                              perceraian.sebab_perceraian,
                              perceraian.status_cerai_hidup,
                              perceraian.cerai_mati,
                              perceraian.no_akta_cerai,
                              perceraian.tgl_akta_cerai,
                              perceraian.no_akta_kematian,
                              perceraian.tgl_akta_kematian,
                              perceraian.keterangan,
                              perceraian.created_at
                          ')
                          ->join('perceraian', 'perceraian.id = perceraian_pihak.perceraian_id', 'inner')
                          ->where('perceraian.kelurahan', sess_kelurahan())
                          ->where('DATE(perceraian.created_at) >=', $awal)
                          ->where('DATE(perceraian.created_at) <=', $akhir)
                          ->orderBy('perceraian.id', 'ASC')
                          ->orderBy("CASE WHEN perceraian_pihak.jenis_pihak = 'SUAMI' THEN 1 ELSE 2 END", '', false);

            // jenis == 1 : Semua (tidak perlu filter status)
            // jenis == 2 : Tercatat
            // jenis == 3 : Tidak Tercatat

            if ($jenis == 2) {
                $builder->where('perceraian.no_akta_cerai !=', null);
            } elseif ($jenis == 3) {
                $builder->where('perceraian.no_akta_cerai', null);
            }

            $rows = $builder->get()->getResultArray();

            // Data wilayah untuk header laporan
            $wilayah = $this->kabkotModel
                            ->select('ref_kota.kota_nama, ref_kecamatan.kecamatan_nama, ref_kelurahan.kelurahan_nama')
                            ->where('ref_kota.kota_id', sess_region())
                            ->join('ref_kecamatan', 'ref_kecamatan.kota_id = ref_kota.kota_id')
                            ->join('ref_kelurahan', 'ref_kelurahan.kecamatan_id = ref_kecamatan.kecamatan_id')
                            ->where('ref_kecamatan.kecamatan_id', sess_kecamatan())
                            ->where('ref_kelurahan.kelurahan_id', sess_kelurahan())
                            ->first();
        }

        $data = [
            'title'         => 'REKAPAN DATA',
            'menu_active'   => 'master',
            'menu_sub'      => 'laporan',
            'jenis'         => $jenis   ?? '',
            'awal'          => $awal    ?? '',
            'akhir'         => $akhir   ?? '',
            'data'          => $rows,
            'total'         => count($rows),
            'wilayah'       => $wilayah ?? [],
            'content'       => 'App\Views\laporan\laporan_kelurahan_view',
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

}
