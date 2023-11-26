<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-muted text-black text-center">
                    <?php if(session()->get('npk') == 0){
                        if ($contentdept == 'ehs' || $contentdept == 'mtc'){
                            echo'
                                <a href="'. base_url('daftaripp/index').'?content=plantserv'.'">
                                        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                    </a>
                                    Daftar Individual Performance Plan Karyawan
                            ';
                        } elseif ($contentdept == 'mkt' || $contentdept == 'fincont' || $contentdept == 'mis'){
                            echo'
                                <a href="'. base_url('daftaripp/index').'?content=fin'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Individual Performance Plan Karyawan
                            ';
                        } elseif ($contentdept == 'productsatu' || $contentdept == 'productdua' || $contentdept == 'ppic' || $contentdept == 'spv'){
                            echo'
                                <a href="'. base_url('daftaripp/index').'?content=plant'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Individual Performance Plan Karyawan
                            ';
                        } elseif ($contentdept == 'hr' || $contentdept == 'procurement'){
                            echo'
                                <a href="'. base_url('daftaripp/index').'?content=adm'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Individual Performance Plan Karyawan
                            ';
                        } elseif ($contentdept == 'qa' || $contentdept == 'producteng' || $contentdept == 'processeng'){
                            echo'
                                <a href="'. base_url('daftaripp/index').'?content=eng'.'">
                                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                </a>
                                Daftar Individual Performance Plan Karyawan
                            ';
                        } else {
                            echo 'Daftar Individual Performance Plan Karyawan';
                        }
                    } ?>
                </div>
                <div class="card-body" style="overflow-x: auto;">
                    <?php
                        if(session()->get('npk') == 0){
                            if ($content == 'plantserv' || $contentdept == 'ehs' || $contentdept == 'mtc'){
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftaripp/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option value="ehs">EHS</option>
                                            <option value="mtc">Maintenance</option>
                                        </select>
                                    </form>
                                
                                ';
                            } elseif ($content == 'fin' || $contentdept == 'mkt' || $contentdept == 'fincont' || $contentdept == 'mis'){
                                echo '
                                    <form class="mb-3" id="content-form" id="content-form" action="'. base_url('/daftaripp/index') .'" method="GET">
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
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftaripp/index') .'" method="GET">
                                        <select id="content-dept-select" style="width: 200px; height: 40px;" name="contentdept">
                                            <option value="" disabled selected>-- Pilih Departemen --</option>
                                            <option style="height: 38px;" value="hr">HRD, GA, IR & CSR</option>
                                            <option value="procurement">Procurement</option>
                                        </select>
                                
                                    </form>
                                ';
                            } elseif ($content == 'plant' || $contentdept == 'productsatu' || $contentdept == 'productdua' || $contentdept == 'ppic' || $contentdept == 'spv') {
                                echo '
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftaripp/index') .'" method="GET">
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
                                    <form class="mb-3" id="content-form" action="'. base_url('/daftaripp/index') .'" method="GET">
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
                    <table class="table table-sm mt-3" id="isidetail">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20px;">No.</th>
                                <th class="text-center" style="width: 60px;">Tanggal Dibuat</th>
                                <th class="text-center">NPK</th>
                                <th class="text-center" style="width: 200px;">Nama</th>
                                <th class="text-center" style="width: 50px;">Periode</th>
                                <?php if (session()->get('kode_jabatan') == 0 && (session()->get('npk') == 0 || session()->get('npk') == null)): ?>
                                    <th class="text-center">Kasie</th>
                                    <th class="text-center">Kadept</th>
                                    <th class="text-center">Kadiv</th>
                                    <th class="text-center">BoD</th>
                                    <th class="text-center">Presdir</th>
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
                                <!-- Kondisi untuk acc kadept oleh kadiv dan bod serta kadiv oleh bod and presdir -->
                                <?php if (session()->get('kode_jabatan') == 1): ?>
                                    <th class="text-center" style="width: 70px;">Kadiv</th>
                                    <th class="text-center" style="width: 70px;">BoD</th>
                                    <th class="text-center" style="width: 70px;">Presdir</th>
                                <?php endif; ?>
                                <!-- Kondisi untuk acc kadiv oleh bod and presdir -->
                                <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280): ?>
                                    <th class="text-center" style="width: 70px;">BoD</th>
                                    <th class="text-center" style="width: 70px;">Presdir</th>
                                <?php endif; ?>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (!empty($daftaripp)): ?>
                                <?php foreach ($daftaripp as $p): ?>
                                    <tr id="<?= $p['approval_kadept'] ?>" data-approve-status="<?= $p['approval_kadept'] ?>">
                                        <td scope="row" class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"> 
                                            <?php 
                                                if ($p['date_submitted_ipp'] != null){
                                                    echo $p['date_submitted_ipp'];
                                                } elseif ($p['date_submitted_ipp_mid'] != null){
                                                    echo $p['date_submitted_ipp_mid'];
                                                } if ($p['date_submitted_ipp_one'] != null){
                                                    echo $p['date_submitted_ipp_one'];
                                                } 
                                            ?>
                                        </td>
                                        <td class="text-center"> <?= $p['created_by']; ?> </td>
                                        <td class="text-left"> <?= $p['nama']; ?> </td>
                                        <td class="text-center"> <?= $p['periode']; ?>
                                        </td>
                                        <?php $disableDetail = false; ?>

                                        <?php if (session()->get('kode_jabatan') == 0 && (session()->get('npk') == 0 || session()->get('npk') == null)): ?>
                                            <?php $disableDetail = true; ?>
                                            <td class="text-center">
                                                <?php if ($p['created_by'] != [3651, 3659] && $p['kode_jabatan'] == 8): ?>
                                                    <?php if (empty($p['approval_kasie'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kasie'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kasie']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kasie'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kasie'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 4 || $p['kode_jabatan'] == 8): ?>
                                                    <?php if (empty($p['approval_kadept'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadept'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadept'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadept'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 3 || $p['kode_jabatan'] == 4 || (in_array($p['created_by'], [3651, 3659]))): ?>
                                                    <?php if (empty($p['approval_kadiv'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadiv'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadiv'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadiv'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 2 || $p['kode_jabatan'] == 3): ?>
                                                    <?php if (empty($p['approval_bod'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_bod'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_bod'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 2): ?>
                                                    <?php if (empty($p['approval_presdir'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_presdir'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_presdir']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_presdir'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_presdir'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>

                                        <!-- yang diapprove oleh kode_jabatan == 4 (kasie) -->
                                        <?php if (session()->get('kode_jabatan') == 4): ?>
                                            <?php if ($p['created_by'] != [3651, 3659]): ?>
                                                <?php $disableDetail = true; ?>
                                                <td class="text-center">
                                                    <?php if (session()->get('kode_jabatan') == 4 && empty($p['approval_kasie'])): ?>
                                                        <?php if (!empty($p['approval_date_kasie'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">
                                                                approved at: <?= $p['approval_date_kasie']; ?>
                                                            </div>
                                                        <?php endif ?>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveKasie/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                        <?php $disableDetail = true; ?>
                                                    <?php elseif (empty($p['approval_kasie'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kasie'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kasie']; ?></div>
                                                            <span class="badge <?= $p['approval_kasie'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                                <?= $p['approval_kasie'] ? "Approved" : "Pending" ?>
                                                            </span>
                                                        <?php endif; ?>
                                                        <?php $disableDetail = true; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if (!in_array($p['created_by'], [3651, 3659])): ?>
                                                        <?php if ($p['approval_kadept'] == 1): ?>
                                                            <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <!-- yang diapprove oleh kode_jabatan == 3 (kadept) -->
                                        <?php if (session()->get('kode_jabatan') == 3): ?>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 8 && $p['created_by'] != [3651, 3659]): ?>
                                                    <?php if ($p['approval_kasie'] == 1): ?>
                                                        <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                        <?php $disableDetail = true; ?>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                        
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 8 && $p['created_by'] != [3651, 3659]): ?>
                                                    <?php if ($p['approval_kasie'] == 1 && empty($p['approval_kadept'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept']; ?></div>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveKadept/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                        <?php $disableDetail = true; ?>
                                                    <?php elseif (empty($p['approval_kadept'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                        <?php if ($p['approval_kasie'] == 1){$disableDetail = true;} ?>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadept'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadept'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadept'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && in_array($p['created_by'], [3651, 3659]))): ?>
                                                    <?php $disableDetail = true; ?>
                                                    <?php if (session()->get('kode_jabatan') == 3 && empty($p['approval_kadept'])): ?>
                                                        <?php if (!empty($p['approval_date_kadept'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">
                                                                approved at: <?= $p['approval_date_kadept']; ?>
                                                            </div>
                                                        <?php endif ?>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveKadept/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php elseif (empty($p['approval_kadept'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadept'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadept']; ?></div>
                                                            <?php $disableDetail = true; ?>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadept'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadept'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (($p['kode_jabatan'] == 4) || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])): ?>
                                                    <?php if ($p['approval_kadiv'] == 1): ?>
                                                        <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                        
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>

                                        <!-- yang diapprove oleh kode_jabatan == 2 (kadiv) -->
                                        <?php if (session()->get('kode_jabatan') == 2): ?>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 4 || ($p['created_by'] == [3651, 3659])): ?>
                                                    <?php if ($p['approval_kadept'] == 1): ?>
                                                        <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                        
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])): ?>
                                                    <?php if ($p['approval_kadept'] == 1 && empty($p['approval_kadiv'])): ?>
                                                        <?php $disableDetail = true; ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv']; ?></div>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveKadiv/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php elseif (empty($p['approval_kadiv'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadiv'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv']; ?></div>
                                                            <?php $disableDetail = true; ?>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadiv'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadiv'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($p['kode_jabatan'] == 3): ?>
                                                    <?php $disableDetail = true; ?>
                                                    <?php if (session()->get('kode_jabatan') == 2 && empty($p['approval_kadiv'])): ?>
                                                        <?php if (!empty($p['approval_date_kadiv'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">
                                                                approved at: <?= $p['approval_date_kadiv']; ?>
                                                            </div>
                                                        <?php endif ?>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveKadiv/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php elseif (empty($p['approval_kadiv'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_kadiv'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_kadiv']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_kadiv'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_kadiv'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 3): ?>
                                                    <?php if ($p['approval_bod'] == 1): ?>
                                                        <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                        
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>

                                        <!-- yang diapprove oleh kode_jabatan == 1 (bod) -->
                                        <?php if (session()->get('kode_jabatan') == 1): ?>
                                            <td class="text-center" style="display: flex; align-items: center; justify-content: center; height: 100%; width: 100%;">
                                                <?php if ($p['kode_jabatan'] == 3): ?>
                                                    <?php if ($p['approval_kadiv'] == 1): ?>
                                                        <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                        
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 3): ?>
                                                    <?php if ($p['approval_kadiv'] == 1 && empty($p['approval_bod'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod']; ?></div>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveBod/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <?php $disableDetail = true; ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php elseif (empty($p['approval_bod'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_bod'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod']; ?></div>
                                                            <?php $disableDetail = true; ?>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_bod'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($p['kode_jabatan'] == 2): ?>
                                                    <?php $disableDetail = true; ?>
                                                    <?php if (session()->get('kode_jabatan') == 1 && empty($p['approval_bod'])): ?>
                                                        <?php if (!empty($p['approval_date_bod'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">
                                                                approved at: <?= $p['approval_date_bod']; ?>
                                                            </div>
                                                        <?php endif ?>
                                                        <!-- <a href="<?php// base_url("/daftaripp/approveBod/{$p['id']}") ?>" class="approve-button">
                                                            <i class="fas fa-check-circle" style="color: green;"></i>
                                                        </a> -->
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php elseif (empty($p['approval_bod'])): ?>
                                                        <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php else: ?>
                                                        <?php if (!empty($p['approval_date_bod'])): ?>
                                                            <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_bod']; ?></div>
                                                        <?php endif; ?>
                                                        <span class="badge <?= $p['approval_bod'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                            <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['kode_jabatan'] == 2): ?>
                                                    <?php if ($p['approval_presdir'] == 1): ?>
                                                        <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                    <?php else: ?>
                                                        <span a class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>

                                        <!-- yang diapprove oleh kode_jabatan == 0 && npk!=null (presdir) -->
                                        <?php if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280 ): ?>
                                            <td class="text-center">
                                                <?php if ($p['approval_bod'] == 1): ?>
                                                    <?php $disableDetail = true; ?>
                                                    <span class="badge badge-primary btn-sm approval-status">Approved</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($p['approval_bod'] == 1 && empty($p['approval_presdir'])): ?>
                                                    <?php if (!empty($p['approval_date_presdir'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">
                                                            approved at: <?= $p['approval_date_presdir']; ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <!-- <a href="<?php// base_url("/daftaripp/approvePresdir/{$p['id']}") ?>" class="approve-button">
                                                        <i class="fas fa-check-circle" style="color: green;"></i>
                                                    </a> -->
                                                    <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                <?php elseif (empty($p['approval_presdir'])): ?>
                                                    <span class="badge badge-secondary btn-sm approval-status">Pending</span>
                                                    <?php if ($p['approval_bod'] == 1){$disableDetail = true;} ?>
                                                <?php else: ?>
                                                    <?php if (!empty($p['approval_date_presdir'])): ?>
                                                        <div class="text-muted" style="font-size: 8px;">approved at: <?= $p['approval_date_presdir']; ?></div>
                                                    <?php endif; ?>
                                                    <span class="badge <?= $p['approval_presdir'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                        <?= $p['approval_presdir'] ? "Approved" : "Pending" ?>
                                                    </span>
                                                    <?php if ($p['approval_bod'] == 1){$disableDetail = true;} ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>

                                        <?php if ($disableDetail): ?>
                                            <td class="text-center">
                                                <a href="<?= base_url("/daftaripp/detail/{$p['id']}") ?>" class="btn btn-sm btn-warning mt-2"> Detail </a>
                                                <?php // if (session()->get('kode_jabatan') == 0 && $p['kode_jabatan'] == 0): ?>
                                                    <!-- <a href="<?php //echo base_url("/daftaripp/editipp/{$p['id']}") ?>" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-pen-square"></i> Edit
                                                    </a>
                                                    <a href="<?php //echo base_url("/daftaripp/delete/{$p['id']}") ?>" class="btn btn-sm btn-danger delete-button">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a> -->
                                                <?php // endif; ?>
                                                <?php if (session()->get('npk') == 0): ?>
                                                    <a href="<?= base_url('daftaripp/viewLogChanges/'.$p['id']) ?>" class="btn btn-secondary btn-sm mt-2" style="font-size: 12px; padding: 5px 10px; width: 50px;">Log</a>
                                                    <!-- <button class="btn btn-danger btn-sm unsubmitted mt-2" data-id="<?php //echo $p['id'] ?>">Unsubmit</button> -->
                                                <?php endif ?>
                                                <?php
                                                    $allowAccessPdf = false;
                                                    if ($p['kode_jabatan'] == 8) {
                                                        if ($p['created_by'] != [3651, 3659]) {
                                                            $allowAccessPdf = $p['approval_kasie'] && $p['approval_kadept'];
                                                        } else {
                                                            $allowAccessPdf = $p['approval_kadept'] && $p['approval_kadiv'];
                                                        }
                                                    } elseif ($p['kode_jabatan'] == 4 || ($p['created_by'] == [3651, 3659])) {
                                                        $allowAccessPdf = $p['approval_kadept'] && $p['approval_kadiv'];
                                                    } elseif ($p['kode_jabatan'] == 3) {
                                                        $allowAccessPdf = $p['approval_kadiv'] && $p['approval_bod'];
                                                    } elseif ($p['kode_jabatan'] == 2) {
                                                        $allowAccessPdf = $p['approval_bod'] && $p['approval_presdir'];
                                                    } elseif ($p['kode_jabatan'] <= 1) {
                                                        $allowAccessPdf = $p['approval_bod'] && $p['approval_presdir'];
                                                    }

                                                    if ($allowAccessPdf == true) {
                                                        echo'
                                                            <a href="' . base_url('daftaripp/generatePdf/' . $p['id']) . '" target="_blank">
                                                                <i class="fas fa-file-pdf mt-2" style="color: red; font-size: 20px;"></i>
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
                               
                            <?php //else: ?>
                                    <?php //if (session()->get('kode_jabatan') == 1 || session()->get('kode_jabatan') == 2 || session()->get('kode_jabatan') == 3){
                                        // echo '<tr><td colspan="9" class="text-center">Tidak ada data yang tersedia.</td></tr>';
                                    // } elseif (session()->get('npk') == 4280 || session()->get('kode_jabatan') == 4){
                                        // echo '<tr><td colspan="8" class="text-center">Tidak ada data yang tersedia.</td></tr>';
                                    // } elseif(session()->get('npk') == 0){
                                        // echo '<tr><td colspan="10" class="text-center">Tidak ada data yang tersedia.</td></tr>';
                                    // } ?>
                            <?php endif ?>
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
            window.location.href = '/daftaripp/index?contentdept=' + selectedOption;
        });
    });
    // document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function(){
            

            $('#isidetail').DataTable({
                "bInfo": false
            });

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
                        row.find('.approve-button').html('<span class="badge btn-sm"> Approved </span>');
                    },
                    success: function(response) {
                        // approvalStatus.show(); 
                        // row.hide();
                        location.reload();
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
    // });
</script>
<?= $this->endSection('script'); ?>
