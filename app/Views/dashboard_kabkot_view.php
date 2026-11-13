    <!-- Main Content -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <div class="main-content">
        <section class="section">
          <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2 icon">
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-fire"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                      Dashboard 
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2 icon">
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <span class="text-small">Total User</span>
                    </div>
                    <div class="card-body">
                      <?= $CountUser; ?> users
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card w-100">
                  <div class="card-body">
                    <h3>Grafik Perkawinan per Bulan</h3>
                    <div class="container">
                      <canvas id="perkawinanChart" width="700" height="200"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <script>
          const ctx = document.getElementById('perkawinanChart').getContext('2d');
          
          const data = {
              labels: <?= json_encode(array_map(function($item) {
                  return date('F', mktime(0, 0, 0, $item['bulan'], 10)); // nama bulan
              }, $chartData)) ?>,
              datasets: [{
                  label: 'Jumlah Perkawinan',
                  data: <?= json_encode(array_column($chartData, 'total')) ?>,
                  backgroundColor: 'rgba(54, 162, 235, 0.6)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          };

          new Chart(ctx, {
              type: 'bar', // Bisa diubah ke 'line', 'pie', dll.
              data: data,
              options: {
                  scales: {
                      y: {
                          beginAtZero: true,
                          ticks: {
                              stepSize: 10
                          }
                      }
                  }
              }
          });
      </script>

