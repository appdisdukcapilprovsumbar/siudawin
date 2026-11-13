<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?= base_url('admin/dashboard'); ?>"><?= get_row('system_config',array('config_key' => 'app_name'),'config_value'); ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?= base_url('admin/dashboard'); ?>">BK</a>
    </div>
    <ul class="sidebar-menu">
      
<!--
// ========================================================================================================================================================================================================================
// Level Akses sebagai Root 
// ========================================================================================================================================================================================================================
-->    
    <?php if(sess_role_code() === 'root'){ ?>

      <li class="menu-header">Dashboard  <?= sess_year(); ?></li>
      <li class="<?php if($menu_active == 'dashboard'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-fire"></i> <span class="icon">Dashboard</span></a></li>
      <li class="menu-header">Starter</li>
      
      <li class="<?php if($menu_active == 'profil'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('profil') ?>"><i class="fa fa-user"></i> <span class="icon">Profil</span></a></li>

      <li class="<?php if($menu_sub == 'blanko_masuk'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/blanko_masuk') ?>"><i class="fa fa-solid fa-file"></i> <span class="icon">Blanko Masuk</span></a></li>
      
      <li class="<?php if($menu_sub == 'users'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/users') ?>"><i class="fa fa-users"></i> <span class="icon">Data User</span></a></li>

      <li class="<?php if($menu_active == 'log'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/log') ?>"><i class="fa fa-history"></i> <span class="icon">Log</span></a></li>

      <li class="dropdown <?php if($menu_active == 'pengaturan'){echo 'active';} ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span class="icon">Pengaturan</span></a>
        <ul class="dropdown-menu">
                    
          <li class="<?php if($menu_sub == 'seo'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/seo'); ?>"><span class="icon"> SEO Website</span></a></li>
          
          <li class="<?php if($menu_sub == 'profil_website'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/profil_website'); ?>"><span class="icon"> Profil Website</span></a></li>
          
          <li class="<?php if($menu_sub == 'profil_dinas'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/profil_dinas'); ?>"><span class="icon"> Profil Dinas</span></a></li>
          
          <li class="<?php if($menu_sub == 'sosial_media'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/sosial_media'); ?>"><span class="icon"> Sosial Media</span></a></li>

          <li class="<?php if($menu_sub == 'logo'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/logo'); ?>"><span class="icon"> Logo & Background</span></a></li>
        </ul>
      </li>
      
      <li class=""><a class="nav-link tombol-logout" href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out-alt"></i> <span class="icon">Logout</span></a></li>
<!--
// ========================================================================================================================================================================================================================
// Level Akses sebagai Administrator
// ========================================================================================================================================================================================================================
-->
    <?php }elseif(sess_role_code() == 'admin') { ?>

      <li class="menu-header">Dashboard </li>
      <li class="<?php if($menu_active == 'dashboard'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/dashboard_prov') ?>"><i class="fa fa-fire"></i> <span class="icon">Dashboard</span></a></li>
      <li class="menu-header">Starter</li>
      
      <li class="<?php if($menu_active == 'profil'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('profil') ?>"><i class="fa fa-user"></i> <span class="icon">Profil</span></a></li>
	  
	    <li class="<?php if($menu_active == 'perkawinan'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/perkawinan') ?>"><i class="fa fa-solid fa-file-alt"></i> <span class="icon">Perkawinan</span></a></li>

      <li class="<?php if($menu_active == 'laporan_perkawinan_prov'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/laporan_perkawinan_prov') ?>"><i class="fa fa-file-alt"></i> <span class="icon">Laporan Perkawinan</span></a></li>
      
      <li class="<?php if($menu_active == 'log'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/log') ?>"><i class="fa fa-history"></i> <span class="icon">Log</span></a></li>

      <li class="<?php if($menu_active == 'users'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/users') ?>"><i class="fa fa-users"></i> <span class="icon">Data User</span></a></li>
      
      <li class="dropdown <?php if($menu_active == 'pengaturan'){echo 'active';} ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span class="icon">Pengaturan</span></a>
        <ul class="dropdown-menu">
                    
          <li class="<?php if($menu_sub == 'seo'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/seo'); ?>"><span class="icon"> SEO Website</span></a></li>
          
          <li class="<?php if($menu_sub == 'profil_website'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/profil_website'); ?>"><span class="icon"> Profil Website</span></a></li>
          
          <li class="<?php if($menu_sub == 'profil_dinas'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/profil_dinas'); ?>"><span class="icon"> Profil Dinas</span></a></li>
          
          <li class="<?php if($menu_sub == 'sosial_media'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/sosial_media'); ?>"><span class="icon"> Sosial Media</span></a></li>

          <li class="<?php if($menu_sub == 'logo'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/logo'); ?>"><span class="icon"> Logo & Background</span></a></li>
        </ul>
      </li>
      
      <li class="">
        <a class="nav-link tombol-logout" href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out-alt"></i> <span class="icon">Logout</span></a>
      </li>
<!--
// ========================================================================================================================================================================================================================
// Level Akses sebagai admin Kakot
// ========================================================================================================================================================================================================================
-->    
    <?php }elseif(sess_role_code() == 'admin_kabkot' || sess_role_code() == 'admin_kecamatan' || sess_role_code() == 'admin_kelurahan'){ ?>
      
      <li class="menu-header">Dashboard</li>
      <?php if(sess_role_code() == 'admin_kabkot'){ ?>
        <li class="<?php if($menu_active == 'dashboard'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/dashboard_kabkot') ?>"><i class="fa fa-fire"></i> <span class="icon">Dashboard</span></a></li>
      <?php }elseif (sess_role_code() == 'admin_kecamatan') { ?>
        <li class="<?php if($menu_active == 'dashboard'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/dashboard_kec') ?>"><i class="fa fa-fire"></i> <span class="icon">Dashboard</span></a></li>
      <?php }else{ ?>
        <li class="<?php if($menu_active == 'dashboard'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/dashboard_kel') ?>"><i class="fa fa-fire"></i> <span class="icon">Dashboard</span></a></li>
      <?php } ?>
      <li class="menu-header">Starter</li>
      <li class="<?php if($menu_active == 'profil'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('profil') ?>"><i class="fa fa-user"></i> <span class="icon">Profil</span></a></li>
    
      <?php if (sess_role_code() == 'admin_kabkot') { ?>
        <li class="<?php if($menu_sub == 'perkawinan'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/kabkot_perkawinan') ?>"><i class="fa fa-solid fa-file-alt"></i> <span class="icon">Perkawinan</span></a></li>
        <li class="<?php if($menu_sub == 'laporan_perkawinan_kabkot'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/laporan_perkawinan_kabkot') ?>"><i class="fa fa-file-alt"></i> <span class="icon">Laporan Perkawinan</span></a></li>
        <li class="<?php if($menu_sub == 'users_kabkot'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/users_kabkot') ?>"><i class="fa fa-users"></i> <span class="icon">Data User</span></a></li>
      <?php }elseif(sess_role_code() == 'admin_kecamatan'){ ?>
        <li class="<?php if($menu_sub == 'perkawinan'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/kecamatan_perkawinan') ?>"><i class="fa fa-solid fa-file-alt"></i> <span class="icon">Perkawinan</span></a></li>
        <li class="<?php if($menu_sub == 'laporan_perkawinan_kec'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/laporan_perkawinan_kecamatan') ?>"><i class="fa fa-solid fa-file-alt"></i> <span class="icon">Lapaoran Perkawinan</span></a></li>
      <?php }else{ ?>
        <li class="<?php if($menu_sub == 'perkawinan'){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('admin/kelurahan_perkawinan') ?>"><i class="fa fa-solid fa-file-alt"></i> <span class="icon">Perkawinan</span></a></li>
      <?php } ?>
      
      <li class=""><a class="nav-link tombol-logout" href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out-alt"></i> <span class="icon">Logout</span></a></li>

    <?php }else{?>

    <?php } ?>
      
    </ul>        
  </aside>
</div>
	<script>	
	  $('.tombol-logout').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Apakah anda yakin logout ?',
          text: "Keluar!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Logout'
        }).then((result) => {
          if (result.value) {
            document.location.href = href;
          }
        })

      });
	  </script>