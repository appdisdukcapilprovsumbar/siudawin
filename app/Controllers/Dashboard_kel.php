<?php 
 namespace App\Controllers; 

 use CodeIgniter\Controller;
 use App\Models\AuthUserAccountModel;
 use App\Models\PerkawinanModel;

class Dashboard_kel extends BaseController
{   
    protected $authModel;
    protected $perkawinanModel;

    public function __construct()
    {
        $this->authModel        = new AuthUserAccountModel();
        $this->perkawinanModel  = new PerkawinanModel();
    }

    public function index(){ 
        $data = [
            'menu_active'      => 'dashboard',
            'menu_sub'         => '',
            'title'            => 'Dashboard',
            'content'          => 'App\Views\dashboard_kelurahan_view',
            'perkawinan'       => $this->perkawinanModel->where('kelurahan',sess_kelurahan())->groupBy('no_pasangan')->countAllResults(),
            'chartData'        => $this->perkawinanModel->select('MONTH(tgl_akad_nikah) as bulan, COUNT(DISTINCT no_pasangan) as total')->where('perkawinan.kelurahan',sess_kelurahan())->where('YEAR(tgl_akad_nikah)', date('Y'))->groupBy('bulan')->orderBy('bulan')->findAll(),
        ];

        return view('App\Views\layout_admin\wrapper', $data);
    }

    
}
