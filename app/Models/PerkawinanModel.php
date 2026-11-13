<?php
namespace App\Models;
use CodeIgniter\Model;

class PerkawinanModel extends Model
{
    protected $table = 'perkawinan';
    protected $useTimestamps = true;
    protected $primaryKey = 'id';
    protected $allowedFields    = [
        'user_id',
        'kabkot',
        'kecamatan',
        'kelurahan',
        'no_pasangan',
        'nik',
        'nama',
        'hub_kawin',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'alamat',
        'nama_ortu_ayah',
        'nama_ortu_ibu',
        'tmp_akad_nikah',
        'tgl_akad_nikah',
        'agama_wali_nikah',
        'nama_wali',
        'alamat_wali',
        'status_perkawinan',
        'no_buku_nikah',
        'ket',
        'created_at',
        'updated_at',
    ];

    // ================================================================================
    public function getJumlahBulanIniKabkot($kabkot,$tahun,$bulan)
    {
        return $this->where('kabkot',$kabkot)
                    ->where('MONTH(tgl_meninggal)', $bulan)
                    ->where('YEAR(tgl_meninggal)', $tahun)
                    ->countAllResults();
    }

    public function getJumlahBulanIniKecamatan($kecamatan,$tahun,$bulan)
    {
        return $this->where('kecamatan',$kecamatan)
                    ->where('MONTH(tgl_meninggal)', $bulan)
                    ->where('YEAR(tgl_meninggal)', $tahun)
                    ->countAllResults();
    }

    public function getJumlahBulanIniKelurahan($kelurahan,$tahun,$bulan)
    {
         return $this->where('kelurahan',$kelurahan)
                    ->where('MONTH(tgl_meninggal)', $bulan)
                    ->where('YEAR(tgl_meninggal)', $tahun)
                    ->countAllResults();
    }
    // ================================================================================
    
    public function getJumlahJanSampaiBulanIniKabkot($kabkot,$tahun,$bulan)
    {
        $awalTahun = 01;
        $sekarang = $bulan;
        return $this->where('kabkot',$kabkot)
                    ->where('MONTH(tgl_meninggal) >=', $awalTahun)
                    ->where('MONTH(tgl_meninggal) <=', $sekarang)
                    ->where('YEAR(tgl_meninggal)',$tahun)
                    ->countAllResults();
    }
    public function getJumlahJanSampaiBulanIniKecamatan($kecamatan,$tahun,$bulan)
    {
       $awalTahun = 01;
        $sekarang = $bulan;
        return $this->where('kecamatan',$kecamatan)
                    ->where('MONTH(tgl_meninggal) >=', $awalTahun)
                    ->where('MONTH(tgl_meninggal) <=', $sekarang)
                    ->where('YEAR(tgl_meninggal)',$tahun)
                    ->countAllResults();
    }

    public function getJumlahJanSampaiBulanIniKelurahan($kelurahan,$tahun,$bulan)
    {
        $awalTahun = 01;
        $sekarang = $bulan;
        return $this->where('kelurahan',$kelurahan)
                    ->where('MONTH(tgl_meninggal) >=', $awalTahun)
                    ->where('MONTH(tgl_meninggal) <=', $sekarang)
                    ->where('YEAR(tgl_meninggal)',$tahun)
                    ->countAllResults();
    }
    // ================================================================================
    
    public function getTotalKeseluruhanKabkot($kabkot)
    {
        return $this->where('kabkot',$kabkot)
                    ->countAllResults();
    }
    public function getTotalKeseluruhanKecamatan($kecamatan)
    {
        return $this->where('kecamatan',$kecamatan)
                    ->countAllResults();
    }
    public function getTotalKeseluruhanKelurahan($kelurahan)
    {
        return $this->where('kelurahan',$kelurahan)
                    ->countAllResults();
    }

    // ================================================================================
    
    public function getJumlahBulanIniKabkotTerbit($kabkot,$tahun,$bulan)
    {
        return $this->where('kabkot',$kabkot)
                    ->where('akta_kematian','SUDAH ADA')
                    ->countAllResults();
    }

    public function getJumlahBulanIniKabkotProses($kabkot,$tahun,$bulan)
    {
        return $this->where('kabkot',$kabkot)
                    ->where('akta_kematian','SEDANG PROSES')
                    ->countAllResults();
    }

    public function getJumlahBulanIniKabkotBelumTerbit($kabkot,$tahun,$bulan)
    {
        return $this->where('kabkot',$kabkot)
                    ->where('akta_kematian','BELUM ADA')
                    ->countAllResults();
    }

    // ================================================================================
    
    public function getJumlahBulanIniKecamatanTerbit($kecamatan,$tahun,$bulan)
    {
        return $this->where('kecamatan',$kecamatan)
                    ->where('akta_kematian','SUDAH ADA')
                    ->countAllResults();
    }

    public function getJumlahBulanIniKecamatanProses($kecamatan,$tahun,$bulan)
    {
        return $this->where('kecamatan',$kecamatan)
                    ->where('akta_kematian','SEDANG PROSES')
                    ->countAllResults();
    }

    public function getJumlahBulanIniKecamatanBelumTerbit($kecamatan,$tahun,$bulan)
    {
        return $this->where('kecamatan',$kecamatan)
                    ->where('akta_kematian','BELUM ADA')
                    ->countAllResults();
    }

    // ================================================================================
    
    public function getJumlahBulanInikelurahanTerbit($kelurahan,$tahun,$bulan)
    {
        return $this->where('kelurahan',$kelurahan)
                    ->where('akta_kematian','SUDAH ADA')
                    ->countAllResults();
    }

    public function getJumlahBulanInikelurahanProses($kelurahan,$tahun,$bulan)
    {
        return $this->where('kelurahan',$kelurahan)
                    ->where('akta_kematian','SEDANG PROSES')
                    ->countAllResults();
    }

    public function getJumlahBulanInikelurahanBelumTerbit($kelurahan,$tahun,$bulan)
    {
        return $this->where('kelurahan',$kelurahan)
                    ->where('akta_kematian','BELUM ADA')
                    ->countAllResults();
    }

}
