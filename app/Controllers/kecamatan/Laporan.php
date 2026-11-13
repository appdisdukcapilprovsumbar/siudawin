<?php 
 namespace App\Controllers\kecamatan;
  
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
        $kelSel  = $this->request->getVar('kel');   // kelurahan yang dipilih di form
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
                              perceraian.kelurahan,
                              perceraian.created_at
                          ')
                          ->join('perceraian', 'perceraian.id = perceraian_pihak.perceraian_id', 'inner')
                          ->where('DATE(perceraian.created_at) >=', $awal)
                          ->where('DATE(perceraian.created_at) <=', $akhir)
                          ->orderBy('perceraian.id', 'ASC')
                          ->orderBy("CASE WHEN perceraian_pihak.jenis_pihak = 'SUAMI' THEN 1 ELSE 2 END", '', false);

            // Filter kelurahan jika dipilih di form
            
            if (!empty($kelSel)) {
                $builder->where('perceraian.kelurahan', $kelSel);
            }

            // jenis == 1 : Semua
            // jenis == 2 : Tercatat (ada akta cerai)
            // jenis == 3 : Tidak Tercatat (tidak ada akta cerai)

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
                            ->where('ref_kelurahan.kelurahan_id', !empty($kelSel) ? $kelSel : 0)
                            ->first();
        }

        // Daftar kelurahan untuk dropdown (variabel berbeda dari $kelSel)
        $listKelurahan = $this->kelurahanModel->where('kecamatan_id', sess_kecamatan())->findAll();

        $data = [
            'title'         => 'REKAPAN DATA',
            'menu_active'   => 'master',
            'menu_sub'      => 'laporan',
            'jenis'         => $jenis   ?? '',
            'awal'          => $awal    ?? '',
            'akhir'         => $akhir   ?? '',
            'kelSel'        => $kelSel  ?? '',
            'data'          => $rows,
            'total'         => count($rows),
            'wilayah'       => $wilayah ?? [],
            'kel'           => $listKelurahan,
            'content'       => 'App\Views\laporan\laporan_kecamatan_view',
        ];
        return view('App\Views\layout_admin\wrapper', $data);
    }

    public function export(){
        $jenis  = $this->request->getVar('jenis');
        $kelSel = $this->request->getVar('kel');
        $awal   = $this->request->getVar('awal');
        $akhir  = $this->request->getVar('akhir');

        if (empty($jenis) || empty($awal) || empty($akhir)) {
            return redirect()->to('admin/kec/laporan');
        }

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
                          perceraian.keterangan
                      ')
                      ->join('perceraian', 'perceraian.id = perceraian_pihak.perceraian_id', 'inner')
                      ->where('perceraian.kecamatan', sess_kecamatan())
                      ->where('DATE(perceraian.created_at) >=', $awal)
                      ->where('DATE(perceraian.created_at) <=', $akhir)
                      ->orderBy('perceraian.id', 'ASC')
                      ->orderBy("CASE WHEN perceraian_pihak.jenis_pihak = 'SUAMI' THEN 1 ELSE 2 END", '', false);

        if (!empty($kelSel)) {
            $builder->where('perceraian.kelurahan', $kelSel);
        }
        if ($jenis == 2) {
            $builder->where('perceraian.no_akta_cerai !=', null);
        } elseif ($jenis == 3) {
            $builder->where('perceraian.no_akta_cerai', null);
        }

        $rows = $builder->get()->getResultArray();

        // ── Build Excel ──────────────────────────────────────────
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Perceraian');

        $headers = [
            'A' => 'No',
            'B' => 'NIK',
            'C' => 'Nama Lengkap',
            'D' => 'Tempat Lahir',
            'E' => 'Tanggal Lahir',
            'F' => 'Sebagai',
            'G' => 'Agama',
            'H' => 'Pekerjaan',
            'I' => 'Alamat',
            'J' => 'Status Perkawinan Sebelum Cerai',
            'K' => 'No Buku Nikah',
            'L' => 'Tgl Buku Nikah',
            'M' => 'Sebab Cerai',
            'N' => 'Status Cerai Hidup/Mati',
            'O' => 'No Akta Cerai',
            'P' => 'Tgl Akta Cerai',
            'Q' => 'No Akta Kematian',
            'R' => 'Tgl Akta Kematian',
            'S' => 'Keterangan',
        ];

        $styleHeader = [
            'font'      => ['bold' => true],
            'fill'      => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFD3D3D3']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders'   => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ];

        foreach ($headers as $col => $label) {
            $sheet->setCellValue($col . '1', $label);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getStyle('A1:S1')->applyFromArray($styleHeader);
        $sheet->getRowDimension(1)->setRowHeight(30);

        $no = 1;
        foreach ($rows as $row) {
            $r = $no + 1;
            $sheet->setCellValue('A'.$r, $no);
            $sheet->setCellValueExplicit('B'.$r, $row['nik'] ?? '', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C'.$r, $row['nama_lengkap']   ?? '');
            $sheet->setCellValue('D'.$r, $row['tempat_lahir']   ?? '');
            $sheet->setCellValue('E'.$r, (!empty($row['tanggal_lahir']) && $row['tanggal_lahir'] != '0000-00-00') ? $row['tanggal_lahir'] : '');
            $sheet->setCellValue('F'.$r, $row['jenis_pihak']    ?? '');
            $sheet->setCellValue('G'.$r, $row['agama']          ?? '');
            $sheet->setCellValue('H'.$r, $row['pekerjaan']      ?? '');
            $sheet->setCellValue('I'.$r, $row['alamat']         ?? '');
            $sheet->setCellValue('J'.$r, $row['status_perceraian_sebelum_cerai'] ?? '');
            $sheet->setCellValue('K'.$r, $row['no_buka_nikah']  ?? '');
            $sheet->setCellValue('L'.$r, $row['tgl_buku_nikah'] ?? '');
            $sheet->setCellValue('M'.$r, $row['sebab_perceraian'] ?? '');
            $sheet->setCellValue('N'.$r, $row['status_cerai_hidup'] ?? '');
            $sheet->setCellValue('O'.$r, $row['no_akta_cerai']  ?? '');
            $sheet->setCellValue('P'.$r, $row['tgl_akta_cerai'] ?? '');
            $sheet->setCellValue('Q'.$r, $row['no_akta_kematian'] ?? '');
            $sheet->setCellValue('R'.$r, $row['tgl_akta_kematian'] ?? '');
            $sheet->setCellValue('S'.$r, $row['keterangan']     ?? '');
            $sheet->getStyle('A'.$r.':S'.$r)->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            ]);
            $no++;
        }

        $namaFile = 'Laporan_Perceraian_' . $awal . '_sd_' . $akhir . '.xlsx';
        $writer   = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $namaFile . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

}
