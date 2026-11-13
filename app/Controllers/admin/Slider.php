<?php 
/**
 * This is Dashboard Modules Controller
 */
 namespace App\Controllers\admin;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Models\SlideModel;

class Slider extends BaseController
{

    private $slide_m;

    public function __construct(){
        $this->slide_m = new SlideModel();
    }

    public function index(){

        $data = [
            'title'         => 'Banner',
            'menu_active'   => 'sistem',
            'menu_sub'      => 'slide',
            'content'       => 'App\Views\admin\slide_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function slide_list()
    {
        $db = db_connect();
        $builder = $db->table('slider')
                      ->select('slide_id,slide_judul,slide_patch,slide_size,created_at')
                      ->orderBy('slide_id','DESC');
        return DataTable::of($builder)

        ->add('action', function($row){
            return '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit"  onclick="edit_data('.$row->slide_id.')"><i class="fas fa-pen"></i></button> 
            <button type="button" class="btn btn-danger btn-sm"  onclick="hapus('.$row->slide_id.')"><i class="fas fa-trash"></i></button>';
        }, 'last')

        ->format('slide_size', function($value){
           return $value . ' KB';
        })

        ->format('slide_patch', function($value){
           return '<img src="' . base_url('uploads/slide/') .'/'. $value . '" width="150px;">';
        })

        ->addNumbering('nomor')
        ->hide('slide_id')
        ->format('created_at', function($value){
            return indonesia_date($value);
        })
        ->toJson();
    }

    public function insert_data(){
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'tambahJudul' => [
                    'label' => 'Judul Slide',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ], 
                
                'tambahFile' => [
                    'label' => 'Upload File',
                    'rules' => 'uploaded[tambahFile]',
                    'errors' => [
                        'uploaded' => '{field} Wajib diisi',
                    ]
                ], 

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'errorJudul'    => $validation->getError('tambahJudul'),
                        'errorFile'     => $validation->getError('tambahFile'),
                    ]
                ];
            }else{

                $judul     = $this->request->getVar('tambahJudul');
                $file      = $this->request->getFile('tambahFile');

                $file_n = $file->getName();
                $beda = date('dmYHis');
                $fileType = $file->guessExtension();
                $kilobytes = $file->getSizeByUnit('kb');
                $name_file = $beda . str_replace(" ", "-", $file_n);
    
                $file->move('uploads/slide',$name_file);
                
                $data = [
                    'slide_judul'   => $judul,
                    'slide_patch'   => $name_file,
                    'slide_tipe'    => $fileType,
                    'slide_size'    => $kilobytes,
                ];

                $this->slide_m->insert($data);

                $msg = [
                    'sukses' => 'Berhasil'
                ];                
                
            }

            echo json_encode($msg);
        }
    }

    public function update_data(){
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'editJudul' => [
                    'label' => 'Judul Slide',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ],  

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'erroreditJudul' => $validation->getError('editJudul'),
                    ]
                ];
            }else{

                $id        = $this->request->getVar('id');
                $judul     = $this->request->getVar('editJudul');
                $file      = $this->request->getFile('editFile');
                $check_file    = $_FILES['editFile']['name'];

                if ($check_file == null ) {
                    
                    $data = [
                        'slide_judul'   => $judul,
                    ];

                    $this->slide_m->update($id,$data);

                    $msg = [
                        'sukses' => 'Berhasil'
                    ]; 

                }else{

                    $file_n = $file->getName();
                    $beda = date('dmYHis');
                    $fileType = $file->guessExtension();
                    $kilobytes = $file->getSizeByUnit('kb');
                    $name_file = $beda . str_replace(" ", "-", $file_n);
        
                    $file->move('uploads/slide',$name_file);
                    
                    $cek = $this->slide_m->find($id);
                    
                    if($cek['slide_patch'] != null){
                        if (file_exists('uploads/slide/'.$cek['slide_patch'])) {
                            unlink('uploads/slide/'.$cek['slide_patch']);
                        }
                    }

                    $data = [
                        'slide_judul'   => $judul,
                        'slide_patch'   => $name_file,
                        'slide_tipe'    => $fileType,
                        'slide_size'    => $kilobytes,
                    ];

                    $this->slide_m->update($id,$data);

                    $msg = [
                        'sukses' => 'Berhasil'
                    ]; 

                }         
                
            }

            echo json_encode($msg);
        }
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        $data = $this->slide_m->find($id);

        return json_encode($data);
    }

    public function delete(){

        if($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $upload_path = $this->slide_m->find($id);

            if($this->slide_m->where('slide_id',$id)->delete()){
                
                if ($upload_path['slide_patch'] == null) {
                
                }else{
                    unlink(FCPATH .'/uploads/slide/'. $upload_path['slide_patch']);
                }

                $result = [
                    'success' => true,
                ]; 
            }
        }
        return json_encode($result);
    }

}
