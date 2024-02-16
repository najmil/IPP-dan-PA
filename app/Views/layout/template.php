<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= base_url('/img/icon-cbi.png') ?>" type="image/x-icon">
  <title>
    <?= $tittle; ?>
  </title>
  
  <?= $this->renderSection('header'); ?>
  <style>
     @font-face {
          font-family: 'poppins';
          src: url('/font/Poppins/Poppins-Regular.ttf') format('truetype');
      }

      .poppins-regular {
        font-family: 'poppins', sans-serif;
        /* color: #333; */
        color: black;
    }

  </style>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/ionicons/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
  <link href="/css/plugins/bootstrap-5/bootstrap.min.css">
  <link rel="stylesheet" href="/css/plugins/datatables/jquery.dataTables.css" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url('home/index'); ?>" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block mr-2">
          <p class="nav-link">Halo, <?= ucwords(strtolower(session()->get('nama'))); ?> </p>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url('home/index'); ?>" class="brand-link">
        <div class="d-flex justify-content-center align-items-center">
          <img src="<?= base_url() ?>/img/logo-cbi.png" alt="CBI Logo" style="width: 100%">
        </div>
      </a>

      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <?php if (in_array(session()->get('kode_jabatan'), ['2', '3', '4', '8'])): ?>
                <li class="nav-item">
                  <a href="#" class="nav-link" style="width: 250px;">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                      IPP
                      <i class="right fas fa-angle-left ml-2 ml-2"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php if (in_array(session()->get('kode_jabatan'), ['2', '3', '4', '8'])): ?>
                      <li class="nav-item">
                        <a href="<?= base_url('ipp/index'); ?>" class="nav-link ml-3">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Individual Performance Planning</p>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </li>
              <?php endif; ?>

              <?php if (in_array(session()->get('kode_jabatan'), ['2', '3', '4', '8'])): ?>
                <li class="nav-item">
                  <a href="#" class="nav-link" style="width: 250px;">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                      Performance Appraisal
                      <i class="right fas fa-angle-left ml-2"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <!-- Mid Year Review -->
                    <?php if (in_array(session()->get('kode_jabatan'), ['2', '3', '4', '8'])): ?>
                      <li class="nav-item">
                        <a href="<?= base_url('midYear/index'); ?>" class="nav-link ml-3">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Mid Year Review</p>
                        </a>
                      </li>
                    <?php endif; ?>
                    <!-- One Year Review -->
                    <?php if (in_array(session()->get('kode_jabatan'), ['2', '3', '4', '8'])): ?>
                      <li class="nav-item">
                        <a href="<?= base_url('oneyear/index'); ?>" class="nav-link ml-3">
                          <i class="far fa-circle nav-icon"></i>
                          <p>One Year Review</p>
                        </a>
                      </li>
                    <?php endif; ?>
                    <!-- Strong weakness -->
                    <li class="nav-item">
                      <a href="<?= base_url('strongweak/index'); ?>" class="nav-link ml-3">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Strength and Weakness</p>
                      </a>
                    </li>
                    <!-- PROC SUMMARY -->
                    <li class="nav-item">
                      <a href="<?= base_url('procsum/index'); ?>" class="nav-link ml-3">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Process Summary</p>
                      </a>
                    </li>
                  </ul>
                </li>
              <?php endif; ?>

                <?php if (in_array(session()->get('kode_jabatan'), ['0', '1', '2', '3', '4'])): ?>
                  <li class="nav-item <?php if(session()->get('npk') == 0){ echo 'menu-open';} ?>">
                    <a href="#" class="nav-link <?php if(session()->get('npk') == 0){ echo 'active';} ?>" style="width: 250px;">
                      <i class="nav-icon fas fa-list-alt"></i>
                      <?php if($countPending != 0 || $countPendingMid != 0 || $countPendingOne != 0 ||$countPendingPMid != 0 || $countPendingSw != 0){
                        echo '<p>Daftar Pengisi</p><span class="badge badge-danger right mr-3" aria-hidden="true">!</span>';
                      } else {
                        echo '<p>Daftar Pengisi</p>';
                      } ?>
                      <i class="right fas fa-angle-left ml-2"></i>
                    </a>
                      <ul class="nav nav-treeview">
                        
                        <div id="content-container">
                          <!-- Daftar pengisi IPP -->
                          <li class="nav-item">
                            <?php if (session()->get('npk') != 0): ?>
                              <a href="<?= base_url('daftaripp/index'); ?>" class="nav-link" style="width: 250px;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Daftar IPP
                                <?php if ($countPending > 0): ?>
                                  <span class="badge badge-danger right ml-2"><?= $countPending ?></span>
                                <?php endif; ?>
                              </p>
                            </a>
                            <?php elseif (session()->get('npk') == 0): ?>
                              <a href="" class="nav-link" style="width: 250px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                  Daftar IPP
                                  <?php if ($countPending > 0): ?>
                                    <span class="badge badge-danger mr-3 right"><?= $countPending ?></span>
                                  <?php endif; ?>
                                </p>
                                <i class="right fas fa-angle-left ml-3"></i>
                              </a>
                            <?php endif; ?>
                            <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 0): ?>
                              <ul class="nav nav-treeview">
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftaripp/index'); ?>?content=plantserv" class="nav-link list" data-content="plantserv">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant Service
                                      <?php if ($countPendingPlantS > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantS ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftaripp/index'); ?>?content=fin" class="nav-link list" data-content="fin">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      FIN, ACC, MARK & MIS
                                      <?php if ($countPendingFin > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingFin ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftaripp/index'); ?>?content=adm" class="nav-link list" data-content="adm">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Administration
                                      <?php if ($countPendingAdm > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingAdm ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftaripp/index'); ?>?content=plant" class="nav-link list" data-content="plant">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant
                                      <?php if ($countPendingPlant > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlant ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftaripp/index'); ?>?content=eng" class="nav-link list" data-content="eng">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Engineering
                                      <?php if ($countPendingEng > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingEng ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftaripp/index'); ?>?content=isd" class="nav-link list" data-content="isd">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Industrial System Development</p>
                                      <?php if ($countPendingIsd > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingIsd ?></span>
                                      <?php endif; ?>
                                  </a>
                                </li>
                              </ul>
                            <?php endif; ?>
                          </li>
                        </div>

                        <!-- Daftar pengisi mid year review -->
                        <div id="content-mid">
                          <!-- Daftar pengisi mid year result -->
                          <li class="nav-item">
                            <?php if (session()->get('npk') != 0): ?>
                              <a href="<?= base_url('daftarmid/index'); ?>" class="nav-link" style="width: 250px;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Daftar Mid Year Result
                                <?php if ($countPendingMid > 0): ?>
                                    <span class="badge badge-danger right ml-2"><?= $countPendingMid ?></span>
                                <?php endif; ?>
                              </p>
                            </a>
                            <?php elseif (session()->get('npk') == 0): ?>
                              <a href="" class="nav-link" style="width: 250px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                  Daftar Mid Year Result
                                  <?php if ($countPendingMid > 0): ?>
                                    <span class="badge badge-danger right mr-3"><?= $countPendingMid ?></span>
                                  <?php endif; ?>
                                </p>
                                <i class="right fas fa-angle-left ml-3"></i>
                              </a>
                            <?php endif; ?>
                            <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 0): ?>
                              <ul class="nav nav-treeview">
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarmid/index'); ?>?content=plantserv" class="nav-link list-mid" data-content="plantserv">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant Service
                                      <?php if ($countPendingPlantSMid > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantSMid ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarmid/index'); ?>?content=fin" class="nav-link list-mid" data-content="fin">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      FIN, ACC, MARK & MIS
                                      <?php if ($countPendingFinMid > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingFinMid ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarmid/index'); ?>?content=adm" class="nav-link list-mid" data-content="adm">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Administration
                                      <?php if ($countPendingAdmMid > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingAdmMid ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarmid/index'); ?>?content=plant" class="nav-link list-mid" data-content="plant">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant
                                      <?php if ($countPendingPlantMid > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantMid ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarmid/index'); ?>?content=eng" class="nav-link list-mid" data-content="eng">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Engineering
                                      <?php if ($countPendingEngMid > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingEngMid ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarmid/index'); ?>?content=isd" class="nav-link list-mid" data-content="isd">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Industrial System Development
                                      <?php if ($countPendingIsdMid > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingIsdMid ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                              </ul>
                            <?php endif; ?>
                          </li>
                        </div>

                        <!-- Daftar pengisi one year review -->
                        <div id="content-one">
                          <!-- Daftar pengisi one year result -->
                          <li class="nav-item">
                            <?php if (session()->get('npk') != 0): ?>
                              <a href="<?= base_url('daftarOne/index'); ?>" class="nav-link" style="width: 250px;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Daftar One Year Result
                                <?php if ($countPendingOne > 0): ?>
                                  <span class="badge badge-danger right ml-2"><?= $countPendingOne ?></span>
                                <?php endif; ?>
                                <?php if (session()->get('npk') == 0): ?>
                                  <i class="right fas fa-angle-left ml-3"></i>
                                <?php endif; ?>
                              </p>
                            </a>
                            <?php elseif (session()->get('npk') == 0): ?>
                              <a href="" class="nav-link" style="width: 250px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                  Daftar One Year
                                  <?php if ($countPendingOne > 0): ?>
                                    <span class="badge badge-danger right mr-3"><?= $countPendingOne ?></span>
                                  <?php endif; ?>
                                </p>
                                <i class="right fas fa-angle-left ml-3"></i>
                              </a>
                            <?php endif; ?>
                            <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 0): ?>
                              <ul class="nav nav-treeview">
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarOne/index'); ?>?content=plantserv" class="nav-link list-one" data-content="plantserv">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant Service 
                                      <?php if ($countPendingPlantSOne > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantSOne ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarOne/index'); ?>?content=fin" class="nav-link list-one" data-content="fin">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      FIN, ACC, MARK & MIS
                                      <?php if ($countPendingFinOne > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingFinOne ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarOne/index'); ?>?content=adm" class="nav-link list-one" data-content="adm">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Administration
                                      <?php if ($countPendingAdmOne > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingAdmOne ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarOne/index'); ?>?content=plant" class="nav-link list-one" data-content="plant">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant
                                      <?php if ($countPendingPlantOne > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantOne ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarOne/index'); ?>?content=eng" class="nav-link list-one" data-content="eng">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Engineering
                                      <?php if ($countPendingEngOne > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingEngOne ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarOne/index'); ?>?content=isd" class="nav-link list-one" data-content="isd">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Industrial System Development
                                      <?php if ($countPendingIsdOne > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingIsdOne ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                              </ul>
                            <?php endif; ?>
                          </li>
                        </div>
                        
                        <div id="content-strong">
                          <!-- Daftar Strength and Weakness -->
                          <li class="nav-item">
                            <?php if (session()->get('npk') != 0): ?>
                              <a href="<?= base_url('daftarstrong/index'); ?>" class="nav-link" style="width: 250px;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Daftar Strength and Weakness
                                  <?php if ($countPendingSw > 0): ?>
                                    <span class="badge badge-danger right"><?= $countPendingSw ?></span>
                                  <?php endif; ?>
                              </p>
                            </a>
                            <?php elseif (session()->get('npk') == 0): ?>
                              <a href="" class="nav-link" style="width: 250px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                  Daftar Strength and Weakness
                                  <?php if ($countPendingSw > 0): ?>
                                    <span class="badge badge-danger right mr-3"><?= $countPendingSw ?></span>
                                  <?php endif; ?>
                                </p>
                                <i class="right fas fa-angle-left ml-3"></i>
                              </a>
                            <?php endif; ?>
                            <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 0): ?>
                              <ul class="nav nav-treeview">
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarstrong/index'); ?>?content=plantserv" class="nav-link list-strong" data-content="plantserv">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant Service 
                                      <?php if ($countPendingPlantSSw > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantSSw ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarstrong/index'); ?>?content=fin" class="nav-link list-strong" data-content="fin">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      FIN, ACC, MARK & MIS
                                      <?php if ($countPendingFinSw > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingFinSw ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarstrong/index'); ?>?content=adm" class="nav-link list-strong" data-content="adm">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Administration
                                      <?php if ($countPendingAdmSw > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingAdmSw ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarstrong/index'); ?>?content=plant" class="nav-link list-strong" data-content="plant">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant
                                      <?php if ($countPendingPlantSw > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantSw ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarstrong/index'); ?>?content=eng" class="nav-link list-strong" data-content="eng">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Engineering
                                      <?php if ($countPendingEngSw > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingEngSw ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarstrong/index'); ?>?content=isd" class="nav-link list-strong" data-content="isd">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Industrial System Development
                                      <?php if ($countPendingIsdSw > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingIsdSw ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                              </ul>
                            <?php endif; ?>
                          </li>
                        </div>

                        <!-- Daftar Process Summary -->
                        <div id="content-procsum">
                          <li class="nav-item">
                            <?php if (session()->get('npk') != 0): ?>
                              <a href="<?= base_url('daftarprocsum/index'); ?>" class="nav-link" style="width: 250px;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>
                                Daftar Process and Summary
                                <?php if ($countPendingPMid > 0): ?>
                                  <span class="badge badge-danger right ml-2"><?= $countPendingPMid ?></span>
                                <?php endif; ?>
                              </p>
                            </a>
                            <?php elseif (session()->get('npk') == 0): ?>
                              <a href="" class="nav-link" style="width: 250px;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                  Daftar Process and Summary
                                  <?php if ($countPendingPMid > 0): ?>
                                    <span class="badge badge-danger right mr-3"><?= $countPendingPMid ?></span>
                                  <?php endif; ?>
                                </p>
                                <i class="right fas fa-angle-left ml-3"></i>
                              </a>
                            <?php endif; ?>
                            <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 0): ?>
                              <ul class="nav nav-treeview">
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarprocsum/index'); ?>?content=plantserv" class="nav-link list-procsum" data-content="plantserv">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant Service 
                                      <?php if ($countPendingPlantSProc > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantSProc ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarprocsum/index'); ?>?content=fin" class="nav-link list-procsum" data-content="fin">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      FIN, ACC, MARK & MIS
                                      <?php if ($countPendingFinProc > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingFinProc ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarprocsum/index'); ?>?content=adm" class="nav-link list-procsum" data-content="adm">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Administration
                                      <?php if ($countPendingAdmProc > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingAdmProc ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarprocsum/index'); ?>?content=plant" class="nav-link list-procsum" data-content="plant">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Plant
                                      <?php if ($countPendingPlantProc > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingPlantProc ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarprocsum/index'); ?>?content=eng" class="nav-link list-procsum" data-content="eng">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Engineering
                                      <?php if ($countPendingEngProc > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingEngProc ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                                <li class="nav-item ml-3">
                                  <a href="<?= base_url('daftarprocsum/index'); ?>?content=isd" class="nav-link list-procsum" data-content="isd">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      Industrial System Development
                                      <?php if ($countPendingIsdProc > 0): ?>
                                        <span class="badge badge-danger right"><?= $countPendingIsdProc ?></span>
                                      <?php endif; ?>
                                    </p>
                                  </a>
                                </li>
                              </ul>
                            <?php endif; ?>
                          </li>
                        </div>
                      </ul>
                    </li>
                <?php endif; ?>
              

                  <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 0): ?>
                    <!-- Periode edit -->
                    <li class="nav-item">
                      <a href="<?= base_url('periode/index'); ?>" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                        <p>Periode Edit</p>
                      </a>
                    </li>
                  <?php endif; ?>
                  
            <li class="nav-item">
              <a href="<?= base_url('login/logout'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout | Keluar
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-6 col-xs-12">
              <h1 class="m-0">
                <?= $this->renderSection('judul'); ?>
              </h1>
            </div><!-- /.col -->
            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          
          <!-- /.row -->
          <!-- Main row -->
          <?= $this->renderSection('content'); ?>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; Century Batteries Indonesia.</strong>
      <!-- <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div> -->
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
<script>
  // IPP
  document.querySelectorAll('.list').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var content = this.getAttribute('data-content');

        window.location.href = '<?= base_url(); ?>daftaripp/index?content=' + content;
    });
  });


  // Mid Year
  document.querySelectorAll('.list-mid').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var content = this.getAttribute('data-content');

        window.location.href = '<?= base_url(); ?>daftarmid/index?content=' + content;
    });
  });
  
  // One Year
  document.querySelectorAll('.list-one').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var content = this.getAttribute('data-content');

        window.location.href = '<?= base_url(); ?>daftarone/index?content=' + content;
    });
  });
  
  // Strength and Weakness
  document.querySelectorAll('.list-strong').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var content = this.getAttribute('data-content');
        
        window.location.href = '<?= base_url(); ?>daftarstrong/index?content=' + content;
    });
  });

  // Process and Summary
  document.querySelectorAll('.list-procsum').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var content = this.getAttribute('data-content');

        window.location.href = '<?= base_url(); ?>daftarprocsum/index?content=' + content;
    });
  });
</script>

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<script src="/css/plugins/sweetalert/sweetalert2@10"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<script src="/css/plugins/bootstrap-5/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<script src="/plugins/jquery/jquery-3.6.0.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="/ajax/jquery.min.js"></script> -->
<script src="/css/plugins/datatables/jquery.dataTables.js"></script> <!-- datatype -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

<?= $this->renderSection('script'); ?>

</body>
</html>
