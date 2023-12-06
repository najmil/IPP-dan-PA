<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <?php if ($kode_jabatan != 8  || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592]) ) : ?>
            <div class="card">
        <?php elseif ($kode_jabatan == 8 || ($kode_jabatan == 4 && $npk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) :?>
            <div class="col">
                <div class="card">
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
                        } elseif ($periodeOne !== null) {
                            $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                        } else {
                            $isWithinMidPeriode = false;
                            $isWithinOnePeriode = false;
                        }
                        ?>
                        <!-- <?php //dd($periodeMid);?>
                        <input type="hidden" id="periodeMidStart" data-start="<?php //$periodeMid['start_period']?>" data-end="<?php //$periodeMid['end_period']?>">
                        <input type="hidden" id="periodeOneStart" data-start="<?php //$periodeOne['start_period']?>" data-end="<?php //$periodeOne['end_period']?>"> -->
                    
                    <!-- Card PDCA AND VALUES -->
                    <?php if ($kode_jabatan !=8  || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) : ?>
                        <div class="col-md-6"> 
                    <?php elseif ($kode_jabatan == 8 || ($kode_jabatan == 4 && $npk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) :?>
                        <div class="col">
                    <?php endif ?>
                        <div class="card">
                            <div class="card-title text-center">
                                <h5>B1. PDCA AND VALUES</h5>
                            </div>
                            <div class="card-body">
                                <?php // dd($sum_midyear_total) ?>
                                <table class="table" id="pdcaTable">
                                    <thead class="text-center">
                                        <tr>
                                            <th rowspan="3" colspan=1 class="text-center">Aspect</th>
                                            <th rowspan="1" colspan=2 style="border-top: hidden">Achievement</th>
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
                                                    <div class="invalid-feedback" id="plan_mid-invalid-feedback"></div>
                                                </td>
                                                <td></td>
                                                <?php elseif ($isWithinOnePeriode): ?>
                                                <td class="text-center">
                                                    <input type="number" class="form-control plan_mid text-center edit-input" name="plan_mid" id="plan_mid" value="<?= isset($procsum['plan_mid']) ? $procsum['plan_mid'] : ''; ?>" min="1" max="5">
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
                                            <?php endif; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if($kode_jabatan == 8 || ($kode_jabatan == 4 && $npk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])): ?>
                            <div class="d-flex justify-content-center">
                                <a href="<?= base_url('procsum/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a>
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
                                    } elseif ($periodeOne !== null) {
                                        $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                                    } else {
                                        $isWithinMidPeriode = false;
                                        $isWithinOnePeriode = false;
                                    }

                                    // dd($isWithinOnePeriode);
                                    if ($isWithinMidPeriode && !$is_submitted_midyear) {
                                        if (empty($procsum)){
                                            echo '<button type="button" id="save" class="btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        Save
                                                </button>';
                                        }else{
                                            echo'<button type="button" id="submit" class="btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        Submit
                                                </button>
                                                <button type="button" id="edit" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                    Edit All
                                                </button>
                                                <button type="button" id="save-edit" class="btn btn-success btn-sm" style="display: none; width: 100px; height: 30px;">
                                                    Save
                                                </button>';
                                        };
                                    } elseif($isWithinOnePeriode && !$is_submitted_oneyear) {
                                        if($is_saved_oneyear == null || $is_saved_oneyear == 0){
                                            echo'
                                                <button type="button" id="save-one" class="btn btn-success btn-sm" style="width: 100px; height: 30px;">
                                                    Save
                                                </button>';
                                        } else {
                                            echo'<button type="button" id="submit-one" class="btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                        Submit
                                                </button>
                                                <button type="button" id="edit-one" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                    Edit All
                                                </button>
                                                <button type="button" id="save-edit" class="btn btn-success btn-sm" style="display: none; width: 100px; height: 30px;">
                                                    Save
                                                </button>';
                                        }
                                    }
                                ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- CARD PEOPLE MANAGEMENT -->
                    <?php
                        $npk = session()->get('npk');
                        $kode_jabatan = session()->get('kode_jabatan');
                        $userConditionsMet = ($kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592]));

                        $periodeModel = new \App\Models\PeriodeModel();
                        $periodeMid = $periodeModel->getLatestMidPeriode();
                        $periodeOne = $periodeModel->getLatestOnePeriode();
                        $isWithinMidPeriode = null;
                        $isWithinOnePeriode = null;
                        // dd($periodeMid);

                        $currentDate = date('Y-m-d H:i:s');
                        if ($periodeMid !== null) {
                            $isWithinMidPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
                        } elseif ($periodeOne !== null) {
                            $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                        } else {
                            $isWithinMidPeriode = false;
                            $isWithinOnePeriode = false;
                        }

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
                    <?php if($kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])): ?>
                        <div class="d-flex justify-content-center">
                            <a href="<?= base_url('procsum/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a>
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

                                if ($isWithinMidPeriode && !$is_submitted_midyear) {
                                    if (empty($procsum)){
                                        echo '<button type="button" id="save" class="btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    Save
                                            </button>';
                                    }else{
                                        echo'<button type="button" id="submit" class="btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    Submit
                                            </button>
                                            <button type="button" id="edit" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                Edit All
                                            </button>
                                            <button type="button" id="save-edit" class="btn btn-success btn-sm" style="display: none; width: 100px; height: 30px;">
                                                Save
                                            </button>';
                                    };
                                } elseif($isWithinOnePeriode && !$is_submitted_oneyear) {
                                    if($is_saved_oneyear == null || $is_saved_oneyear == 0){
                                        echo'
                                            <button type="button" id="save-one" class="btn btn-success btn-sm" style="width: 100px; height: 30px;">
                                                Save
                                            </button>';
                                    } else {
                                        echo'<button type="button" id="submit-one" class="btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    Submit
                                            </button>
                                            <button type="button" id="edit-one" class="btn btn-warning btn-sm mb-2 mr-2" style="width: 100px; height: 30px;">
                                                Edit All
                                            </button>
                                            <button type="button" id="save-edit" class="btn btn-success btn-sm" style="display: none; width: 100px; height: 30px;">
                                                Save
                                            </button>';
                                    }
                                }

                                // dd($is_saved_oneyear);
                            ?>
                        </div>
                    <?php endif ?>    
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
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average'] !== null ? '30%' : '') .'" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average'] !== null ? '35%' : '') .'" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average'] !== null ? '40%' : '') .'" readonly>';
                                                        break;
                                                    case 8:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average'] !== null ? '50%' : '') .'" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average'] !== null ? '40%' : '') .'" readonly>';
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
                                        $kode_jabatan = session()->get('kode_jabatan');
                                        // $specificNPKValues = [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592];
                                        // $userConditionsMet = ($kode_jabatan != 8 || !in_array($user, $specificNPKValues));
                                        $userConditionsMet = ($kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592]));

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
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b2_average'] !== null ? '20%' : '') .'" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="'. ($procsum['b2_average'] !== null ? '15%' : '') .'" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="'. ($procsum['b2_average'] !== null ? '10%' : '') .'" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="'. ($procsum['b2_average'] !== null ? '10%' : '') .'" readonly>';
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
                                                    <input type="number" class="form-control sum_oneyear_total" value="<?= isset($d['sum_oneyear_total']) ? $d['sum_oneyear_total'] : ''; ?>" readonly>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <input type="number" class="form-control sum_oneyear_total" value="0" readonly>
                                            <?php endif ?>
                                        </td>
                                        <td>X</td>
                                        <td>
                                            <input type="number" class="form-control percentage_one_total" placeholder="<?= isset($d['sum_oneyear_total']) ? '50%' : ''; ?>" readonly>
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
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average_one'] !== null ? '30%' : '').'" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average_one'] !== null ? '35%' : '').'" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average_one'] !== null ? '40%' : '') .'" readonly>';
                                                        break;
                                                    case 8:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average_one'] !== null ? '50%' : '').'" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b1_average_one'] !== null ? '40%' : '').'" readonly>';
                                                }
                                                // echo 'kode jabatan:'.$kode_jabatan;
                                            ?>
                                        </td>
                                        <td>=</td>
                                        <td>
                                            <input type="number" class="form-control pdca_one" value="<?= isset($procsum['pdca_one']) && $procsum['pdca_one'] !== null ? $procsum['pdca_one'] : ''; ?>" readonly>
                                        </td>
                                    </tr>
                                    <?php
                                        // $user = session()->get('npk');
                                        $kode_jabatan = session()->get('kode_jabatan');
                                        $npk          = session()->get('npk');
                                        // $specificNPKValues = [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592];
                                        // $userConditionsMet = ($kode_jabatan != 8 || !in_array($user, $specificNPKValues));
                                        $userConditionsMet = ($kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592]));

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
                                                        echo '<input type="number" class="form-control percentage_b1_average" placeholder="'. ($procsum['b2_average_one'] !== null ? '20%' : '') .'" readonly>';
                                                        break;
                                                    case 3:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="'. ($procsum['b2_average_one'] !== null ? '15%' : '') .'" readonly>';
                                                        break;
                                                    case 4:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="'. ($procsum['b2_average_one'] !== null ? '10%' : '') .'" readonly>';
                                                        break;
                                                    default:
                                                        echo '<input type="number" class="form-control percentage_b2_average" placeholder="'. ($procsum['b2_average_one'] !== null ? '10%' : '') .'" readonly>';
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
                                        <td><span class="<?= isset($procsum['plan_one']) ? 'grade_one' : '' ?>" readonly></span></td>
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

        var isSubmitted = <?php echo json_encode($is_submitted_midyear); ?>;
    
        console.log(isSubmitted);

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

        $('.plan_mid, .plan_one').on('input', function () {
                var planValue = $(this).val();
                console.log("Input detected:", planValue); 
                var isValid = planValue >= 1 && planValue <= 5;
                if (!isValid) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text("Plan's column must be between 1 and 5.");
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.do_mid, .do_one').on('input', function () {
                var do_mid = $(this).val();
                var do_one = $(this).val();
                if (do_mid < 1 || do_mid > 5 || do_one < 1 || do_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Do\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.check_mid, .check_one').on('input', function () {
                var check_mid = $(this).val();
                var check_one = $(this).val();
                if (check_mid < 1 || check_mid > 5 || check_one < 1 || check_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Check\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.act_mid, .act_one').on('input', function () {
                var act_mid = $(this).val();
                var act_one = $(this).val();
                if (act_mid < 1 || act_mid > 5 || act_one < 1 || act_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Action\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.teamwork_mid, .teamwork_one').on('input', function () {
                var teamwork_mid = $(this).val();
                var teamwork_one = $(this).val();
                if (teamwork_mid < 1 || teamwork_mid > 5 || teamwork_one < 1 || teamwork_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Teamwork\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.cust_mid, .cust_one').on('input', function () {
                var cust_mid = $(this).val();
                var cust_one = $(this).val();
                if (cust_mid < 1 || cust_mid > 5 || cust_one < 1 || cust_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Customer Focus\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.passion_mid, .passion_one').on('input', function () {
                var passion_mid = $(this).val();
                var passion_one = $(this).val();
                if (passion_mid < 1 || passion_mid > 5 || passion_one < 1 || passion_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Passion for Excellence\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.gc_mid, .gc_one').on('input', function () {
                var gc_mid = $(this).val();
                var gc_one = $(this).val();
                if (gc_mid < 1 || gc_mid > 5 || gc_one < 1 || gc_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Getting Commitment on IPP\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.delegating_mid, .delegating_one').on('input', function () {
                var delegating_mid = $(this).val();
                var delegating_one = $(this).val();
                if (delegating_mid < 1 || delegating_mid > 5 || delegating_one < 1 || delegating_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Delegating\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.couch_mid, .couch_one').on('input', function () {
                var couch_mid = $(this).val();
                var couch_one = $(this).val();
                if (couch_mid < 1 || couch_mid > 5 || couch_one < 1 || couch_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Couching and Counseling\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.develop_mid, develop_one').on('input', function () {
                var develop_mid = $(this).val();
                var develop_one = $(this).val();
                if (develop_mid < 1 || develop_mid > 5 || develop_one < 1 || develop_one > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Developing Subordinate\'s column must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            function validateInput($element, min, max, errorMessage) {
                var value = $element.val();
                var isValid = value >= min && value <= max;
                if (!isValid) {
                    $element.addClass('is-invalid');
                    $element.siblings('.invalid-feedback').text(errorMessage);
                } else {
                    $element.removeClass('is-invalid');
                    $element.siblings('.invalid-feedback').text('');
                }
            }
        
        // $('.invalid-feedback').remove();
        // $('.is-invalid').remove();

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

            // validasi

            $('.plan_mid, .do_mid, .check_mid, .act_mid, .teamwork_mid, .cust_mid, .passion_mid, .gc_mid, .delegating_mid, .couch_mid, .develop_mid').on('input', function () {
                validateInput($(this), 1, 5, "Column must be between 1 and 5.");
            });
            
            // end of validation

            $('#edit').hide();
            $('#save-edit').show();
            $('#submit').hide();
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
            $('#submit-one').hide();
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
            
            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;

            if(isWithinMidPeriode){
                if (kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])){
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
            }
            // console.log(plan_mid);

            $.ajax({
                url: '<?= base_url('procsum/save_edit'); ?>',
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
            // console.log(plan_mid);

            $.ajax({
                url: '<?= base_url('procsum/save_one'); ?>',
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
        
        // Button submit and cannot be edit anymore
        $('#submit').on('click', function () {
            var id_procsum_main = $('#id_procsum_main').val();
            var plan_mid        = $('.plan_mid').text();
            var do_mid          = $('.do_mid').text();
            var check_mid       = $('.check_mid').text();
            var act_mid         = $('.act_mid').text();
            var teamwork_mid    = $('.teamwork_mid').text();
            var cust_mid        = $('.cust_mid').text();
            var passion_mid     = $('.passion_mid').text();
            var gc_mid          = $('.gc_mid').text();
            var delegating_mid  = $('.delegating_mid').text();
            var couch_mid       = $('.couch_mid').text();
            var develop_mid     = $('.develop_mid').text();
            var b1_average      = $('.b1_average').text();
            var b2_average      = $('.b2_average').text();
            var result_mid      = $('.result_mid').text();
            var pdca_mid        = $('.pdca_mid').text();
            var pm_mid          = $('.pm_mid').text();
            var midyear_value   = $('.midyear_value').text();
            var plan_one        = $('.plan_one').text();
            var do_one          = $('.do_one').text();
            var check_one       = $('.check_one').text();
            var act_one         = $('.act_one').text();
            var teamwork_one    = $('.teamwork_one').text();
            var cust_one        = $('.cust_one').text();
            var passion_one     = $('.passion_one').text();
            var gc_one          = $('.gc_one').text();
            var delegating_one  = $('.delegating_one').text();
            var couch_one       = $('.couch_one').text();
            var develop_one     = $('.develop_one').text();
            var b1_average      = $('.b1_average').text();
            var b2_average      = $('.b2_average').text();
            var result_one      = $('.result_one').text();
            var pdca_one        = $('.pdca_one').text();
            var pm_one          = $('.pm_one').text();
            var oneyear_value   = $('.oneyear_value').text();

            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
            if(isWithinMidPeriode){
                if (kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])){
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
            }
            
            var formData = {
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
                b1_average: b1_average,
                b2_average: b2_average,
                result_one: result_one,
                pdca_one: pdca_one,
                pm_one: pm_one,
                oneyear_value: oneyear_value
            };

            $.ajax({
                url: '<?= site_url('procsum/insert_data'); ?>',
                type: 'post',
                data: formData,
                beforeSend: function(){
                    $('#submit').html('<i class="fas fa-spinner fa-spin"></i>');
                    $('#edit').hide();
                },
                complete: function(){
                    $('#submit').hide();
                },
                success: function(hasil) {
                    console.log(hasil);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });

            // Untuk Mid Year
            var b1_values = [plan_mid, do_mid, check_mid, act_mid, teamwork_mid, cust_mid, passion_mid];
            var b1_total = 0;
            for (var i = 0; i < b1_values.length; i++) {
                if (b1_values[i]) {
                    b1_total += parseFloat(b1_values[i]);
                }
            }
            var b1_average = b1_total / b1_values.length;
            $('.b1_average').val(b1_average.toFixed(2));

            var b2_values = [gc_mid, delegating_mid, couch_mid, develop_mid];
            var b2_total = 0;
            for (var j = 0; j < b2_values.length; j++) {
                if (b2_values[j]) {
                    b2_total += parseFloat(b2_values[j]);
                }
            }
            var b2_average = b2_total / b2_values.length;
            $('.b2_average').val(b2_average.toFixed(2));

            // Untuk One Year
            var b1_values_one = [plan_one, do_one, check_one, act_one, teamwork_one, cust_one, passion_one];
            var b1_total_one = 0;
            for (var i = 0; i < b1_values_one.length; i++) {
                if (b1_values_one[i]) {
                    b1_total_one += parseFloat(b1_values_one[i]);
                }
            }
            var b1_average_one = b1_total_one / b1_values_one.length;
            $('.b1_average_one').val(b1_average_one.toFixed(2));

            var b2_values_one = [gc_one, delegating_one, couch_one, develop_one];
            var b2_total_one = 0;
            for (var j = 0; j < b2_values_one.length; j++) {
                if (b2_values_one[j]) {
                    b2_total_one += parseFloat(b2_values_one[j]);
                }
            }
            var b2_average_one = b2_total_one / b2_values_one.length;
            $('.b2_average_one').val(b2_average_one.toFixed(2));
        });
        
        // Button submit and cannot be edit anymore
        $('#submit-one').on('click', function () {
            var id_procsum_main = $('#id_procsum_main').val();
            
            var formData = {
                id_procsum_main: id_procsum_main
            };

            $.ajax({
                url: '<?= site_url('procsum/insert_data'); ?>',
                type: 'post',
                data: formData,
                beforeSend: function(){
                    $('#submit-one').html('<i class="fas fa-spinner fa-spin"></i>');
                    $('#edit-one').hide();
                },
                complete: function(){
                    $('#submit-one').hide();
                },
                success: function(hasil) {
                    console.log(hasil);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
        });

        // Button save temporarily
        $('#save').on('click', function () {
            var id_procsum_main = $('#id_procsum_main').val();
            var plan_mid = $('#plan_mid').val();
            var do_mid = $('#do_mid').val();
            var check_mid = $('#check_mid').val();
            var act_mid = $('#act_mid').val();
            var teamwork_mid = $('#teamwork_mid').val();
            var cust_mid = $('#cust_mid').val();
            var passion_mid     = $('#passion_mid').val();
            var gc_mid          = $('#gc_mid').val();
            var delegating_mid  = $('#delegating_mid').val();
            var couch_mid       = $('#couch_mid').val();
            var develop_mid     = $('#develop_mid').val();
            var b1_average      = $('#b1_average').val();
            var b2_average      = $('#b2_average').val();
            var result_mid      = $('#result_mid').val();
            var pdca_mid        = $('#pdca_mid').val();
            var pm_mid          = $('#pm_mid').val();
            var midyear_value   = $('#midyear_value').val();
            var plan_one        = $('.plan_one').text();
            var do_one          = $('.do_one').text();
            var check_one       = $('.check_one').text();
            var act_one         = $('.act_one').text();
            var teamwork_one    = $('.teamwork_one').text();
            var cust_one        = $('.cust_one').text();
            var passion_one     = $('.passion_one').text();
            var gc_one          = $('.gc_one').text();
            var delegating_one  = $('.delegating_one').text();
            var couch_one       = $('.couch_one').text();
            var develop_one     = $('.develop_one').text();
            var b1_average_one  = $('.b1_average_one').text();
            var b2_average_one  = $('.b2_average_one').text();
            var result_one      = $('.result_one').text();
            var pdca_one        = $('.pdca_one').text();
            var pm_one          = $('.pm_one').text();
            var oneyear_value   = $('.oneyear_value').text();
      
            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
            if (kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])){
                if (plan_mid === "" || do_mid === "" || check_mid === "" || act_mid === "" || teamwork_mid === "" || cust_mid === "" || passion_mid === "" || gc_mid === "" || delegating_mid === "" || couch_mid === "" || develop_mid === ""){
                    if (!isAlertShown) {
                        alert('Fields must be filled.');
                        isAlertShown = true;
                    }
                    return false;
                }
            } else {
                if (plan_mid === "" || do_mid === "" || check_mid === "" || act_mid === "" || teamwork_mid === "" || cust_mid === "" || passion_mid === ""){
                    if (!isAlertShown) {
                        alert('Fields must be filled.');
                        isAlertShown = true;
                    }
                    return false;
                }
            }
            
            var formData = {
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
            };

            $.ajax({
                url: '<?= base_url('procsum/save_temporarily'); ?>',
                type: 'post',
                data: formData,
                beforeSend: function(){
                    $('#save').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save').hide();
                },
                success: function(hasil) {
                    // console.log(hasil);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });

            // Untuk Mid Year
            var b1_values = [plan_mid, do_mid, check_mid, act_mid, teamwork_mid, cust_mid, passion_mid];
            var b1_total = 0;
            for (var i = 0; i < b1_values.length; i++) {
                if (b1_values[i]) {
                    b1_total += parseFloat(b1_values[i]);
                }
            }
            var b1_average = b1_total / b1_values.length;
            $('.b1_average').val(b1_average.toFixed(2));

            var b2_values = [gc_mid, delegating_mid, couch_mid, develop_mid];
            var b2_total = 0;
            for (var j = 0; j < b2_values.length; j++) {
                if (b2_values[j]) {
                    b2_total += parseFloat(b2_values[j]);
                }
            }
            var b2_average = b2_total / b2_values.length;
            $('.b2_average').val(b2_average.toFixed(2));

            // Untuk One Year
            var b1_values_one = [plan_one, do_one, check_one, act_one, teamwork_one, cust_one, passion_one];
            var b1_total_one = 0;
            for (var i = 0; i < b1_values_one.length; i++) {
                if (b1_values_one[i]) {
                    b1_total_one += parseFloat(b1_values_one[i]);
                }
            }
            var b1_average_one = b1_total_one / b1_values_one.length;
            $('.b1_average_one').val(b1_average_one.toFixed(2));

            var b2_values_one = [gc_one, delegating_one, couch_one, develop_one];
            var b2_total_one = 0;
            for (var j = 0; j < b2_values_one.length; j++) {
                if (b2_values_one[j]) {
                    b2_total_one += parseFloat(b2_values_one[j]);
                }
            }
            var b2_average_one = b2_total_one / b2_values_one.length;
            $('.b2_average_one').val(b2_average_one.toFixed(2));
        });

        function hitungHasil() {
            // Untuk Mid Year
            var sum_midyear_total = parseFloat($(".sum_midyear_total").val()) || 0;
            var b1_average = parseFloat($(".b1_average").val()) || 0;
            var b2_average = parseFloat($(".b2_average").val()) || 0;

            b1_average !== 0 ? $(".b1_average").val(b1_average.toFixed(2)) : '';
            b2_average !== 0 ? $(".b2_average").val(b2_average.toFixed(2)) : '';
            sum_midyear_total !== 0 ? $(".sum_midyear_total").val(sum_midyear_total.toFixed(2)) : '';

            // Untuk One Year
            var sum_oneyear_total = parseFloat($(".sum_oneyear_total").val()) || 0;
            var b1_average_one = parseFloat($(".b1_average_one").val()) || 0;
            var b2_average_one = parseFloat($(".b2_average_one").val()) || 0;

            b1_average_one !== 0 ? $(".b1_average_one").val(b1_average_one.toFixed(2)) : '';
            b2_average_one !== 0 ?$(".b2_average_one").val(b2_average_one.toFixed(2)) : '';
            sum_oneyear_total !== 0 ? $(".sum_oneyear_total").val(sum_oneyear_total.toFixed(2)) : '';
            
            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");

            var percentage_b1_average = 0;
            if (kode_jabatan === 2) {
                percentage_b1_average = 0.3;
            } else if (kode_jabatan === 3) {
                percentage_b1_average = 0.35; 
            } else if (kode_jabatan === 4) {
                percentage_b1_average = 0.4;
            } else if (kode_jabatan === 8 || ($kode_jabatan === 4 && [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592].includes($npk))) {
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
            // $(".pdca_mid").val(pdca_mid.toFixed(2));
            // $(".pm_mid").val(pm_mid.toFixed(2));
            // $(".result_mid").val(result_mid.toFixed(2));
            // $(".pdca_one").val(pdca_one.toFixed(2));
            // $(".pm_one").val(pm_one.toFixed(2));
            // $(".result_one").val(result_one.toFixed(2));
            pdca_mid !== 0 ? $(".pdca_mid").val(pdca_mid.toFixed(2)) : '';
            pm_mid !== 0 ? $(".pm_mid").val(pm_mid.toFixed(2)) : '';
            result_mid !== 0 ? $(".result_mid").val(result_mid.toFixed(2)) : '';
            pdca_one !== 0 ? $(".pdca_one").val(pdca_one.toFixed(2)) : '';
            pm_one !== 0 ? $(".pm_one").val(pm_one.toFixed(2)) : '';
            result_one !== 0 ? $(".result_one").val(result_one.toFixed(2)) : '';

            // Hitung dan tampilkan nilai Mid Year Value
            var midyear_value = pdca_mid + pm_mid + result_mid;
            midyear_value !== 0 ? $(".midyear_value").val(midyear_value.toFixed(2)) : '';

            // Hitung dan tampilkan nilai One Year Value
            var oneyear_value = pdca_one + pm_one + result_one;
            oneyear_value !== 0 ? $(".oneyear_value").val(oneyear_value.toFixed(2)) : '';

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
    });

</script>

<?= $this->endSection('script'); ?>