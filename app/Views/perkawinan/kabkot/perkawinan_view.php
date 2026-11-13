    <!-- Main Content -->
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
                    <a href="<?= base_url('admin/kabkot_perkawinan'); ?>" class="btn btn-outline-success">Refrash Data Kabupaten Kota</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table">
                        <thead>                                 
                          <tr>
                            <th class="text-center">No</th>
                            <th>NIK</th>
                            <th>Jenis</th>
                            <th>Nama Lengkap</th>
                            <th>Kabupaten Kota</th>
                            <th>Kecamatan</th>
                            <th>Status Perkawinan</th>
                            <th>No Buku Nikah/Akta Perkawinan</th>
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

      </div>

  <script>
    $(document).ready(function() {
        listData = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('admin/getPerkawinanKabkot');?>',
            columns: [
              {data: 'no', orderable: false}, // Kolom nomor tidak diurutkan
              {data: 'nik'},
              {data: 'nama'},
              {data: 'hub_kawin'},
              {data: 'nama_kabkot'},
              {data: 'kecamatan_nama'},
              {data: 'status_perkawinan'},
              {data: 'no_buku_nikah'},
              {data: 'action', orderable: false},
            ],
            order: [[1, 'asc']] // Urutkan berdasarkan kolom `kegiatan_name` secara default
        });
    });
</script>
  <script>
  $(document).ready(function(){
    // ==========================================================================================================================================================
    // Update Account User
    // ==========================================================================================================================================================
    $('#verifybtn').click(function(e){
      e.preventDefault();  
      let form = $('.form-verify')[0];
      let data = new FormData(form);
      $(".loader-div").show();
      $.ajax({
        type: "post",
        url : "<?= base_url('admin/verifyPerkawinan') ?>",
        data:data,
        enctype: "multipart/form-data",
        processData:false,
        contentType:false,
        cache:false,
        dataType:"json",
        beforeSend: function(e){
          $('.btnverify').prop('disabled','disabled');
          $('.btnverify').html(`<img src='<?php echo base_url('template/image/eloading.gif'); ?>' width='20px' height='16px'> Memproses`);
        },
        complate: function(e){
          $('.btnverify').removeAttr('disabled');
          $('.btnverify').html(`Simpan`);
        },
        success:function(response){
          if (response.error) {
              //error 
              if (response.error.errorverifyStatus) {
                  $('.btnverify').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnverify').removeAttr('disabled');
                  $('#verifyStatus').addClass('is-invalid');
                  $('.errorverifyStatus').html(response.error.errorverifyStatus);
                }else{
                  $('.btnverify').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnverify').removeAttr('disabled');
                  $('#verifyStatus').removeClass('is-invalid');
                  $('.errorverifyStatus').removeClass('is-invalid');
                }
              //end
              $(".loader-div").hide();

          }else{
              $('.btnverify').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
              $('.btnverify').removeAttr('disabled');

              $('#verifyStatus').removeClass('is-invalid');
              $('.errorverifyStatus').removeClass('is-invalid');

              $(".form-verify")[0].reset();
              $('#verify').modal('hide');
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.sukses,
                showConfirmButton: false,
                timer: 1000
              });
              listData.ajax.reload();
              $(".loader-div").hide();
          }
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }

      });

    });


  });

  // Edit Permintaan Data
  function verify(id) {
    $.ajax({
        type : "GET",
        url  : "<?= base_url('admin/getByIdKematian')?>",
        dataType : "JSON",
        data : {id: id},
        cache:false,
        success: function(data){
          $.each(data,function(id,nik,status){
              $("#verifyIdKematian").val(data.id);
              $("#verifyNik").val(data.nik);
              $("#verifyStatus").val(data.status).trigger('change');
          });
        }
    });

  }
  
  

  function deleteData(id){

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
            url: "<?= base_url('admin/deletePerkawinan'); ?>",
            data: {
                <?= csrf_token()?>: "<?= csrf_hash(); ?>",
                id:id 
            },
            dataType: "json",
            success: function(response){
                if(response.sukses){
                $(".loader-div").hide();
                listData.ajax.reload();
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
