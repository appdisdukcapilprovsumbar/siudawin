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
                    <h4>Filter Data Pemakaman</h4>
                  </div>
                  <div class="card-body">
                    <form action="" method="GET" class="form-filter">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun" id="tahun" required oninvalid="this.setCustomValidity('Tahun tidak boleh kosong')" oninput="this.setCustomValidity('')">
                              <option value="">.: TAHUN :.</option>
                              <?php 
                              $yearNow = date('Y');
                              $yearLast =  date('Y') - 1;
                                for ($i= $yearLast; $i <= $yearNow  ; $i++) { 
                              ?>
                              <option value="<?= $i ?>"><?= $i; ?></option>
                            <?php } ?>

                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan" id="bulan" required oninvalid="this.setCustomValidity('Bulan tidak boleh kosong')" oninput="this.setCustomValidity('')">
                            <option value="">.: BULAN :.</option>
                            <?php 
                                $namaBulan = [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember'
                                ];

                                foreach ($namaBulan as $key => $value) {
                                    echo "<option value=\"$key\">$value</option>";
                                }
                            ?>
                        </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="row">
                                <div class="col-md-6">
                                  <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-search"></i> Cari
                                  </button>
                                </div>
                                <div class="col-md-6">
                                  <!-- <button class="btn btn-primary btn-block" onclick="exportTableToExcel('tabel-data', 'Laporan Data Kematian')"><i class="fas fa-download"></i> Export</button> -->
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                    <div class="table-responsive mt-4">
                      <table class="table table-striped" id="tabel-data">
                        <thead>                        
                          <tr class="text-center">
                            <th>NAMA KECAMATAN</th>
                            <th>JUMLAH PERKAWINAN BULAN INI</th>
                            <th>JUMLAH PERKAWINAN TERCATAT BULAN INI</th>
                            <th>JUMLAH PERKAWINAN TIDAK TERCATAT BULAN INI</th>
                            <th>JUMLAH SELURUH PERKAWINAN SEJAK BULAN JANUARI TAHUN INI</th>
                            <th>JUMLAH SELURUH PERKAWINAN TERCATAT SEJAK BULAN JANUARI TAHUN INI</th>
                            <th>JUMLAH SELURUH PERKAWINAN TIDAK TERCATAT SEJAK BULAN JANUARI TAHUN INI</th>
                            <th>JUMLAH SELURUH DATA PERKAWINAN</th>
                            <th>JUMLAH SELURUH DATA PERKAWINAN TERCATAT</th>
                            <th>JUMLAH SELURUH DATA PERKAWINAN TIDAK TERCATAT</th>
                            <th>KET</th>
                          </tr>
                        </thead>
                        <tbody class="">
                          <?php 
                            $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : null;
                            $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
                          ?>
                          <?php foreach ($getkecamatan as $row) { ?>
                          <tr>
                            <td><?= $row['kecamatan_nama']; ?></td>
                            <!-- JUMLAH PERKAWINAN BULAN INI -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_bulan_ini('perkawinan',array('kecamatan' => $row['kecamatan_id']),$tahun,$bulan); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH PERKAWINAN TERCATAT BULAN INI -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_bulan_ini('perkawinan',array('kecamatan' => $row['kecamatan_id'],'status_perkawinan' => 'Tercatat'),$tahun,$bulan); ?>
                              <?php } ?>
                            </td> 
                            <!-- JUMLAH PERKAWINAN TIDAK TERCATAT BULAN INI -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_bulan_ini('perkawinan',array('kecamatan' => $row['kecamatan_id'],'status_perkawinan' => 'Tidak Tercatat/Siri'),$tahun,$bulan); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH SELURUH PERKAWINAN SEJAK BULAN JANUARI TAHUN INI -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_bulan_sejak_januari('perkawinan',array('kecamatan' => $row['kecamatan_id']),$tahun,$bulan); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH SELURUH PERKAWINAN TERCATAT SEJAK BULAN JANUARI TAHUN INI -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_bulan_sejak_januari('perkawinan',array('kecamatan' => $row['kecamatan_id'],'status_perkawinan' => 'Tercatat'),$tahun,$bulan); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH SELURUH PERKAWINAN TIDAK TERCATAT SEJAK BULAN JANUARI TAHUN INI -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_bulan_sejak_januari('perkawinan',array('kecamatan' => $row['kecamatan_id'],'status_perkawinan' => 'Tidak Tercatat/Siri'),$tahun,$bulan); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH SELURUH DATA PERKAWINAN -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_count('perkawinan',array('kecamatan' => $row['kecamatan_id'])); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH SELURUH DATA PERKAWINAN TERCATAT -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_count('perkawinan',array('kecamatan' => $row['kecamatan_id'],'status_perkawinan' => 'Tercatat')); ?>
                              <?php } ?>
                            </td>
                            <!-- JUMLAH SELURUH DATA PERKAWINAN TIDAK TERCATAT -->
                            <td class="text-center">
                              <?php if($tahun != null){ ?>
                                <?= get_count('perkawinan',array('kecamatan' => $row['kecamatan_id'],'status_perkawinan' => 'Tidak Tercatat/Siri')); ?>
                              <?php } ?>
                            </td>

                            <td class="text-center">
                            </td>
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

    <style>
    .form-filter .form-group {
      margin-bottom: 0;
    }
    .form-filter label {
      font-weight: 600;
      margin-bottom: 5px;
    }
    </style>

    <script>
      $(document).ready(function () {
        $('#tabel-data').DataTable({
          dom: 'Bfrtip',
          buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
          columnDefs: [
            { targets: [1, 2], className: 'text-center' } // index kolom yang ingin dirata tengah
          ]
        });
      });
    </script>
