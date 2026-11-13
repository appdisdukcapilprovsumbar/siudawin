<?php 
 namespace App\Controllers; 

 use CodeIgniter\Controller;
 use App\Models\AuthUserAccountModel;
 use App\Models\KelurahanModel;
 use App\Models\PerkawinanModel;

class Dashboard_kec extends BaseController
{   
    protected $authModel;
    protected $kelurahanModel;
    protected $perkawinanModel;

    public function __construct()
    {
        $this->authModel        = new AuthUserAccountModel();
        $this->kelurahanModel   = new KelurahanModel();
        $this->perkawinanModel  = new PerkawinanModel();
    }

    public function index(){ 
        
        $kecamatan = sess_kecamatan();

        $data = [
            'menu_active'      => 'dashboard',
            'menu_sub'         => '',
            'title'            => 'Dashboard',
            'chartData'        => $this->perkawinanModel->select('MONTH(tgl_akad_nikah) as bulan, COUNT(DISTINCT no_pasangan) as total')->where('perkawinan.kecamatan',sess_kecamatan())->where('YEAR(tgl_akad_nikah)', date('Y'))->groupBy('bulan')->orderBy('bulan')->findAll(),
            'content'          => 'App\Views\dashboard_kecamatan_view',
            'user'             => $this->authModel->getAllUser(),
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

    
}
