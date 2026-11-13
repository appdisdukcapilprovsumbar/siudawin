<?php 
 namespace App\Controllers; 

 use CodeIgniter\Controller;
 use App\Models\AuthUserAccountModel;
 use App\Models\KecamatanModel;
 use App\Models\PerkawinanModel;

class Dashboard_kabkot extends BaseController
{   
    protected $authModel;
    protected $kecamatanModel;
    protected $perkawinanModel;

    public function __construct()
    {
        $this->authModel        = new AuthUserAccountModel();
        $this->kecamatanModel   = new KecamatanModel();
        $this->perkawinanModel  = new PerkawinanModel();
    }

    public function index(){ 
        
        $kabkot = sess_region();
        
        $user = $this->authModel->where('region',$kabkot)->whereIn('auth_user_account.role_access_id',[4,10,11])->countAllResults();

        $data = [
            'menu_active'      => 'dashboard',
            'menu_sub'         => '',
            'title'            => 'Dashboard',
            'CountUser'        => $user,
            'chartData'        => $this->perkawinanModel->select('MONTH(tgl_akad_nikah) as bulan, COUNT(DISTINCT no_pasangan) as total')->where('perkawinan.kabkot',sess_region())->where('YEAR(tgl_akad_nikah)', date('Y'))->groupBy('bulan')->orderBy('bulan')->findAll(),
            'content'          => 'App\Views\dashboard_kabkot_view',
            'user'             => $this->authModel->getAllUser(),
        ];

        return view('App\Views\layout_admin\wrapper', $data);
    }

    
}
