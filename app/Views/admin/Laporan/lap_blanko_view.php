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
                    <?= esc($title_page);?>
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
                    
                    <div class="container-fluid">
                      <div class="row justify-content-between">
                        <div class="col-6">
                          <a href="<?= base_url('admin/lap_blanko_masuk'); ?>" class="btn btn-outline-success"><i class="fas fa-undo"></i> Refrash Halaman</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="card-body">
                    <?php 
                      $thn = date('Y'); 
                      $endThn = $thn - 2;
                    ?>
                    <form>
                      <?php $getThn = isset($_GET['thn']) ? $_GET['thn'] : null; ?>
                      <div class="row">
                        <div class="col-3">
                          <select class="form-control" name="thn" id="thn">
                            <option value="">Pilih Tahun</option>
                            <?php for ($i=$endThn; $i <= $thn; $i++) { ?>
                              <option value="<?= $i; ?>" <?php if($getThn == $i){echo "selected";}?>><?= $i; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-2">
                          <button type="submit" name="search" class="btn btn-outline-success"> Cari</button>
                          <button type="submit" name="Export" class="btn btn-outline-success"> Export Excel</button>
                        </div>
                      </div>
                    </form>

                    <div class="table-responsive mt-4">
                      <table id="table-datatables" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Berita Acara Serah Terima Pusat dengan Provinsi</th>
                            <th>Tanggal</th>
                            <th>Jumlah (Keping)</th>
                            <th>Penerima</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($dataSearch != null) { ?>
                            <?php $i=1; foreach ($dataSearch as $value) { ?>
                              <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $value['no_berita_acara']; ?></td>
                                <td><?= indonesia_date_v1($value['tgl_masuk']); ?></td>
                                <td><?= number_format($value['jumlah']); ?></td>
                                <td><?= $value['penerima']; ?></td>
                              </tr>
                            <?php } ?>
                          <?php }else{ ?>
                            <tr>
                              <td colspan="4" style="text-align: center;">Data Kosong</td>
                            </tr>
                          <?php } ?>
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
            ajax: '<?= base_url('admin/getAllProgram');?>',
            columns: [
              {data: 'no', orderable: false}, // Kolom nomor tidak diurutkan
              {data: 'program_name'},
              {data: 'created_at'},
              {data: 'action', orderable: false},
            ],
            order: [[1, 'asc']] // Urutkan berdasarkan kolom `program_name` secara default
        });

        $(document).ready(function () {
          $('#table-datatables').DataTable({
              dom: 'Bfrtip',
              buttons: ['copy','csv','excel','pdf','print']
          });
        });
    });
</script>
<script>

// Edit Permintaan Data
function editData(id) {
    $.ajax({
        type : "GET",
        url  : "<?= base_url('admin/getByIdProgram')?>",
        dataType : "JSON",
        data : {id: id},
        cache:false,
        success: function(data){
            $.each(data,function(program_id,program_name){
                $("#editProgramId").val(data.program_id);
                $("#editProgram").val(data.program_name);
            });
        }
    });

}

</script>  
