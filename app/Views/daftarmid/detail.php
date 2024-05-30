<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Detail Mid Year</h1>
                </div>
                <div class="card-body">
                    <a href="/pdf/kriteriapk.pdf" target="_blank">
                        <i class="fas fa-file-pdf ml-2 mr-2 mb-2" style="color: red; font-size: 20px;"></i>Kriteria PK
                    </a>
                    <?php if (!empty($daftarmid)): ?>
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 22%;">Program</th>
                                    <th rowspan="1"style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Weight (%)</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 22%;">Mid Year</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 22%;">Mid Year Achievement</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 8%;">Score</th>
                                    <th rowspan="1" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 8%;">Total Score</th>
                                    <?php
                                        $periodeModel = new \App\Models\PeriodeModel();
                                        $periodeMidyear = $periodeModel->getLatestMidPeriode();
                                        // dd($periodeMidyear);

                                        $currentDate = date('Y-m-d H:i:s');
                                        if ($periodeMidyear !== null) {
                                            $isWithinMidPeriode = ($currentDate >= $periodeMidyear['start_period'] && $currentDate <= $periodeMidyear['end_period']);
                                        } else {
                                            $isWithinMidPeriode = false;
                                        }

                                        if (session()->get('npk') != 0 && $isWithinMidPeriode && $is_approved && $is_approved_before) {
                                            echo '
                                                <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Aksi</th>
                                            ';
                                        }
                                    ?>
                                </tr>
                                <tr>
                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top: hidden; text-align: center;">
                                        <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                            <input type="text" class="form-control input-sm text-center" id="total_weight" disabled="" style="width: 100%; border: none; padding: 0;">
                                        </div>
                                    </th>

                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top: hidden; text-align: center;">
                                        <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                        <input type="text" class="form-control input-sm text-center" id="total_score" disabled="" style="width: 100%; border: none; padding: 0;">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($daftarmid as $mid): ?>
                                    <tr class="editable">
                                        <td class="program" data-id="<?= $mid['id']; ?>">
                                            <?= $mid['program']; ?>
                                        </td>
                                        <td class="weight text-center" data-id="<?= $mid['id']; ?>">
                                            <?= $mid['weight']; ?>
                                        </td>
                                        <td class="midyear" data-id="<?= $mid['id']; ?>">
                                            <?= $mid['midyear']; ?>
                                        </td>
                                        <td class="midyear_achv" data-id="<?= $mid['id']; ?>">
                                            <?= $mid['midyear_achv']; ?>
                                        </td>
                                        <td class="midyear_achv_score text-center" data-id="<?= $mid['id']; ?>">
                                            <?= $mid['midyear_achv_score']; ?>
                                        </td>
                                        <td class="midyear_achv_total text-center" data-id="<?= $mid['id']; ?>">
                                            <?= $mid['midyear_achv_total']; ?>
                                        </td>
                                        <?php
                                            $periodeModel = new \App\Models\PeriodeModel();
                                            $periodeMidyear = $periodeModel->getLatestMidPeriode();
                                            // dd($periodeMidyear);

                                            $currentDate = date('Y-m-d H:i:s');
                                            if ($periodeMidyear !== null) {
                                                $isWithinMidPeriode = ($currentDate >= $periodeMidyear['start_period'] && $currentDate <= $periodeMidyear['end_period']);
                                            } else {
                                                $isWithinMidPeriode = false;
                                            }

                                            if (session()->get('npk') != 0 && $isWithinMidPeriode && $is_approved && $is_approved_before) {
                                                echo '
                                                    <td class="text-center">
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
                        <p>Data Mid Year Result tidak ditemukan.</p>
                    <?php endif; ?>

                    <div class="d-flex justify-content mt-3">
                        <?php if(session()->get('npk') != 0) { ?>
                            <a href="<?= base_url('DaftarMid/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a>
                        <?php } ?>
                        <?php
                            if (session()->get('npk') != 0 && $isWithinMidPeriode && $is_approved_before && $is_approved && $midmain['is_submitted'] == 1) {
                                // dd($midmain);
                                // Approval Kasie
                                if (session()->get('kode_jabatan') == 4) {
                                    if ($midmain['kode_jabatan'] == 8) {
                                        echo '<td class="text-center">';
                                        if (session()->get('kode_jabatan') == 4 && empty($midmain['approval_kasie_midyear'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approveKasie/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval kasie
                                // dd($midmain['kode_jabatan']);
                                
                                // Approval Kadept
                                if (session()->get('kode_jabatan') == 3) {
                                    if ($midmain['kode_jabatan'] == 8) {
                                        if ($midmain['approval_kasie_midyear'] == 1 && empty($midmain['approval_kadept_midyear'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approveKadept/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    } elseif ($midmain['kode_jabatan'] == 4 && empty($midmain['approval_kadept_midyear'])) {
                                        // dd($midmain['id']);
                                        echo '<a href="' . base_url("/DaftarMid/approveKadept/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                            <i class="fas fa-check" style="color: white;">Approve</i>
                                        </a>';
                                    }
                                }
                                // The end of approval kadept

                                // Approval Kadiv
                                if (session()->get('kode_jabatan') == 2) {
                                    if ($midmain['kode_jabatan'] == 4 || ($midmain['kode_jabatan'] == 8 && $midmain['created_by'] == [3651, 3659])) {
                                        if ($midmain['approval_kadept_midyear'] == 1 && empty($midmain['approval_kadiv_midyear'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approveKadiv/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }

                                    if ($midmain['kode_jabatan'] == 3) {
                                        if (session()->get('kode_jabatan') == 2 && empty($midmain['approval_kadiv_midyear'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approveKadiv/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval kadiv

                                // Approval BoD
                                if (session()->get('kode_jabatan') == 1) {
                                    if ($midmain['kode_jabatan'] == 3) {
                                        // dd($midmain['approval_bod_midyear']);
                                        if ($midmain['approval_kadiv_midyear'] == 1 && empty($midmain['approval_bod_midyear'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approveBod/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }

                                    if ($midmain['kode_jabatan'] == 2) {
                                        if (session()->get('kode_jabatan') == 1 && empty($midmain['approval_bod_midyear'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approveBod/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval BoD

                                // Approval presdir
                                if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                    if ($midmain['kode_jabatan'] == 2) {
                                        echo '<td class="text-center">';
                                        if (empty($midmain['approval_presdir'])) {
                                            echo '<a href="' . base_url("/DaftarMid/approvePresdir/{$midmain['id']}") . '" class="approve-button btn btn-success btn-sm mr-2" style="width: 100px; height: 30px;">
                                                <i class="fas fa-check" style="color: white;">Approve</i>
                                            </a>';
                                        }
                                    }
                                }
                                // The end of approval presdir
                                
                            }

                            // if (session()->get('npk') == 0){
                            //     echo'
                            //         <button class="btn btn-danger btn-sm unsubmitted" data-id="'. $midmain['id'] .'"  style="width: 70px; height: 30px;" title="Unsubmit Mid Year Result"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            //     ';
                            // }

                            if (session()->get('npk') == 0){
                                echo'
                                    <table style="width: 100%;" class="table text-center table-bordered">
                                        <thead>
                                            <trstyle="style="border: 1px solid black;">
                                                <th rowspan=2>Unsubmit IPP</th>
                                                <th colspan=2>Cancel Approval</th>';
                                            echo'</tr>
                                            <tr>';
                                                if ($midmain['kode_jabatan'] == 8){
                                                    echo '<th>Kasie</th>';
                                                    echo '<th>Kadept</th>';
                                                } elseif ($midmain['kode_jabatan'] == 4){
                                                    echo '<th>Kadept</th>';
                                                    echo '<th>Kadiv</th>';
                                                } elseif ($midmain['kode_jabatan'] == 3){
                                                    echo '<th>Kadiv</th>';
                                                    echo '<th>Direktur</th>';
                                                } elseif ($midmain['kode_jabatan'] == 2){
                                                    echo '<th>Direktur</th>';
                                                    echo '<th>Presdir</th>';
                                                }
                                            echo '</tr>
                                        </thead>
                                        <tbody> <tr>
                                                <td>
                                                    <button class="btn btn-danger btn-sm unsubmitted" data-id="'. $midmain['id'] .'"  style="width: 70px; height: 30px;" title="Unsubmit Mid Year Result"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                </td>';
                                                if ($midmain['kode_jabatan'] == 8){
                                                    echo'<td>';
                                                        if($midmain['approval_kasie_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "8" data-keterangan="kasie" style="width: 70px; height: 30px;" title="Cancel Approval Kasie"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_kasie_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                    echo'<td>';
                                                        if($midmain['approval_kadept_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "8" data-keterangan="kadept" style="width: 70px; height: 30px;" title="Cancel Approval Kadept"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_kadept_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                } elseif ($midmain['kode_jabatan'] == 4){
                                                    echo'<td>';
                                                        if($midmain['approval_kadept_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "4" data-keterangan="kadept" style="width: 70px; height: 30px;" title="Cancel Approval Kadep"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_kadept_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                    echo'<td>';
                                                        if($midmain['approval_kadiv_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "4" data-keterangan="kadiv" style="width: 70px; height: 30px;" title="Cancel Approval Kadiv"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_kadiv_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                        // dd($midmain);
                                                    echo'</td>';
                                                } elseif ($midmain['kode_jabatan'] == 3){
                                                    echo'<td>';
                                                        if($midmain['approval_kadiv_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "3" data-keterangan="kadiv" style="width: 70px; height: 30px;" title="Cancel Approval Kadiv"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_kadiv_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                    echo'<td>';
                                                        if($midmain['approval_bod_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "3" data-keterangan="bod" style="width: 70px; height: 30px;" title="Cancel Approval Direktur"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_bod_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                } elseif ($midmain['kode_jabatan'] == 2){
                                                    echo'<td>';
                                                        if($midmain['approval_bod_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "2" data-keterangan="bod" style="width: 70px; height: 30px;" title="Cancel Approval Direktur"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_bod_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                    echo'<td>';
                                                        if($midmain['approval_presdir_midyear'] == 1){
                                                            echo '<button class="btn btn-danger btn-sm cancelApproval" data-id="' . $midmain['id'] . '" data-kode_jabatan = "2" data-keterangan="presdir" style="width: 70px; height: 30px;" title="Cancel Approval Presdir"><i class="fa fa-times" aria-hidden="true"></i></button>';
                                                        } elseif($midmain['approval_presdir_midyear'] === null){
                                                            echo '<span class="badge badge-secondary btn-sm approval-status">Pending</span>';
                                                        }
                                                    echo'</td>';
                                                }
                                            echo '</tr>
                                        </tbody>
                                    </table>';
                            } elseif ($is_approved_before && $is_approved && (($midmain['is_submitted_ipp'] == 1 && $midmain['is_submitted_ipp_mid'] === null && $midmain['is_submitted_ipp_one'] === null) || ($midmain['is_submitted_ipp'] === null && $midmain['is_submitted_ipp_mid'] == 1 && $midmain['is_submitted_ipp_one'] === null) || ($midmain['is_submitted_ipp'] === null && $midmain['is_submitted_ipp_mid'] === null && $midmain['is_submitted_ipp_one'] == 1)) && session()->get('nama') !== 'admin' && $midmain['is_submitted'] == 1) {
                                echo'
                                    <button class="btn btn-danger btn-sm unsubmitted" data-id="'. $midmain['id'] .'"  style="width: 150px; height: 30px;" title="Need Revision"><i class="fa fa-backward" aria-hidden="true"></i> Need Revision</button>
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

        $(document).on('click', '.unsubmitted', function() {
            var id = $(this).data('id');
            console.log(id);

            $.ajax({
                url: "<?= base_url("DaftarMid/unsubmit") ?>",
                type: "POST",
                data: {id: id},
                success: function (response) {
                    var msg = response;
                    if (msg.sukses) {
                        location.reload();
                    }
                }
            });
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

        $('.edit-btn').click(function () {
            var row = $(this).closest('tr');
            console.log('Edit button clicked');

            // Mengubah tampilan kolom menjadi input dalam baris yang sesuai
            row.find('.midyear_achv').html('<textarea class="form-control midyear_achv-input">' + row.find('.midyear_achv').text().trim() + '</textarea>');
            row.find('.midyear_achv_score').html('<input type="number" class="form-control midyear_achv_score-input" name="midyear_achv_score" min=1 value="' + row.find('.midyear_achv_score').text().trim() + '">');

            // Menambahkan atribut data-id dengan ID yang sesuai
            row.find('.save-btn').data('id', row.find('.program').data('id'));
            row.find('.save-btn').data('id', row.find('.weight').data('id'));
            row.find('.save-btn').data('id', row.find('.midyear').data('id'));
            row.find('.save-btn').data('id', row.find('.midyear_achv').data('id'));
            row.find('.save-btn').data('id', row.find('.midyear_achv_score').data('id'));
            row.find('.save-btn').data('id', row.find('.midyear_achv_total').data('id'));

            row.find('.edit-btn').hide(); 
            row.find('.btn-hapus').hide();
            row.find('.save-btn').show();
            // $('.approve-button').hide();
        });

        // Fungsi yang dijalankan saat tombol "Simpan" pada halaman detail diklik
        $(document).on('click', '.save-btn', function () {
            let isAlertShown = false;
            var row = $(this).closest('tr');
            console.log('Simpan button clicked for ID: ' + id);

            // Ambil ID dari atribut data-id
            var id = $(this).data('id');

            // Mengambil nilai dari input
            var id = row.find('.program').data('id');
            var idMain = <?= $id_main ?>;
            var program = row.find('.program').text();
            var weight = row.find('.weight').text();
            var midyear = row.find('.midyear').text();
            var newmidyear_achv = row.find('.midyear_achv-input').val();
            var newmidyear_achv_score = row.find('.midyear_achv_score-input').val();
            var newmidyear_achv_total = row.find('.midyear_achv_total').text();

            if (row.find('.is-invalid').length > 0) {
                if (!isAlertShown) {
                    alert('Score must be between 1-5.');
                    isAlertShown = true;
                }
                return false;
            }

            if (newmidyear_achv === "" || newmidyear_achv_score === "") {
                if (!isAlertShown) {
                    alert('All columns required.');
                    isAlertShown = true;
                }
                return false;
            }

            $.ajax({
                url: "<?= site_url('DaftarMid/save_data'); ?>",
                type: 'POST',
                data: {
                    id: id,
                    idMain: idMain,
                    program: program,
                    weight: weight,
                    midyear: midyear,
                    midyear_achv: newmidyear_achv,
                    midyear_achv_score: newmidyear_achv_score,
                    midyear_achv_total: newmidyear_achv_total,
                },
                // beforeSend: function(){
                //     row.find('.save-btn').html('<i class="fas fa-spinner fa-spin"></i>');
                // },
                complete: function(){
                    row.find('.save-btn').hide();
                },
                success: function (response) {
                        var result = response;
                        if (result.sukses) {
                            console.log('Data berhasil disimpan.');
                            // alert('Data berhasil disimpan.');

                            row.find('.save-btn').hide();

                            // Mengembalikan kolom ke tampilan normal
                            row.find('.midyear_achv').text(newmidyear_achv);
                            row.find('.midyear_achv_score').text(newmidyear_achv_score);
                            row.find('.midyear_achv_total').text(newmidyear_achv_total);

                            // Mengembalikan input ke tampilan <span>
                            row.find('.edit-btn').show();
                            row.find('.program-input').hide();
                            row.find('.weight-input').hide();
                            row.find('.midyear-input').hide();
                            row.find('.midyear_achv-input').hide();
                            row.find('.midyear_achv_score-input').hide();
                        } else {
                            alert('Gagal menyimpan data: ' + result.message);
                        }
                },
                // error: function () {
                //     alert('Terjadi kesalahan saat mengirim data ke server.');
                // }
            });
        });

        $('.cancelApproval').click(function (event) {
            var keterangan = $(this).data('keterangan');
            var confirmed = confirm('Are you sure you want to cancel approval ' + keterangan + '?');

            if (confirmed) {
                var id = $(this).data('id');
                var kode_jabatan = $(this).data('kode_jabatan');

                $.ajax({
                    url: "<?= base_url("DaftarMid/cancelapproval") ?>",
                    type: "POST",
                    data: {id: id, keterangan: keterangan, kode_jabatan: kode_jabatan},
                    success: function (response) {
                        var msg = response;
                        if (msg.sukses) {
                            location.reload();
                        }
                    }
                });
            }
        });

        // Fungsi untuk menghitung total total score
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

        // Fungsi untuk menambahkan event handler ke input baru
        function setupScoreInputHandlers() {
            $('.score-input').on('input', function () {
                calculateTotalScore();
            });
        }

        $(document).on('change', '.midyear_achv_score-input', function () {
            var row = $(this).closest('tr');
            calculateTotalScore(row);
        });

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

            if (totalWeightInput != 100.00) {
                // Set the flag to indicate unsaved changes
                isDataSaved = false;
                alert('Total Weight must be 100%, currently total is ' + totalWeightInput + '%. Please check again.');
            } else {
                // Set the flag to indicate data is saved
                isDataSaved = true;
            }

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