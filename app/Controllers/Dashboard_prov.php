<?php 
 namespace App\Controllers; 

 use CodeIgniter\Controller;
 use App\Models\AuthUserAccountModel;
 use App\Models\PerkawinanModel;
 use App\Models\KabkotModel;

class Dashboard_prov extends BaseController
{   
    protected $authModel;
    protected $kabkotModel;
    protected $perkawinanModel;

    public function __construct()
    {
        $this->authModel        = new AuthUserAccountModel();
        $this->perkawinanModel  = new PerkawinanModel();
        $this->kabkotModel      = new KabkotModel();
    }

    public function index(){ 
        $user       = $this->authModel->whereIn('auth_user_account.role_access_id',[2,4,10,11])->countAllResults();
        
        $data = [
            'menu_active'      => 'dashboard',
            'menu_sub'         => '',
            'title'            => 'Dashboard',
            'CountUser'        => $user,
            'kabkot'           => $this->kabkotModel->where('provinsi_id',13)->find(),
            'content'          => 'App\Views\dashboard_prov_view',
            'user'             => $this->authModel->getAllUser(),
            'chartData'        => $this->perkawinanModel->select('MONTH(tgl_akad_nikah) as bulan, COUNT(DISTINCT no_pasangan) as total')->where('YEAR(tgl_akad_nikah)', date('Y'))->groupBy('bulan')->orderBy('bulan')->findAll(),
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

    
}
