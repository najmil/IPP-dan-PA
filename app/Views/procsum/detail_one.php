<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <?php if ($kode_jabatan != 8 ) : ?>
            <div class="card">
        <?php elseif ($kode_jabatan == 8) :?>
            <div class="col">
                <div class="card">
            </div>
        <?php endif ?>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <!-- Card PDCA AND VALUES -->
                    <?php if ($kode_jabatan !=8 ) : ?>
                        <div class="col-md-6"> 
                    <?php elseif ($kode_jabatan == 8) :?>
                        <div class="col">
                    <?php endif ?>
                        <div class="card">
                            <div class="card-body">
                                <?php // dd($sum_oneyear_total) ?>
                                <h5 class="card-title">B1. PDCA AND VALUES</h5>
                                <table class="table" id="pdcaTable">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Aspect</th>
                                            <th rowspan="1" style="border-top: hidden">Achievement (One Year)</th>
                                        </tr>
                                        <tr style="border-top: hidden">
                                            <th rowspan="1"><input type="text" class="form-control b1_average text-center .edit-input" value="<?= isset($procsum['b1_average']) ? $procsum['b1_average'] : ''; ?>" readonly></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th row>1. Plan</th>
                                            <td>
                                                <input type="number" class="form-control plan_mid text-center edit-input" name="plan_mid" value="<?= isset($procsum['plan_mid']) ? $procsum['plan_mid'] : ''; ?>" min="1" max="5" autofocus>
                                                <div class="invalid-feedback"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th row>2. Do</th>
                                            <td>
                                                <input type="number" class="form-control do_mid text-center edit-input" name="do_mid"value="<?= isset($procsum['do_mid']) ? $procsum['do_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th row>3. Check</th>
                                            <td>
                                                <input type="number" class="form-control check_mid text-center edit-input" name="check_mid" value="<?= isset($procsum['check_mid']) ? $procsum['check_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <th row>4. Action</th>
                                            <td>
                                                <input type="number" class="form-control act_mid text-center edit-input" name="act_mid" value="<?= isset($procsum['act_mid']) ? $procsum['act_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th row>5. Teamwork</th>
                                            <td>
                                                <input type="number" class="form-control teamwork_mid text-center edit-input" name="teamwork_mid" value="<?= isset($procsum['teamwork_mid']) ? $procsum['teamwork_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th row>6. Customer Focus</th>
                                            <td>
                                                <input type="number" class="form-control cust_mid text-center edit-input" name="cust_mid" value="<?= isset($procsum['cust_mid']) ? $procsum['cust_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th row>7. Passion for Excellence</th>
                                            <td>
                                                <input type="number" class="form-control passion_mid text-center edit-input" name="passion_mid" value="<?= isset($procsum['passion_mid']) ? $procsum['passion_mid'] : ''; ?>" min="1" max="5">
                                                <div class="invalid-feedback"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if($kode_jabatan == 8): ?>
                            <div class="d-flex justify-content-center">
                                <a href="<?= base_url('procsum/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Kembali</a>
                                <?php
                                    $periodeModel = new \App\Models\PeriodeModel();
                                    $periodeOne = $periodeModel->getLatestOnePeriode();
                                    // dd($periodeOne);

                                    $currentDate = date('Y-m-d H:i:s');
                                    if ($periodeOne !== null) {
                                        $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                                    } else {
                                        $isWithinOnePeriode = false;
                                    }

                                    if ($isWithinOnePeriode && ($is_submitted_midyear == 0 || $is_submitted_midyear == null)) {
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
                                    }
                                ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- CARD PEOPLE MANAGEMENT -->
                    <?php
                        // $user = session()->get('npk');
                        $kode_jabatan = session()->get('kode_jabatan');
                        $userConditionsMet = ($kode_jabatan != 8);

                        if ($userConditionsMet) {
                    ?>
                        <div class="col-md-6"> <!-- Kolom kanan, ukuran setengah lebar dari total lebar grid -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">B2. PEOPLE MANAGEMENT</h5>
                                    <table class="table" id="peopleMng">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Aspect</th>
                                                <th rowspan="1" style="border-top: hidden">Achievement (One Year)</th>
                                            </tr>
                                            <tr style="border-top: hidden">
                                                <th rowspan="1"><input type="text" class="form-control b2_average text-center" value="<?= isset($procsum['b2_average']) ? $procsum['b2_average'] : ''; ?>" readonly></th>
                                                <div class="invalid-feedback"></div>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th row>1. Getting Commitment on IPP</th>
                                                <td>
                                                    <input type="number" class="form-control gc_mid text-center edit-input" name="gc_mid" value="<?= isset($procsum['gc_mid']) ? $procsum['gc_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th row>2. Delegating</th>
                                                <td>
                                                    <input type="number" class="form-control delegating_mid text-center edit-input" name="delegating_mid" value="<?= isset($procsum['delegating_mid']) ? $procsum['delegating_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th row>3. Couching and Counseling</th>
                                                <td>
                                                    <input type="number" class="form-control couch_mid text-center edit-input" name="couch_mid" value="<?= isset($procsum['couch_mid']) ? $procsum['couch_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th row>4. Developing Subordinate</th>
                                                <td>
                                                    <input type="number" class="form-control develop_mid text-center edit-input" name="develop_mid" value="<?= isset($procsum['develop_mid']) ? $procsum['develop_mid'] : ''; ?>" min="1" max="5">
                                                    <div class="invalid-feedback"></div>
                                                </td>
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
                            <a href="<?= base_url('procsum/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Kembali</a>
                            <?php
                                $periodeModel = new \App\Models\PeriodeModel();
                                $periodeOne = $periodeModel->getLatestOnePeriode();
                                // dd($periodeOne);

                                $currentDate = date('Y-m-d H:i:s');
                                if ($periodeOne !== null) {
                                    $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                                } else {
                                    $isWithinOnePeriode = false;
                                }

                                // dd($isWithinOnePeriode);

                                if ($isWithinOnePeriode && ($is_submitted_midyear == 0 || $is_submitted_midyear == null)) {
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
                                }
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    // $isDataSaved = true;
                    // $isEditable = !$isDataSaved;
                    ?>
                </div>
            </div>
        </div>    

        <div class="card">
            <div class="card-body">
                <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">One Year Review</h5>
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
                                                $kode_jabatan = session()->get('kode_jabatan');
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
                                                <th>Final Value</th>
                                                <td>
                                                    <input type="number" class="form-control midyear_value" value="<?= isset($procsum['midyear_value']) ? $procsum['midyear_value'] : ''; ?>" readonly>
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
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php
    $inputFields = [
        'b1_average' => isset($procsum['b1_average']) ? $procsum['b1_average'] : '',
        'b2_average' => isset($procsum['b2_average']) ? $procsum['b1_average'] : '',
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
    ];
?>

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function () {
        var isSubmitted = <?php echo json_encode($is_submitted_midyear); ?>;
    
        console.log(isSubmitted);

        function replaceWithSpan(inputClass, value) {
            if (value !== '') {
                $('.' + inputClass).each(function() {
                    if (!$(this).prop('readonly')) {
                        $(this).replaceWith('<span class="' + inputClass + ' text-center">' + $(this).val() + '</span>');
                    }
                });
            }
        }

        $.each(<?php echo json_encode($inputFields); ?>, function(inputClass, value) {
            replaceWithSpan(inputClass, value);
        });

        $('.plan_mid').on('input', function () {
                var plan_mid = $(this).val();
                if (plan_mid < 1 || plan_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Plan (One Year) must be between 1 and 5.');
                    // console.log('Pesan validasi Plan (One Year) terpanggil');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.do_mid').on('input', function () {
                var do_mid = $(this).val();
                if (do_mid < 1 || do_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Do (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.check_mid').on('input', function () {
                var check_mid = $(this).val();
                if (check_mid < 1 || check_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Check (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.act_mid').on('input', function () {
                var act_mid = $(this).val();
                if (act_mid < 1 || act_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Action (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.teamwork_mid').on('input', function () {
                var teamwork_mid = $(this).val();
                if (teamwork_mid < 1 || teamwork_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Teamwork (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.cust_mid').on('input', function () {
                var cust_mid = $(this).val();
                if (cust_mid < 1 || cust_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Customer Focus (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.passion_mid').on('input', function () {
                var passion_mid = $(this).val();
                if (passion_mid < 1 || passion_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Passion for Excellence (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.gc_mid').on('input', function () {
                var gc_mid = $(this).val();
                if (gc_mid < 1 || gc_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Getting Commitment on IPP (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.delegating_mid').on('input', function () {
                var delegating_mid = $(this).val();
                if (delegating_mid < 1 || delegating_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Delegating (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.couch_mid').on('input', function () {
                var couch_mid = $(this).val();
                if (couch_mid < 1 || couch_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Couching and Counseling (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });

            $('.develop_mid').on('input', function () {
                var develop_mid = $(this).val();
                if (develop_mid < 1 || develop_mid > 5) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('Developing Subordinate (One Year) must be between 1 and 5.');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });
        
        // $('.invalid-feedback').remove();
        // $('.is-invalid').remove();

        // Funtion for the #edit button
        $('#edit').on('click', function () {
            var $editInputs = $('#pdcaTable tbody span, #peopleMng tbody span');
            
            $editInputs.each(function () {
                var $span = $(this);
                var text = $span.text();
                var spanClass = $span.attr('class').split(' ')[0]; // Mengambil class pertama dari span
                var $newInput = $('<input type="text" class="form-control ' + spanClass + ' edit-input text-center" value="' + text + '">');
                $span.replaceWith($newInput);
                console.log($newInput);
            });

            $('#edit').hide();
            $('#save-edit').show();
            $('#submit').hide();
        });

        // Function to save the edit input
        $('#save-edit').on('click', function () {
            // Gather the edited data from input fields
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

            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
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
                    midyear_value: midyear_value
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

            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
            if (kode_jabatan != 8){
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
                midyear_value: midyear_value
            };

            $.ajax({
                url: '<?= site_url('procsum/insert_data'); ?>',
                type: 'post',
                data: formData,
                beforeSend: function(){
                    $('#submit').html('<i class="fas fa-spinner fa-spin"></i>');
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
        });

        // Button save temporarily
        $('#save').on('click', function () {
            var id_procsum_main = $('#id_procsum_main').val();
            var plan_mid = $('.plan_mid').val();
            var do_mid = $('.do_mid').val();
            var check_mid = $('.check_mid').val();
            var act_mid = $('.act_mid').val();
            var teamwork_mid = $('.teamwork_mid').val();
            var cust_mid = $('.cust_mid').val();
            var passion_mid = $('.passion_mid').val();
            var gc_mid = $('.gc_mid').val();
            var delegating_mid = $('.delegating_mid').val();
            var couch_mid = $('.couch_mid').val();
            var develop_mid = $('.develop_mid').val();
            var b1_average = $('.b1_average').val();
            var b2_average = $('.b2_average').val();
            var result_mid = $('.result_mid').val();
            var pdca_mid = $('.pdca_mid').val();
            var pm_mid = $('.pm_mid').val();
            var midyear_value = $('.midyear_value').val();

            var kode_jabatan = parseInt("<?= $kode_jabatan; ?>");
            let isAlertShown = false;
            if (kode_jabatan != 8){
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
                midyear_value: midyear_value
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
                    console.log(hasil);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });

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
        });

        function hitungHasil() {
            var sum_oneyear_total = parseFloat($(".sum_oneyear_total").val()) || 0;
            var b1_average = parseFloat($(".b1_average").val()) || 0;
            var b2_average = parseFloat($(".b2_average").val()) || 0;

            $(".b1_average").val(b1_average.toFixed(2));
            $(".b2_average").val(b2_average.toFixed(2));
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

            // Hitung hasil sesuai dengan persentase
            var pdca_mid = b1_average * percentage_b1_average;
            var pm_mid = b2_average * percentage_b2_average;
            var result_mid = sum_oneyear_total * 0.5;

            // Tampilkan hasil di input yang sesuai
            $(".pdca_mid").val(pdca_mid.toFixed(2));
            $(".pm_mid").val(pm_mid.toFixed(2));
            $(".result_mid").val(result_mid.toFixed(2));

            // Hitung dan tampilkan nilai One Year Value
            var midyear_value = pdca_mid + pm_mid + result_mid;
            $(".midyear_value").val(midyear_value.toFixed(2));

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

            // Hitung grade dan tampilkan di elemen input
            var grade = calculateGrade(midyear_value);
            console.log(grade);
            $(".grade").text(grade);
        }
        
        hitungHasil();

        // Event listener untuk input yang berubah
        $("input").on("input", function () {
            hitungHasil();
        });
    });

</script>

<?= $this->endSection('script'); ?>