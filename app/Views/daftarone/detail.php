<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Detail IPP</h1>
                </div>
                <?php
                    $periodeModel = new \App\Models\PeriodeModel();
                    $periodeOneyear = $periodeModel->getLatestOnePeriode();
                    // dd($periodeOneyear);

                    $currentDate = date('Y-m-d H:i:s');
                    if ($periodeOneyear !== null) {
                        $isWithinOnePeriode = ($currentDate >= $periodeOneyear['start_period'] && $currentDate <= $periodeOneyear['end_period']);
                    } else {
                        $isWithinOnePeriode = false;
                    }
                ?>
                <div class="card-body">
                    <?php if (!empty($daftarone)): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Program</th>
                                    <th rowspan="1"style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Weight (%)</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">One Year</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">One Year Achievement</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Score</th>
                                    <th rowspan="1" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Total Score</th>
                                    <?php

                                        if ($isWithinOnePeriode && $is_approved && $is_approved_before) {
                                            echo '
                                                <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Aksi</th>
                                            ';
                                        }
                                    ?>
                                </tr>
                                <tr>
                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top: hidden;">
                                        <div style="width: 100px; align-items: center;">
                                            <input type="text" class="form-control input-sm text-center" id="total_weight" disabled="" style="width: 100%; border: none; padding: 0;">
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
                                <?php foreach ($daftarone as $one): ?>
                                    <tr class="editable">
                                    <td class="program" data-id="<?= $one['id']; ?>">
                                            <?= $one['program']; ?>
                                        </td>
                                        <td class="weight text-center" data-id="<?= $one['id']; ?>">
                                            <?= $one['weight']; ?>
                                        </td>
                                        <td class="oneyear" data-id="<?= $one['id']; ?>">
                                            <?= $one['oneyear']; ?>
                                        </td>
                                        <td class="oneyear_achv" data-id="<?= $one['id']; ?>">
                                            <?= $one['oneyear_achv']; ?>
                                        </td>
                                        <td class="oneyear_achv_score text-center" data-id="<?= $one['id']; ?>">
                                            <?= $one['oneyear_achv_score']; ?>
                                        </td>
                                        <td class="oneyear_achv_total text-center" data-id="<?= $one['id']; ?>">
                                            <?= $one['oneyear_achv_total']; ?>
                                        </td>  
                                        <?php
                                            $periodeModel = new \App\Models\PeriodeModel();
                                            $periodeOneyear = $periodeModel->getLatestOnePeriode();
                                            // dd($periodeOneyear);

                                            $currentDate = date('Y-m-d H:i:s');
                                            if ($periodeOneyear !== null) {
                                                $isWithinOnePeriode = ($currentDate >= $periodeOneyear['start_period'] && $currentDate <= $periodeOneyear['end_period']);
                                            } else {
                                                $isWithinOnePeriode = false;
                                            }

                                            // dd($is_approved);
                                            if ($isWithinOnePeriode && $is_approved && $is_approved_before) {
                                                echo '
                                                    <td>
                                                        <button class="btn btn-warning edit-btn" style="width: 42px; font-size: 12px; padding: 0;">Edit</button>
                                                        <button class="btn btn-success save-btn" style="display: none; width: 42px; font-size: 12px; padding: 0;">Simpan</button>
                                                    </td>
                                                ';
                                                // dd($mainData['id']);
                                            
                                            }
                                        ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Data IPP tidak ditemukan.</p>
                    <?php endif; ?>

                    <div class="d-flex justify-content mt-3">
                        <?php if (session()->get('npk') !== 0) { ?>
                            <a href="<?= base_url('daftarone/index') ?>" class="btn btn-primary mr-2 text-center" style="width: 100px; height: 30px;">Back</a>
                        <?php } ?>
                        <?php
                            // dd($is_approved);
                            if ($isWithinOnePeriode && $is_approved && $is_approved_before) {
                                
                                // Approval Kasie
                                if (session()->get('kode_jabatan') == 4) {
                                    if ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] != [3651, 3659]) {
                                        echo '<td class="text-center">';
                                        if (session()->get('kode_jabatan') == 4 && empty($mainData['approval_kasie_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveKasie/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval kasie
                            
                                // Approval Kadept
                                if (session()->get('kode_jabatan') == 3) {
                                    if ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] != [3651, 3659]) {
                                        if ($mainData['approval_kasie_oneyear'] == 1 && empty($mainData['approval_kadept_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveKadept/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }

                                    if ($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && in_array($mainData['created_by'], [3651, 3659]))) {
                                        if (session()->get('kode_jabatan') == 3 && empty($mainData['approval_kadept_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveKadept/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval kadept

                                // Approval Kadiv
                                if (session()->get('kode_jabatan') == 2) {
                                    if ($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])) {
                                        if ($mainData['approval_kadept_oneyear'] == 1 && empty($mainData['approval_kadiv_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveKadiv/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }

                                    if ($mainData['kode_jabatan'] == 3) {
                                        if (session()->get('kode_jabatan') == 2 && empty($mainData['approval_kadiv_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveKadiv/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval kadiv

                                // Approval BoD
                                if (session()->get('kode_jabatan') == 1) {
                                    if ($mainData['kode_jabatan'] == 3) {
                                        if ($mainData['approval_kadiv_oneyear'] == 1 && empty($mainData['approval_bod_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveBod/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }

                                    if ($mainData['kode_jabatan'] == 2) {
                                        if (session()->get('kode_jabatan') == 1 && empty($mainData['approval_bod_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approveBod/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval BoD

                                // Approval presdir
                                if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                    if ($mainData['kode_jabatan'] == 2) {
                                        echo '<td class="text-center">';
                                        if (empty($mainData['approval_presdir_oneyear'])) {
                                            echo '<a href="' . base_url("/daftarone/approvePresdir/{$mainData['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval presdir
                            
                            }

                            if (session()->get('npk') == 0){
                                echo'
                                    <button class="btn btn-danger btn-sm unsubmitted" data-id="'. $mainData['id'] .'"  style="width: 70px; height: 30px;" title="Unsubmit One Year Result"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function () {
        $('.approve-button').click(function (event) {
            console.log('clicked');
            event.preventDefault();

            var row = $(this);
            var idMain = <?= $id_main ?>;
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
                    $('.approve-button').hide();
                },
                success: function(response) {
                    $('.approve-button').hide();
                    // approvalStatus.show(); 
                    // row.hide();
                    location.reload();
                }
            });
        });

        $(document).on('click', '.unsubmitted', function() {
            var id = $(this).data('id');
            console.log(id);
            var isConfirmed = confirm("You Sure to Unsubmit the Data?")

            if(isConfirmed) {
                $.ajax({
                    url: "<?= base_url("daftarone/unsubmit") ?>",
                    type: "POST",
                    data: {id: id},
                    success: function (response) {
                        var msg = response;
                        if (msg.sukses) {
                            location.reload();
                        }
                    }
                });
            }
        });

        $('.edit-btn').click(function () {
            var row = $(this).closest('tr');
            console.log('Edit button clicked');

            // Mengubah tampilan kolom menjadi input dalam baris yang sesuai
            row.find('.oneyear_achv').html('<textarea class="form-control oneyear_achv-input">' + row.find('.oneyear_achv').text().trim() + '</textarea>');
            row.find('.oneyear_achv_score').html('<input type="number" class="form-control oneyear_achv_score-input" name="oneyear_achv_score" value="' + row.find('.oneyear_achv_score').text().trim() + '">');

            // Menambahkan atribut data-id dengan ID yang sesuai
            row.find('.save-btn').data('id', row.find('.program').data('id'));
            row.find('.save-btn').data('id', row.find('.weight').data('id'));
            row.find('.save-btn').data('id', row.find('.oneyear').data('id'));
            row.find('.save-btn').data('id', row.find('.oneyear_achv').data('id'));
            row.find('.save-btn').data('id', row.find('.oneyear_achv_score').data('id'));
            row.find('.save-btn').data('id', row.find('.oneyear_achv_total').data('id'));

            row.find('.edit-btn').hide(); 
            row.find('.btn-hapus').hide();
            row.find('.save-btn').show();
        });

        // Fungsi yang dijalankan saat tombol "Simpan" pada halaman detail diklik
        $(document).on('click', '.save-btn', function () {
            var row = $(this).closest('tr');
            console.log('Simpan button clicked for ID: ' + id);

            // Ambil ID dari atribut data-id
            var id = $(this).data('id');

            // Mengambil nilai dari input
            var id = row.find('.program').data('id');
            var idMain = <?= $id_main ?>;
            var program = row.find('.program').text();
            var weight = row.find('.weight').text();
            var oneyear = row.find('.oneyear').text();
            var newoneyear_achv = row.find('.oneyear_achv-input').val();
            var newoneyear_achv_score = row.find('.oneyear_achv_score-input').val();
            var newoneyear_achv_total = row.find('.oneyear_achv_total').text();
            // console.log(idMain);

            if (newoneyear_achv === "" || newoneyear_achv_score === "") {
                if (!isAlertShown) {
                    alert('Kolom One Year Achievement dan One Year Score harus diisi.');
                    isAlertShown = true;
                }
                row.find('.save-btn').hide();
                row.find('.oneyear_achv').text(newoneyear_achv);
                row.find('.oneyear_achv_score').text(newoneyear_achv_score);
                row.find('.oneyear_achv_total').text(newoneyear_achv_total);
                row.find('.edit-btn').show();
                // $('.approve-button').hide();
                $('.submit').show();
                return;
            }

            // Mengirim data ke server untuk disimpan, termasuk ID
            $.ajax({
                url: "<?= site_url('daftarone/save_data'); ?>",
                type: 'POST',
                data: {
                    id: id,
                    idMain: idMain,
                    program: program,
                    weight: weight,
                    oneyear: oneyear,
                    oneyear_achv: newoneyear_achv,
                    oneyear_achv_score: newoneyear_achv_score,
                    oneyear_achv_total: newoneyear_achv_total,
                },
                beforeSend: function() {
                    row.find('.save-btn').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    try {
                        var result = response;
                        if (result.sukses) {
                            alert('Data berhasil disimpan.');

                            row.find('.save-btn').hide();

                            // Mengembalikan kolom ke tampilan normal
                            row.find('.oneyear_achv').text(newoneyear_achv);
                            row.find('.oneyear_achv_score').text(newoneyear_achv_score);
                            row.find('.oneyear_achv_total').text(newoneyear_achv_total);

                            // Mengembalikan input ke tampilan <span>
                            row.find('.edit-btn').show();
                            row.find('.program-input').hide();
                            row.find('.weight-input').hide();
                            row.find('.oneyear-input').hide();
                            row.find('.oneyear_achv-input').hide();
                            row.find('.oneyear_achv_score-input').hide();
                        } else {
                            alert('Gagal menyimpan data: ' + result.message);
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan dalam respons dari server.');
                    }
                }
            });
        });

        // Fungsi untuk menghitung total total score
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

        // Fungsi untuk menambahkan event handler ke input baru
        function setupScoreInputHandlers() {
            $('.score-input').on('input', function () {
                calculateTotalScore();
            });
        }

        $(document).on('change', '.oneyear_achv_score-input', function () {
            var row = $(this).closest('tr');
            calculateTotalScore(row);
        });

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
        function calculateTotalWeight() {
            var totalWeight = 0;

            $('.weight').each(function () {
                var weight = parseFloat($(this).text());
                if (!isNaN(weight)) {
                    totalWeight += weight;
                }
            });

            // Tambah nilai weight ke dalam total
            $('.weight-input').each(function () {
                var weight = parseFloat($(this).val());
                if (!isNaN(weight)) {
                    totalWeight += weight;
                }
            });

            var totalWeightInput = totalWeight.toFixed(2);
            $('#total_weight').val(totalWeightInput);

            return true;
        }

        // Fungsi untuk menambahkan event handler ke input baru
        function setupWeightInputHandlers() {
            $('.weight-input').on('input', function () {
                calculateTotalWeight();
            });
        }

        $(document).on('input', '.weight-input', function () {
            console.log('Input event triggered for weight-input');
            calculateTotalWeight();
        });

        calculateTotalWeight();
        setupScoreInputHandlers();
        calculateTotalOverallScore();
        setupWeightInputHandlers();
    });

</script>
<?= $this->endSection('script'); ?>