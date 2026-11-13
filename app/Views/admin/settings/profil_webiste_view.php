    <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2 icon">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-building"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                  </div>
                  <?php
                    if (session()->getFlashdata('respon_message')) {?>
                      <script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: '<?= session()->getFlashdata('respon_message'); ?>',
                          showConfirmButton: false,
                          timer: 1500
                        });
                      </script>
                  <?php } ?>
                  
                  <?php
                    if (session()->getFlashdata('respon_error_message')) {?>
                      <script>
                        Swal.fire({
                          position: 'top-end',
                          icon: 'error',
                          title: '<?= session()->getFlashdata('respon_error_message'); ?>',
                          showConfirmButton: false,
                          timer: 2000
                        });
                      </script>
                  <?php } ?>
                  <div class="card-body">
                    <?= esc($title);?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <a href="<?= base_url('admin/profil_website'); ?>" class="btn btn-outline-success">Refrash Halaman</a>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <?= form_open('admin/update_profil_website', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        
                        <div class="form-group">
                          <label>Nama Aplikasi</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="app_name" placeholder="Nama Dinas" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'app_name'),'config_value')); ?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Author</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="app_author" placeholder="kontak" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'app_author'),'config_value')); ?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Versi Aplikasi</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="app_version" placeholder="Email" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'app_version'),'config_value')); ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Tahun Aplikasi</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="app_year" placeholder="Alamat" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'app_year'),'config_value')); ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Copyright</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="app_copyright" placeholder="Kode POS" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'app_copyright'),'config_value')); ?>">
                          </div>
                        </div>

                        <button class="btn btn-primary float-right" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <?= form_close();?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
