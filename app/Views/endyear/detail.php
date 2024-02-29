<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card" style="max-width: 100%; overflow-y: auto;">
                <div class="card-body">

                    <h3 class="mb-3 text-center">ONE YEAR REVIEW RESULT</h3>
                    
                    <div class="showdata">

                        <?php
                            $periodeModel = new \App\Models\PeriodeModel();
                            $periodeOne = $periodeModel->getLatestOnePeriode();
                            $periodeIPPOne = $periodeModel->getLatestOnePeriode();
                            $editIppMid = false;
                            $editIppOne = false;
                            
                            $currentDate = date('Y-m-d H:i:s');
                            $currentYear = date('Y');
                            if ($periodeOne !== null) {
                                $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                            } else {
                                $isWithinOnePeriode = false;
                            }
                            // dd($isWithinOnePeriode);

                            $isRevisi = false;
                            $periodeArray = array_column($mainall, 'periode');
                            $mainby = array_column($mainall, 'created_by');
                            $periodes = array_column($mainall, 'periode');
                            $keyword = $currentYear.' Rev. Mid Year';
                            $keywordone = $currentYear.' Rev. One Year';

                            $matches = array_filter($mainby, function($id, $index) use ($periodes, $keyword) {
                                return strpos($periodes[$index], $keyword) !== false;
                            }, ARRAY_FILTER_USE_BOTH);
                            $matchesone = array_filter($mainby, function($id, $index) use ($periodes, $keywordone) {
                                return strpos($periodes[$index], $keywordone) !== false;
                            }, ARRAY_FILTER_USE_BOTH);
                            // dd($matches == false);

                            if ($matches == true && $matchesone == true) {
                                if (strpos($main['periode'], $currentYear.' Rev. One Year') !== false){
                                    $isRevisi = true;
                                }
                            } elseif ($matches == false && $matchesone == true) {
                                if (strpos($main['periode'], $currentYear.' Rev. One Year') !== false){
                                    $isRevisi = true;
                                };
                            } elseif ($matches == false && $matchesone == false) {
                                if (strpos($main['periode'], $currentYear) !== true){
                                    $isRevisi = true;
                                    // dd($isRevisi);
                                };
                            } elseif ($matches == true && $matchesone == false) {
                                if (strpos($main['periode'], $currentYear.' Rev. Mid Year') !== false){
                                    $isRevisi = true;
                                }
                            }
                            
                            if ($main['periode'] == $currentYear) {
                                // if (strpos($main['periode'], $currentYear) == true ){
                                    $isRevisi = true;
                                // };
                            }

                            $allowAccess = false;
                            if (session()->get('kode_jabatan') == 8) {
                                // Kode jabatan 8: Harus menunggu approval dari kasie dan kadept (kecuali npk=(960, 4277, 3659, 1814, 2070, 2322, 2364, 2592))
                                if (!in_array(session()->get('npk'), [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])) {
                                    $allowAccess = $mainData['approval_kasie'] && $mainData['approval_kadept'];
                                } else {
                                    $allowAccess = $mainData['approval_kadept'] && $mainData['approval_kadiv'];
                                }
                            } elseif (session()->get('kode_jabatan') == 4) {
                                $allowAccess = $mainData['approval_kadept'] && $mainData['approval_kadiv'];
                            } elseif (session()->get('kode_jabatan') == 3) {
                                $allowAccess = $mainData['approval_kadiv'] && $mainData['approval_bod'];
                            } elseif (session()->get('kode_jabatan') == 2) {
                                $allowAccess = $mainData['approval_bod'] && $mainData['approval_presdir'];
                            } elseif (session()->get('kode_jabatan') <= 1) {
                                $allowAccess = $mainData['approval_bod'] && $mainData['approval_presdir'];
                            }

                            // dd($isRevisi);
                            if ($isWithinOnePeriode && !$is_submitted && $isRevisi && $allowAccess) {
                                echo '
                                    <button type="button" class="btn btn-warning btn-sm edit-all-btn mb-2 float-right">Edit All</button>
                                    <button type="button" class="btn btn-success btn-sm save-all-btn mb-2 float-right" style="display: none;">Save Temporarily</button>
                                    <button type="button" class="btn btn-danger btn-sm submit mb-2 float-right mr-2">Submit</button>
                                ';
                            }
                        ?>

                        <a href="/pdf/kriteriapk.pdf" target="_blank">Kriteria PK (Lihat Di Sini)</a>

                        <table class="table table-sm table-striped table-hover" id="isidetail" style="width: 100%;">
                            <thead style="display: table-header-group; text-align: center;">
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">No.</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Program/Activity</th>
                                    <th rowspan="1" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Weight (%)</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">One Year Target</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">One Year Achievement</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Score</th>
                                    <th rowspan="1" style=" border-bottom: hidden; text-align: center; vertical-align: middle;">Total Score</th>
                                    <?php if ($isWithinOnePeriode && !$is_submitted && ($isRevisi && strpos($periode, 'Revisi 2') == true)) {
                                        echo '<th rowspan="2" style=" border-bottom: hidden; text-align: center; vertical-align: middle;">Aksi</th>';
                                    }?>
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
                                    foreach($oneyear as $m):
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
                                    <td class="oneyear" data-id="<?= $m['id']; ?>">
                                        <?= $m['oneyear']; ?>
                                    </td>
                                    <td class="oneyear_achv" data-id="<?= $m['id']; ?>">
                                        <?= $m['oneyear_achv']; ?>
                                    </td>
                                    <td class="oneyear_achv_score" data-id="<?= $m['id']; ?>">
                                        <?= $m['oneyear_achv_score']; ?>
                                        <!-- <div class="invalid-feedback"></div> -->
                                    </td>
                                    <td class="oneyear_achv_total" data-id="<?= $m['id']; ?>">
                                        <?= $m['oneyear_achv_total']; ?>
                                    </td>
                                    <?php //if ($isWithinOnePeriode && !$is_submitted && ($isRevisi && strpos($periode, 'Revisi 2') == true)) {
                                        //echo '
                                            //<td>
                                            //    <button type="button" class="btn btn-danger btn-sm remove_row">Hapus</button>
                                            //</td>';
                                    //}?>
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
            url: "<?php echo site_url('/oneyear/detail'); ?>/" + id,
            dataType: "json",
            success: function(response){
                $('.showdata').html(response.data);
            }
        });
    }

    $(document).ready(function(){
        isidetail(id);

        $('.editable').on('input', '.oneyear_achv_score-input', function () {
            var oneyear_achv_score = $(this).val();
            if (oneyear_achv_score === '') {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            } else if (oneyear_achv_score < 1 || oneyear_achv_score > 5) {
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
                    row.find('.oneyear_achv').html('<textarea class="form-control oneyear_achv-input" name="oneyear_achv">' + row.find('.oneyear_achv').text().trim() + '</textarea>');
                    row.find('.oneyear_achv_score').html('<input type="number" class="form-control oneyear_achv_score-input" style="width: 100px;" name="oneyear_achv_score" value="' + row.find('.oneyear_achv_score').text().trim() + '"><div class="invalid-feedback"></div>');
                }
            });

            // Menampilkan tombol "Save All" dan menyembunyikan "Edit All"
            $('.edit-all-btn').hide();
            $('.submit').hide();
            $('.save-all-btn').show();
            $('#total_score').prop('disabled', true);
        });

        // Fungsi yang dijalankan saat tombol "Save All" diklik (masih bisa edit)
        $('.save-all-btn').click(function () {
            $('.editable').each(function () {
                var row = $(this);
                var id = row.find('.program').data('id');
                var program = row.find('.program').text().trim();
                var weight = row.find('.weight').text().trim();
                var oneyear = row.find('.oneyear').text().trim();
                var newOneYearAchv = row.find('.oneyear_achv-input').val();
                var newOneYearScore = row.find('.oneyear_achv_score-input').val();
                var newOneYearTotal = row.find('.oneyear_achv_total').text().trim();
                var idMain = row.find('input[name="id_main[]"]').val();
                
                // Periksa jika input kosong
                if (newOneYearAchv === "" || newOneYearScore === "") {
                    alert('Kolom One Year Achievement dan One Year Score harus diisi.');
                    return;
                }

                $.ajax({
                    url: "<?= base_url('oneyear/save_data'); ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        idMain: idMain,
                        program: program,
                        weight: weight,
                        oneyear: oneyear,
                        oneyear_achv: newOneYearAchv,
                        oneyear_achv_score: newOneYearScore,
                        oneyear_achv_total: newOneYearTotal
                    },
                    success: function (response) {
                        var result = response;
                        console.log(response);
                        if (result.sukses) {
                            row.find('.save-btn').hide();
                            row.find('.oneyear_achv').text(newOneYearAchv);
                            row.find('.oneyear_achv_score').text(newOneYearScore);
                            row.find('.oneyear_achv_total').text(newOneYearTotal);
                            // location.reload();
                            row.find('.edit-btn').show();
                            $('.submit').show();
                        } else {
                            alert('Gagal menyimpan data: ' + result.message);
                    } 
                    }
                });

            });

            // Menampilkan tombol "Edit All" dan menyembunyikan "Save All"
            $('.save-all-btn').hide();
            $('.edit-all-btn').show();
        });

        // Fungsi untuk submit (cannot be edit anymore)
        $('.submit').click(function () {
            $('.editable').each(function () {
                var row = $(this);
                var id = row.find('.program').data('id');
                var idMain = row.find('input[name="id_main[]"]').val();

                $.ajax({
                    url: '<?= base_url('oneyear/submit') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        idMain: idMain
                    },
                    beforeSend:function(){
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
                    url: "<?= base_url('oneyear/delete_data'); ?>",
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
        $(document).on('change', '.oneyear_achv_score-input', function () {
            var row = $(this).closest('tr');
            calculateTotalScore(row);
            $('.save-all-btn').show();
        });

        // Fungsi untuk menghitung total skor pada baris tertentu
        function calculateTotalScore(row) {
            var weight = parseFloat(row.find('.weight').text());
            var scoreInput = parseFloat(row.find('.oneyear_achv_score-input').val());

            if (!isNaN(weight) && !isNaN(scoreInput)) {
                var totalScore = (weight / 100) * scoreInput;
                row.find('.oneyear_achv_total').text(totalScore.toFixed(2));

                // Menambahkan log untuk memeriksa oneyear_achv_total
                console.log('oneyear_achv_total:', totalScore.toFixed(2));
            } else {
                row.find('.oneyear_achv_total').text('');
            }

            calculateTotalOverallScore();
        }

        // Fungsi untuk menghitung total skor keseluruhan
        function calculateTotalOverallScore() {
            var totalScore = 0;
            $('.oneyear_achv_total').each(function () {
                var score = parseFloat($(this).text());
                if (!isNaN(score)) {
                    totalScore += score;
                }
            });
            $('#total_score').val(totalScore.toFixed(2));
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