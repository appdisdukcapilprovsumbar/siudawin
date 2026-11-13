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
                  <a href="<?= base_url('admin/profil_dinas'); ?>" class="btn btn-outline-success">Refrash Halaman</a>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <?= form_open('admin/update_profil_dinas', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        
                        <div class="form-group">
                          <label>Nama Dinas</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="company_name" placeholder="Nama Dinas" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'company_name'),'config_value')); ?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Kontak</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="company_phone" placeholder="kontak" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'company_phone'),'config_value')); ?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Email</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="company_email" placeholder="Email" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'company_email'),'config_value')); ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Alamat</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="company_address" placeholder="Alamat" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'company_address'),'config_value')); ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Kode pos</label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="company_postcode" placeholder="Kode POS" autocomplete="off" value="<?= esc(get_row('system_config',array('config_key' => 'company_postcode'),'config_value')); ?>">
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
