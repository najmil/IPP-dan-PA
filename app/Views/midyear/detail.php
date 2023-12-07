<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body" style="max-width: 100%; overflow-y: auto;">

                    <h3 class="mb-3 text-center">MID YEAR REVIEW RESULT</h3>
                    
                    <div class="showdata">
                        <?php
                            $periodeModel = new \App\Models\PeriodeModel();
                            $periodeMid = $periodeModel->getLatestMidPeriode();$periodeIPPMid = $periodeModel->getLatestMidPeriode();
                            $editIppMid = false;
                            $editIppOne = false;
                            // dd($periodeMid);

                            $currentDate = date('Y-m-d H:i:s');
                            $currentYear = date('Y');
                            if ($periodeMid !== null) {
                                $isWithinIPPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
                            } else {
                                $isWithinIPPeriode = false;
                            }

                            $isRevisi = false;
                            $periodeArray = array_column($mainall, 'periode');
                            $mainby = array_column($mainall, 'created_by');
                            $periodes = array_column($mainall, 'periode');
                            $keyword = $currentYear.' Rev. Mid Year';
                            $keywordone = $currentYear.' Rev. One Year';

                            $matchesmid = array_filter($mainby, function($id, $index) use ($periodes, $keyword) {
                                return strpos($periodes[$index], $keyword) !== false;
                            }, ARRAY_FILTER_USE_BOTH);
                            $matches = array_filter($mainby, function($id, $index) use ($periodes, $keywordone) {
                                return strpos($periodes[$index], $keywordone) !== false;
                            }, ARRAY_FILTER_USE_BOTH);
                            
                            if ($matches == false && $matchesmid == true) {
                                if (strpos($main['periode'], $currentYear.' Rev. Mid Year') !== false){
                                    $isRevisi = true;
                                }
                            } elseif ($matches == true && $matchesmid == true) {
                                if (strpos($main['periode'], $currentYear.' Rev. One Year') !== false){
                                    $isRevisi = true;
                                };
                            } elseif ($matches == false && $matchesmid == false) {
                                if (strpos($main['periode'], $currentYear) !== false){
                                    $isRevisi = true;
                                };
                            }

                            if ($main['periode'] == $currentYear) {
                                // if (strpos($main['periode'], $currentYear) == true ){
                                    $isRevisi = true;
                                // };
                            } elseif (strpos($main['periode'], $currentYear.' Rev. One Year') !== false){
                                $isRevisi = true;
                            } elseif (strpos($main['periode'], $currentYear.' Rev. Mid Year') !== false){
                                $isRevisi = true;
                            }
                            // dd($isRevisi);
                            // dd($periodeArray);

                            $allowAccess = false;
                            if (session()->get('kode_jabatan') == 8) {
                                // Kode jabatan 8: Harus menunggu approval dari kasie dan kadept (kecuali npk=(960, 4277, 3659, 1814, 2070, 2322, 2364, 2592))
                                if (!in_array(session()->get('npk'), [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])) {
                                    $allowAccess = $mainData['approval_kasie'] == 1 && $mainData['approval_kadept'] == 1;
                                } else {
                                    $allowAccess = $mainData['approval_kadept'] == 1 && $mainData['approval_kadiv'] == 1;
                                }
                            } elseif (session()->get('kode_jabatan') == 4) {
                                $allowAccess = $mainData['approval_kadept'] == 1 && $mainData['approval_kadiv'] == 1;
                            } elseif (session()->get('kode_jabatan') == 3) {
                                $allowAccess = $mainData['approval_kadiv'] == 1 && $mainData['approval_bod'] == 1;
                            } elseif (session()->get('kode_jabatan') == 2) {
                                $allowAccess = $mainData['approval_bod'] == 1 && $mainData['approval_presdir'] == 1;
                            } elseif (session()->get('kode_jabatan') <= 1) {
                                $allowAccess = $mainData['approval_bod'] == 1 && $mainData['approval_presdir'] == 1;
                            }

                            // dd($isRevisi);
                            if ($isWithinIPPeriode && !$is_submitted && $allowAccess && $isRevisi) {
                                echo '
                                    <button type="button" class="btn btn-warning btn-sm edit-all-btn mb-2 float-right">Edit All</button>
                                    <button type="button" class="btn btn-success btn-sm save-all-btn mb-2 float-right" style="display: none;">Save Temporarily</button>
                                    <button type="button" class="btn btn-danger btn-sm submit mb-2 float-right mr-2">Submit</button>
                                ';
                            }
                        ?>

                        <a href="/pdf/kriteriapk.pdf" target="_blank">
                            <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>Kriteria PK
                        </a>

                        <table class="table table-sm table-striped table-hover" id="isidetail" style="width: 100%;">
                            <thead style="display: table-header-group; text-align: center;">
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">No.</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Program/Activity</th>
                                    <th rowspan="1" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Weight (%)</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Mid Year Target</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Mid Year Achievement</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Score</th>
                                    <th rowspan="1" style=" border-bottom: hidden; text-align: center; vertical-align: middle;">Total Score</th>
                                    <!-- <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Aksi</th> -->
                                    <?php //if ($isWithinIPPeriode && !$is_submitted && $allowAccess && ($isRevisi && strpos($periode, 'Revisi') == true)) {
                                        //echo '<th rowspan="2" style=" border-bottom: hidden; text-align: center; vertical-align: middle;">Aksi</th>';
                                    //}?>
                                </tr>
                                <tr>
                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; width: 10%;">
                                        <div style="align-items: center;">
                                            <input type="text" class="form-control input-sm text-center" id="total_weight" disabled="" style="border: none; padding: 0;">
                                        </div>
                                    </th>
                                    <th style="border-bottom: 1px solid #dee2e6; border-top:hidden">
                                        <div style="width: 100px; align-items: center;">
                                            <input type="text" class="form-control input-sm text-center" id="total_score" disabled="" style="width: 100%; border: none; padding: 0;">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 0;
                                    foreach($midyear as $m):
                                        $nomor++;
                                ?>
                                <tr class="editable">
                                    <td><?= $nomor; ?></td>
                                    <td class="program" data-id="<?= $m['id']; ?>">
                                        <?= $m['program']; ?>
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="id_main" name="id_main[]" value="<?= $id_main; ?>">
                                    </td>
                                    <td class="weight" data-id="<?= $m['id']; ?>">
                                        <?= $m['weight']; ?>
                                    </td>
                                    <td class="midyear" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear']; ?>
                                    </td>
                                    <td class="midyear_achv" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear_achv']; ?>
                                    </td>
                                    <td class="midyear_achv_score" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear_achv_score']; ?>
                                    </td>
                                    <td class="midyear_achv_total" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear_achv_total']; ?>
                                    </td>
                                    <?php // if ($isWithinIPPeriode && !$is_submitted && $allowAccess && ($isRevisi && strpos($periode, 'Revisi') == true)) {
                                        // echo '
                                            // <td>
                                            //     <button type="button" class="btn btn-danger btn-sm remove_row">Hapus</button>
                                            // </td>';
                                    //} ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>


<?= $this->section('script'); ?>
<script>
    var id = <?= $id_main; ?>;
    
    $('#isidetail').DataTable({
        lengthChange: false,
        lengthMenu: [[-1], ["All"]],
        pagingType: "simple"
    });
    
    function isidetail(id){
        $.ajax({
            url: "<?php echo site_url('/midyear/detail'); ?>/" + id,
            dataType: "json",
            success: function(response){
                $('.showdata').html(response.data);
            }
        });
    }

    $(document).ready(function(){
        isidetail(id);

        // $('#isidetail tbody tr').each(function() {
        //     console.log($(this).text());
        // });

        $('.editable').on('input', '.midyear_achv_score-input', function () {
            var midyear_achv_score = $(this).val();
            if (midyear_achv_score === '') {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            } else if (midyear_achv_score < 1 || midyear_achv_score > 5) {
                $(this).addClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('Score must be between 1 and 5.');
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            }
        });

        // Fungsi yang dijalankan saat tombol "Edit All" diklik
        $('.edit-all-btn').click(function () {
            $('.editable').each(function () {
                var row = $(this);
                if (row.hasClass('editable')) {
                    row.find('.midyear_achv').html('<textarea class="form-control midyear_achv-input" name="midyear_achv">' + row.find('.midyear_achv').text().trim() + '</textarea>');
                    row.find('.midyear_achv_score').html('<input type="number" class="form-control midyear_achv_score-input" name="midyear_achv_score" value="' + row.find('.midyear_achv_score').text().trim() + '"><div class="invalid-feedback"></div>');
                }
            });

            $('.edit-all-btn').hide();
            $('.save-all-btn').show();
            $('.submit').hide();
            $('#total_score').prop('disabled', true);
            $('.remove_row').hide();
        });

        // Fungsi yang dijalankan saat tombol "Save All" diklik (untuk save edit (save inputan pertama))
        $('.save-all-btn').click(function () {
            let isAlertShown = false;
            $('.editable').each(function () {
                var row = $(this);
                var id = row.find('.program').data('id');
                var program = row.find('.program').text().trim();
                var weight = row.find('.weight').text().trim();
                var midyear = row.find('.midyear').text().trim();
                var newMidYearAchv = row.find('.midyear_achv-input').val();
                var newMidYearScore = row.find('.midyear_achv_score-input').val();
                var newMidYearTotal = row.find('.midyear_achv_total').text().trim();
                var idMain = row.find('input[name="id_main[]"]').val();
                
                if (newMidYearAchv === "" || newMidYearScore === "") {
                    if (!isAlertShown) {
                        alert('Kolom Mid Year Achievement dan Mid Year Score harus diisi.');
                        isAlertShown = true;
                    }
                    // row.find('.save-btn').hide();
                    // row.find('.midyear_achv').text(newMidYearAchv);
                    // row.find('.midyear_achv_score').text(newMidYearScore);
                    // row.find('.midyear_achv_total').text(newMidYearTotal);
                    // // location.reload();
                    // row.find('.edit-btn').show();
                    // $('.submit').show();
                    return false;
                }

                $.ajax({
                    url: "<?= site_url('midyear/save_data'); ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        idMain: idMain,
                        program: program,
                        weight: weight,
                        midyear: midyear,
                        midyear_achv: newMidYearAchv,
                        midyear_achv_score: newMidYearScore,
                        midyear_achv_total: newMidYearTotal
                    },
                    beforeSend: function(){
                        $('.save-all-btn').html('<i class="fas fa-spinner fa-spin"></i>');
                    },
                    complete: function(){
                        $('.save-all-btn').hide();
                    },
                    success: function (response) {
                        var result = response;
                        console.log(response);
                        if (result.sukses) {
                            if (!isAlertShown) {
                                // Mengembalikan tampilan baris ke mode normal
                                row.find('.save-btn').hide();
                                row.find('.midyear_achv').text(newMidYearAchv);
                                row.find('.midyear_achv_score').text(newMidYearScore);
                                row.find('.midyear_achv_total').text(newMidYearTotal);
                                // location.reload();
                                row.find('.edit-btn').show();
                                $('.submit').show();
                                $('.remove_row').show();
                                // Menampilkan tombol "Edit All" dan menyembunyikan "Save All"
                                $('.save-all-btn').hide();
                                $('.edit-all-btn').show();
                            }
                        }
                    }
                });

            });
        });

        // Fungsi yang dijalankan untuk submit
        $('.submit').click(function () {
            let isAlertShown = false;
            $('.editable').each(function () {
                var row = $(this);
                var id = row.find('.program').data('id');
                var idMain = row.find('input[name="id_main[]"]').val();
                var newMidYearAchv = row.find('.midyear_achv-input').val();
                var newMidYearScore = row.find('.midyear_achv_score-input').val();

                if (newMidYearAchv === null || newMidYearAchv === "" || newMidYearScore === null || newMidYearScore === "") {
                    if (!isAlertShown) {
                        alert('Kolom Mid Year Achievement dan Mid Year Score harus diisi.');
                        isAlertShown = true;
                    }
                    return;
                }

                $.ajax({
                    url: '<?= base_url('midyear/submit') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        idMain: idMain
                    },
                    beforeSend: function(){
                        $('.submit').html('<i class="fas fa-spinner fa-spin"></i>');
                    },
                    complete: function(){
                        $('.submit').hide();
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.sukses) {
                            // alert(response.message);
                            location.reload();
                        } 
                    },
                    error: function () {
                        // alert('An error occurred while sending data to the server.');
                    }
                });
            });

            // Menampilkan tombol "Edit All" dan menyembunyikan "Save All"
            $('.save-all-btn').hide();
            $('.edit-all-btn').show();
        });

        // Fungsi untuk menghapus baris
        $(document).on('click', '.btn-hapus', function () {
            console.log('button diklik');
            var row = $(this).closest('tr');
            var id = row.find('.program').data('id');
            
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: "<?= base_url('midyear/delete_data'); ?>",
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        var result = response;
                        if (result.sukses) {
                            row.remove();
                            // location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error: " + status, error);
                    }
                });
            }
            calculateTotalScore();
        });

        // Event handler saat input kolom "Score" berubah
        $(document).on('change', '.midyear_achv_score-input', function () {
            var row = $(this).closest('tr');
            calculateTotalScore(row);
            $('.save-all-btn').show();
        });

        // Fungsi untuk menghitung total skor pada baris tertentu
        function calculateTotalScore(row) {
            var weight = parseFloat(row.find('.weight').text());
            var scoreInput = parseFloat(row.find('.midyear_achv_score-input').val());

            if (!isNaN(weight) && !isNaN(scoreInput)) {
                var totalScore = (weight / 100) * scoreInput;
                row.find('.midyear_achv_total').text(totalScore.toFixed(2));

                // Menambahkan log untuk memeriksa midyear_achv_total
                console.log('midyear_achv_total:', totalScore.toFixed(2));
            } else {
                row.find('.midyear_achv_total').text('');
            }

            calculateTotalOverallScore();
        }

        // Fungsi untuk menghitung total skor keseluruhan
        function calculateTotalOverallScore() {
            var totalScore = 0;
            $('.midyear_achv_total').each(function () {
                var score = parseFloat($(this).text());
                if (!isNaN(score)) {
                    totalScore += score;
                }
            });
            $('#total_score').val(totalScore.toFixed(2));

            // Menyimpan total_score ke dalam tabel main
            // var idMain = $('#isidetail').data('id_main');
            // saveTotalScore(idMain, totalScore.toFixed(2));
        }

        // Fungsi untuk menghitung total weight
        function calculateTotalWeightScore() {
            var totalScore = 0;

            $('.weight').each(function () {
                var score = parseFloat($(this).text());
                if (!isNaN(score)) {
                    totalScore += score;
                }
            });

            // Tambah nilai weight ke dalam total
            $('.weight').each(function () {
                var score = parseFloat($(this).val());
                if (!isNaN(score)) {
                    totalScore += score;
                }
            });

            var totalWeightInput = totalScore.toFixed(2);
            $('#total_weight').val(totalWeightInput);

            if (totalWeightInput != 100.00) {
                isDataSaved = false;
                // Display an error message
                // alert('Total Weight must be 100%, currently total is ' + totalWeightInput + '%. Please check again.');
            } else {
                // Set the flag to indicate data is saved
                isDataSaved = true;
            }

            return true;
        }

        // Fungsi untuk menambahkan event handler ke input baru
        function setupWeightInputHandlers() {
            $('.weight').on('input', function () {
                calculateTotalWeightScore();
            });
        }

        $(document).on('input', '.weight', function () {
            console.log('Input event triggered for weight');
            var weightValue = $(this).val();
            console.log('Raw Weight Value:', weightValue);
            
            weightValue = parseFloat(weightValue);
            console.log('Parsed Weight Value:', weightValue);

            if (!isNaN(weightValue)) {
                calculateTotalWeightScore();
            } else {
                console.log('Invalid weight value:', weightValue);
            }
        });

        calculateTotalWeightScore();
        setupWeightInputHandlers();

        // Hitung total skor saat dokumen pertama kali dimuat
        calculateTotalOverallScore();
    });


</script>
<?= $this->endSection('script'); ?>