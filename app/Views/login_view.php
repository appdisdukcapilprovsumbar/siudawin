<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login - <?= esc(get_row('system_config',array('config_key' => 'app_name'),'config_value')); ?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/gallery').'/'. get_row('system_config',array('config_key' => 'meta_favicon'),'config_value') ?>">
  <meta name="description" content="<?= esc(get_row('system_config',array('config_key' => 'meta_description'),'config_value')); ?>">
  <meta name="keywords" content="<?= esc(get_row('system_config',array('config_key' => 'meta_keyword'),'config_value')); ?>">
  <meta name="title" content="<?= esc(get_row('system_config',array('config_key' => 'meta_title'),'config_value')); ?>">

<!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/css/components.css">

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->

  <style>
    /* Styling untuk animasi loading */
    #loading {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        display: none; /* Hidden by default */
    }

    body {
        margin: 0;
        padding: 0;
        background-image: url(uploads/gallery/<?= esc(get_row('system_config',array('config_key' => 'app_background'),'config_value')); ?>); /* Ganti dengan URL gambar Anda */
        background-size: cover; /* Gambar menutupi seluruh halaman */
        background-repeat: no-repeat; /* Tidak mengulang gambar */
        background-position: center; /* Posisi gambar di tengah */
        height: 100vh; /* 100% tinggi layar */
    }

    /* Styling untuk daftar ikon */
      .social-icons {
          list-style: none; /* Menghapus bullet list */
          display: flex; /* Menggunakan Flexbox untuk baris sejajar */
          justify-content: center; /* Pusatkan konten secara horizontal */
          padding: 0; /* Menghapus padding bawaan */
          margin: 0; /* Menghapus margin bawaan */
      }

      .social-icons li {
          margin: 0 10px; /* Memberikan jarak antar ikon */
      }

      .social-icons li a {
          text-decoration: none; /* Menghapus garis bawah */
          color: #333; /* Warna default ikon */
          font-size: 24px; /* Ukuran ikon */
          transition: color 0.3s ease; /* Animasi transisi warna */
      }

      .social-icons li a:hover {
          color: #007bff; /* Warna saat hover */
      }

      #captcah_code{
        font-size: 28px;
        font-weight:bold;
        font-family: 'Courier New', monospace; /* Contoh font monospace */
      }
      
      .password-container {
        position: relative;
      }

      .eye-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
      }
  </style>

</head>

<?php 
    $random_alpha = md5(rand());
    $captcha_code = substr($random_alpha, 0, 4);
?>

<body>
  <div id="loading">
      <img src="<?= base_url('template/image/eloading.gif'); ?>" alt="Loading...">
  </div>

  <?php if (session()->getFlashdata('respon_message')) { ?>
    <script type="text/javascript">
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="#">Why do I have this issue?</a>'
      });
    </script>
  <?php } ?>

  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img style="margin-bottom: -35px;" width="100px" src="<?= base_url("uploads/gallery/".get_row('system_config',array('config_key' => 'app_logo'),'config_value')) ?>">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="m-1">
                <?= session()->getFlashdata('respon_message'); ?>
              </div>
              <div class="card-body">
                  <?= form_open('auth', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                  <div class="form-group">
                    <label for="email">NIK</label>
                    <input id="text" type="text" class="form-control" name="username" value="<?= old('username'); ?>" tabindex="1" maxlength="16" required autofocus required>
                    <div class="invalid-feedback">
                      Silahkan isi NIK anda
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Password</label>
                    <div class="position-relative">
                      <input id="password" type="password" class="form-control" name="password" value="<?= old('password'); ?>" tabindex="2" required>
                      <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                    </div>
                    <div class="invalid-feedback">
                      Silahkan isi password anda
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 centered-input">
                      <div class="form-group last mb-4">
                        <input type="text" class="form-control" placeholder="Captcha" name="captcah_code" id="captcah_code" value="<?= $captcha_code; ?>" readonly>
                      </div>
                    </div>

                    <div class="col-md-7">
                      <div class="input-group mb-4">
                      <input type="text" class="form-control" placeholder="Enter Captcha" id="captcha" name="captcha" style="font-weight: bold;" value="<?= old('captcha'); ?>" required>
                      </div>
                      <small id="error_captcha" class="form-text text-danger"></small>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" name="proses" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                    
                  </div>
                <?= form_close() ?>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Your Account</div>
                </div>

                <ul class="social-icons">
                    <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                </ul>

              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? Register with admin
            </div>
            <div class="simple-footer">
              Copyright &copy; PIAK & PD Prov Sumbar
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
      // JavaScript untuk menampilkan dan menyembunyikan animasi loading
      window.addEventListener('beforeunload', function () {
          document.getElementById('loading').style.display = 'flex';
      });

      window.addEventListener('load', function () {
          document.getElementById('loading').style.display = 'none';
      });

      // JavaScript untuk menonaktifkan fungsi copy pada elemen input tertentu
        document.getElementById('captcah_code').addEventListener('copy', function (event) {
            event.preventDefault();
            alert('tidak boleh copy captcah');
        });

      // memberikan icon mata pada password
      const togglePassword = document.getElementById("togglePassword");
      const passwordField = document.getElementById("password");

      togglePassword.addEventListener("click", function () {
          // Toggle tipe input password
          const type = passwordField.type === "password" ? "text" : "password";
          passwordField.type = type;

          // Ganti ikon mata
          this.classList.toggle("fa-eye");
          this.classList.toggle("fa-eye-slash");
      });
      // end

  </script>

  <!-- General JS Scripts -->
  <script src="<?= base_url('template/dist')?>/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/popper.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/tooltip.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/moment.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="<?= base_url('template/dist')?>/assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url('template/dist')?>/assets/js/page/forms-advanced-forms.js"></script>
  
  <!-- Template JS File -->
  <script src="<?= base_url('template/dist')?>/assets/js/scripts.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/js/custom.js"></script>

</body>
</html>