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
                                <a href="'. base_url('daftarmid/index').'?content=plantserv'.'">
                                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                    </a>
                                    Daftar Mid Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'mkt' || $contentdept == 'fincont' || $contentdept == 'mis'){
                            echo'
                                <a href="'. base_url('daftarmid/index').'?content=fin'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Mid Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'productsatu' || $contentdept == 'productdua' || $contentdept == 'ppic' || $contentdept == 'spv'){
                            echo'
                                <a href="'. base_url('daftarmid/index').'?content=plant'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Mid Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'hr' || $contentdept == 'procurement'){
                            echo'
                                <a href="'. base_url('daftarmid/index').'?content=adm'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Mid Year Result Karyawan
                            ';
                        } elseif ($contentdept == 'qa' || $contentdept == 'producteng' || $contentdept == 'processeng'){
                            echo'
                                <a href="'. base_url('daftarmid/index').'?content=eng'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Mid Year Result Karyawan
                            ';
                        } else {
                            echo 'Daftar Mid Year Result Karyawan';
                        }
                    } ?>
                </div>
                <div class="card-body" style="overflow-x: auto;">
                    <?php
                        if(session()->get('npk') == 0){
                            if ($content == 'plantserv' || $contentdept == 'ehs' || $contentdept == 'mtc'){
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftarmid/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option value="ehs">EHS</option>
                                            <option value="mtc">Maintenance</option>
                                        </select>
                                    </form>
                                
                                ';
                            } elseif ($content == 'fin' || $contentdept == 'mkt' || $contentdept == 'fincont' || $contentdept == 'mis'){
                                echo '
                                    <form class="mb-3" id="content-form" id="content-form" action="'. base_url('/daftarmid/index') .'" method="GET">
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
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftarmid/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option style="height: 38px;" value="hr">HRD, GA, IR & CSR</option>
                                            <option value="procurement">Procurement</option>
                                        </select>
                                
                                    </form>
                                ';
                            } elseif ($content == 'plant' || $contentdept == 'productsatu' || $contentdept == 'productdua' || $contentdept == 'ppic' || $contentdept == 'spv') {
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftarmid/index') .'" method="GET">
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
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftarmid/index') .'" method="GET">
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
                                <th class="text-center" style="width: 200px;">Nama</th>
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
                                    <th class="text-center">Kadiv</th>
                                    <th class="text-center">BoD</th>
                                    <th class="text-center">Presdir</th>
                                <?php endif; ?>
                                <!-- Kondisi untuk acc kadiv oleh bod dan presdir -->
                                <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280): ?>
                                    <th class="text-center">BoD</th>
                                    <th class="text-center">Presdir</th>
                                <?php endif; ?>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($daftarmid as $p): ?>
                                <tr data-approve-status="<?= $p['approval_kadept_midyear'] ?>">
                                    <th scope="row" class="text-center"><?= $i++; ?></th>
                                    <td class="text-center"> <?= $p['created_at']; ?> </td>
                                    <td class="text-center"> <?= $p['created_by']; ?> </td>
                                    <td class="text-center"> <?= $p['nama']; ?> </td>
                                    <td class="text-center"> <?= $p['periode']; ?> </td>
                                    <?php $disableDetail = false; ?>

                                    <?php if (session()->get('kode_jabatan') == 0 && (session()->get('npk') == 0 || session()->get('npk') == null)): ?>
                                        <?php $disableDetail = true; ?>
                                        <td class="text-center">
                                            <?php if (!in_array($p['created_by'], [3651, 3659]) && $p['kode_jabatan'] == 8): ?>
                                                <?php if (empty($p['approval_kasie_midyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kasie_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kasie_midyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kasie_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kasie_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || $p['kode_jabatan'] == 8): ?>
                                                <?php if (empty($p['approval_kadept_midyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadept_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_midyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3 || $p['kode_jabatan'] == 4 || (in_array($p['created_by'], [3651, 3659]))): ?>
                                                <?php if (empty($p['approval_kadiv_midyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadiv_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_midyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 2 || $p['kode_jabatan'] == 3): ?>
                                                <?php if (empty($p['approval_bod_midyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_bod_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_midyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 2): ?>
                                                <?php if (empty($p['approval_presdir_midyear'])): ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_presdir_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_presdir_midyear']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_presdir_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_presdir_midyear'] ? "Approved" : "Pending" ?>
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
                                                <?php if (empty($p['approval_kasie_midyear'])): ?>
                                                    <?php if (!empty($p['approval_date_kasie_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_kasie_midyear']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadept_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kasie_midyear']; ?></div>
                                                    <?php endif ?>
                                                    <span class="badge <?= $p['approval_kasie_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kasie_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['approval_kadept_midyear'] == 1): ?>
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
                                                <?php if ($p['approval_kasie_midyear'] == 1): ?>
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
                                                <?php if ($p['approval_kasie_midyear'] == 1 && empty($p['approval_kadept_midyear'])): ?>
                                                    <?php if(isset($p['approval_date_kadept_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_midyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadept_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_midyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($p['kode_jabatan'] == 4): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (session()->get('kode_jabatan') == 3 && empty($p['approval_kadept_midyear'])): ?>
                                                    <?php if (!empty($p['approval_date_kadept_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_kadept_midyear']; ?>
                                                        </div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftarmid/approveKadept/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php elseif (empty($p['approval_kadept_midyear'])): ?>
                                                        <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadept_midyear'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept_midyear']; ?></div>
                                                            <?php $disableDetail = true; ?>
                                                            <!-- <span class="badge <?= $p['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                                <?php//echo $p['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                                            </span> -->
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || ($p['created_by'] == [3651, 3659])): ?>
                                                <?php if ($p['approval_kadiv_midyear'] == 1): ?>
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
                                                <?php if ($p['approval_kadept_midyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])): ?>
                                                <?php if (($p['approval_kadept_midyear'] == 1 && empty($p['approval_kadiv_midyear'])) || empty($p['approval_kadiv_midyear'])): ?>
                                                    <?php if(isset($p['approval_date_kadiv_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_midyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_kadiv_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_midyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (session()->get('kode_jabatan') == 2 && empty($p['approval_kadiv_midyear'])): ?>
                                                    <?php if (!empty($p['approval_date_kadiv_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_kadiv_midyear']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftarmid/approveKadiv/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php elseif (empty($p['approval_kadiv_midyear'])): ?>
                                                        <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadiv_midyear'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv_midyear']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php if ($p['approval_bod_midyear'] == 1): ?>
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
                                                <?php if ($p['approval_kadiv_midyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                    
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 3): ?>
                                                <?php if (($p['approval_kadiv_midyear'] == 1 && $p['id_department'] != 27 && empty($p['approval_bod_midyear'])) || $p['id_department'] == 27 && empty($p['approval_bod_midyear'])): ?>
                                                    <?php if(isset($p['approval_date_bod_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_midyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_bod_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_midyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($p['kode_jabatan'] == 2): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (session()->get('kode_jabatan') == 1 && empty($p['approval_bod_midyear'])): ?>
                                                    <?php if (!empty($p['approval_date_bod_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_bod_midyear']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftarmid/approveBod/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php elseif (empty($p['approval_bod_midyear'])): ?>
                                                        <span class="badge badge-secondary btn-sm">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_bod_midyear'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_midyear']; ?></div>
                                                            <span class="badge <?= $p['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                                <?= $p['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                                            </span>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($p['kode_jabatan'] == 2): ?>
                                                <?php if ($p['approval_presdir_midyear'] == 1): ?>
                                                    <span class="badge badge-primary btn-sm">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php endif; ?>
                                            <?php elseif ($p['kode_jabatan'] == 4 && $p['id_department'] == 27): ?>
                                                <?php if (($p['approval_kadept_midyear'] == 1 && empty($p['approval_bod_midyear'])) || $p['id_department'] == 27 && empty($p['approval_bod_midyear']) || empty($p['approval_bod_midyear'])): ?>
                                                    <?php if(isset($p['approval_date_bod_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_midyear']; ?></div>
                                                    <?php endif ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-secondary btn-sm">Pending</span>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_bod_midyear'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod_midyear']; ?></div>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <!-- yang diapprove oleh presdir -->
                                    <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280): ?>
                                        <td class="text-center">
                                            <?php if ($p['approval_bod_midyear'] == 1): ?>
                                                <span class="badge badge-primary btn-sm">Approved</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary btn-sm">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if (($p['kode_jabatan'] == 3 && $p['approval_bod_midyear'] == 1 && empty($p['approval_presdir_midyear']) && $p['id_department'] == 27) || empty($p['approval_presdir_midyear'])): ?>
                                                <?php $disableDetail = true; ?>
                                                <?php if (!empty($p['approval_date_presdir_midyear_midyear'])): ?>
                                                    <div class="text-muted" style="font-size: 8px;">
                                                        approved at: <?= $p['approval_date_presdir_midyear']; ?>
                                                    </div>
                                                <?php endif ?>
                                                <span class="badge badge-secondary btn-sm">Pending</span>
                                            <?php else: ?>
                                                <?php if (!empty($p['approval_date_presdir_midyear'])): ?>
                                                    <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_presdir_midyear']; ?></div>
                                                <?php endif; ?>
                                                <span class="badge <?= $p['approval_presdir_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                    <?= $p['approval_presdir_midyear'] ? "Approved" : "Pending" ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <?php if ($disableDetail): ?>
                                        <td class="text-center">
                                            <a href="<?= base_url("/daftarmid/detail/{$p['id']}") ?>" class="btn btn-sm btn-warning mt-2"> Detail </a>
                                            <?php // if (session()->get('kode_jabatan') == 0 && $p['kode_jabatan'] == 0): ?>
                                                <!-- <a href="<?php //echo base_url("/daftarmid/editipp/{$p['id']}") ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-pen-square"></i> Edit
                                                </a>
                                                <a href="<?php //echo base_url("/daftarmid/delete/{$p['id']}") ?>" class="btn btn-sm btn-danger delete-button">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a> -->
                                            <?php // endif; ?>
                                            <?php if (session()->get('npk') == 0): ?>
                                                <a href="<?= base_url('daftarmid/logchanges/'.$p['id']) ?>" class="btn btn-secondary btn-sm mt-2" style="font-size: 12px; padding: 5px 10px;">Log</a>
                                            <?php endif ?>
                                            
                                            <?php
                                                $allowAccessPdf = false;
                                                if ($p['kode_jabatan'] == 8) {
                                                    if (!in_array($p['created_by'], [3651, 3659])) {
                                                        $allowAccessPdf = $p['approval_kasie_midyear'] && $p['approval_kadept_midyear'];
                                                    } else {
                                                        $allowAccessPdf = $p['approval_kadept_midyear'] && $p['approval_kadiv_midyear'];
                                                    }
                                                } elseif ($p['kode_jabatan'] == 4 || (in_array($p['created_by'], [3651, 3659]))) {
                                                    $allowAccessPdf = $p['approval_kadept_midyear'] && $p['approval_kadiv_midyear'];
                                                } elseif ($p['kode_jabatan'] == 3) {
                                                    $allowAccessPdf = $p['approval_kadiv_midyear'] && $p['approval_bod_midyear'];
                                                } elseif ($p['kode_jabatan'] == 2) {
                                                    $allowAccessPdf = $p['approval_bod_midyear'] && $p['approval_presdir_midyear'];
                                                } elseif ($p['kode_jabatan'] <= 1) {
                                                    $allowAccessPdf = $p['approval_bod_midyear'] && $p['approval_presdir_midyear'];
                                                }

                                                if ($allowAccessPdf == true) {
                                                    echo'
                                                        <a href="' . base_url('daftarmid/midyearpdf/' . $p['id']) . '" target="_blank">
                                                            <i class="fas fa-file-pdf" style="color: red; font-size: 20px;"></i>
                                                        </a>';
                                                }
                                            ?>
                                        </td>
                                    <?php else : ?>
                                        <td class="text-center">
                                            <button class="btn btn-secondary btn-sm" style="width: 55px;">Detail</button>
                                        </td>
                                    <?php endif; ?>
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
            window.location.href = '/daftarmid/index?contentdept=' + selectedOption;
        });
    });
    $(document).ready(function(){
        $('#isidetail').DataTable();

        $('.approve-button').click(function (event) {
            console.log('clicked');
            event.preventDefault();

            var row = $(this);
            // var approvalStatus = row.siblings('.approval-status');
            var idMain = row.find('input[name="id_main[]"]').val();
            var program = row.data('program');
            var weight = row.data('weight');
            var midyear = row.data('midyear');
            var duedate = row.data('duedate');

            row.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: row.attr('href'),
                data: {
                    idMain: idMain,
                    program: program,
                    weight: weight,
                    midyear: midyear,
                    duedate: duedate
                },
                beforeSend: function(){
                    row.find('.approve-button').html('<i class="fas fa-spinner fa-spin" style="color: green;"></i>');
                },
                complete: function(){
                    row.find('.approve-button').html('approved');
                },
                success: function(response) {
                    // approvalStatus.show(); 
                    row.hide();
                    location.reload();
                }
            });
        });
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
            url: "<?php echo site_url("ipp/save") ?>",
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
            window.location="<?php echo site_url("ipp/hapus") ?>/"+ $id;
        }
    }
</script>
<?= $this->endSection('script'); ?>
