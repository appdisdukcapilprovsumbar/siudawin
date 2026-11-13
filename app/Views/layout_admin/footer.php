      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= get_row('system_config',array('config_key' => 'app_copyright'),'config_value'); ?> <div class="bullet"></div> <?= get_row('system_config',array('config_key' => 'app_year'),'config_value'); ?>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>
  
  <script>
      // JavaScript untuk menampilkan dan menyembunyikan animasi loading
      window.addEventListener('beforeunload', function () {
          document.getElementById('loading').style.display = 'flex';
      });

      window.addEventListener('load', function () {
          document.getElementById('loading').style.display = 'none';
      });

      function formatTanggal(tanggal) {
          let date = new Date(tanggal);
          let day = String(date.getDate()).padStart(2, '0');
          let month = String(date.getMonth() + 1).padStart(2, '0'); // Januari = 0
          let year = date.getFullYear();
          let hours = String(date.getHours()).padStart(2, '0');
          let minutes = String(date.getMinutes()).padStart(2, '0');

          return `${day}-${month}-${year} ${hours}:${minutes}`;
      }

      // Fungsi untuk format uang Rupiah
      function formatAngka(angka) {
          return new Intl.NumberFormat('id-ID', { 
              minimumFractionDigits: 0, 
              useGrouping: true // Memisahkan ribuan dengan titik
          }).format(angka);
      }
  </script>

  <!-- General JS Scripts -->
  
  <script src="<?= base_url('template/dist')?>/assets/modules/popper.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/tooltip.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/moment.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/js/stisla.js"></script>
  <!-- JS Libraies -->
  <script src="<?= base_url('template/dist')?>/assets/modules/chart.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/summernote/summernote-bs4.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?= base_url('template/dist')?>/assets/js/page/index.js"></script>
    <!-- JS Libraies -->
  <script src="<?= base_url('template/dist')?>/assets/modules/datatables/datatables.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url('template/dist')?>/assets/js/page/modules-datatables.js"></script>
  
  <!-- Template JS File -->
  <script src="<?= base_url('template/dist')?>/assets/js/scripts.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/js/custom.js"></script>
</body>
</html>