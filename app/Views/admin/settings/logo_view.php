    <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2 icon">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-image"></i>
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
                  <a href="" class="btn btn-outline-success">Refrash Halaman</a>
                </div>
                <div class="card-body">

                  <div class="row">

                    <div class="col-lg-4 col-md-12">
                        <!-- start -->
                          
                        <div class="form-body">
                          <h4 class="form-section">Logo</h4>                                  
                        </div>
                        <hr class="hr-dashed m-buttom-20"/>

                        <p id="errorLogo" class="text-danger"></p>    
                          <center><img height="200" class="img-responsive card-img-top" src="<?= base_url('uploads/gallery').'/'. esc(get_row('system_config',array('config_key' => 'app_logo'),'config_value')) ?>"></center>
                        <br/>
                        <?= form_open_multipart('',['class' => 'formLogo']) ?>
                        <div class="form-group row">
                          <div class="col-md-12">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="btn bg-secondary"><i class="fa fa-image"></i></span>
                              </div>
                                <input type="file" class="form-control" name="logo" id="logo">
                            </div>
                          </div>
                        </div>
                        <hr class="hr-dashed m-buttom-20"/>
                        <div class="form-actions right">
                          <button type="submit" id="saveLogo" class="btn btn-primary btnLogo"><i class="fa fa-upload">&nbsp;</i> Simpan</button>
                        </div>
                        <?= form_close(); ?>
                        <!-- end -->
                      </div>

                    <div class="col-lg-4 col-md-12">
                      <!-- start -->
                          <div class="form-body">
                            <h4 class="form-section">Background</h4>                                  
                          </div>
                          <hr class="hr-dashed m-buttom-20"/>

                            <center><img height="200" class="img-responsive card-img-top" src="<?= base_url('uploads/gallery').'/'. esc(get_row('system_config',array('config_key' => 'app_background'),'config_value')) ?>"></center>

                          <br/>
                          <?= form_open_multipart('',['class' => 'formBg']) ?>
                          <div class="form-group row">
                            <div class="col-md-12">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="btn bg-secondary"><i class="fa fa-image"></i></span>
                                </div>
                                  <input type="file" class="form-control" name="foto_bg" id="foto_bg">
                              </div>
                            </div>
                          </div>
                          <hr class="hr-dashed m-buttom-20"/>
                          <div class="form-actions right">
                            <button type="submit" id="saveBg" class="btn btn-primary btnBg"><i class="fa fa-upload">&nbsp;</i> Simpan</button>
                          </div>
                        <?= form_close(); ?>
                      <!-- end -->
                    </div>
                  
                    <div class="col-lg-4 col-md-12">
                      <!-- start -->
                      <div class="form-body">
                        <h4 class="form-section">Favicon</h4>                                  
                      </div>
                      <hr class="hr-dashed m-buttom-20"/>

                        <center><img height="200" class="img-responsive card-img-top" src="<?= base_url('uploads/gallery').'/'. esc(get_row('system_config',array('config_key' => 'meta_favicon'),'config_value')) ?>"></center>

                        <br/>
                        <?= form_open_multipart('',['class' => 'formFavicon']) ?>
                        <div class="form-group row">
                          <div class="col-md-12">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="btn bg-secondary"><i class="fa fa-image"></i></span>
                              </div>
                                <input type="file" class="form-control" name="favicon" id="favicon">
                            </div>
                          </div>
                        </div>
                        <hr class="hr-dashed m-buttom-20"/>
                        <div class="form-actions right">
                          <button type="submit" id="saveFavicon" class="btn btn-primary btnFavicon"><i class="fa fa-upload">&nbsp;</i> Simpan</button>
                        </div>
                        <?= form_close(); ?>
                      <!-- end -->
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

<script>
  $(document).ready(function(){
    
    //Logo
    $('#saveLogo').click(function(e){
      e.preventDefault();

      let form = $('.formLogo')[0];

      let data = new FormData(form);

      $.ajax({
        type:"post",
        url:"<?= base_url('admin/upload_logo'); ?>",
        data:data,
        enctype:"multipart/form-data",
        processData:false,
        contentType:false,
        cache:false,
        dataType:"json",
        beforeSend: function(e){  
          $('.btnLogo').prop('disabled','disabled');
          $('.btnLogo').html(`<img src='<?php echo base_url('assets/img/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
        },
        complate: function(e){  
          $('.btnLogo').removeAttr('disabled');
          $('.btnLogo').html(`Upload`);
        },
        success:function(response){
          if (response.error) {
            if (response.error.logo) {
              Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: response.error.logo,
                  showConfirmButton: false,
                  timer: 1500
              });
              $('.btnLogo').html(`<i class="fa fa-upload">&nbsp;</i> Upload`);
              $('.btnLogo').removeAttr('disabled');
              $('#logo').val('');
            }
          }else{
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.sukses,
                showConfirmButton: false,
                timer: 1500
            });
            $('.btnLogo').html(`<i class="fa fa-upload">&nbsp;</i> Upload`);
            $('.btnLogo').removeAttr('disabled');
            $('#logo').val('');
            location.reload();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });

    });

    //End Logo

    // Backgound 
    $('#saveBg').click(function(e){
      e.preventDefault();

      let form = $('.formBg')[0];

      let data = new FormData(form);

      $.ajax({
        type:"post",
        url:"<?= base_url('admin/upload_bg'); ?>",
        data:data,
        enctype:"multipart/form-data",
        processData:false,
        contentType:false,
        cache:false,
        dataType:"json",
        beforeSend: function(e){  
          $('.btnBg').prop('disabled','disabled');
          $('.btnBg').html(`<img src='<?php echo base_url('assets/img/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
        },
        complate: function(e){  
          $('.btnBg').removeAttr('disabled');
          $('.btnBg').html(`Upload`);
        },
        success:function(response){
          if (response.error) {
            if (response.error.foto_bg) {
              Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: response.error.foto_bg,
                  showConfirmButton: false,
                  timer: 1500
              });
              $('.btnBg').html(`<i class="fa fa-upload">&nbsp;</i> Upload`);
              $('.btnBg').removeAttr('disabled');
              $('#foto_bg').val('');
            }
          }else{
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.sukses,
                showConfirmButton: false,
                timer: 1500
            });
            $('.btnBg').html(`<i class="fa fa-upload">&nbsp;</i> Upload`);
            $('.btnBg').removeAttr('disabled');
            $('#foto_bg').val('');
            location.reload();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });

    });
    // End Background
    
    
    // Favicon
    $('#saveFavicon').click(function(e){
      e.preventDefault();

      let form = $('.formFavicon')[0];

      let data = new FormData(form);

      $.ajax({
        type:"post",
        url:"<?= base_url('admin/upload_favicon'); ?>",
        data:data,
        enctype:"multipart/form-data",
        processData:false,
        contentType:false,
        cache:false,
        dataType:"json",
        beforeSend: function(e){  
          $('.btnFavicon').prop('disabled','disabled');
          $('.btnFavicon').html(`<img src='<?php echo base_url('assets/img/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
        },
        complate: function(e){  
          $('.btnFavicon').removeAttr('disabled');
          $('.btnFavicon').html(`Upload`);
        },
        success:function(response){
          if (response.error) {
            if (response.error.favicon) {
              Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: response.error.favicon,
                  showConfirmButton: false,
                  timer: 1500
              });
              $('.btnFavicon').html(`<i class="fa fa-upload">&nbsp;</i> Upload`);
              $('.btnFavicon').removeAttr('disabled');
              $('#favicon').val('');
            }
          }else{
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.sukses,
                showConfirmButton: false,
                timer: 1500
            });
            $('.btnFavicon').html(`<i class="fa fa-upload">&nbsp;</i> Upload`);
            $('.btnFavicon').removeAttr('disabled');
            $('#favicon').val('');
            location.reload();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });

    });
    // End Favicon

  });
</script>