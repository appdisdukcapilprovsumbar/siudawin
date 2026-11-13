    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2 icon">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
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
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Tambah</button>&nbsp;
                    <a href="<?= base_url('admin/users_kabkot'); ?>" class="btn btn-outline-success">Refrash Halaman</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              No
                            </th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Level Akses</th>
                            <th>Kabupaten/Kota</th>
                            <th>Waktu Resgister</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>  

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Add Data Users -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tamba Data Users</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?= form_open_multipart('insert_user', ['class' => 'form-add']) ?>
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Level Akses</label>
                    <select name="addLevel" id="addLevel" class="form-control">
                      <option value="">.: Pilih Level Akses :.</option>
                      <?php foreach ($role_access as $row) { ?>
                        <option value="<?= $row['role_access_id'];?>"><?= $row['role_access_name'];?></option>
                      <?php } ?>
                    </select>
                    <div class="invalid-feedback erroraddLevel"></div>
                </div>
                <div class="form-group">
                    <label for="">Kabupaten / Kota</label>
                    <select class="form-control" name="addKabkot" id="addKabkot">
                        <option value="">.:: Kabupaten / Kota ::.</option>
                        <?php 
                        foreach ($kabkot as $row) { ?>
                            <option value="<?= esc($row['kota_id']);?>"> <?= esc($row['kota_id']);?> - <?= esc($row['kota_nama']); ?></option>
                        <?php }?>
                    </select>
                    <div class="invalid-feedback erroraddKabkot"></div>
                </div> 

                <div class="form-group">
                    <label>Kecamatan</label>
                    <select class="form-control" name="addKecamatan" id="addKecamatan">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    <div class="invalid-feedback erroraddKecamatan"></div>
                </div>

                <div class="form-group">
                    <label for="">Kelurahan</label>
                    <select class="form-control" name="addKelurahan" id="addKelurahan">
                        <option value="">Pilih Kelurahan</option>
                    </select>
                    <div class="invalid-feedback erroraddKelurahan"></div>
                </div>

                <div class="form-group">
                    <label for="">Nama User</label>
                    <input type="text" class="form-control" name="addNama" id="addNama" placeholder="Nama User" >
                    <div class="invalid-feedback erroraddNama"></div>
                </div>
                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="text" class="form-control" name="addNIK" id="addNIK" maxlength="16" placeholder="NIK" >
                    <div class="invalid-feedback erroraddNIK"></div>
                </div>
                <div class="form-group">
                    <label for="">Nomor Hp / Telepon</label>
                    <input type="text" class="form-control" name="addHp" id="addHp" placeholder="Nomor Hp/Telepon" >
                    <div class="invalid-feedback erroraddHp"></div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="addPass" id="addPass" placeholder="Password" >
                    <div class="invalid-feedback erroraddPass"></div>
                </div>
                <div class="form-group">
                    <label for="">Ulangi Password</label>
                    <input type="password" class="form-control" name="addUlangiPass" id="addUlangiPass" onkeyup="validatePword(this)" placeholder="Ulangi Password" >
                    <span id="pword_error" class="text-sm text-danger" hidden>Password harus sama!</span>
                    <div class="invalid-feedback erroraddUlangiPass"></div>
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary btnsave" id="savebtn"><i class="far fa-paper-plane">&nbsp;</i> Simpan</button>
              </div>
              <?= form_close();?>
            </div>
          </div>
        </div>
        <!-- End Data Users -->

        <!-- Edit Data Users -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Ubah Data Users</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?= form_open_multipart('update_user', ['class' => 'form-edit']) ?>
              <input type="hidden" name="idUser" id="idUser">
              <div class="modal-body">
                
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="editStatus" id="editStatus" class="form-control">
                      <option value="">.: Pilih Status :.</option>
                        <option value="Active">Active</option>
                        <option value="Disable">Disable</option>
                        <option value="Block">Block</option>
                        <option value="Delete">Delete</option>
                    </select>
                    <div class="invalid-feedback errorEditStatus"></div>
                </div>
                <div class="form-group">
                    <label for="">Level Akses</label>
                    <select name="editLevel" id="editLevel" class="form-control">
                      <option value="">.: Pilih Level Akses :.</option>
                      <?php foreach ($role_access as $row) { ?>
                        <option value="<?= $row['role_access_id'];?>"><?= $row['role_access_name'];?></option>
                      <?php } ?>
                    </select>
                    <div class="invalid-feedback errorEditLevel"></div>
                </div>
                <div class="form-group">
                    <label for="">Kabupaten / Kota</label>
                    <select class="form-control" name="editKabkot" id="editKabkot">
                        <option value="">.:: Kabupaten / Kota ::.</option>
                        <?php 
                        foreach ($kabkot as $row) { ?>
                            <option value="<?= esc($row['kota_id']);?>"> <?= esc($row['kota_id']);?> - <?= esc($row['kota_nama']); ?></option>
                        <?php }?>
                    </select>
                    <div class="invalid-feedback errorEditKabkot"></div>
                </div> 

                <div class="form-group">
                    <label>Kecamatan</label>
                    <select class="form-control" name="editKecamatan" id="editKecamatan">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    <div class="invalid-feedback errorEditKecamatan"></div>
                </div>

                <div class="form-group">
                    <label for="">Kelurahan</label>
                    <select class="form-control" name="editKelurahan" id="editKelurahan">
                        <option value="">Pilih Kelurahan</option>
                    </select>
                    <div class="invalid-feedback errorEditKelurahan"></div>
                </div>

                <div class="form-group">
                    <label for="">Nama User</label>
                    <input type="text" class="form-control" name="editNama" id="editNama" placeholder="Nama User" >
                    <div class="invalid-feedback errorEditNama"></div>
                </div>
                <div class="form-group">
                    <label for="">NIK</label>
                    <input type="text" class="form-control" name="editNIK" id="editNIK" maxlength="16" placeholder="NIK" >
                    <div class="invalid-feedback errorEditNIK"></div>
                </div>
                <div class="form-group">
                    <label for="">Nomor Hp / Telepon</label>
                    <input type="text" class="form-control" name="editHp" id="editHp" placeholder="Nomor Hp/Telepon" >
                    <div class="invalid-feedback errorEditHp"></div>
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary btnedit" id="editbtn"><i class="far fa-paper-plane">&nbsp;</i> Simpan</button>
              </div>
              <?= form_close();?>
            </div>
          </div>
        </div>
        <!-- End Edit Data Users -->

        <!-- Edit Password Users -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editPass">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Ubah Password Users</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?= form_open_multipart('update_pass_user', ['class' => 'form-edit-pass']) ?>
              <input type="hidden" name="idUserPass" id="idUserPass">
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" name="editNewPass" id="editNewPass" maxlength="16" placeholder="Password Baru" >
                    <div class="invalid-feedback erroreditNewPass"></div>
                </div>
                <div class="form-group">
                    <label for="">Ulangi Password Baru</label>
                    <input type="password" class="form-control" name="editRepeatPass" id="editRepeatPass" placeholder="Ulangi Password Baru">
                    <div class="invalid-feedback erroreditRepeatPass"></div>
                </div>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary btneditpass" id="editbtnpass"><i class="far fa-paper-plane">&nbsp;</i> Simpan</button>
              </div>
              <?= form_close();?>
            </div>
          </div>
        </div>
        <!-- End Edit Password Users -->

      </div>
  <script type=text/javascript>
      // when city dropdown changes
    $('#addKabkot').on('change', function() {

        var kotaID = $(this).val();

        if (kotaID) {

            $.ajax({
                type: "GET",
                url: "<?= base_url('wilayah/getKecamatan')?>",
                data:{
                  kabkot_id: kotaID
                },
                success: function(res) {
                    var data = JSON.parse(res);
                    if (res) {
                        $("#addKecamatan").empty();
                        $("#addKecamatan").append('<option value="">Select Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $("#addKecamatan").append('<option value="' + value.kecamatan_id + '">' + value.kecamatan_nama +
                                '</option>');
                        });

                    } else {

                        $("#addKecamatan").empty();
                    }
                }
            });
        } else {

            $("#addKecamatan").empty();
        }
    });

    // when city dropdown changes
    $('#addKecamatan').on('change', function() {

        var kecamatanID = $(this).val();

        if (kecamatanID) {

            $.ajax({
                type: "GET",
                url: "<?= base_url('wilayah/getKelurahan')?>",
                data:{
                    kecamatan_id: kecamatanID
                },
                success: function(res) {
                    var data = JSON.parse(res);
                    if (res) {
                        $("#addKelurahan").empty();
                        $("#addKelurahan").append('<option value="">Select Kelurahan</option>');
                        $.each(data, function(key, value) {
                            $("#addKelurahan").append('<option value="' + value.kelurahan_id + '">' + value.kelurahan_nama +
                                '</option>');
                        });

                    } else {

                        $("#addKelurahan").empty();
                    }
                }
            });
        } else {
            
            $("#addKelurahan").empty();
        }
    });

  </script>

  <script>
    $(document).ready(function() {
        // Sembunyikan field kecamatan dan kelurahan saat halaman dimuat
    $('#addKabkot').parent().hide();
    $('#addKecamatan').parent().hide();
    $('#addKelurahan').parent().hide();
    
    // Ketika level akses berubah
    $('#addLevel').change(function() {
        var levelId = $(this).val();
        
        // Jika level provinsi
        if (levelId == '2') { // sesuaikan dengan ID level kabupaten/kota Anda
            $('#addKabkot').parent().hide();
            $('#addKecamatan').parent().hide();
            $('#addKelurahan').parent().hide();
            $("#addKecamatan").empty();
            $("#addKelurahan").empty();
        } 
        // Jika level kabkot
        else if (levelId == '4') { // sesuaikan dengan ID level kecamatan Anda
            $('#addKabkot').parent().show();
            $('#addKecamatan').parent().hide();
            $('#addKelurahan').parent().hide();
            $("#addKecamatan").empty();
            $("#addKelurahan").empty();
        }
        // Jika level kecamatan
        else if (levelId == '10') { // sesuaikan dengan ID level kelurahan Anda
            $('#addKabkot').parent().show();
            $('#addKecamatan').parent().show();
            $('#addKelurahan').parent().hide();
            $("#addKelurahan").empty();
        }
        // Level lainnya
        else {
            $('#addKecamatan').parent().show();
            $('#addKelurahan').parent().show();
            $('#addKabkot').parent().show();
        }
    });

        listdata = $('#table').DataTable({ 
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('admin/data_user_kabkot') ?>',
                 data: function (d) {
                    d.wilayah = $('#wilayah').val();
                }
            },
        });

        $('#wilayah').change(function(event) {
            listdata.ajax.reload();
        });

    });
</script>
  <script>
  $(document).ready(function(){
    $('#savebtn').click(function(e){
      e.preventDefault();
      let form = $('.form-add')[0];
      let data = new FormData(form);
      $(".loader-div").show();
        $.ajax({
          type: "post",
          url : "<?= base_url('admin/insert_user_kabkot') ?>",
          data:data,
          enctype: "multipart/form-data",
          processData:false,
          contentType:false,
          cache:false,
          dataType:"json",
          beforeSend: function(e){
            $('.btnsave').prop('disabled','disabled');
            $('.btnsave').html(`<img src='<?php echo base_url('template/image/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
          },
          complate: function(e){
            $('.btnsave').removeAttr('disabled');
            $('.btnsave').html(`Simpan`);
          },
          success:function(response){
            if (response.error) {
                //error 
                if (response.error.erroraddLevel) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addLevel').addClass('is-invalid');
                  $('.erroraddLevel').html(response.error.erroraddLevel);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addLevel').removeClass('is-invalid');
                  $('.erroraddLevel').removeClass('is-invalid');
                }

                if (response.error.erroraddKabkot) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addKabkot').addClass('is-invalid');
                  $('.erroraddKabkot').html(response.error.erroraddKabkot);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addKabkot').removeClass('is-invalid');
                  $('.erroraddKabkot').removeClass('is-invalid');
                }

                if (response.error.erroraddKecamatan) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addKecamatan').addClass('is-invalid');
                  $('.erroraddKecamatan').html(response.error.erroraddKecamatan);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addKecamatan').removeClass('is-invalid');
                  $('.erroraddKecamatan').removeClass('is-invalid');
                }

                if (response.error.erroraddKelurahan) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addKelurahan').addClass('is-invalid');
                  $('.erroraddKelurahan').html(response.error.erroraddKelurahan);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addKelurahan').removeClass('is-invalid');
                  $('.erroraddKelurahan').removeClass('is-invalid');
                }

                if (response.error.erroraddNama) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNama').addClass('is-invalid');
                  $('.erroraddNama').html(response.error.erroraddNama);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNama').removeClass('is-invalid');
                  $('.erroraddNama').removeClass('is-invalid');
                }

                if (response.error.erroraddNIK) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNIK').addClass('is-invalid');
                  $('.erroraddNIK').html(response.error.erroraddNIK);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNIK').removeClass('is-invalid');
                  $('.erroraddNIK').removeClass('is-invalid');
                }

                if (response.error.erroraddHp) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addHp').addClass('is-invalid');
                  $('.erroraddHp').html(response.error.erroraddHp);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addHp').removeClass('is-invalid');
                  $('.erroraddHp').removeClass('is-invalid');
                }

                if (response.error.erroraddPass) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addPass').addClass('is-invalid');
                  $('.erroraddPass').html(response.error.erroraddPass);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addPass').removeClass('is-invalid');
                  $('.erroraddPass').removeClass('is-invalid');
                } 

                if (response.error.erroraddUlangiPass) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addUlangiPass').addClass('is-invalid');
                  $('.erroraddUlangiPass').html(response.error.erroraddUlangiPass);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addUlangiPass').removeClass('is-invalid');
                  $('.erroraddUlangiPass').removeClass('is-invalid');
                }
                //end
                $(".loader-div").hide();

            }else{

                $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                $('.btnsave').removeAttr('disabled');
                
                $('#addKabkot').removeClass('is-invalid');
                $('.erroraddKabkot').removeClass('is-invalid');

                $('#addKecamatan').removeClass('is-invalid');
                $('.erroraddKecamatan').removeClass('is-invalid');

                $('#addKelurahan').removeClass('is-invalid');
                $('.erroraddKelurahan').removeClass('is-invalid');

                $('#addNama').removeClass('is-invalid');
                $('.erroraddNama').removeClass('is-invalid');

                $('#addLevel').removeClass('is-invalid');
                $('.erroraddLevel').removeClass('is-invalid');
                
                $('#addNIK').removeClass('is-invalid');
                $('.erroraddNIK').removeClass('is-invalid');
                
                $('#addHp').removeClass('is-invalid');
                $('.erroraddHp').removeClass('is-invalid');

                $('#addPass').removeClass('is-invalid');
                $('.erroraddPass').removeClass('is-invalid');
                
                $('#addUlangiPass').removeClass('is-invalid');
                $('.erroraddUlangiPass').removeClass('is-invalid');

                $(".form-add")[0].reset();
                $('#add').modal('hide');
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: response.sukses,
                  showConfirmButton: false,
                  timer: 1000
                });
                listdata.ajax.reload();
                $(".loader-div").hide();
            }
          },
          error: function(xhr, ajaxOptions, thrownError){
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }

        });

    });
    // ==========================================================================================================================================================
    // Update Account User
    // ==========================================================================================================================================================
    $('#editbtn').click(function(e){
      e.preventDefault();  
      let form = $('.form-edit')[0];
      let data = new FormData(form);
      $(".loader-div").show();
      setTimeout(function() {
      $.ajax({
        type: "post",
        url : "<?= base_url('admin/update_user_kabkot') ?>",
        data:data,
        enctype: "multipart/form-data",
        processData:false,
        contentType:false,
        cache:false,
        dataType:"json",
        beforeSend: function(e){
          $('.btnedit').prop('disabled','disabled');
          $('.btnedit').html(`<img src='<?php echo base_url('template/image/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
        },
        complate: function(e){
          $('.btnedit').removeAttr('disabled');
          $('.btnedit').html(`Simpan`);
        },
        success:function(response){
          if (response.error) {
              //error 
                if (response.error.errorEditStatus) {
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editStatus').addClass('is-invalid');
                  $('.errorEditStatus').html(response.error.errorEditStatus);
                }else{
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editStatus').removeClass('is-invalid');
                  $('.errorEditStatus').removeClass('is-invalid');
                }

                if (response.error.errorEditLevel) {
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editLevel').addClass('is-invalid');
                  $('.errorEditLevel').html(response.error.errorEditLevel);
                }else{
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editLevel').removeClass('is-invalid');
                  $('.errorEditLevel').removeClass('is-invalid');
                }

                if (response.error.errorEditKabkot) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#editKabkot').addClass('is-invalid');
                  $('.errorEditKabkot').html(response.error.errorEditKabkot);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#editKabkot').removeClass('is-invalid');
                  $('.errorEditKabkot').removeClass('is-invalid');
                }

                if (response.error.errorEditKecamatan) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#editKecamatan').addClass('is-invalid');
                  $('.errorEditKecamatan').html(response.error.errorEditKecamatan);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#editKecamatan').removeClass('is-invalid');
                  $('.errorEditKecamatan').removeClass('is-invalid');
                }

                if (response.error.errorEditKelurahan) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#editKelurahan').addClass('is-invalid');
                  $('.errorEditKelurahan').html(response.error.errorEditKelurahan);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#editKelurahan').removeClass('is-invalid');
                  $('.errorEditKelurahan').removeClass('is-invalid');
                }

                if (response.error.erroreditNama) {
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editNama').addClass('is-invalid');
                  $('.erroreditNama').html(response.error.erroreditNama);
                }else{
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editNama').removeClass('is-invalid');
                  $('.erroreditNama').removeClass('is-invalid');
                }

                if (response.error.erroreditNIK) {
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editNIK').addClass('is-invalid');
                  $('.erroreditNIK').html(response.error.erroreditNIK);
                }else{
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editNIK').removeClass('is-invalid');
                  $('.erroreditNIK').removeClass('is-invalid');
                }
                
                if (response.error.erroreditHp) {
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editHp').addClass('is-invalid');
                  $('.erroreditHp').html(response.error.erroreditHp);
                }else{
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editHp').removeClass('is-invalid');
                  $('.erroreditHp').removeClass('is-invalid');
                }
              //end
              $(".loader-div").hide();

          }else{

              $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
              $('.btnedit').removeAttr('disabled');

              $('#editLevel').removeClass('is-invalid');
              $('.erroreditLevel').removeClass('is-invalid');

              $('#editStatus').removeClass('is-invalid');
              $('.errorEditStatus').removeClass('is-invalid');

              $('#editKabkot').removeClass('is-invalid');
              $('.errorEditKabkot').removeClass('is-invalid');

              $('#editKecamatan').removeClass('is-invalid');
              $('.errorEditKecamatan').removeClass('is-invalid');

              $('#editKelurahan').removeClass('is-invalid');
              $('.errorEditKelurahan').removeClass('is-invalid');

              $('#editNama').removeClass('is-invalid');
              $('.erroreditNama').removeClass('is-invalid');
            
              $('#editNIK').removeClass('is-invalid');
              $('.erroreditNIK').removeClass('is-invalid');
            
              $('#editHp').removeClass('is-invalid');
              $('.erroreditHp').removeClass('is-invalid');

              $(".form-edit")[0].reset();
              $('#edit').modal('hide');
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.sukses,
                showConfirmButton: false,
                timer: 1000
              });
              listdata.ajax.reload();
              $(".loader-div").hide();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }

      });

    }, 500);

    });

    // ==========================================================================================================================================================
    // Update Password
    // ==========================================================================================================================================================

    $('#editbtnpass').click(function(e){
      e.preventDefault();  
      let form = $('.form-edit-pass')[0];
      let data = new FormData(form);
      $(".loader-div").show();
      $.ajax({
        type: "post",
        url : "<?= base_url('admin/update_pass_kabkot') ?>",
        data:data,
        enctype: "multipart/form-data",
        processData:false,
        contentType:false,
        cache:false,
        dataType:"json",
        beforeSend: function(e){
          $('.btneditpass').prop('disabled','disabled');
          $('.btneditpass').html(`<img src='<?php echo base_url('assets/img/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
        },
        complate: function(e){
          $('.btneditpass').removeAttr('disabled');
          $('.btneditpass').html(`Simpan`);
        },
        success:function(response){
          if (response.error) {
              //error 
                if (response.error.erroreditNewPass) {
                  $('.btneditpass').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btneditpass').removeAttr('disabled');
                  $('#editNewPass').addClass('is-invalid');
                  $('.erroreditNewPass').html(response.error.erroreditNewPass);
                }else{
                  $('.btneditpass').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btneditpass').removeAttr('disabled');
                  $('#editNewPass').removeClass('is-invalid');
                  $('.erroreditNewPass').removeClass('is-invalid');
                }
                
                if (response.error.erroreditRepeatPass) {
                  $('.btneditpass').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btneditpass').removeAttr('disabled');
                  $('#editRepeatPass').addClass('is-invalid');
                  $('.erroreditRepeatPass').html(response.error.erroreditRepeatPass);
                }else{
                  $('.btneditpass').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btneditpass').removeAttr('disabled');
                  $('#editRepeatPass').removeClass('is-invalid');
                  $('.erroreditRepeatPass').removeClass('is-invalid');
                }
              //end
              $(".loader-div").hide();

          }else{
              $('.btneditpass').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
              $('.btneditpass').removeAttr('disabled');
            
              $('#editNewPass').removeClass('is-invalid');
              $('.erroreditNewPass').removeClass('is-invalid');
            
              $('#editRepeatPass').removeClass('is-invalid');
              $('.erroreditRepeatPass').removeClass('is-invalid');

              $(".form-edit-pass")[0].reset();
              $('#editPass').modal('hide');
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.sukses,
                showConfirmButton: false,
                timer: 1000
              });
              listdata.ajax.reload();
              $(".loader-div").hide();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }

      });

    });

    // End edit password 

  });

  // Edit Permintaan Data
  function edit_data(id) {
    $.ajax({
        type : "GET",
        url  : "<?= base_url('admin/edit_user_kabkot')?>",
        dataType : "JSON",
        data : {id: id},
        cache: false,
        success: function(data){
            $("#idUser").val(data.user_account_id);
            $("#editStatus").val(data.user_account_status).trigger('change');
            $("#editKabkot").val(data.region).trigger('change');

            // Ambil data kecamatan berdasarkan kota
            $.ajax({
                url: "<?= base_url('wilayah/getKecamatanByKabkot') ?>",
                type: "GET",
                data: { kota_id: data.region },
                dataType: "json",
                success: function(kecamatanList) {
                    $('#editKecamatan').html('<option value="">Pilih Kecamatan</option>');
                    $.each(kecamatanList, function(i, row) {
                        let selected = row.kecamatan_id == data.kecamatan ? 'selected' : '';
                        $('#editKecamatan').append(`<option value="${row.kecamatan_id}" ${selected}>${row.kecamatan_nama}</option>`);
                    });

                    // Ambil data kelurahan berdasarkan kecamatan
                    $.ajax({
                        url: "<?= base_url('wilayah/getKelurahanByKecamatan') ?>",
                        type: "GET",
                        data: { kecamatan_id: data.kecamatan },
                        dataType: "json",
                        success: function(kelurahanList) {
                            $('#editKelurahan').html('<option value="">Pilih Kelurahan</option>');
                            $.each(kelurahanList, function(i, row) {
                                let selected = row.kelurahan_id == data.kelurahan ? 'selected' : '';
                                $('#editKelurahan').append(`<option value="${row.kelurahan_id}" ${selected}>${row.kelurahan_nama}</option>`);
                            });
                        }
                    });
                }
            });

            $("#editNama").val(data.user_account_full_name);
            $("#editNIK").val(data.user_account_username);
            $("#editRegion").val(data.region);
            $("#editHp").val(data.user_account_contact);
            $("#editLevel").val(data.role_access_id).trigger('change');
            $("#editBidang").val(data.bidang_id).trigger('change');
        }
    });

}

  
  function edit_password(id){
    $.ajax({
        type : "GET",
        url  : "<?= base_url('admin/edit_user_kabkot')?>",
        dataType : "JSON",
        data : {id: id},
        cache:false,
        success: function(data){
          $.each(data,function(user_account_id){
              $("#idUserPass").val(data.user_account_id);
          });
        }
    });
  }

  function delete_data(id){

    Swal.fire({
    title: 'Hapus',
    text: "Yakin hapus data ini",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#31ce36',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: "Tidak"
    }).then((result) => {
    if (result.isConfirmed) {
        $(".loader-div").show();
        setTimeout(function() {
            $.ajax({
            type: 'post',
            url: "<?= base_url('admin/delete_user_kabkot'); ?>",
            data: {
                <?= csrf_token()?>: "<?= csrf_hash(); ?>",
                id:id 
            },
            dataType: "json",
            success: function(response){
                if(response.sukses){
                $(".loader-div").hide();
                listdata.ajax.reload();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.sukses,
                    showConfirmButton: false,
                    timer: 1000
                });
                }else{
                $(".loader-div").hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal Hapus Data',
                    showConfirmButton: false,
                    timer: 1000
                });
                }
            },
            error: function(){
                $(".loader-div").hide();
                toastr['error']("gagal dihapus");
            }
            });
        }, 500);
    }
    })      
 }

</script>   
