<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\kelurahan;
  
 use App\Controllers\BaseController;
 use CodeIgniter\Controller;
 use \Hermawan\DataTables\DataTable;
 use App\Libraries\LogAktifitas;
 use App\Models\PerkawinanModel;
 use App\Models\KabkotModel;
 use App\Models\KecamatanModel;
 use App\Models\KelurahanModel;
 use PhpOffice\PhpSpreadsheet\Spreadsheet;
 use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Perkawinan extends BaseController
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
        $Export  = $this->request->getVar('excel');

        if (isset($Export)) {

            $styleArray = [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $dataSearch = $this->perkawinanModel->join('kabkot','kabkot.kode_kabkot = perkawinan.kabkot')
                                                ->join('ref_kecamatan','ref_kecamatan.kecamatan_id = perkawinan.kecamatan')
                                                ->join('ref_kelurahan','ref_kelurahan.kelurahan_id = perkawinan.kelurahan')
                                                ->where('perkawinan.kelurahan',sess_kelurahan())
                                                ->orderBy('no_pasangan','DESC')
                                                ->findAll();
            $getNameWilayah = $this->kabkotModel->where('ref_kota.kota_id',sess_region())
                                                ->where('ref_kecamatan.kecamatan_id',sess_kecamatan())
                                                ->where('ref_kelurahan.kelurahan_id',sess_kelurahan())
                                                ->join('ref_kecamatan','ref_kecamatan.kota_id = ref_kota.kota_id') 
                                                ->join('ref_kelurahan','ref_kelurahan.kecamatan_id = ref_kecamatan.kecamatan_id') 
                                                ->first();
           
            $judul = "DATA PERKAWINAN WARGA DI DESA/NAGARI/KELURAHAN";
            $data = $dataSearch;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getCell('B2')->setValue($judul);
            $sheet->mergeCells('B2:N2');
            $sheet->getStyle('B2')->applyFromArray($styleArray);
            
            // Menambahkan pengaturan Wrap Text
            $sheet->getStyle('B2')->getAlignment()->setWrapText(true);
            $sheet->getRowDimension(2)->setRowHeight(30);
            $sheet->setCellValue('C3','KABUPATEN / KOTA :');
            $sheet->setCellValue('D3',strtoupper($getNameWilayah['kota_nama']));
            $sheet->setCellValue('C4','KECAMATAN :');
            $sheet->setCellValue('D4',strtoupper($getNameWilayah['kecamatan_nama']));
            $sheet->setCellValue('C5','KELURAHAN :');
            $sheet->setCellValue('D5',strtoupper($getNameWilayah['kelurahan_nama']));

            $sheet->setCellValue('B7','No');
            $sheet->setCellValue('C7','NIK');
            $sheet->setCellValue('D7','NAMA LENGKAP');
            $sheet->setCellValue('E7','TEMPAT TGL LAHIR');
            $sheet->setCellValue('F7','SEBAGAI SUAMI/ISTRI');
            $sheet->setCellValue('G7','ALAMAT');
            $sheet->setCellValue('H7','NAMA ORANG TUA AYAH & IBU');
            $sheet->setCellValue('I7','TEMPAT TGL AKAD NIKAH/PERKAWINAN');
            $sheet->setCellValue('J7','DIHADAPAN WALI NIKAH/PEMUKA AGAMA');
            $sheet->setCellValue('K7','NAMA WALI NIKAH/PEMUKA AGAMA');
            $sheet->setCellValue('L7','STATUS PERKAWINANNYA');
            $sheet->setCellValue('M7','NO & TGL NIKAH/AKTA PERKAWINAN');
            $sheet->setCellValue('N7','KET');
                 
            $sheet->getStyle('B')->getFont()->setSize(12);
            $sheet->getStyle('C')->getFont()->setSize(12);
            $sheet->getStyle('D')->getFont()->setSize(12);
            $sheet->getStyle('E')->getFont()->setSize(12);
            $sheet->getStyle('F')->getFont()->setSize(12);
            $sheet->getStyle('G')->getFont()->setSize(12);
            $sheet->getStyle('H')->getFont()->setSize(12);
            $sheet->getStyle('I')->getFont()->setSize(12);
            $sheet->getStyle('J')->getFont()->setSize(12);  
            $sheet->getStyle('K')->getFont()->setSize(12);
            $sheet->getStyle('L')->getFont()->setSize(12);
            $sheet->getStyle('M')->getFont()->setSize(12);
            $sheet->getStyle('N')->getFont()->setSize(12);

            $column = 8; // Variabel untuk menyimpan total jumlah
            foreach ($data as $value) {
                $sheet->setCellValue('B'.$column, ($column-7));
                $sheet->setCellValueExplicit('C'.$column, $value['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValue('D'.$column, $value['nama']);
                $sheet->setCellValue('E'.$column, $value['tmp_lahir'].', '.indonesia_date_v1($value['tgl_lahir']));
                $sheet->setCellValue('F'.$column, $value['hub_kawin']);
                $sheet->setCellValue('G'.$column, $value['alamat']);
                $sheet->setCellValue('H'.$column, $value['nama_ortu_ayah'].', '.$value['nama_ortu_ibu']);
                $sheet->setCellValue('I'.$column, $value['tmp_akad_nikah'].', '.$value['tgl_akad_nikah']);
                $sheet->setCellValue('J'.$column, $value['agama_wali_nikah']);
                $sheet->setCellValue('K'.$column, $value['nama_wali']);
                $sheet->setCellValue('L'.$column, $value['status_perkawinan']); 
                $sheet->setCellValue('M'.$column, $value['no_buku_nikah']); 
                $sheet->setCellValue('N'.$column, $value['ket']); 
                $column++;
            }
           
            $sheet->getStyle('B2:N7')->getFont()->setBold(true);
            $sheet->getStyle('B7:N7')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('D3D3D3');

            $borderArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];

            $sheet->getStyle('B7:N'.($column-1))->applyFromArray($borderArray);
            
            // Menambahkan border pada baris total
            $sheet->getStyle('B'.$column.':N'.$column)->applyFromArray($borderArray);


            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->getColumnDimension('J')->setAutoSize(true);
            $sheet->getColumnDimension('K')->setAutoSize(true);
            $sheet->getColumnDimension('L')->setAutoSize(true);
            $sheet->getColumnDimension('M')->setAutoSize(true);
            $sheet->getColumnDimension('N')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename='.$judul.'.xlsx');
            header('Cache-Control: max-age=0');
    
            $writer->save('php://output');
            exit();

        }

        $data = [
            'title'         => 'PERKAWINAN',
            'menu_active'   => 'master',
            'menu_sub'      => 'perkawinan',
            'kabkot'        => $this->kabkotModel->select('kota_id,kota_nama')->where('provinsi_id',13)->find(),
            'content'       => 'App\Views\perkawinan\kelurahan\perkawinan_view',
        ];
        return view('App\Views\layout_admin\wrapper',$data);
    }

    public function getAll(){
        $db = db_connect();
        $builder = $db->table('perkawinan')
                      ->select('id,
                                nik,
                                nama,
                                hub_kawin,
                                nama_kabkot,
                                kecamatan_nama,
                                kelurahan_nama,
                                status_perkawinan,
                                no_buku_nikah,
                                no_pasangan,
                                perkawinan.created_at')
                       ->join('kabkot','kabkot.kode_kabkot = perkawinan.kabkot')
                       ->join('ref_kecamatan','ref_kecamatan.kecamatan_id = perkawinan.kecamatan')
                       ->join('ref_kelurahan','ref_kelurahan.kelurahan_id = perkawinan.kelurahan')
                       ->where('kelurahan',sess_kelurahan())
                      ->orderBy('no_pasangan','DESC');
        return DataTable::of($builder)
        ->add('action', function($row){
            return '<a href="'.base_url('admin/perkawinan/detail/'.$row->no_pasangan).'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>
            <button type="button" title="Ubah Data" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#edit" onclick="editData('.$row->id.')"><i class="fas fa-pen"></i></button>
            <button type="button" title="Hapus Data" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete"  onclick="deleteData('.$row->id.')"><i class="fas fa-trash"></i></button>';
        }, 'last')
        ->format('created_at', function($value){
            return indonesia_date($value);
        })

        ->format('status', function($value){
            if($value == 'Pending'){
                return '<div class="btn btn-sm btn-warning">'.$value.'<div>';
            }elseif($value == 'Approved'){
                return '<div class="btn btn-sm btn-success">'.$value.'<div>';
            }else{
                return '<div class="btn btn-sm btn-danger">Rejected<div>';
            }
        })

        ->hide('id')
        ->hide('no_pasangan')
        ->addNumbering('no')
        ->toJson(true);
    }


    function insert(){
        
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            
            $valid = $this->validate([ 
                'addNikSuami' => [
                    'label' => 'NIK Suami',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                        'numeric' => '{field} hanya boleh angka',
                    ]
                ],

                'addNikIstri' => [
                    'label' => 'NIK Istri',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                        'numeric' => '{field} hanya boleh angka',
                    ]
                ],


            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'erroraddNikSuami'    => $validation->getError('addNikSuami'),
                        'erroraddNikIstri'    => $validation->getError('addNikIstri'),
                    ]
                ];
            }else{
                
                // Generate nomor pasangan yang lebih efisien
                $prefix = 'PW';
                $timestamp = date('ymd'); // Format: tahun(2 digit) + bulan + tanggal
                $random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);
                $no_pasangan = $prefix . $timestamp . $random;
                
                // Data dasar yang sama untuk suami dan istri
                $base_data = [
                    'no_pasangan'           => $no_pasangan,
                    'user_id'               => sess_user_account(),
                    'kabkot'                => sess_region(),
                    'kecamatan'             => sess_kecamatan(),
                    'kelurahan'             => sess_kelurahan(),
                    'tmp_akad_nikah'        => $this->request->getVar('addPelaksaanAkad'),
                    'tgl_akad_nikah'        => $this->request->getVar('addTglAkad'),
                    'agama_wali_nikah'      => $this->request->getVar('addHadapanWali'),
                    'nama_wali'             => $this->request->getVar('addNamaWali'),
                    'alamat_wali'           => $this->request->getVar('addAlamatWali'),
                    'status_perkawinan'     => $this->request->getVar('addStatusPerkawinan'),
                    'no_buku_nikah'         => $this->request->getVar('addNoBukuNikah'),
                    'ket'                   => $this->request->getVar('addKet'),
                ];

                // Data spesifik suami
                $data_suami = array_merge($base_data, [
                    'nik'                   => $this->request->getVar('addNikSuami'),
                    'nama'                  => $this->request->getVar('addNamaSuami'),
                    'hub_kawin'             => 'Suami',
                    'tmp_lahir'             => $this->request->getVar('addTmpLahirSuami'),
                    'tgl_lahir'             => $this->request->getVar('addTglLahirSuami'),
                    'agama'                 => $this->request->getVar('addAgamaSuami'),
                    'alamat'                => $this->request->getVar('addAlamatSuami'),
                    'nama_ortu_ayah'        => $this->request->getVar('addNamaOtruSuamiAyah'),
                    'nama_ortu_ibu'         => $this->request->getVar('addNamaOtruSuamiIbu'),
                ]);

                // Data spesifik istri
                $data_istri = array_merge($base_data, [
                    'nik'                   => $this->request->getVar('addNikIstri'),
                    'nama'                  => $this->request->getVar('addNamaIstri'),
                    'hub_kawin'             => 'Istri',
                    'tmp_lahir'             => $this->request->getVar('addTmpLahirIstri'),
                    'tgl_lahir'             => $this->request->getVar('addTglLahirIstri'),
                    'agama'                 => $this->request->getVar('addAgamaIstri'),
                    'alamat'                => $this->request->getVar('addAlamatIstri'),
                    'nama_ortu_ayah'        => $this->request->getVar('addNamaOtruIstriAyah'),
                    'nama_ortu_ibu'         => $this->request->getVar('addNamaOtruIstriIbu'),
                ]);

                $this->perkawinanModel->insertBatch([$data_suami, $data_istri]);

                $this->log->create('Menambahkan data Perkawinan '.sess_full_name());

                $msg = [
                    'sukses' => 'Berhasil'
                ];
                    
                
            }

            echo json_encode($msg);
        }
    }

    // function for form edit data program
    public function getById(){
        $id = $this->request->getVar('id');
        $data = $this->perkawinanModel->find($id);
        return json_encode($data);
    }
    // end function

    function update(){
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            
            $valid = $this->validate([
                'editNik' => [
                    'label' => 'NIK',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                        'numeric' => '{field} hanya boleh angka',
                    ] 
                ],
                'editNama' => [
                    'label' => 'Nama lengkap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib diisi',
                    ]
                ],

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'erroreditNik'    => $validation->getError('editNik'),
                        'erroreditNama'   => $validation->getError('editNama'),
                    ]
                ];

            }else{
                $id                 = $this->request->getVar('editIdPerkawinan');
                $nik                = $this->request->getVar('editNik');
                $nama               = $this->request->getVar('editNama');
                $tmpLahir           = $this->request->getVar('editTmpLahir');
                $tglLahir           = $this->request->getVar('editTglLahir');
                $agama              = $this->request->getVar('editAgama');
                $alamat             = $this->request->getVar('editAlamat');
                $ortuAyah           = $this->request->getVar('editNamaOtruAyah');
                $ortuIbu            = $this->request->getVar('editNamaOtruIbu');
                $pelaksanaanAkad    = $this->request->getVar('editPelaksaanAkad');
                $tglAkad            = $this->request->getVar('editTglAkad');
                $hadapanWali        = $this->request->getVar('editHadapanWali');
                $namaWali           = $this->request->getVar('editNamaWali');
                $alamat             = $this->request->getVar('editAlamatWali');
                $status             = $this->request->getVar('editStatusPerkawinan');
                $noAkta             = $this->request->getVar('editNoBukuNikah');
                $ket                = $this->request->getVar('editKet');
                
                $data = [
                    'nik'               => $nik,
                    'nama'              => $nama,
                    'tmp_lahir'         => $tmpLahir,
                    'tgl_lahir'         => $tglLahir,
                    'agama'             => $agama,
                    'alamat'            => $alamat,
                    'nama_ortu_ayah'    => $ortuAyah,
                    'nama_ortu_ibu'     => $ortuIbu,
                    'tmp_akad_nikah'    => $pelaksanaanAkad,
                    'tgl_akad_nikah'    => $tglAkad,
                    'agama_wali_nikah'  => $hadapanWali,
                    'nama_wali'         => $namaWali,
                    'alamat_wali'       => $alamat,
                    'status_perkawinan' => $status,
                    'no_buku_nikah'     => $noAkta,
                    'ket'               => $ket,
                ];

                $this->perkawinanModel->update($id,$data);
                $this->log->create('Mengubah data perkawinan dengan nik : '.$nik.' '.sess_full_name());

                $msg = [
                    'sukses' => 'Berhasil ubah data'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function delete(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->perkawinanModel->delete($id);
            $msg = [
                'sukses' => "berhasil dihapus",
            ];

            return json_encode($msg);
        }
    }


}
