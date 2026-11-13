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
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Tambah</button>&nbsp;
                    <a href="<?= base_url('admin/kelurahan_perkawinan'); ?>" class="btn btn-outline-success">Refrash Data Kelurahan</a>
                    <form action="" class="ml-1">
                      <button type="submit" name="excel" class="btn btn-primary">Export Excel</button>
                    </form>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              No
                            </th>
                            <th>NIK</th>
                            <th>Jenis</th>
                            <th>Nama Lengkap</th>
                            <th>Kabupaten Kota</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
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

        <!-- Add Data Users -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Entri Perkawinan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?= form_open_multipart('insert_user', ['class' => 'form-add']) ?>
              <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">NIK Suami</label>
                            <input type="text" class="form-control" name="addNikSuami" id="addNikSuami" maxlength="16" placeholder="NIK Suami">
                            <div class="invalid-feedback erroraddNikSuami"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nik Istri</label>
                            <input type="text" class="form-control" name="addNikIstri" id="addNikIstri" maxlength="16" placeholder="NIK Istri">
                            <div class="invalid-feedback erroraddNikIstri"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Suami</label>
                            <input type="text" class="form-control" name="addNamaSuami" id="addNamaSuami" placeholder="Nama Suami">
                            <div class="invalid-feedback erroraddNamaSuami"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Istri</label>
                            <input type="text" class="form-control" name="addNamaIstri" id="addNamaIstri" placeholder="Nama Istri">
                            <div class="invalid-feedback erroraddNamaIstri"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tempat Lahir Suami</label>
                            <input type="text" class="form-control" name="addTmpLahirSuami" id="addTmpLahirSuami" placeholder="Tempat Lahir Suami">
                            <div class="invalid-feedback erroraddTmpLahirSuami"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tempat Lahir Istri</label>
                            <input type="text" class="form-control" name="addTmpLahirIstri" id="addTmpLahirIstri" placeholder="Tempat Lahir Istri">
                            <div class="invalid-feedback erroraddTmpLahirIstri"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Lahir Suami</label>
                            <input type="date" class="form-control" name="addTglLahirSuami" id="addTglLahirSuami">
                            <div class="invalid-feedback erroraddTglLahirSuami"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Lahir Istri</label>
                            <input type="date" class="form-control" name="addTglLahirIstri" id="addTglLahirIstri">
                            <div class="invalid-feedback erroraddTglLahirIstri"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Agama Suami</label>
                            <input type="text" class="form-control" name="addAgamaSuami" id="addAgamaSuami" placeholder="Agama Suami">
                            <div class="invalid-feedback erroraddAgamaSuami"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Agama Istri</label>
                            <input type="text" class="form-control" name="addAgamaIstri" id="addAgamaIstri" placeholder="Agama Istri">
                            <div class="invalid-feedback erroraddAgamaIstri"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Alamat Suami</label>
                            <input type="text" class="form-control" name="addAlamatSuami" id="addAlamatSuami" placeholder="Alamat Suami">
                            <div class="invalid-feedback erroraddAlamatSuami"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Alamat Istri</label>
                            <input type="text" class="form-control" name="addAlamatIstri" id="addAlamatIstri" placeholder="Alamat Istri">
                            <div class="invalid-feedback erroraddAlamatIstri"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Orang Tua Suami (Ayah)</label>
                            <input type="text" class="form-control" name="addNamaOtruSuamiAyah" id="addNamaOtruSuamiAyah" placeholder="Nama Ortu Suami (Ayah)">
                            <div class="invalid-feedback erroraddNamaOtruSuamiAyah"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Orang Tua Istri (Ayah)</label>
                            <input type="text" class="form-control" name="addNamaOtruIstriAyah" id="addNamaOtruIstriAyah" placeholder="Nama Ortu Istri (Ayah)">
                            <div class="invalid-feedback erroraddNamaOtruIstriAyah"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Orang Tua Suami (Ibu)</label>
                            <input type="text" class="form-control" name="addNamaOtruSuamiIbu" id="addNamaOtruSuamiIbu" placeholder="Nama Ortu Suami (Ibu)">
                            <div class="invalid-feedback erroraddNamaOtruSuamiIbu"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Orang Tua Istri (Ibu)</label>
                            <input type="text" class="form-control" name="addNamaOtruIstriIbu" id="addNamaOtruIstriIbu" placeholder="Nama Ortu Istri (Ibu)">
                            <div class="invalid-feedback erroraddNamaOtruIstriIbu"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Tempat Pelaksanaan Akad Nikah/Perkawinan</label>
                            <input type="text" name="addPelaksaanAkad" id="addPelaksaanAkad" class="form-control" placeholder="Tempat Pelaksanaan Akad">
                            <div class="invalid-feedback erroraddPelaksaanAkad"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Tanggal Pelaksanaan Akad Nikah/Perkawinan</label>
                            <input type="date" name="addTglAkad" class="form-control">
                            <div class="invalid-feedback erroraddTglAkad"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Dihadapan/Didepan Wali Nikah/Perkawinan</label>
                            <select name="addHadapanWali" id="addHadapanWali" class="form-control">
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Katolik">Katolik</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Konghucu">Konghucu</option>
                              <option value="Penganut Kepercayaan">Penganut Kepercayaan</option>
                            </select>
                            <div class="invalid-feedback erroraddHadapanWali"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama Wali Nikah/Pemuka Agama</label>
                            <input type="text" name="addNamaWali" id="addNamaWali" class="form-control" placeholder="Nama Wali Nikah/Pemuka Agama">
                            <div class="invalid-feedback erroraddNamaWali"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Alamat Wali Nikah/Pemuka Agama</label>
                            <input type="text" name="addAlamatWali" id="addAlamatWali" class="form-control" placeholder="Alamat Wali Nikah/Pemuka Agama">
                            <div class="invalid-feedback erroraddAlamatWali"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Status Perkawinan</label>
                            <select name="addStatusPerkawinan" id="addStatusPerkawinan" class="form-control">
                              <option value="Tercatat">Tercatat</option>
                              <option value="Tidak Tercatat/Siri">Tidak Tercatat/Siri</option>
                            </select>
                            <div class="invalid-feedback erroraddStatusPerkawinan"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Jika Tercatat No.Buku Nikah/Akta Perkawinan</label>
                            <input type="text" name="addNoBukuNikah" class="form-control" placeholder="No.Buku Nikah/Akta Perkawinan">
                            <div class="invalid-feedback erroraddNoBukuNikah"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="addKet" class="form-control" placeholder="Keterangan">
                            <div class="invalid-feedback erroraddKet"></div>
                        </div>
                    </div>
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

        <!-- Edit Data  -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Perkawinan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?= form_open_multipart('update_user', ['class' => 'form-edit']) ?>
              <input type="hidden" name="editIdPerkawinan" id="editIdPerkawinan">
              <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">NIK</label>
                            <input type="text" class="form-control" name="editNik" id="editNik" maxlength="16" placeholder="NIK">
                            <div class="invalid-feedback erroreditNik"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="editNama" id="editNama" placeholder="Nama">
                            <div class="invalid-feedback erroreditNama"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control" name="editTmpLahir" id="editTmpLahir" placeholder="Tempat Lahir">
                            <div class="invalid-feedback erroreditTmpLahir"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="editTglLahir" id="editTglLahir">
                            <div class="invalid-feedback erroreditTglLahir"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Agama</label>
                            <input type="text" class="form-control" name="editAgama" id="editAgama" placeholder="Agama Suami">
                            <div class="invalid-feedback erroreditAgama"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="editAlamat" id="editAlamat" placeholder="Alamat Suami">
                            <div class="invalid-feedback erroreditAlamat"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Orang Tua (Ayah)</label>
                            <input type="text" class="form-control" name="editNamaOtruAyah" id="editNamaOtruAyah" placeholder="Nama Ortu (Ayah)">
                            <div class="invalid-feedback erroreditNamaOtruAyah"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Orang Tua (Ibu)</label>
                            <input type="text" class="form-control" name="editNamaOtruIbu" id="editNamaOtruIbu" placeholder="Nama Ortu (Ayah)">
                            <div class="invalid-feedback erroreditNamaOtruIbu"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tempat Pelaksanaan Akad Nikah/Perkawinan</label>
                            <input type="text" name="editPelaksaanAkad" id="editPelaksaanAkad" class="form-control" placeholder="Tempat Pelaksanaan Akad">
                            <div class="invalid-feedback erroreditPelaksaanAkad"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tanggal Pelaksanaan Akad Nikah/Perkawinan</label>
                            <input type="date" name="editTglAkad" id="editTglAkad" class="form-control">
                            <div class="invalid-feedback erroreditTglAkad"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Dihadapan/Didepan Wali Nikah/Perkawinan</label>
                            <select name="editHadapanWali" id="editHadapanWali" class="form-control">
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Katolik">Katolik</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                              <option value="Konghucu">Konghucu</option>
                              <option value="Penganut Kepercayaan">Penganut Kepercayaan</option>
                            </select>
                            <div class="invalid-feedback erroreditHadapanWali"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Wali Nikah/Pemuka Agama</label>
                            <input type="text" name="editNamaWali" id="editNamaWali" class="form-control" placeholder="Nama Wali Nikah/Pemuka Agama">
                            <div class="invalid-feedback erroreditNamaWali"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Alamat Wali Nikah/Pemuka Agama</label>
                            <input type="text" name="editAlamatWali" id="editAlamatWali" class="form-control" placeholder="Alamat Wali Nikah/Pemuka Agama">
                            <div class="invalid-feedback erroreditAlamatWali"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Status Perkawinan</label>
                            <select name="editStatusPerkawinan" id="editStatusPerkawinan" class="form-control">
                              <option value="Tercatat">Tercatat</option>
                              <option value="Tidak Tercatat/Siri">Tidak Tercatat/Siri</option>
                            </select>
                            <div class="invalid-feedback erroreditStatusPerkawinan"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Jika Tercatat No.Buku Nikah/Akta Perkawinan</label>
                            <input type="text" name="editNoBukuNikah" id="editNoBukuNikah" class="form-control" placeholder="No.Buku Nikah/Akta Perkawinan">
                            <div class="invalid-feedback erroreditNoBukuNikah"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="editKet" id="editKet" class="form-control" placeholder="Keterangan">
                            <div class="invalid-feedback erroraddKet"></div>
                        </div>
                    </div>
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
        <!-- End Edit  -->

      </div>
  <script>
    $(document).ready(function() {
        listData = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?= base_url('admin/getPerkawinanKelurahan')?>',
            columns: [
              {data: 'no', orderable: false}, // Kolom nomor tidak diurutkan
              {data: 'nik'},
              {data: 'nama'},
              {data: 'hub_kawin'},
              {data: 'nama_kabkot'},
              {data: 'kecamatan_nama'},
              {data: 'kelurahan_nama'},
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
    $('#savebtn').click(function(e){
      e.preventDefault();
      let form = $('.form-add')[0];
      let data = new FormData(form);
      $(".loader-div").show();
        $.ajax({
          type: "post",
          url : "<?= base_url('admin/insert_perkawinan') ?>",
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
                if (response.error.erroraddNikSuami) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNikSuami').addClass('is-invalid');
                  $('.erroraddNikSuami').html(response.error.erroraddNikSuami);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNikSuami').removeClass('is-invalid');
                  $('.erroraddNikSuami').removeClass('is-invalid');
                }

                if (response.error.erroraddNikIstri) {
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNikIstri').addClass('is-invalid');
                  $('.erroraddNikIstri').html(response.error.erroraddNikIstri);
                }else{
                  $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnsave').removeAttr('disabled');
                  $('#addNikIstri').removeClass('is-invalid');
                  $('.erroraddNikIstri').removeClass('is-invalid');
                }
                //end
                $(".loader-div").hide();

            }else{

                $('.btnsave').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                $('.btnsave').removeAttr('disabled');
                
                $('#addNikSuami').removeClass('is-invalid');
                $('.erroraddNikSuami').removeClass('is-invalid');

                $('#addNikIstri').removeClass('is-invalid');
                $('.erroraddNikIstri').removeClass('is-invalid');
                
                $(".form-add")[0].reset();
                $('#add').modal('hide');
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
    // ==========================================================================================================================================================
    // Update Account User
    // ==========================================================================================================================================================
    $('#editbtn').click(function(e){
      e.preventDefault();  
      let form = $('.form-edit')[0];
      let data = new FormData(form);
      $(".loader-div").show();
      $.ajax({
        type: "post",
        url : "<?= base_url('admin/update_perkawinan') ?>",
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
              if (response.error.erroreditNik) {
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editNik').addClass('is-invalid');
                  $('.erroreditNik').html(response.error.erroreditNik);
                }else{
                  $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
                  $('.btnedit').removeAttr('disabled');
                  $('#editNik').removeClass('is-invalid');
                  $('.erroreditNik').removeClass('is-invalid');
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
              //end
              $(".loader-div").hide();

          }else{
              $('.btnedit').html(`<i class="far fa-paper-plane">&nbsp;</i> Simpan`);
              $('.btnedit').removeAttr('disabled');

              $('#editNama').removeClass('is-invalid');
              $('.erroreditNama').removeClass('is-invalid');
              
              $('#editNik').removeClass('is-invalid');
              $('.erroreditNik').removeClass('is-invalid');

              $(".form-edit")[0].reset();
              $('#edit').modal('hide');
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
  function editData(id) {
    $.ajax({
        type : "GET",
        url  : "<?= base_url('admin/getByIdPerkawinan')?>",
        dataType : "JSON",
        data : {id: id},
        cache:false,
        success: function(data){
          $.each(data,function(id,user_id,no_pasangan,nik,nama,hub_kawin,tmp_lahir,tgl_lahir,agama,alamat,nama_ortu_ayah,nama_ortu_ibu,tmp_akad_nikah,tgl_akad_nikah,agama_wali_nikah,nama_wali,alamat_wali,status_perkawinan,no_buku_nikah,ket){
              $("#editIdPerkawinan").val(data.id);
              $("#editNik").val(data.nik);
              $("#editNama").val(data.nama);
              $("#editTmpLahir").val(data.tmp_lahir);
              $("#editTglLahir").val(data.tgl_lahir);
              $("#editAgama").val(data.agama);
              $("#editAlamat").val(data.alamat);
              $("#editNamaOtruAyah").val(data.nama_ortu_ayah);
              $("#editNamaOtruIbu").val(data.nama_ortu_ibu);
              $("#editPelaksaanAkad").val(data.tmp_akad_nikah);
              $("#editTglAkad").val(data.tgl_akad_nikah);
              $("#editHadapanWali").val(data.agama_wali_nikah).trigger('change');
              $("#editNamaWali").val(data.nama_wali);
              $("#editAlamatWali").val(data.alamat_wali);
              $("#editStatusPerkawinan").val(data.status_perkawinan);
              $("#editNoBukuNikah").val(data.no_buku_nikah);
              $("#editKet").val(data.ket);
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
