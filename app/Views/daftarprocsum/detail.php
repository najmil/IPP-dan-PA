<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <?php if ($kode_jabatan != 8 ) : ?>
            <div class="card" style="overflow-y: auto;">
        <?php elseif ($kode_jabatan == 8) :?>
            <div class="col">
                <div class="card" style="overflow-y: auto;">
            </div>
        <?php endif ?>
            <div class="card-body">
                <a href="/pdf/kriteriapk.pdf" target="_blank">
                    <i class="fas fa-file-pdf ml-2 mr-2 mb-2" style="color: red; font-size: 20px;"></i>Kriteria PK
                </a>
                <div class="row">

                    <?php
                        $periodeModel = new \App\Models\PeriodeModel();
                        $periodeMid = $periodeModel->getLatestMidPeriode();
                        $periodeOne = $periodeModel->getLatestOnePeriode();
                        $isWithinMidPeriode = null;
                        $isWithinOnePeriode = null;
                        // dd($periodeMid);

                        $currentDate = date('Y-m-d H:i:s');
                        if ($periodeMid !== null) {
                            $isWithinMidPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
                            // dd($isWithinMidPeriode);
                        } elseif ($periodeOne !== null) {
                            $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                        } else {
                            $isWithinMidPeriode = false;
                            $isWithinOnePeriode = false;
                        }
                    ?>
                    <!-- Card PDCA AND VALUES -->
                    <?php if ($kode_jabatan !=8 ) : ?>
                        <div class="col-md-6"> 
                    <?php elseif ($kode_jabatan == 8) :?>
                        <div class="col">
                    <?php endif ?>
                        <div class="card">
                            <div class="card-title text-center">
                                <h5>B1. PDCA AND VALUES</h5>
                            </div>
                            <div class="card-body">
                                <?php // dd($sum_midyear_total) ?>
                                <table class="table" id="pdcaTable">
                                    <thead>
                                        <tr>
                                            <th rowspan="3" class="text-center">Aspect</th>
                                            <th rowspan="1" style="border-top: hidden" class="text-center">Achievement</th>
                                        </tr>
                                        <tr style="border-top: hidden">
                                            <th>Mid Year</th>
                                            <th>One Year</th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control b1_average text-center" value="<?= isset($procsum['b1_average']) ? $procsum['b1_average'] : ''; ?>" readonly></th>
                                            <div class="invalid-feedback"></div>
                                            <th><input type="text" class="form-control b1_average_one text-center" value="<?= isset($procsum['b1_average_one']) ? $procsum['b1_average_one'] : ''; ?>" readonly></th>
                                            <div class="invalid-feedback"></div>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th row>1. Plan</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control plan_mid text-center edit-input" name="plan_mid" id="plan_mid" value="<?= isset($procsum['plan_mid']) ? $procsum['plan_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                            <td class="text-center">
                                                <input type="number" class="form-control plan_mid text-center edit-input" name="plan_mid" id="plan_mid" value="<?= isset($procsum['plan_mid']) ? $procsum['plan_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                            <td class="text-center">
                                                <input type="number" class="form-control plan_one text-center edit-input one" name="plan_one" id="plan_one" value="<?= isset($procsum['plan_one']) ? $procsum['plan_one'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                            <?php elseif (isset($procsum['plan_mid']) || isset($procsum['plan_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control plan_mid text-center edit-input" name="plan_mid" id="plan_mid" value="<?= $procsum['plan_mid']; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                <input type="number" class="form-control plan_one text-center edit-input one" name="plan_one" id="plan_one" value="<?= isset($procsum['plan_one']) ? $procsum['plan_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback" id="plan_one-invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th row>2. Do</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control do_mid text-center edit-input" name="do_mid" id="do_mid" value="<?= isset($procsum['do_mid']) ? $procsum['do_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control do_mid text-center edit-input" name="do_mid" id="do_mid" value="<?= isset($procsum['do_mid']) ? $procsum['do_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control do_one text-center edit-input one" name="do_one" id="do_one" value="<?= isset($procsum['do_one']) ? $procsum['do_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php elseif (isset($procsum['do_one']) || isset($procsum['do_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control do_mid text-center edit-input" name="do_mid" id="do_mid" value="<?= isset($procsum['do_mid']) ? $procsum['do_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control do_one text-center edit-input one" name="do_one" id="do_one" value="<?= isset($procsum['do_one']) ? $procsum['do_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th row>3. Check</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control check_mid text-center edit-input" name="check_mid" id="check_mid" value="<?= isset($procsum['check_mid']) ? $procsum['check_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control check_mid text-center edit-input" name="check_mid" id="check_mid" value="<?= isset($procsum['check_mid']) ? $procsum['check_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control check_one text-center edit-input one" name="check_one" id="check_one" value="<?= isset($procsum['check_one']) ? $procsum['check_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php elseif (isset($procsum['check_mid']) || isset($procsum['check_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control check_mid text-center edit-input" name="check_mid" id="check_mid" value="<?= isset($procsum['check_mid']) ? $procsum['check_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control check_one text-center edit-input one" name="check_one" id="check_one" value="<?= isset($procsum['check_one']) ? $procsum['check_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th row>4. Action</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control act_mid text-center edit-input" name="act_mid" id="act_mid" value="<?= isset($procsum['act_mid']) ? $procsum['act_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control act_mid text-center edit-input" name="act_mid" id="act_mid" value="<?= isset($procsum['act_mid']) ? $procsum['act_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control act_one text-center edit-input one" name="act_one" id="act_one" value="<?= isset($procsum['act_one']) ? $procsum['act_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php elseif (isset($procsum['act_mid']) || isset($procsum['act_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control act_mid text-center edit-input" name="act_mid" id="act_mid" value="<?= isset($procsum['act_mid']) ? $procsum['act_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control act_one text-center edit-input one" name="act_one" id="act_one" value="<?= isset($procsum['act_one']) ? $procsum['act_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th row>5. Teamwork</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control teamwork_mid text-center edit-input" name="teamwork_mid" id="teamwork_mid" value="<?= isset($procsum['teamwork_mid']) ? $procsum['teamwork_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control teamwork_mid text-center edit-input" name="teamwork_mid" id="teamwork_mid" value="<?= isset($procsum['teamwork_mid']) ? $procsum['teamwork_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control teamwork_one text-center edit-input one" name="teamwork_one" id="teamwork_one" value="<?= isset($procsum['teamwork_one']) ? $procsum['teamwork_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php elseif (isset($procsum['teamwork_mid']) || isset($procsum['teamwork_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control teamwork_mid text-center edit-input" name="teamwork_mid" id="teamwork_mid" value="<?= isset($procsum['teamwork_mid']) ? $procsum['teamwork_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control teamwork_one text-center edit-input one" name="teamwork_one" id="teamwork_one" value="<?= isset($procsum['teamwork_one']) ? $procsum['teamwork_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th row>6. Customer Focus</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control cust_mid text-center edit-input" name="cust_mid" id="cust_mid" value="<?= isset($procsum['cust_mid']) ? $procsum['cust_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control cust_mid text-center edit-input" name="cust_mid" id="cust_mid" value="<?= isset($procsum['cust_mid']) ? $procsum['cust_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control cust_one text-center edit-input one" name="cust_one" id="cust_one" value="<?= isset($procsum['cust_one']) ? $procsum['cust_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php elseif (isset($procsum['cust_mid']) || isset($procsum['cust_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control cust_mid text-center edit-input" name="cust_mid" id="cust_mid" value="<?= isset($procsum['cust_mid']) ? $procsum['cust_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control cust_one text-center edit-input one" name="cust_one" id="cust_one" value="<?= isset($procsum['cust_one']) ? $procsum['cust_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <th row>7. Passion for Excellence</th>
                                            <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control passion_mid text-center edit-input" name="passion_mid" id="passion_mid" value="<?= isset($procsum['passion_mid']) ? $procsum['passion_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                            <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control passion_mid text-center edit-input" name="passion_mid" id="passion_mid" value="<?= isset($procsum['passion_mid']) ? $procsum['passion_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control passion_one text-center edit-input one" name="passion_one" id="passion_one" value="<?= isset($procsum['passion_one']) ? $procsum['passion_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php elseif (isset($procsum['passion_mid']) || isset($procsum['passion_one'])): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control passion_mid text-center edit-input" name="passion_mid" id="passion_mid" value="<?= isset($procsum['passion_mid']) ? $procsum['passion_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="number" class="form-control passion_one text-center edit-input one" name="passion_one" id="passion_one" value="<?= isset($procsum['passion_one']) ? $procsum['passion_one'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if($kode_jabatan == 8): ?>
                            <div class="d-flex justify-content-center">
                                <!-- <a href="<?php //echo base_url('DaftarProcsum/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a> -->
                                <?php
                                    $periodeModel = new \App\Models\PeriodeModel();
                                    $periodeMid = $periodeModel->getLatestMidPeriode();
                                    // dd($periodeMid);

                                    $currentDate = date('Y-m-d H:i:s');
                                    if ($periodeMid !== null) {
                                        $isWithinMidPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
                                    } else {
                                        $isWithinMidPeriode = false;
                                    }

                                    if (session()->get('npk') != 0 && $isWithinMidPeriode && !$is_approved && !$is_approved_before) {
                                        if ($is_submitted){
                                            // dd($isWithinOnePeriode);
                                            echo'
                                                <button type="button" id="edit" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                    Edit All
                                                </button>
                                                <button type="button" id="save-edit" class="btn btn-success btn-sm" style="display: none; width: 100px; height: 30px;">
                                                    Save
                                                </button>';

                                                // Approval Kasie
                                                if (session()->get('kode_jabatan') == 4) {
                                                    if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                        echo '<td class="text-center">';
                                                        if (session()->get('kode_jabatan') == 4 && empty($daftarprocsum['approval_kasie_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKasie/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kasie" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kasie
                                            
                                                // Approval Kadept
                                                if (session()->get('kode_jabatan') == 3) {
                                                    if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                        if ($daftarprocsum['approval_kasie_midyear'] == 1 && empty($daftarprocsum['approval_kadept_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadept/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    } elseif ($daftarprocsum['kode_jabatan'] == 4 || ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] == [3651, 3659])) {
                                                        if (session()->get('kode_jabatan') == 3 && empty($daftarprocsum['approval_kadept_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadept/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kadept
    
                                                // Approval Kadiv
                                                if (session()->get('kode_jabatan') == 2) {
                                                    if ($daftarprocsum['kode_jabatan'] == 4 || ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] == [3651, 3659])) {
                                                        if ($daftarprocsum['approval_kadept_midyear'] == 1 && empty($daftarprocsum['approval_kadiv_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadiv/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    } elseif ($daftarprocsum['kode_jabatan'] == 3) {
                                                        if (session()->get('kode_jabatan') == 2 && empty($daftarprocsum['approval_kadiv_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadiv/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kadiv
    
                                                // Approval BoD
                                                if (session()->get('kode_jabatan') == 1) {
                                                    if ($daftarprocsum['kode_jabatan'] == 3) {
                                                        if ($daftarprocsum['approval_kadiv_midyear'] == 1 && empty($daftarprocsum['approval_bod_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveBod/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    } elseif ($daftarprocsum['kode_jabatan'] == 2) {
                                                        if (session()->get('kode_jabatan') == 1 && empty($daftarprocsum['approval_bod_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveBod/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval BoD
    
                                                // Approval presdir
                                                if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                                    if ($daftarprocsum['kode_jabatan'] == 2) {
                                                        echo '<td class="text-center">';
                                                        if (empty($daftarprocsum['approval_presdir_midyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approvePresdir/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="presdir" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval presdir
                                        };
                                    } elseif (session()->get('npk') != 0 && $isWithinOnePeriode && !$is_approved && !$is_approved_before) {
                                        if($is_submitted_oneyear == 1){
                                            // dd($isWithinOnePeriode);
                                            echo'<button type="button" id="edit-one" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                    Edit All
                                                </button>
                                                <button type="button" id="save-edit" class="btn btn-success btn-sm mr-2" style="display: none; width: 100px; height: 30px;">
                                                    Save
                                                </button>';
    
                                                // Approval Kasie
                                                if (session()->get('kode_jabatan') == 4) {
                                                    if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                        echo '<td class="text-center">';
                                                        if (session()->get('kode_jabatan') == 4 && empty($daftarprocsum['approval_kasie_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKasieOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kasie" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kasie
                                            
                                                // Approval Kadept
                                                if (session()->get('kode_jabatan') == 3) {
                                                    if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                        if ($daftarprocsum['approval_kasie_oneyear'] == 1 && empty($daftarprocsum['approval_kadept_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadeptOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    } elseif ($daftarprocsum['kode_jabatan'] == 4 || ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] == [3651, 3659])) {
                                                        if (session()->get('kode_jabatan') == 3 && empty($daftarprocsum['approval_kadept_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadeptOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kadept
    
                                                // Approval Kadiv
                                                if (session()->get('kode_jabatan') == 2) {
                                                    if ($daftarprocsum['kode_jabatan'] == 4) {
                                                        if ($daftarprocsum['approval_kadept_oneyear'] == 1 && empty($daftarprocsum['approval_kadiv_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadivOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    } elseif ($daftarprocsum['kode_jabatan'] == 3) {
                                                        if (session()->get('kode_jabatan') == 2 && empty($daftarprocsum['approval_kadiv_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveKadivOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kadiv
    
                                                // Approval BoD
                                                if (session()->get('kode_jabatan') == 1) {
                                                    if ($daftarprocsum['kode_jabatan'] == 3) {
                                                        if ($daftarprocsum['approval_kadiv_oneyear'] == 1 && empty($daftarprocsum['approval_bod_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveBodOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    } elseif ($daftarprocsum['kode_jabatan'] == 2) {
                                                        if (session()->get('kode_jabatan') == 1 && empty($daftarprocsum['approval_bod_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approveBodOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval BoD
    
                                                // Approval Kasie
                                                if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                                    if ($daftarprocsum['kode_jabatan'] == 2) {
                                                        echo '<td class="text-center">';
                                                        if (empty($daftarprocsum['approval_presdir_oneyear'])) {
                                                            echo '<a href="' . base_url("/DaftarProcsum/approvePresdirOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                                            </a>';
                                                            echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="presdir" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                                <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                            </button>';
                                                        }
                                                    }
                                                }
                                                // The end of approval kasie
                                        }
                                    }
                                ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- CARD PEOPLE MANAGEMENT -->
                    <?php
                        // $user = session()->get('npk');
                        // $kode_jabatan = session()->get('kode_jabatan');
                        $userConditionsMet = ($kode_jabatan != 8);

                        if ($userConditionsMet) {
                    ?>
                        <div class="col-md-6"> 
                            <div class="card">
                                <div class="card-title text-center">
                                    <h5>B2. PEOPLE MANAGEMENT</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table" id="peopleMng">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="3" colspan="1">Aspect</th>
                                                <th rowspan="1" colspan="2" style="border-top: hidden">Achievement</th>
                                            </tr>
                                            <tr style="border-top: hidden">
                                                <th>Mid Year</th>
                                                <th>One Year</th>
                                            </tr>
                                            <tr>
                                                <th><input type="text" class="form-control b2_average text-center" value="<?= isset($procsum['b2_average']) ? $procsum['b2_average'] : ''; ?>" readonly></th>
                                                <div class="invalid-feedback"></div>
                                                <th><input type="text" class="form-control b2_average_one text-center" value="<?= isset($procsum['b2_average_one']) ? $procsum['b2_average_one'] : ''; ?>" readonly></th>
                                                <div class="invalid-feedback"></div>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1. Getting Commitment on IPP</th>
                                                <?php if ($isWithinMidPeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control gc_mid text-center edit-input" name="gc_mid" id="gc_mid" value="<?= isset($procsum['gc_mid']) ? $procsum['gc_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td></td>
                                                <?php elseif ($isWithinOnePeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control gc_mid text-center edit-input" name="gc_mid" id="gc_mid" value="<?= isset($procsum['gc_mid']) ? $procsum['gc_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control gc_one text-center edit-input one" name="gc_one" id="gc_one" value="<?= isset($procsum['gc_one']) ? $procsum['gc_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php elseif (isset($procsum['gc_mid']) || isset($procsum['gc_one'])): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control gc_mid text-center edit-input" name="gc_mid" id="gc_mid" value="<?= isset($procsum['gc_mid']) ? $procsum['gc_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control gc_one text-center edit-input one" name="gc_one" id="gc_one" value="<?= isset($procsum['gc_one']) ? $procsum['gc_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>2. Delegating</th>
                                                <?php if ($isWithinMidPeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control delegating_mid text-center edit-input" name="delegating_mid" id="delegating_mid" value="<?= isset($procsum['delegating_mid']) ? $procsum['delegating_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td></td>
                                                <?php elseif ($isWithinOnePeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control delegating_mid text-center edit-input" name="delegating_mid" id="delegating_mid" value="<?= isset($procsum['delegating_mid']) ? $procsum['delegating_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control delegating_one text-center edit-input one" name="delegating_one" id="delegating_one" value="<?= isset($procsum['delegating_one']) ? $procsum['delegating_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php elseif (isset($procsum['delegating_mid']) || isset($procsum['delegating_one'])): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control delegating_mid text-center edit-input" name="delegating_mid" id="delegating_mid" value="<?= isset($procsum['delegating_mid']) ? $procsum['delegating_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control delegating_one text-center edit-input one" name="delegating_one" id="delegating_one" value="<?= isset($procsum['delegating_one']) ? $procsum['delegating_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>3. Couching and Counseling</th>
                                                <?php if ($isWithinMidPeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control couch_mid text-center edit-input" name="couch_mid" id="couch_mid" value="<?= isset($procsum['couch_mid']) ? $procsum['couch_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                                <?php elseif ($isWithinOnePeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control couch_mid text-center edit-input" name="couch_mid" id="couch_mid" value="<?= isset($procsum['couch_mid']) ? $procsum['couch_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control couch_one text-center edit-input one" name="couch_one" id="couch_one" value="<?= isset($procsum['couch_one']) ? $procsum['couch_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php elseif (isset($procsum['couch_one']) || isset($procsum['couch_one'])): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control couch_mid text-center edit-input" name="couch_mid" id="couch_mid" value="<?= isset($procsum['couch_mid']) ? $procsum['couch_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control couch_one text-center edit-input one" name="couch_one" id="couch_one" value="<?= isset($procsum['couch_one']) ? $procsum['couch_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>4. Developing Subordinate</th>
                                                <?php if ($isWithinMidPeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control develop_mid text-center edit-input" name="develop_mid" id="develop_mid" value="<?= isset($procsum['develop_mid']) ? $procsum['develop_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td></td>
                                                <?php elseif ($isWithinOnePeriode): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control develop_mid text-center edit-input" name="develop_mid" id="develop_mid" value="<?= isset($procsum['develop_mid']) ? $procsum['develop_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control develop_one text-center edit-input one" name="develop_one" id="develop_one" value="<?= isset($procsum['develop_one']) ? $procsum['develop_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php elseif (isset($procsum['develop_mid']) || isset($procsum['develop_one'])): ?>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control develop_mid text-center edit-input" name="develop_mid" id="develop_mid" value="<?= isset($procsum['develop_mid']) ? $procsum['develop_mid'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="number" class="form-control develop_one text-center edit-input one" name="develop_one" id="develop_one" value="<?= isset($procsum['develop_one']) ? $procsum['develop_one'] : ''; ?>" min="1" max="5">
                                                        <div class="invalid-feedback"></div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <input type="hidden" id="id_procsum_main" name="id_procsum_main" value="<?= $id_procsum_main; ?>">

                    <!-- Button Save -->
                    <?php if($kode_jabatan != 8): ?>
                        <div class="d-flex justify-content-center">
                            <?php if(session()->get('npk') != 0) { ?>
                                <a href="<?= base_url('DaftarProcsum/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a>
                            <?php } ?>
                            <?php
                            // dd(!$is_approved);
                                if (session()->get('npk') != 0 && $isWithinMidPeriode && !$is_approved && !$is_approved_before) {
                                    if ($is_submitted){
                                        echo '
                                        <button type="button" id="edit" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                            Edit All
                                        </button>
                                        <button type="button" id="save-edit" class="btn btn-success btn-sm mr-2" style="display: none; width: 100px; height: 30px;">
                                            Save
                                        </button>';

                                        // Approval Kasie
                                        if (session()->get('kode_jabatan') == 4) {
                                            if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                echo '<td class="text-center">';
                                                if (session()->get('kode_jabatan') == 4 && empty($daftarprocsum['approval_kasie_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveKasie/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kasie" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            }
                                        }
                                        // The end of approval kasie
                                    
                                        // Approval Kadept
                                        if (session()->get('kode_jabatan') == 3) {
                                            if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                if ($daftarprocsum['approval_kasie_midyear'] == 1 && empty($daftarprocsum['approval_kadept_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveKadept/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            } elseif ($daftarprocsum['kode_jabatan'] == 4 || ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] == [3651, 3659])) {
                                                if (session()->get('kode_jabatan') == 3 && empty($daftarprocsum['approval_kadept_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveKadept/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            }
                                        }
                                        // The end of approval kadept

                                        // Approval Kadiv
                                        if (session()->get('kode_jabatan') == 2) {
                                            if ($daftarprocsum['kode_jabatan'] == 4 || ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] == [3651, 3659])) {
                                                if ($daftarprocsum['approval_kadept_midyear'] == 1 && empty($daftarprocsum['approval_kadiv_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveKadiv/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                }
                                                echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                    <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                </button>';
                                            } elseif ($daftarprocsum['kode_jabatan'] == 3) {
                                                if (session()->get('kode_jabatan') == 2 && empty($daftarprocsum['approval_kadiv_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveKadiv/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            }
                                        }
                                        // The end of approval kadiv

                                        // Approval BoD
                                        if (session()->get('kode_jabatan') == 1) {
                                            if ($daftarprocsum['kode_jabatan'] == 3) {
                                                if ($daftarprocsum['approval_kadiv_midyear'] == 1 && empty($daftarprocsum['approval_bod_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveBod/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            } elseif ($daftarprocsum['kode_jabatan'] == 2) {
                                                if (session()->get('kode_jabatan') == 1 && empty($daftarprocsum['approval_bod_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approveBod/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            }
                                        }
                                        // The end of approval BoD

                                        // Approval presdir
                                        if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                            if ($daftarprocsum['kode_jabatan'] == 2) {
                                                echo '<td class="text-center">';
                                                if (empty($daftarprocsum['approval_presdir_midyear'])) {
                                                    echo '<a href="' . base_url("/DaftarProcsum/approvePresdir/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        <i class="fas fa-check" style="color: white;">Approve</i>
                                                    </a>';
                                                    echo '<button class="unsubmitted btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="presdir" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                        <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                    </button>';
                                                }
                                            }
                                        }
                                        // The end of approval presdir
                                    }
                                } elseif (session()->get('npk') != 0 && $isWithinOnePeriode && !$is_approved && !$is_approved_before) {
                                    if($is_submitted_oneyear == 1){
                                        dd($daftarprocsum);
                                        echo'<button type="button" id="edit-one" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                Edit All
                                            </button>
                                            <button type="button" id="save-edit" class="btn btn-success btn-sm mr-2" style="display: none; width: 100px; height: 30px;">
                                                Save
                                            </button>';

                                            // Approval Kasie
                                            if (session()->get('kode_jabatan') == 4) {
                                                if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                    echo '<td class="text-center">';
                                                    if (session()->get('kode_jabatan') == 4 && empty($daftarprocsum['approval_kasie_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveKasieOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kasie" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                }
                                            }
                                            // The end of approval kasie
                                        
                                            // Approval Kadept
                                            if (session()->get('kode_jabatan') == 3) {
                                                if ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] != [3651, 3659]) {
                                                    if ($daftarprocsum['approval_kasie_oneyear'] == 1 && empty($daftarprocsum['approval_kadept_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveKadeptOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadept" data-kode_jabatan="8" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                } elseif ($daftarprocsum['kode_jabatan'] == 4 || ($daftarprocsum['kode_jabatan'] == 8 && $daftarprocsum['created_by'] == [3651, 3659])) {
                                                    if (session()->get('kode_jabatan') == 3 && empty($daftarprocsum['approval_kadept_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveKadeptOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kasie" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                }
                                            }
                                            // The end of approval kadept

                                            // Approval Kadiv
                                            if (session()->get('kode_jabatan') == 2) {
                                                if ($daftarprocsum['kode_jabatan'] == 4) {
                                                    if ($daftarprocsum['approval_kadept_oneyear'] == 1 && empty($daftarprocsum['approval_kadiv_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveKadivOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="4" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                } elseif ($daftarprocsum['kode_jabatan'] == 3) {
                                                    if (session()->get('kode_jabatan') == 2 && empty($daftarprocsum['approval_kadiv_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveKadivOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="kadiv" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                }
                                            }
                                            // The end of approval kadiv

                                            // Approval BoD
                                            if (session()->get('kode_jabatan') == 1) {
                                                if ($daftarprocsum['kode_jabatan'] == 3) {
                                                    if ($daftarprocsum['approval_kadiv_oneyear'] == 1 && empty($daftarprocsum['approval_bod_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveBodOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="3" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                } elseif ($daftarprocsum['kode_jabatan'] == 2) {
                                                    if (session()->get('kode_jabatan') == 1 && empty($daftarprocsum['approval_bod_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approveBodOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="direktur" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                }
                                            }
                                            // The end of approval BoD

                                            // Approval Kasie
                                            if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                                if ($daftarprocsum['kode_jabatan'] == 2) {
                                                    echo '<td class="text-center">';
                                                    if (empty($daftarprocsum['approval_presdir_oneyear'])) {
                                                        echo '<a href="' . base_url("/DaftarProcsum/approvePresdirOne/{$daftarprocsum['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                                        </a>';
                                                        echo '<button class="unsubmitted-one btn btn-danger btn-sm mr-2" data-id='.$daftarprocsum['id'].' data-keterangan="presdir" data-kode_jabatan="2" style="width: 150px; height: 30px;">
                                                            <i class="fa fa-backward" style="color: white;">  Need Revision</i>
                                                        </button>';
                                                    }
                                                }
                                            }
                                            // The end of approval kasie
                                    };
                                }
                            ?>
                        </div>
                    <?php endif ?> 
                    
                    <?php
                        if (session()->get('npk') == 0){
                            echo'
                                <button class="btn btn-danger btn-sm unsubmitted mr-3" data-id="'. $daftarprocsum['id'] .'"  style="width: 70px; height: 30px;" title="Unsubmit Mid Year"><i class="fa fa-trash" aria-hidden="true"></i> Mid</button>
                                <button class="btn btn-danger btn-sm unsubmitted-one" data-id="'. $daftarprocsum['id'] .'"  style="width: 70px; height: 30px;" title="Unsubmit One Year"><i class="fa fa-trash" aria-hidden="true"></i> One</button>
                            ';
                        }
                    ?>
                    <?php
                    // $isDataSaved = true;
                    // $isEditable = !$isDataSaved;
                    ?>
                </div>
            </div>
        </div>    

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Mid year review (result) -->
                    <div class="card col-sm-6">
                        <div class="card-title text-center">
                            <h5>Mid Year Review</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>A. Result</th>
                                        <td>
                                            <?php if (!empty($sum_midyear_total)): ?>
                                                <?php foreach ($sum_midyear_total as $d): ?>
                                                    <input type="number" class="form-control sum_midyear_total" value="<?= isset($d['sum_midyear_total']) ? $d['sum_midyear_total'] : '0'; ?>" readonly>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <input type="number" class="form-control sum_midyear_total" value="0" readonly>
                                            <?php endif ?>
                                        </td>
                                        <td>X</td>
                                        <td>
                                            <input type="number" class="form-control percentage_mid_total" placeholder="50%" readonly>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control result_mid" value="<?= isset($procsum['result_mid']) ? $procsum['result_mid'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>B. Process*</th>
                                    </tr>
                                    <tr>
                                        <th>B1. PDCA and Values</th>
                                        <td>
                                            <input type="number" class="form-control b1_average" value="<?= isset($procsum['b1_average']) ? $procsum['b1_average'] : ''; ?>" readonly>
                                        </td> 
                                        <td>X</td>
                                        <td>
                                            <?php
                                                switch ($kode_jabatan) {
                                                    case 2:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="30%" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="35%" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="40%" readonly>';
                                                        break;
                                                    case 8:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="50%" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="40%" readonly>';
                                                }
                                                // echo 'kode jabatan:'.$kode_jabatan;
                                            ?>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control pdca_mid" value="<?= isset($procsum['pdca_mid']) ? $procsum['pdca_mid'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <?php
                                        // $user = session()->get('npk');
                                        // $kode_jabatan = session()->get('kode_jabatan');
                                        // $specificNPKValues = [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592];
                                        // $userConditionsMet = ($kode_jabatan != 8 || !in_array($user, $specificNPKValues));
                                        $userConditionsMet = ($kode_jabatan != 8);

                                        if ($userConditionsMet) {
                                    ?>
                                    <tr>
                                        <th>B2. People Management</th>
                                        <td>
                                            <input type="number" class="form-control b2_average" value="<?= isset($procsum['b2_average']) ? $procsum['b2_average'] : ''; ?>" readonly>
                                        </td> 
                                        <td>X</td>
                                        <td id="data2">
                                            <?php
                                                switch ($kode_jabatan) {
                                                    case 2:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="20%" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="15%" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="10%" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="10%" readonly>';
                                                }
                                                // echo 'kode jabatan:'.$kode_jabatan;
                                            ?>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control pm_mid" value="<?= isset($procsum['pm_mid']) ? $procsum['pm_mid'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>Mid Year Value</th>
                                        <td>
                                            <input type="number" class="form-control midyear_value" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Grade</th>
                                        <td><span class="grade" readonly></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- One year review (result) -->
                    <div class="card col-sm-6">
                        <div class="card-title text-center">
                            <h5>One Year Review</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>A. Result</th>
                                        <td>
                                            <?php if (!empty($sum_oneyear_total)): ?>
                                                <?php foreach ($sum_oneyear_total as $d): ?>
                                                    <input type="number" class="form-control sum_oneyear_total" value="<?= isset($d['sum_oneyear_total']) ? $d['sum_oneyear_total'] : '0'; ?>" readonly>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <input type="number" class="form-control sum_oneyear_total" value="0" readonly>
                                            <?php endif ?>
                                        </td>
                                        <td>X</td>
                                        <td>
                                            <input type="number" class="form-control percentage_one_total" placeholder="50%" readonly>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control result_one" value="<?= isset($procsum['result_one']) ? $procsum['result_one'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>B. Process*</th>
                                    </tr>
                                    <tr>
                                        <th>B1. PDCA and Values</th>
                                        <td>
                                            <input type="number" class="form-control b1_average_one" value="<?= isset($procsum['b1_average_one']) ? $procsum['b1_average_one'] : ''; ?>" readonly>
                                        </td> 
                                        <td>X</td>
                                        <td>
                                            <?php
                                                switch ($kode_jabatan) {
                                                    case 2:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="30%" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="35%" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="40%" readonly>';
                                                        break;
                                                    case 8:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="50%" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="40%" readonly>';
                                                }
                                                // echo 'kode jabatan:'.$kode_jabatan;
                                            ?>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control pdca_one" value="<?= isset($procsum['pdca_one']) ? $procsum['pdca_one'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <?php
                                        $userConditionsMet = ($kode_jabatan != 8);

                                        if ($userConditionsMet) {
                                    ?>
                                    <tr>
                                        <th>B2. People Management</th>
                                        <td>
                                            <input type="number" class="form-control b2_average_one" value="<?= isset($procsum['b2_average_one']) ? $procsum['b2_average_one'] : ''; ?>" readonly>
                                        </td> 
                                        <td>X</td>
                                        <td id="data2">
                                            <?php
                                                switch ($kode_jabatan) {
                                                    case 2:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="20%" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="15%" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="10%" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="10%" readonly>';
                                                }
                                                // echo 'kode jabatan:'.$kode_jabatan;
                                            ?>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control pm_one" value="<?= isset($procsum['pm_one']) ? $procsum['pm_one'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>One Year Value</th>
                                        <td>
                                            <input type="number" class="form-control oneyear_value" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Grade</th>
                                        <td><span class="grade_one" readonly></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $inputFields = [
        'b1_average' => isset($procsum['b1_average']) ? $procsum['b1_average'] : '',
        'b2_average' => isset($procsum['b2_average']) ? $procsum['b2_average'] : '',
        'pdca_mid' => isset($procsum['pdca_mid']) ? $procsum['pdca_mid'] : '',
        'pm_mid' => isset($procsum['pm_mid']) ? $procsum['pm_mid'] : '',
        'plan_mid' => isset($procsum['plan_mid']) ? $procsum['plan_mid'] : '',
        'do_mid' => isset($procsum['do_mid']) ? $procsum['do_mid'] : '',
        'act_mid' => isset($procsum['act_mid']) ? $procsum['act_mid'] : '',
        'check_mid' => isset($procsum['check_mid']) ? $procsum['check_mid'] : '',
        'teamwork_mid' => isset($procsum['teamwork_mid']) ? $procsum['teamwork_mid'] : '',
        'cust_mid' => isset($procsum['cust_mid']) ? $procsum['cust_mid'] : '',
        'passion_mid' => isset($procsum['passion_mid']) ? $procsum['passion_mid'] : '',
        'gc_mid' => isset($procsum['gc_mid']) ? $procsum['gc_mid'] : '',
        'delegating_mid' => isset($procsum['delegating_mid']) ? $procsum['delegating_mid'] : '',
        'couch_mid' => isset($procsum['couch_mid']) ? $procsum['couch_mid'] : '',
        'couch_mid' => isset($procsum['couch_mid']) ? $procsum['couch_mid'] : '',
        'develop_mid' => isset($procsum['develop_mid']) ? $procsum['develop_mid'] : '',
        'b1_average_one' => isset($procsum['b1_average_one']) ? $procsum['b1_average_one'] : '',
        'b2_average_one' => isset($procsum['b2_average_one']) ? $procsum['b2_average_one'] : '',
        'pdca_one' => isset($procsum['pdca_one']) ? $procsum['pdca_one'] : '',
        'pm_one' => isset($procsum['pm_one']) ? $procsum['pm_one'] : '',
        'plan_one' => isset($procsum['plan_one']) ? $procsum['plan_one'] : '',
        'do_one' => isset($procsum['do_one']) ? $procsum['do_one'] : '',
        'act_one' => isset($procsum['act_one']) ? $procsum['act_one'] : '',
        'check_one' => isset($procsum['check_one']) ? $procsum['check_one'] : '',
        'teamwork_one' => isset($procsum['teamwork_one']) ? $procsum['teamwork_one'] : '',
        'cust_one' => isset($procsum['cust_one']) ? $procsum['cust_one'] : '',
        'passion_one' => isset($procsum['passion_one']) ? $procsum['passion_one'] : '',
        'gc_one' => isset($procsum['gc_one']) ? $procsum['gc_one'] : '',
        'delegating_one' => isset($procsum['delegating_one']) ? $procsum['delegating_one'] : '',
        'couch_one' => isset($procsum['couch_one']) ? $procsum['couch_one'] : '',
        'couch_one' => isset($procsum['couch_one']) ? $procsum['couch_one'] : '',
        'develop_one' => isset($procsum['develop_one']) ? $procsum['develop_one'] : '',
    ];
?>

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
    var isWithinMidPeriode = <?= json_encode($isWithinMidPeriode); ?>;
    var isWithinOnePeriode = <?= json_encode($isWithinOnePeriode); ?>;
    $(document).ready(function () {
        // var isSubmitted = <?php //echo json_encode($is_submitted_midyear); ?>;
    
        // console.log(isSubmitted);

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
                    $('.approve-button').html('<i class="fas fa-spinner fa-spin" style="color: white;"></i>');
                },
                complete: function(){
                    $('.approve-button').html('approved');
                },
                success: function(response) {
                    $('.approve-button').html('approved');
                    // approvalStatus.show(); 
                    $('.approve-button').hide();
                    $('#edit-one').hide();
                    $('#edit').hide();
                    location.reload();
                }
            });
        });

        function replaceWithSpan(inputClass, value) {
            if (value !== '') {
                $('.' + inputClass).each(function() {
                    if (!$(this).prop('readonly')) {
                        if ($(this).hasClass('one')) {
                            $(this).replaceWith('<span class="' + inputClass + ' text-center one">' + $(this).val() + '</span>');
                        } else {
                            $(this).replaceWith('<span class="' + inputClass + ' text-center">' + $(this).val() + '</span>');
                        }
                    }
                });
            }
        }

        $.each(<?php echo json_encode($inputFields); ?>, function(inputClass, value) {
            replaceWithSpan(inputClass, value);
        });

        function validateInput($element, min, max, errorMessage) {
            var value = parseFloat($element.val());
            var isValid = value >= min && value <= max;
            if (!isValid) {
                $element.addClass('is-invalid');
                $element.siblings('.invalid-feedback').text(errorMessage);
            } else {
                $element.removeClass('is-invalid');
                $element.siblings('.invalid-feedback').text('');
            }
        }

        $('.plan_mid, .plan_one, .do_mid, .do_one, .check_mid, .check_one, .act_mid, .act_one, .teamwork_mid, .teamwork_one, .cust_mid, .cust_one, .passion_mid, .passion_one, .gc_mid, .gc_one, .delegating_mid, .delegating_one, .couch_mid, .couch_one, .develop_mid, .develop_one').on('input', function () {
            validateInput($(this), 1, 5, "Value must be between 1 and 5.");
        });

        // Funtion for the #edit button
        $('#edit').on('click', function () {
            var $editInputs = $('#pdcaTable tbody span, #peopleMng tbody span');
            
            $editInputs.each(function () {
                var $span = $(this);
                var text = $span.text();
                var spanClass = $span.attr('class').split(' ')[0];
                var $newInput = $('<input type="number" class="form-control ' + spanClass + ' edit-input text-center" value="' + text + '">');
                $span.replaceWith($newInput);
                console.log($newInput);
            });

            $('.plan_mid, .do_mid, .check_mid, .act_mid, .teamwork_mid, .cust_mid, .passion_mid, .gc_mid, .delegating_mid, .couch_mid, .develop_mid').on('input', function () {
                validateInput($(this), 1, 5, "Column must be between 1 and 5.");
            });

            $('#edit').hide();
            $('#save-edit').show();
            $('#submit').hide();
            $('.approve-button').hide();
        });

        // Funtion for the #edit-one button
        $('#edit-one').on('click', function () {
            var $editInputs = $('#pdcaTable tbody span, #peopleMng tbody span');
            console.log('button clicked');
            
            $editInputs.each(function () {
                var text = $(this).text();
                var spanClass = $(this).attr('class').split(' ')[0];
                
                if($(this).hasClass('one')){
                    var $newInput = $('<input type="number" class="form-control ' + spanClass + ' edit-input text-center" value="' + text + '">');
                    $(this).replaceWith($newInput);
                }
            });

            $('.plan_one, .do_one, .check_one, .act_one, .teamwork_one, .cust_one, .passion_one, .gc_one, .delegating_one, .couch_one, .develop_one').on('input', function () {
                validateInput($(this), 1, 5, "Column must be between 1 and 5.");
            });

            $('#edit').hide();
            $('#edit-one').hide();
            $('#save-edit').show();
            $('#submit').hide();
            $('.approve-button').hide();
        });

        // Function to save the edit input
        $('#save-edit').on('click', function () {
            var row = $(this);
            var id = row.find('.plan_mid').data('id');
            var id_procsum_main = $('#id_procsum_main').val();
            var plan_mid = $('.plan_mid.edit-input').val();
            var do_mid = $('.do_mid.edit-input').val();
            var check_mid = $('.check_mid.edit-input').val();
            var act_mid = $('.act_mid.edit-input').val();
            var teamwork_mid = $('.teamwork_mid.edit-input').val();
            var cust_mid = $('.cust_mid.edit-input').val();
            var passion_mid = $('.passion_mid.edit-input').val();
            var gc_mid = $('.gc_mid.edit-input').val();
            var delegating_mid = $('.delegating_mid.edit-input').val();
            var couch_mid = $('.couch_mid.edit-input').val();
            var develop_mid = $('.develop_mid.edit-input').val();
            var b1_average = $('.b1_average').val();
            var b2_average = $('.b2_average').val();
            var result_mid = $('.result_mid.edit-input').val();
            var pdca_mid = $('.pdca_mid.edit-input').val();
            var pm_mid = $('.pm_mid.edit-input').val();
            var midyear_value = $('.midyear_value').val();
            var plan_one = $('.plan_one.edit-input').val();
            var do_one = $('.do_one.edit-input').val();
            var check_one = $('.check_one.edit-input').val();
            var act_one = $('.act_one.edit-input').val();
            var teamwork_one = $('.teamwork_one.edit-input').val();
            var cust_one = $('.cust_one.edit-input').val();
            var passion_one = $('.passion_one.edit-input').val();
            var gc_one = $('.gc_one.edit-input').val();
            var delegating_one = $('.delegating_one.edit-input').val();
            var couch_one = $('.couch_one.edit-input').val();
            var develop_one = $('.develop_one.edit-input').val();
            var b1_average_one = $('.b1_average_one').val();
            var b2_average_one = $('.b2_average_one').val();
            var result_one = $('.result_one.edit-input').val();
            var pdca_one = $('.pdca_one.edit-input').val();
            var pm_one = $('.pm_one.edit-input').val();
            var oneyear_value = $('.oneyear_value').val();

            var isValid = true;

            $('.plan_mid.edit-input, .do_mid.edit-input, .check_mid.edit-input, .act_mid.edit-input, .teamwork_mid.edit-input, .cust_mid.edit-input, .passion_mid.edit-input, .gc_mid.edit-input, .delegating_mid.edit-input, .couch_mid.edit-input, .develop_mid.edit-input').each(function() {
                validateInput($(this), 1, 5, "Value must be between 1 and 5.");
                if ($(this).hasClass('is-invalid')) {
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Please correct the highlighted fields.');
                return false;
            }
            
            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
            if(isWithinMidPeriode){
                if (kode_jabatan != 8){
                    if (plan_mid === "" || do_mid === "" || check_mid === "" || act_mid === "" || teamwork_mid === "" || cust_mid === "" || passion_mid === "" || gc_mid === "" || delegating_mid === "" || couch_mid === "" || develop_mid === "" || plan_mid === "0" || do_mid === "0" || check_mid === "0" || act_mid === "0" || teamwork_mid === "0" || cust_mid === "0" || passion_mid === "0" || gc_mid === "0" || delegating_mid === "0" || couch_mid === "0" || develop_mid === "0"){
                        if (!isAlertShown) {
                            alert('Fields must be filled.');
                            isAlertShown = true;
                        }
                        return false;
                    }
                } else {
                    if (plan_mid === "" || do_mid === "" || check_mid === "" || act_mid === "" || teamwork_mid === "" || cust_mid === "" || passion_mid === "" || plan_mid === "0" || do_mid === "0" || check_mid === "0" || act_mid === "0" || teamwork_mid === "0" || cust_mid === "0" || passion_mid === "0"){
                        if (!isAlertShown) {
                            alert('Fields must be filled.');
                            isAlertShown = true;
                        }
                        return false;
                    }
                }
            } else if(isWithinOnePeriode){
                if (kode_jabatan != 8){
                    if  (plan_one === "" || do_one === "" || check_one === "" || act_one === "" || teamwork_one === "" || cust_one === "" || passion_one === "" || gc_one === "" || delegating_one === "" || couch_one === "" || develop_one === "" || plan_one === "0" || do_one === "0" || check_one === "0" || act_one === "0" || teamwork_one === "0" || cust_one === "0" || passion_one === "0" || gc_one === "0" || delegating_one === "0" || couch_one === "0" || develop_one === "0"){
                        if (!isAlertShown) {
                            alert('Fields must be filled.');
                            isAlertShown = true;
                        }
                        return false;
                    } 
                } else {
                    if (plan_one === "" || do_one === "" || check_one === "" || act_one === "" || teamwork_one === "" || cust_one === "" || passion_one === "" || plan_one === "0" || do_one === "0" || check_one === "0" || act_one === "0" || teamwork_one === "0" || cust_one === "0" || passion_one === "0"){
                        if (!isAlertShown) {
                            alert('Fields must be filled.');
                            isAlertShown = true;
                        }
                        return false;
                    }
                }
            }
            // console.log(plan_mid);

            $.ajax({
                url: '<?= base_url('DaftarProcsum/save_edit'); ?>',
                type: 'post',
                data: {
                    id_procsum_main: id_procsum_main,
                    plan_mid: plan_mid,
                    do_mid: do_mid,
                    check_mid: check_mid,
                    act_mid: act_mid,
                    teamwork_mid: teamwork_mid,
                    cust_mid: cust_mid,
                    passion_mid: passion_mid,
                    gc_mid: gc_mid,
                    delegating_mid: delegating_mid,
                    couch_mid: couch_mid,
                    develop_mid: develop_mid,
                    b1_average: b1_average,
                    b2_average: b2_average,
                    result_mid: result_mid,
                    pdca_mid: pdca_mid,
                    pm_mid: pm_mid,
                    midyear_value: midyear_value,
                    plan_one: plan_one,
                    do_one: do_one,
                    check_one: check_one,
                    act_one: act_one,
                    teamwork_one: teamwork_one,
                    cust_one: cust_one,
                    passion_one: passion_one,
                    gc_one: gc_one,
                    delegating_one: delegating_one,
                    couch_one: couch_one,
                    develop_one: develop_one,
                    b1_average_one: b1_average_one,
                    b2_average_one: b2_average_one,
                    result_one: result_one,
                    pdca_one: pdca_one,
                    pm_one: pm_one,
                    oneyear_value: oneyear_value
                },
                beforeSend: function(){
                    $('#save-edit').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save-edit').hide();
                },
                success: function (response) {
                    // alert('Data saved successfully!');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert('Error saving data: ' + error);
                }
            });
        });

        // Function to save when one year
        $('#save-one').on('click', function () {
            var row = $(this);
            var id = row.find('.plan_mid').data('id');
            var id_procsum_main = $('#id_procsum_main').val();
            var plan_one = $('.plan_one.edit-input').val();
            var do_one = $('.do_one.edit-input').val();
            var check_one = $('.check_one.edit-input').val();
            var act_one = $('.act_one.edit-input').val();
            var teamwork_one = $('.teamwork_one.edit-input').val();
            var cust_one = $('.cust_one.edit-input').val();
            var passion_one = $('.passion_one.edit-input').val();
            var gc_one = $('.gc_one.edit-input').val();
            var delegating_one = $('.delegating_one.edit-input').val();
            var couch_one = $('.couch_one.edit-input').val();
            var develop_one = $('.develop_one.edit-input').val();
            var b1_average_one = $('.b1_average_one').val();
            var b2_average_one = $('.b2_average_one').val();
            var result_one = $('.result_one.edit-input').val();
            var pdca_one = $('.pdca_one.edit-input').val();
            var pm_one = $('.pm_one.edit-input').val();
            var oneyear_value = $('.oneyear_value').val();

            var isValid = true;

            $('.plan_one.edit-input, .do_one.edit-input, .check_one.edit-input, .act_one.edit-input, .teamwork_one.edit-input, .cust_one.edit-input, .passion_one.edit-input, .gc_one.edit-input, .delegating_one.edit-input, .couch_one.edit-input, .develop_one.edit-input').each(function() {
                validateInput($(this), 1, 5, "Value must be between 1 and 5.");
                if ($(this).hasClass('is-invalid')) {
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Please correct the highlighted fields.');
                return false;
            }
            
            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
                if (kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])){
                    if  (plan_one === "" || do_one === "" || check_one === "" || act_one === "" || teamwork_one === "" || cust_one === "" || passion_one === "" || gc_one === "" || delegating_one === "" || couch_one === "" || develop_one === "" || plan_one === "0" || do_one === "0" || check_one === "0" || act_one === "0" || teamwork_one === "0" || cust_one === "0" || passion_one === "0" || gc_one === "0" || delegating_one === "0" || couch_one === "0" || develop_one === "0"){
                        if (!isAlertShown) {
                            alert('Fields must be filled.');
                            isAlertShown = true;
                        }
                        return false;
                    } 
                } else {
                    if (plan_one === "" || do_one === "" || check_one === "" || act_one === "" || teamwork_one === "" || cust_one === "" || passion_one === "" || plan_one === "0" || do_one === "0" || check_one === "0" || act_one === "0" || teamwork_one === "0" || cust_one === "0" || passion_one === "0"){
                        if (!isAlertShown) {
                            alert('Fields must be filled.');
                            isAlertShown = true;
                        }
                        return false;
                    }
                }

            $.ajax({
                url: '<?= base_url('DaftarProcsum/save_one'); ?>',
                type: 'post',
                data: {
                    id_procsum_main: id_procsum_main,
                    plan_one: plan_one,
                    do_one: do_one,
                    check_one: check_one,
                    act_one: act_one,
                    teamwork_one: teamwork_one,
                    cust_one: cust_one,
                    passion_one: passion_one,
                    gc_one: gc_one,
                    delegating_one: delegating_one,
                    couch_one: couch_one,
                    develop_one: develop_one,
                    b1_average_one: b1_average_one,
                    b2_average_one: b2_average_one,
                    result_one: result_one,
                    pdca_one: pdca_one,
                    pm_one: pm_one,
                    oneyear_value: oneyear_value
                },
                beforeSend: function(){
                    $('#save-one').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save-one').hide();
                },
                success: function (response) {
                    // alert('Data saved successfully!');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert('Error saving data: ' + error);
                }
            });
        });

        function hitungHasil() {
            // Untuk Mid Year
            var sum_midyear_total = parseFloat($(".sum_midyear_total").val()) || 0;
            var b1_average = parseFloat($(".b1_average").val()) || 0;
            var b2_average = parseFloat($(".b2_average").val()) || 0;

            $(".b1_average").val(b1_average.toFixed(2));
            $(".b2_average").val(b2_average.toFixed(2));
            $(".sum_midyear_total").val(sum_midyear_total.toFixed(2));

            // Untuk One Year
            var sum_oneyear_total = parseFloat($(".sum_oneyear_total").val()) || 0;
            var b1_average_one = parseFloat($(".b1_average_one").val()) || 0;
            var b2_average_one = parseFloat($(".b2_average_one").val()) || 0;

            $(".b1_average_one").val(b1_average_one.toFixed(2));
            $(".b2_average_one").val(b2_average_one.toFixed(2));
            $(".sum_oneyear_total").val(sum_oneyear_total.toFixed(2));
            
            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");

            var percentage_b1_average = 0;
            if (kode_jabatan === 2) {
                percentage_b1_average = 0.3;
            } else if (kode_jabatan === 3) {
                percentage_b1_average = 0.35; 
            } else if (kode_jabatan === 4) {
                percentage_b1_average = 0.4;
            } else if (kode_jabatan === 8) {
                percentage_b1_average = 0.5;
            }

            var percentage_b2_average = 0;
            if (kode_jabatan === 2) {
                percentage_b2_average = 0.2;
            } else if (kode_jabatan === 3) {
                percentage_b2_average = 0.15; 
            } else if (kode_jabatan === 4) {
                percentage_b2_average = 0.1;
            }

            // Hitung hasil sesuai dengan persentase (Mid Year)
            var pdca_mid = b1_average * percentage_b1_average;
            var pm_mid = b2_average * percentage_b2_average;
            var result_mid = sum_midyear_total * 0.5;

            // Hitung hasil sesuai dengan persentase (One Year)
            var pdca_one = b1_average_one * percentage_b1_average;
            var pm_one = b2_average_one * percentage_b2_average;
            var result_one = sum_oneyear_total * 0.5;

            // Tampilkan hasil di input yang sesuai
            $(".pdca_mid").val(pdca_mid.toFixed(2));
            $(".pm_mid").val(pm_mid.toFixed(2));
            $(".result_mid").val(result_mid.toFixed(2));
            $(".pdca_one").val(pdca_one.toFixed(2));
            $(".pm_one").val(pm_one.toFixed(2));
            $(".result_one").val(result_one.toFixed(2));

            // Hitung dan tampilkan nilai Mid Year Value
            var midyear_value = pdca_mid + pm_mid + result_mid;
            $(".midyear_value").val(midyear_value.toFixed(2));

            // Hitung dan tampilkan nilai One Year Value
            var oneyear_value = pdca_one + pm_one + result_one;
            $(".oneyear_value").val(oneyear_value.toFixed(2));

            function calculateGrade(midyear_value) {
                if (midyear_value < 2) {
                    return "K";
                } else if (midyear_value >= 1.99 && midyear_value <= 2.495) {
                    return "C";
                } else if (midyear_value > 2.494 && midyear_value < 3) {
                    return "C+";
                } else if (midyear_value >= 2.99 && midyear_value <= 3.495) {
                    return "B";
                } else if (midyear_value > 3.494 && midyear_value < 4) {
                    return "B+";
                } else if (midyear_value >= 3.99 && midyear_value <= 4.37) {
                    return "BS";
                } else if (midyear_value > 4.36 && midyear_value <= 4.75) {
                    return "BS+";
                } else if (midyear_value > 4.74 && midyear_value < 5.01) {
                    return "IST";
                } else {
                    return "Tidak Diketahui";
                }
            }

            function calculateGradeOne(oneyear_value) {
                if (oneyear_value < 2) {
                    return "K";
                } else if (oneyear_value >= 1.99 && oneyear_value <= 2.495) {
                    return "C";
                } else if (oneyear_value > 2.494 && oneyear_value < 3) {
                    return "C+";
                } else if (oneyear_value >= 2.99 && oneyear_value <= 3.495) {
                    return "B";
                } else if (oneyear_value > 3.494 && oneyear_value < 4) {
                    return "B+";
                } else if (oneyear_value >= 3.99 && oneyear_value <= 4.37) {
                    return "BS";
                } else if (oneyear_value > 4.36 && oneyear_value <= 4.75) {
                    return "BS+";
                } else if (oneyear_value > 4.74 && oneyear_value < 5.01) {
                    return "IST";
                } else {
                    return "Tidak Diketahui";
                }
            }

            // Hitung grade dan tampilkan di elemen input (Grade Mid Year)
            var grade = calculateGrade(midyear_value);
            console.log(grade);
            $(".grade").text(grade);

            // Hitung grade dan tampilkan di elemen input (Grade One Year)
            var grade_one = calculateGradeOne(oneyear_value);
            console.log(grade_one);
            $(".grade_one").text(grade_one);
        }
        
        hitungHasil();

        // Event listener untuk input yang berubah
        $("input").on("input", function () {
            hitungHasil();
        });

        $(document).on('click', '.unsubmitted', function() {
            var id = $(this).data('id');
            console.log(id);

            $.ajax({
                url: "<?= base_url("DaftarProcsum/unsubmit") ?>",
                type: "POST",
                data: {id: id},
                beforeSend: function(){
                    $('.unsubmitted').html('<i class="fas fa-spinner fa-spin" style="color: white;"></i>');
                },
                success: function (response) {
                    var msg = response;
                    if (msg.sukses) {
                        location.reload();
                    }
                }
            });
        });

        $(document).on('click', '.unsubmitted-one', function() {
            var id = $(this).data('id');
            console.log(id);

            <?php if ($procsum['plan_one'] == 0 || $procsum['plan_one'] == null) { ?>
                alert ("Process And Summary One Year Belum Disubmit")
            <?php } elseif ($procsum['plan_one'] != 0) { ?>
                $.ajax({
                    url: "<?= base_url("DaftarProcsum/unsubmit_one") ?>",
                    type: "POST",
                    data: {id: id},
                    beforeSend: function(){
                        $('.unsubmitted-one').html('<i class="fas fa-spinner fa-spin" style="color: white;"></i>');
                    },
                    success: function (response) {
                        var msg = response;
                        if (msg.sukses) {
                            location.reload();
                            alert('Unsubmitted Success.')
                        }
                    }
                });
            <?php } ?>
        });
    });

</script>

<?= $this->endSection('script'); ?>