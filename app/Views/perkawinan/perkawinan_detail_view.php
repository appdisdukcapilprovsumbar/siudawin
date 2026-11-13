    <!-- Main Content -->
    <style>
        .spesifik dt {
          text-align: left;
          width: 200px; /* Menambahkan lebar tetap */
          white-space: nowrap;
        }
        .spesifik dd {
          text-align: right;
          padding-right: 40%;
        }
      </style>
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2 icon">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <?= esc($title);?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <?php if(sess_role_code() == 'admin'){ ?>
                      <a href="<?= base_url('admin/perkawinan/'); ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Kembali</a> &nbsp;
                    <?php }elseif(sess_role_code() == 'admin_kabkot'){ ?>
                      <a href="<?= base_url('admin/kabkot_perkawinan/'); ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Kembali</a> &nbsp;
                    <?php }elseif(sess_role_code() == 'admin_kecamatan'){ ?> 
                      <a href="<?= base_url('admin/kecamatan_perkawinan/'); ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Kembali</a> &nbsp;
                    <?php }else{ ?>
                      <a href="<?= base_url('admin/kelurahan_perkawinan'); ?>" class="btn btn-outline-warning"><i class="fas fa-undo"></i> Kembali</a> &nbsp;
                    <?php } ?>
                    <a href="<?= base_url('admin/perkawinan/detail/'.$base_data['no_pasangan']); ?>" class="btn btn-outline-success">Refrash Halaman</a>
                  </div>
                  <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Kabupaten Kota</dt>
                        <dd class="col-sm-9"><?= $base_data['nama_kabkot']; ?></dd>

                        <dt class="col-sm-3">Kecamatan</dt>
                        <dd class="col-sm-9"><?= $base_data['kecamatan_nama']; ?></dd>

                        <dt class="col-sm-3">Kelurahan</dt>
                        <dd class="col-sm-9"><?= $base_data['kelurahan_nama']; ?></dd>

                        <dt class="col-sm-3">Tempat Pelaksanaan Akad Nikah/Perkawinan</dt>
                        <dd class="col-sm-9"><?= $base_data['tmp_akad_nikah']; ?></dd>

                        <dt class="col-sm-3">Tanggal Pelaksanaan Akad Nikah/Perkawinan</dt>
                        <dd class="col-sm-9"><?= indonesia_date_v1($base_data['tgl_akad_nikah']); ?></dd>
                        
                        <dt class="col-sm-3">Dihadapan/Didepan Wali Nikah/Pemuka Agam</dt>
                        <dd class="col-sm-9"><?= $base_data['agama_wali_nikah']; ?></dd>
                        
                        <dt class="col-sm-3">Nama Wali Nikah/Pemuka Agama</dt>
                        <dd class="col-sm-9"><?= $base_data['nama_wali'];?></dd>

                        <dt class="col-sm-3">Alamat Wali Nikah/Pemuka Agama</dt>
                        <dd class="col-sm-9"><?= $base_data['alamat_wali'];?></dd>

                        <dt class="col-sm-3">Status Perkawinannya</dt>
                        <dd class="col-sm-9"><?= $base_data['status_perkawinan'];?></dd>

                        <dt class="col-sm-3">Jika Tercatat No.Buka Nikah / Akta Perkawinan</dt>
                        <dd class="col-sm-9"><?= $base_data['no_buku_nikah'];?></dd>

                        <dt class="col-sm-3">Keterangan</dt>
                        <dd class="col-sm-9"><?= $base_data['ket'];?></dd>
                    </dl>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-header font-weight-bold"><h3>Data Suami</h3></div>
                          <div class="card-body">
                            <dl class="row spesifik">
                              <dt class="col-sm-3">Status Hubungan Keluarga</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['hub_kawin'];?></dd>

                              <dt class="col-sm-3">NIK</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['nik'];?></dd>

                              <dt class="col-sm-3">Nama Lengkap</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['nama'];?></dd>

                              <dt class="col-sm-3">Tempat Lahir</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['tmp_lahir'];?></dd>

                              <dt class="col-sm-3">Tanggal Lahir</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['agama'];?></dd>

                              <dt class="col-sm-3">Tanggal Lahir</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['alamat'];?></dd>

                              <dt class="col-sm-3">Nama Orang Tua (Ayah)</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['nama_ortu_ayah'];?></dd>

                              <dt class="col-sm-3">Nama Orang Tua (Ibu)</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[0]['nama_ortu_ibu'];?></dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card">
                        <div class="card-header font-weight-bold"><h3>Data Istri</h3></div>
                          <div class="card-body">
                            <dl class="row spesifik">
                              <dt class="col-sm-3">Status Hubungan Keluarga</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['hub_kawin'];?></dd>

                              <dt class="col-sm-3">NIK</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['nik'];?></dd>

                              <dt class="col-sm-3">Nama Lengkap</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['nama'];?></dd>

                              <dt class="col-sm-3">Tempat Lahir</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['tmp_lahir'];?></dd>

                              <dt class="col-sm-3">Tanggal Lahir</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['agama'];?></dd>

                              <dt class="col-sm-3">Tanggal Lahir</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['alamat'];?></dd>

                              <dt class="col-sm-3">Nama Orang Tua (Ayah)</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['nama_ortu_ayah'];?></dd>

                              <dt class="col-sm-3">Nama Orang Tua (Ibu)</dt>
                              <dd class="col-sm-9"><?= $spesifik_data[1]['nama_ortu_ibu'];?></dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


      </div>
