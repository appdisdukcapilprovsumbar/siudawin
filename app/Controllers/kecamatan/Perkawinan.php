<?php 
/**
 * This is Program Modules Controller
 */
 namespace App\Controllers\kecamatan;
  
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
                                                ->where('perkawinan.kecamatan',sess_kecamatan())
                                                ->orderBy('no_pasangan','DESC')
                                                ->findAll();
            $getNameWilayah = $this->kabkotModel->where('ref_kota.kota_id',sess_region())
                                                ->where('ref_kecamatan.kecamatan_id',sess_kecamatan())
                                                ->join('ref_kecamatan','ref_kecamatan.kota_id = ref_kota.kota_id') 
                                                ->first();
          
            $judul = "DATA PERKAWINAN WARGA DI KECAMATAN";
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
            'content'       => 'App\Views\perkawinan\kecamatan\perkawinan_view',
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
                       ->where('kecamatan',sess_kecamatan())
                      ->orderBy('id','DESC');
        return DataTable::of($builder)
        ->add('action', function($row){
            return '<a href="'.base_url('admin/perkawinan/detail/'.$row->no_pasangan).'" class="btn btn-outline-success btn-sm"><i class="fas fa-eye"></i></a>';
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
        ->addNumbering('no')
        ->toJson(true);
    }


}
