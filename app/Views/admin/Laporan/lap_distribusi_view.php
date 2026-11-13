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
                          <a href="<?= base_url('admin/lap_distribusian'); ?>" class="btn btn-outline-success"><i class="fas fa-undo"></i> Refrash Halaman</a>
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
                      <?php $getBln     = isset($_GET['bln']) ? $_GET['bln'] : null; ?>
                      <div class="row">
                        <div class="col-2">
                          <select class="form-control" name="thn" id="thn" required>
                            <option value="">Pilih Tahun</option>
                            <?php for ($i=$endThn; $i <= $thn; $i++) { ?>
                              <option value="<?= $i; ?>" <?php if($getThn == $i){echo "selected";}?>><?= $i; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-2">
                          <select class="form-control" name="bln" id="bln">
                            <option value="">Semua</option>
                            <option value="01" <?php if($getBln == '01'){echo "selected";} ?>>Januari</option>
                            <option value="02" <?php if($getBln == '02'){echo "selected";} ?>>Februari</option>
                            <option value="03" <?php if($getBln == '03'){echo "selected";} ?>>Maret</option>
                            <option value="04" <?php if($getBln == '04'){echo "selected";} ?>>April</option>
                            <option value="05" <?php if($getBln == '05'){echo "selected";} ?>>Mei</option>
                            <option value="06" <?php if($getBln == '06'){echo "selected";} ?>>Juni</option>
                            <option value="07" <?php if($getBln == '07'){echo "selected";} ?>>Juli</option>
                            <option value="08" <?php if($getBln == '08'){echo "selected";} ?>>Agustus</option>
                            <option value="09" <?php if($getBln == '09'){echo "selected";} ?>>September</option>
                            <option value="10" <?php if($getBln == '10'){echo "selected";} ?>>Oktober</option>
                            <option value="11" <?php if($getBln == '11'){echo "selected";} ?>>November</option>
                            <option value="12" <?php if($getBln == '12'){echo "selected";} ?>>Desember</option>
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
                            <th>Jumlah (Keping)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if ($dataSearch != null) { ?>
                            <?php $i=1; foreach ($dataSearch as $value) { ?>
                              <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $value['nama_kabkot']; ?></td>
                                <td><?= number_format($value['total_blanko']); ?></td>
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
