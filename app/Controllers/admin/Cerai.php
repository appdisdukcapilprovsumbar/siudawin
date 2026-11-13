<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\admin;
  
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
            'content'       => 'App\Views\cerai\prov\cerai_view',
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
            <a href="'.base_url('admin/prov/cerai/detail/'.$row->perceraian_id).'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>';
        }, 'last')
        ->format('created_at', function($value){
            return indonesia_date($value);
        })
        ->hide('id')
        ->hide('perceraian_id')
        ->addNumbering('no')
        ->toJson();
    }

    public function detail($id){
        $perceraian = $this->CeraiModel
                            ->join('kabkot','kabkot.kode_kabkot = perceraian.kabkot','inner')
                            ->join('ref_kecamatan','ref_kecamatan.kecamatan_id = perceraian.kecamatan','inner')
                            ->join('ref_kelurahan','ref_kelurahan.kelurahan_id = perceraian.kelurahan','inner')
                            ->find($id);

        if (empty($perceraian)) {
            return redirect()->to('admin/kabkot/cerai');
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
            'content'     => 'App\Views\cerai\prov\cerai_detail_view',
            'perceraian'  => $perceraian,
            'pihakSuami'  => $pihakSuami ?? [],
            'pihakIstri'  => $pihakIstri ?? [],
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

}
