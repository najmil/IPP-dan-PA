<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-muted text-black text-center">
                    <?php if(session()->get('npk') == 0){
                        if ($contentdept == 'ehs' || $contentdept == 'mtc'){
                            echo'
                                <a href="'. base_url('DaftarOne/index').'?content=plantserv'.'">
                                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                    </a>
                                    Daftar One Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'mkt' || $contentdept == 'fincont' || $contentdept == 'mis'){
                            echo'
                                <a href="'. base_url('DaftarOne/index').'?content=fin'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar One Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'productsatu' || $contentdept == 'productdua' || $contentdept == 'ppic' || $contentdept == 'spv'){
                            echo'
                                <a href="'. base_url('DaftarOne/index').'?content=plant'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar One Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'hr' || $contentdept == 'procurement'){
                            echo'
                                <a href="'. base_url('DaftarOne/index').'?content=adm'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar One Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'qa' || $contentdept == 'producteng' || $contentdept == 'processeng'){
                            echo'
                                <a href="'. base_url('DaftarOne/index').'?content=eng'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar One Year Result Karyawan
                            ';
                        } else {
                            echo 'Daftar One Year Result Karyawan';
                        }
                    } ?>
                </div>
                <div class="card-body" style="overflow-x: auto;">
                    <?php
                        if(session()->get('npk') == 0){
                            if ($content == 'plantserv' || $contentdept == 'ehs' || $contentdept == 'mtc'){
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/DaftarOne/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option value="ehs">EHS</option>
                                            <option value="mtc">Maintenance</option>
                                        </select>
                                    </form>
                                
                                ';
                            } elseif ($content == 'fin' || $contentdept == 'mkt' || $contentdept == 'fincont' || $contentdept == 'mis'){
                                echo '
                                    <form class="mb-3" id="content-form" id="content-form" action="'. base_url('/DaftarOne/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option value="mkt">Marketing</option>
                                            <option value="fincont">FIN, ACC  & RISK MGT CONT</option>
                                            <option value="mis">mis</option>
                                        </select>
                                    </form>
                                
                                ';
                            } elseif ($content == 'adm' || $contentdept == 'hr' || $contentdept == 'procurement'){
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/DaftarOne/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option style="height: 38px;" value="hr">HRD, GA, IR & CSR</option>
                                            <option value="procurement">Procurement</option>
                                        </select>
                                
                                    </form>
                                ';
                            } elseif ($content == 'plant' || $contentdept == 'productsatu' || $contentdept == 'productdua' || $contentdept == 'ppic' || $contentdept == 'spv') {
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/DaftarOne/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option value="productsatu">Production 1</option>
                                            <option value="productdua">Production 2</option>
                                            <option value="ppic">PPIC</option>
                                            <option value="spv">Supervisor Shift 2 & 3</option>
                                        </select>
                                    </form>
                                
                                ';
                            } elseif ($content == 'eng' || $contentdept == 'qa' || $contentdept == 'producteng' || $contentdept == 'processeng'){
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/DaftarOne/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option value="qa">Quality Assurane</option>
                                            <option value="producteng">Product Engineering</option>
                                            <option value="processeng">Process Engineering</option>
                                        </select>
                                    </form>
                                
                                ';
                            }
                        }
                    ?>
                    <!-- Table Data -->
                    <table class="table mt-3" id="isidetail">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20px;">No.</th>
                                <th class="text-center" style="width: 60px;">Tanggal Dibuat</th>
                                <th class="text-center">NPK</th>
                                <th class="text-center" style="width: 250px;">Nama</th>
                                <th class="text-center" style="width: 50px;">Periode</th>

                                <?php if (session()->get('kode_jabatan') == 0 && (session()->get('npk') == 0 || session()->get('npk') == null)): ?>
                                    <th class="text-center" style="width: 70px;">Kasie</th>
                                    <th class="text-center" style="width: 70px;">Kadept</th>
                                    <th class="text-center" style="width: 70px;">Kadiv</th>
                                    <th class="text-center" style="width: 70px;">BoD</th>
                                    <th class="text-center" style="width: 70px;">Presdir</th>
                                <?php endif; ?>
                                <?php if (session()->get('kode_jabatan') == 4): ?>
                                    <th class="text-center" style="width: 70px;">Kasie</th>
                                    <th class="text-center" style="width: 70px;">Kadept</th>
                                <?php endif; ?>
                                <?php if (session()->get('kode_jabatan') == 3): ?>
                                    <th class="text-center" style="width: 70px;">Kasie</th>
                                    <th class="text-center" style="width: 70px;">Kadept</th>
                                    <th class="text-center" style="width: 70px;">Kadiv</th>
                                <?php endif; ?>
                                <?php if (session()->get('kode_jabatan') == 2): ?>
                                    <th class="text-center" style="width: 70px;">Kadept</th>
                                    <th class="text-center" style="width: 70px;">Kadiv</th>
                                    <th class="text-center" style="width: 70px;">BoD</th>
                                <?php endif; ?>
                                <!-- Kondisi untuk acc kadept oleh kadiv dan bod serta kadiv oleh bod dan presdir -->
                                <?php if (session()->get('kode_jabatan') == 1): ?>
                                    <th class="text-center" style="width: 70px;">Kadiv</th>
                                    <th class="text-center" style="width: 70px;">BoD</th>
                                    <th class="text-center" style="width: 70px;">Presdir</th>
                                <?php endif; ?>
                                <!-- Kondisi untuk acc kadiv oleh bod dan presdir -->
                                <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280): ?>
                                    <th class="text-center" style="width: 70px;">BoD</th>
                                    <th class="text-center" style="width: 70px;">Presdir</th>
                                <?php endif; ?>
                                <th class="text-center" style="width: 70px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($daftarone as $p): ?>
                                <tr data-approve-status="<?= $p['approval_kadept_oneyear'] ?>">
                                    <th scope="row" class="text-center"><?= $i++; ?></th>
                                    <td class="text-center"> <?= $p['created_at']; ?> </td>
                                    <td class="text-center"> <?= $p['created_by']; ?> </td>
                                    <td class="text-center"> <?= $p['nama']; ?> </td>
                                    <td class="text-center"> <?= $p['periode']; ?> </td>
                                    <?php $disableDetail = false; ?>

                                    <?php if (session()->get('kode_jabatan') == 0 && (session()->get('npk') == 0 || session()->get('npk') == null)): ?>
                                        <td class="text-center">
                                            <?php if (!in_array($p['created_by'], [3651, 3659]) && $p['kode_jabatan'] == 8): ?>
                                                <?php if (empty($p['approval_kasie_oneyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kasie_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px">approved at: <?= $p['approval_date_kasie_oneyear']; ?></div>
                                                        <span class="badge <?= $p['approval_kasie_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kasie_oneyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge <?= $p['approval_kasie_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kasie_oneyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || $p['kode_jabatan'] == 8): ?>
                                                <?php if (empty($p['approval_kadept_oneyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadept_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px">approved at: <?= $p['approval_date_kadept_oneyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3 || $p['kode_jabatan'] == 4 || (in_array($p['created_by'], [3651, 3659]))): ?>
                                                <?php if (empty($p['approval_kadiv_oneyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadiv_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px">approved at: <?= $p['approval_date_kadiv_oneyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 2 || $p['kode_jabatan'] == 3): ?>
                                                <?php if (empty($p['approval_bod_oneyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_bod_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px">approved at: <?= $p['approval_date_bod_oneyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 2): ?>
                                                <?php if (empty($p['approval_presdir_oneyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_presdir_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px">approved at: <?= $p['approval_date_presdir_oneyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_presdir_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_presdir_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <!-- yang diapprove oleh kode_jabatan == 4 (kasie) -->
                                    <?php if (session()->get('kode_jabatan') == 4): ?>
                                        <?php $disableDetail = true; ?>
                                        <?php if ($p['created_by'] != [3651, 3659]): ?>
                                            <td class="text-center">
                                                <?php if (empty($p['approval_kasie_oneyear'])): ?>
                                                    <?php if (!empty($p['approval_date_kasie_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_kasie_oneyear']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadept_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kasie_oneyear']; ?></div>
                                                    <?php endif ?>
                                                    <span class="badge <?= $p['approval_kasie_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kasie_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['approval_kadept_oneyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- yang diapprove oleh kode_jabatan == 3 (kadept) -->
                                    <?php if (session()->get('kode_jabatan') == 3): ?>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 8): ?>
                                                <?php if ($p['approval_kasie_oneyear'] == 1): ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 8): ?>
                                                <?php if ($p['approval_kasie_oneyear'] == 1 && empty($p['approval_kadept_oneyear'])): ?>
                                                    <?php if(isset($p['approval_date_kadept_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_oneyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadept_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_oneyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($p['kode_jabatan'] == 4): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (session()->get('kode_jabatan') == 3 && empty($p['approval_kadept_oneyear'])): ?>
                                                    <?php if (!empty($p['approval_date_kadept_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_kadept_oneyear']; ?>
                                                        </div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftarmid/approveKadept/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php elseif (empty($p['approval_kadept_oneyear'])): ?>
                                                        <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadept_oneyear'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_oneyear']; ?></div>
                                                            <?php $disableDetail = true; ?>
                                                            <!-- <span class="badge <?= $p['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                                <?php//echo $p['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                                            </span> -->
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || ($p['created_by'] == [3651, 3659])): ?>
                                                <?php if ($p['approval_kadiv_oneyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <!-- yang diapprove oleh kode_jabatan == 2 (kadiv) -->
                                    <?php if (session()->get('kode_jabatan') == 2): ?>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || ($p['created_by'] == [3651, 3659])): ?>
                                                <?php if ($p['approval_kadept_oneyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])): ?>
                                                <?php if (($p['approval_kadept_oneyear'] == 1 && empty($p['approval_kadiv_oneyear'])) || empty($p['approval_kadiv_oneyear'])): ?>
                                                    <?php if(isset($p['approval_date_kadiv_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_oneyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadiv_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_oneyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (session()->get('kode_jabatan') == 2 && empty($p['approval_kadiv_oneyear'])): ?>
                                                    <?php if (!empty($p['approval_date_kadiv_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_kadiv_oneyear']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftarmid/approveKadiv/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php elseif (empty($p['approval_kadiv_oneyear'])): ?>
                                                        <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadiv_oneyear'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_oneyear']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php if ($p['approval_bod_oneyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <!-- yang diapprove oleh kode_jabatan == 1 (BoD) -->
                                    <?php if (session()->get('kode_jabatan') == 1): ?>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php if ($p['approval_kadiv_oneyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php if (($p['approval_kadiv_oneyear'] == 1 && $p['id_department'] != 27 && empty($p['approval_bod_oneyear'])) || $p['id_department'] == 27 && empty($p['approval_bod_oneyear'])): ?>
                                                    <?php if(isset($p['approval_date_bod_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_oneyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_bod_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_oneyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($p['kode_jabatan'] == 2): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (session()->get('kode_jabatan') == 1 && empty($p['approval_bod_oneyear'])): ?>
                                                    <?php if (!empty($p['approval_date_bod_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_bod_oneyear']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftarmid/approveBod/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php elseif (empty($p['approval_bod_oneyear'])): ?>
                                                        <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_bod_oneyear'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_oneyear']; ?></div>
                                                            <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                                <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                                            </span>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 2): ?>
                                                <?php if ($p['approval_presdir_oneyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php elseif ($p['kode_jabatan'] == 4 && $p['id_department'] == 27): ?>
                                                <?php if (($p['approval_kadept_oneyear'] == 1 && empty($p['approval_bod_oneyear'])) || $p['id_department'] == 27 && empty($p['approval_bod_oneyear']) || empty($p['approval_bod_oneyear'])): ?>
                                                    <?php if(isset($p['approval_date_bod_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_oneyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_bod_oneyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_oneyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <!-- yang diapprove oleh presdir -->
                                    <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280): ?>
                                        <td class="text-center">
                                            <?php if ($p['approval_bod_oneyear'] == 1): ?>
                                                <span class="badge badge-primary btn-sm">Approved</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary btn-sm">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if (($p['kode_jabatan'] == 3 && $p['approval_bod_oneyear'] == 1 && empty($p['approval_presdir_oneyear']) && $p['id_department'] == 27) || empty($p['approval_presdir_oneyear'])): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (!empty($p['approval_date_presdir_oneyear_oneyear'])): ?>
                                                    <div class="text-muted" style="font-size: 8px;">
                                                        approved at: <?= $p['approval_date_presdir_oneyear']; ?>
                                                    </div>
                                                <?php endif ?>
                                                <span class="badge badge-secondary btn-sm">Pending</span>
                                            <?php else: ?>
                                                <?php if (!empty($p['approval_date_presdir_oneyear'])): ?>
                                                    <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_presdir_oneyear']; ?></div>
                                                <?php endif; ?>
                                                <span class="badge <?= $p['approval_presdir_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                    <?= $p['approval_presdir_midyear'] ? "Approved" : "Pending" ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <td class="text-center">
                                        <?php if (session()->get('npk') != 0): ?>
                                            <?php if ($disableDetail): ?>
                                                <a href="<?= base_url("/DaftarOne/detail/{$p['id']}") ?>" class="btn btn-warning btn-sm" style="width: 55px;">Detail</a>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" style="width: 55px;">Detail</button>
                                            <?php endif ?>
                                        <?php elseif (session()->get('npk') == 0): ?>
                                            <a href="<?= base_url("/DaftarOne/detail/{$p['id']}") ?>" class="btn btn-warning btn-sm" style="width: 55px;">Detail</a>
                                        <?php endif ?>

                                        
                                        <?php if (session()->get('npk') == 0): ?>
                                            <a href="<?= base_url('DaftarOne/logchanges/'.$p['id']) ?>" class="btn btn-secondary btn-sm mt-2" style="font-size: 12px; padding: 5px 10px; width: 55px;">Log</a>
                                        <?php endif ?>

                                        <?php
                                            $allowAccessPdf = false;
                                            if ($p['kode_jabatan'] == 8) {
                                                if (!in_array($p['created_by'], [3651, 3659])) {
                                                    $allowAccessPdf = $p['approval_kasie_oneyear'] && $p['approval_kadept_oneyear'];
                                                } else {
                                                    $allowAccessPdf = $p['approval_kadept_oneyear'] && $p['approval_kadiv_oneyear'];
                                                }
                                            } elseif ($p['kode_jabatan'] == 4 || (in_array($p['created_by'], [3651, 3659]))) {
                                                $allowAccessPdf = $p['approval_kadept_oneyear'] && $p['approval_kadiv_oneyear'];
                                            } elseif ($p['kode_jabatan'] == 3) {
                                                $allowAccessPdf = $p['approval_kadiv_oneyear'] && $p['approval_bod_oneyear'];
                                            } elseif ($p['kode_jabatan'] == 2) {
                                                $allowAccessPdf = $p['approval_bod_oneyear'] && $p['approval_presdir_oneyear'];
                                            } elseif ($p['kode_jabatan'] <= 1) {
                                                $allowAccessPdf = $p['approval_bod_oneyear'] && $p['approval_presdir_oneyear'];
                                            }

                                            if ($allowAccessPdf == true) {
                                                echo'
                                                    <a href="' . base_url('DaftarOne/oneyearpdf/' . $p['id']) . '" target="_blank">
                                                        <i class="fas fa-file-pdf mt-2" style="color: red; font-size: 20px;"></i>
                                                    </a>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contentDeptSelect = document.getElementById('content-dept-select');

        contentDeptSelect.addEventListener('change', function() {
            const selectedOption = this.value;
            window.location.href = '/daftarone/index?contentdept=' + selectedOption;
        });
    });

    $(document).ready(function(){
        $('#isidetail').DataTable();

        $('.approve-button').click(function (event) {
            event.preventDefault();

            var row = $(this);
            var idMain = row.find('input[name="id_main[]"]').val();
            var oneyear_achv = $(this).data('oneyear_achv');
            var oneyear_achv_score = $(this).data('oneyear_achv_score');
            var oneyear_achv_total = $(this).data('oneyear_achv_total');

            $.ajax({
                type: 'POST',
                url: $(this).attr('href'),
                data: {
                    idMain: idMain,
                    oneyear_achv: oneyear_achv,
                    oneyear_achv_score: oneyear_achv_score,
                    oneyear_achv_total: oneyear_achv_total
                },
                beforeSend: function(){
                    row.find('.approve-button').html('<i class="fas fa-spinner fa-spin" style="color: green;"></i>');
                },
                complete: function(){
                    row.find('.approve-button').html('approved');
                },
                success: function($result) {
                    location.reload()
                }
            });
        });

        function approveRow(button) {
            var form = document.getElementById('detail-form');
            form.submit();
        }
    });

    function bersihkan(){
        $('#npk_user').val('');
        $('#nama').val('');
    }

    $('.tombol-tutup').on('click', function(){
        if($('.sukses').is(":visible")){
            window.location.href = "<?= current_url()."?".$_SERVER['QUERY_STRING']; ?>";
        }
        $('.alert').hide();
        bersihkan();
    })

    $('#tombolSimpan').on('click', function(){
        var $created_by = $('#created_by').val();
        var $nama = $('#nama').val();

        $.ajax({
            url: "<?php echo site_url("Ipp/save") ?>",
            type: "POST",
            data: {
                created_by: $created_by,
                nama: $nama
            },
            success: function(hasil){
                var $obj = $.parseJSON(hasil);
                if ($obj.sukses == false){
                    $('.sukses').hide();
                    $('.gagal').show();
                    $('.gagal').html($obj.gagal);
                } else {
                    $('.gagal').hide();
                    $('.sukses').show();
                    $('.sukses').html($obj.sukses);
                }
            }
        });
        bersihkan();
    }) ;

    function hapus($id){
        var result = confirm('Apakah anda yakin untuk menghapus data ini?');
        if (result){
            window.location="<?php echo site_url("Ipp/hapus") ?>/"+ $id;
        }
    }
</script>
<?= $this->endSection('script'); ?>
