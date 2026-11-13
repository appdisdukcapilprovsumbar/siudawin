<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/fontawesome/css/all.min.css">
  <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/gallery').'/'. get_row('system_config',array('config_key' => 'meta_favicon'),'config_value') ?>">
  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/jqvmap/dist/jqvmap.min.css"> -->
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <script src="<?= base_url('template/dist')?>/assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url('template/dist')?>/assets/css/components.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="<?= base_url('template/dist')?>/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?= base_url('template/dist')?>/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Select 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- End Select 2 -->
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<style>
  /* Styling untuk animasi loading */
  /*#loading {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      display: none; /* Hidden by default */
  }*/
  /*CSS for loading progress*/
  .loader-div {
      display: none;
      position: fixed;
      margin: 0px;
      padding: 0px;
      right: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      background-color: #fff;
      z-index: 30001;
      opacity: 0.8;
  }
  .loader-img {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      margin: auto;
  }
  .icon:hover{
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }

  .hover-trigger {
    cursor: pointer;
  }

  /* Optional: Add some styles for better visibility */
  .hover-trigger:hover {
    text-decoration: underline;
    color: blue;
  }
  /*end*/
</style>
<!-- /END GA -->
</head>
<div id="loading">
    <img src="<?= base_url('template/image/eloading.gif'); ?>" alt="Loading...">
</div>

<div class="loader-div">
    <!-- <img class="loader-img" src="<?= base_url('template/image/eloading.gif'); ?>" style="height: 50px;width: auto;" /> -->
</div> 

<body>