    <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2 icon">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-user"></i>
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
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>BIODATA DIRI</h4>
                  <a href="<?= base_url('profil'); ?>" class="btn btn-outline-success">Refrash Halaman</a>
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
                <div class="row m-2">
                  <div class="col-md-3">
                    <div class="alert alert-primary"><p><?= sess_role_name(); ?></p></div>
                  </div>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <?= form_open('update_profil/'.sess_user_account(), ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        <div class="form-group">
                          <label>Nama</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-user"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" name="nama" value="<?= esc($profil['user_account_full_name']); ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" name="email" value="<?= esc($profil['user_account_email']); ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Kontak</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" name="kontak" value="<?= esc($profil['user_account_contact']); ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Username</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-user"></i>
                              </div>
                            </div>
                            <input type="text" class="form-control" name="username" value="<?= esc($profil['user_account_username']); ?>">
                          </div>
                        </div>
                        <button class="btn btn-primary float-right" type="submit"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <?= form_close();?>
                    </div>
                    <div class="col-md-6">
                      <?= form_open('update_pass', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        <input type="hidden" name="id" value="<?= sess_user_account(); ?>">
                        <div class="form-group">
                          <label>Password Lama</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" name="pass_lama" required value="<?= old('pass_lama') ?>">
                            <div class="invalid-feedback">
                              Silahkan isi password lama
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Password Baru</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" name="pass_baru" required value="<?= old('pass_baru') ?>">
                            <div class="invalid-feedback">
                              Silahkan isi password baru
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Ulangi Password Baru</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" class="form-control" name="ulangi_pass" required value="<?= old('ulangi_pass') ?>">
                            <div class="invalid-feedback">
                              Silahkan isi ulangi password baru
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary float-right"><i class="fas fa-paper-plane"></i> Simpan</button>
                      <?= form_close();?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
