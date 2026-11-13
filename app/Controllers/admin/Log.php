<?php 

 namespace App\Controllers\admin;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Models\LogModel; 

class Log extends BaseController
{
    protected $logModel;

    public function __construct(){
        $this->logModel = new LogModel();
    }

    public function index() {
        $data = [
            'title'         => 'LOG AKTIVITAS',
            'menu_active'   => 'log',
            'menu_sub'      => '',
            'content'       => 'App\Views\admin\settings\log_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function get_data(){

       if (sess_role_code() == 'root') {
            $db = db_connect();
            $builder = $db->table('log')->select('id_log,nama_user,ket,created_at')->orderBy('id_log','DESC');
            return DataTable::of($builder)

            ->add('action', function($row){
                return '<button type="button" title="Hapus Data" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete"  onclick="delete_data('.$row->id_log.')"><i class="fas fa-trash"></i></button>';
            }, 'last')
            ->addNumbering('nomor')
            ->hide('id_log')
            ->format('created_at', function($value){
                return indonesia_date($value);
            })
            ->toJson();
        }else{
             $db = db_connect();
            $builder = $db->table('log')->select('id_log,nama_user,ket,created_at')->orderBy('id_log','DESC');
            return DataTable::of($builder)
            ->addNumbering('nomor')
            ->hide('id_log')
            ->format('created_at', function($value){
                return indonesia_date($value);
            })
            ->toJson();
        }
    }

    public function delete(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->logModel->delete($id);
            
            $msg = [
                'sukses' => "Berhasil hapus data log aktivitas",
            ];

            return json_encode($msg);
        }
    }   

}
