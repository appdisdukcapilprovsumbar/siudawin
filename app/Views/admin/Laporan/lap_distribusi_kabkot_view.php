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
                          <a href="<?= base_url('admin/lap_distribusian_kabkot'); ?>" class="btn btn-outline-success"><i class="fas fa-undo"></i> Refrash Halaman</a>
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
                      <?php $getKabkot  = isset($_GET['kabkot']) ? $_GET['kabkot'] : null; ?>
                      <?php $getThn     = isset($_GET['thn']) ? $_GET['thn'] : null; ?>
                      <div class="row">
                        <div class="col-3">
                          <select class="form-control" name="kabkot" id="kabkot">
                            <option value="">Pilih Kabupaten Kota</option>
                            <?php foreach ($kabkot as $value) { ?>
                              <option value="<?= $value['kode_kabkot']; ?>" <?php if($getKabkot == $value['kode_kabkot']){echo "selected";}?>><?= $value['kode_kabkot']; ?> - <?= $value['nama_kabkot']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-2">
                          <select class="form-control" name="thn" id="thn" required>
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
                            <th>Kabupaten/Kota</th>
                            <th>Nomor Berita Acara</th>
                            <th>Jumlah (Keping)</th>
                            <th>Tanggal Keluar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($dataSearch != null) { ?>
                            <?php $i=1; foreach ($dataSearch as $value) { ?>
                              <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $value['nama_kabkot']; ?></td>
                                <td><?= $value['no_berita_acara']; ?></td>
                                <td><?= number_format($value['jumlah']); ?></td>
                                <td><?= indonesia_date_only($value['tgl_keluar']); ?></td>
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
      $(document).ready(function () {
        $('#table-datatables').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy','csv','excel','pdf','print']
        });
      });
</script>
