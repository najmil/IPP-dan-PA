<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card" style="max-width: 100%; overflow-y: auto;">
                <div class="card-body">
                    <h3 class="text-center poppins-regular"style="margin-bottom: 35px;">INDIVIDUAL PERFORMANCE PLANNING</h3>
                    
                    <div class="showdata">

                        <?php
                            $periodeModel = new \App\Models\PeriodeModel();
                            $periodeIPP = $periodeModel->getLatestIPPeriode();
                            $periodeIPPNull = $periodeModel->getLatestIPPeriodeNull();
                            $periodeIPPMid = $periodeModel->getLatestMidPeriode();
                            $periodeIPPOne = $periodeModel->getLatestOnePeriode();
                            $isWithinIPPeriode = false;
                            $editIppMid = false;
                            $editIppOne = false;
                            // dd($periodeIPPMid);

                            $currentDate = date('Y-m-d H:i:s');
                            if ($periodeIPP !== null) {
                                $isWithinIPPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
                            } elseif ($periodeIPPMid !== null){
                                $editIppMid = ($currentDate >= $periodeIPPMid['start_period'] && $currentDate <= $periodeIPPMid['end_period']);
                            } elseif ($periodeIPPOne !== null){
                                $editIppOne = ($currentDate >= $periodeIPPOne['start_period'] && $currentDate <= $periodeIPPOne['end_period']);
                            };

                            $isRevisiInIndex = false;
                            $isRevisiOne = false;
                            $currentYear = date('Y');
                            $isNotRevisi = false;
                            foreach ($main as $m) {
                                if (strpos($m['periode'], 'Rev. Mid Year') === false) {
                                    $isRevisiInIndex = true;
                                } elseif (strpos($m['periode'], 'Rev. One Year') !== false){
                                    $isRevisiOne = true;
                                } elseif ($m['periode'] == $currentYear) {
                                    $isNotRevisi = true;
                                    $isRevisiInIndex = false;
                                }
                            }

                            // dd($cek_submit);
                            if ($isWithinIPPeriode && ($is_submitted_ipp_main == 0 || $is_submitted_ipp_main == null)) {
                                    echo '
                                    <div class="d-flex justify-content-md-end">
                                        <div class=mr-2 mb-2" style="clear: both">
                                            <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                                Save Temporarily
                                            </button>
                                        </div>
                                        <div class=mr-2 mb-2" style="clear: both">
                                            <button type="button" id="saveAllButton" class="btn btn-danger btn-sm">
                                                Submit
                                            </button>
                                        </div>
                                        <div class=mr-2 mb-2" style="clear: both">
                                            <button type="button" id="addRowButton" class="btn btn-primary btn-sm">
                                                + Add Row
                                            </button>
                                        </div>
                                    </div>
                                    ';
                            } elseif($editIppMid && ($is_submittedmid == 0) && $is_submitted_ipp_main && !$editIppOne && !$isWithinIPPeriode && ($isRevisiInIndex && strpos($periode, 'Rev. Mid Year') === false)){
                                echo'
                                <div class="d-flex justify-content-md-end">
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                            Save Temporarily
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" class="edit-btn-mid btn btn-primary btn-sm">
                                            Edit
                                        </button>
                                    </div>
                                </div>
                                ';
                            } elseif($editIppOne && ($is_submittedmid == 1) && ((empty($is_submitted_ipp_main) || $is_submitted_ipp_main === 0) || $is_submitted_ipp_mid_main == true) && !$editIppMid && !$isWithinIPPeriode && ($isRevisiInIndex && strpos($periode, 'Rev. Mid Year') !== false) && $is_submitted_ipp_mid_main == 1 && (empty($is_submitted_ipp_main) || $is_submitted_ipp_main === 0)){
                                echo'
                                <div class="d-flex justify-content-md-end">
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                            Save Temporarily
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" class="edit-btn-one btn btn-primary btn-sm">
                                            Edit
                                        </button>
                                    </div>
                                </div>
                                ';
                            } elseif ($editIppOne && ($is_submitted_ipp == 1) && !$editIppMid && !$isWithinIPPeriode && (($isRevisiInIndex == true) || ($isRevisiOne == false))) {
                                echo '
                                <div class="d-flex justify-content-md-end">
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                            Save Temporarily
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" class="edit-btn-one btn btn-primary btn-sm">
                                            Edit
                                        </button>
                                    </div>
                                </div>
                                ';
                            };
                            // dd($isRevisiInIndex == true);


                            if ($isRevisiInIndex && (empty($is_submitted_ipp_mid_main) || $is_submitted_ipp_mid_main === 0) && strpos($periode, 'Rev. Mid Year') !== false){
                                echo
                                '<div class="d-flex justify-content-md-end">
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                            Save Temporarily
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="saveAllButton" class="btn btn-danger btn-sm">
                                            Submit
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="addRowButton" class="btn btn-primary btn-sm">
                                            + Add Row
                                        </button>
                                    </div>
                                </div>
                                ';
                            } elseif($isRevisiInIndex && (empty($is_submitted_ipp_one_main) || $is_submitted_ipp_one_main === 0) && strpos($periode, 'Rev. One Year') !== false){
                                echo
                                '<div class="d-flex justify-content-md-end">
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                            Save Temporarily
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="saveAllButton" class="btn btn-danger btn-sm">
                                            Submit
                                        </button>
                                    </div>
                                    <div class=mr-2 mb-2" style="clear: both">
                                        <button type="button" id="addRowButton" class="btn btn-primary btn-sm">
                                            + Add Row
                                        </button>
                                    </div>
                                </div>
                                ';
                            };
                        ?>

                        <table class="table table-sm table-bordered mt-2" id="isidetail" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 5%;">No.</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 21%;">Program/Activity</th>
                                    <th rowspan="1" style="border-bottom: hidden; text-align: center; vertical-align: middle; width: 10%;">Weight (%)</th>
                                    <th rowspan="1" colspan="2" style="border-bottom: hidden; text-align: center; vertical-align: middle;">Target</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Due Date</th>
                                    <?php
                                        $periodeModel = new \App\Models\PeriodeModel();
                                        $periodeIPP = $periodeModel->getLatestIPPeriode();
                                        // dd($periodeIPP);

                                        $currentDate = date('Y-m-d H:i:s');
                                        if ($periodeIPP !== null) {
                                            $isWithinIPPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
                                        } else {
                                            $isWithinIPPeriode = false;
                                        }

                                        if (($isWithinIPPeriode && !$is_submitted_ipp_main) ||
                                        ($editIppMid && (empty($is_submitted_ipp_mid_main) || $is_submitted_ipp_mid_main === 0) && strpos($periode, 'Rev. Mid Year') !== false) ||
                                        ($editIppOne && (empty($is_submitted_ipp_one_main) || $is_submitted_ipp_one_main === 0) && strpos($periode, 'Rev. One Year') !== false)) {
                                            echo '
                                                <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Aksi</th>
                                            ';
                                        };
                                    ?>
                                </tr>
                                <tr>
                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; width: 10%;">
                                        <div style="align-items: center;">
                                            <input type="text" class="form-control input-sm text-center" id="total_weight" disabled="" style="border: none; padding: 0;">
                                        </div>
                                    </th>
                                    <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 21%;">Mid Year</th>
                                    <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 21%;">One Year</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 0;
                                    foreach($ipp as $d):
                                        $nomor++;
                                ?>
                                
                                <tr class="thisTable editable" data-id="<?= $d['id']; ?>">
                                    <!-- <td class="handle" style="cursor: grab;">
                                        <i class="fas fa-grip-vertical"></i>
                                    </td> -->
                                    <td class="nomor text-center" <?= $is_submitted_ipp_main == true || $is_submitted_ipp_mid_main == true ||$is_submitted_ipp_one_main == true ? '' : 'style="cursor: grab;"' ?> ><?= $is_submitted_ipp_main == true || $is_submitted_ipp_mid_main == true ||$is_submitted_ipp_one_main == true ? '' : '<i class="fas fa-grip-vertical"></i>  ' ?><?= $nomor; ?></td>
                                    <td class="program" data-id="<?= $d['id']; ?>">
                                        <?= $d['program']; ?>
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="program" name="program[]" value="<?= $d['program']; ?>">
                                    </td>
                                    <td class="weight" data-id="<?= $d['id']; ?>">
                                        <?= $d['weight']; ?>
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="weight" name="weight[]" value="<?= $d['weight']; ?>">
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="id_main" name="id_main[]" value="<?= $id_main; ?>">
                                    </td>
                                    <td class="midyear" data-id="<?= $d['id']; ?>">
                                        <?= $d['midyear']; ?>
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="midyear" name="midyear[]" value="<?= $d['midyear']; ?>">
                                    </td>
                                    <td class="oneyear" data-id="<?= $d['id']; ?>"><?= $d['oneyear']; ?></td>
                                    <td class="duedate" data-id="<?= $d['id']; ?>">
                                        <?= $d['duedate']; ?>
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="duedate" name="duedate[]" value="<?= $d['duedate']; ?>">
                                    </td>
                                    <?php
                                        $periodeModel = new \App\Models\PeriodeModel();
                                        $periodeIPP = $periodeModel->getLatestIPPeriode();
                                        // dd($periodeIPP);

                                        $currentDate = date('Y-m-d H:i:s');
                                        if ($periodeIPP !== null) {
                                            $isWithinIPPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
                                        } else {
                                            $isWithinIPPeriode = false;
                                        }

                                        // dd($isWithinIPPeriode && empty($is_submitted_ipp_main));
                                        if (($isWithinIPPeriode && empty($is_submitted_ipp_main)) ||
                                        ($editIppMid && (empty($is_submitted_ipp_mid_main) || $is_submitted_ipp_mid_main === 0) && (strpos($periode, 'Rev. Mid Year') !== false)) ||
                                        ($editIppOne && (empty($is_submitted_ipp_one) || $is_submitted_ipp_one_main === 0) && (strpos($periode, 'Rev. One Year') !== false))) {
                                            echo '
                                                <td class="text-center"> <!-- Tombol -->
                                                    <button type="button" class="btn btn-warning btn-sm edit-btn" style="width: 40px; font-size: 12px; padding: 0;">Edit</button>
                                                    <button type="button" class="btn btn-success btn-sm save-btn" style="width: 50px; font-size: 12px; padding: 0; display: none;">Simpan</button>
                                                    <button type="button" class="btn btn-danger btn-sm btn-hapus" style="width: 40px; font-size: 12px; padding: 0;">Hapus</button>
                                                </td>
                                            ';
                                        }
                                    ?>
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
    var id = <?= $id_main ?>;
    var isDataSaved = false;
    var isSubmitted = false;

    function validateDate(input) {
        <?php if ($periodeIPP !== null) : ?>
            const minDate = '<?= substr($periodeIPP['start_period'], 0, 10); ?>';
            const selectedDate = input.value;

            if (selectedDate < minDate) {
                alert('Tidak dapat memilih tanggal sebelum periode dimulai.');
                input.value = minDate;
            }
        <?php elseif ($periodeIPP == null) : ?>
            const minDate = '<?= substr($periodeIPPNull['start_period'], 0, 10); ?>';
            const selectedDate = input.value;

            if (selectedDate < minDate) {
                alert('Tidak dapat memilih tanggal sebelum periode dimulai.');
                input.value = minDate;
            }
        <?php endif ?>
    }

    function checkDataSaved() {
        if (!isDataSaved) {
            return "Data hasn't saved. Sure to leave this page?";
        }
    }

    function isidetail(id){
        $.ajax({
            url: "<?php echo site_url('/ipp/detail'); ?>/"+id,
            dataType: "json",
            success: function(response){
                $('.showdata').html(response.data);
            }
        });
    }

    $(document).ready(function(){
        var validateSubmit = <?= ($is_submitted_ipp_main == true || $is_submitted_ipp_mid_main == true || $is_submitted_ipp_one_main == true) ? 'true' : 'false'; ?>;

        console.log('validateSubmit', validateSubmit);
        if(validateSubmit == false){
            var table = $('#isidetail').DataTable({
                rowReorder: {
                    selector: 'td.nomor',
                },
                columnDefs: [
                    { targets: [0], orderable: false }
                ],
                "searching": false,
                "lengthChange": false,
                paging: false,
                ordering: false
            });

            table.on('row-reorder', function (e, diff, edit) {
                var reorderedData = [];
                var id_main = <?= $id_main ?>;
                for (var i = 0; i < diff.length; i++) {
                    var row = diff[i].node; 
                    reorderedData.push({
                        id: $(row).find('.program').data('id'),
                        newPosition: diff[i].newPosition
                    });
                }

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('ipp/fungsi_simpan_urutan') ?>', 
                    data: { reorderedData: JSON.stringify(reorderedData), id_main: id_main },
                    success: function(response) {
                    }
                });
            });
        } 

        isidetail(id);

        function removeErrorIndication() {
            $(this).removeClass('is-invalid');
            $(this).closest('td').find('.invalid-feedback').remove();
        }

        // Tambahkan event listener pada input dan textarea untuk menghilangkan error saat ada inputan
        $('#isidetail').on('input', '.program-input, .weight-input, .midyear-input, .oneyear-input, .duedate-input', removeErrorIndication);

        // Temporarily save
        $(document).on('click', '#simpan', function () {
            var dataToSave = [];
            var isFormValid = true;

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $('#isidetail tbody tr').each(function () {
                var row = $(this).closest('tr');
                var idMain = row.find('input[name="id_main[]"]').val();
                var program = row.find('.program-input').val(); 
                var weight = row.find('.weight-input').val();
                var midyear = row.find('.midyear-input').val();
                var oneyear = row.find('.oneyear-input').val();
                var duedate = row.find('.duedate-input').val();

                var hasError = false;

                if (program === '') {
                    row.find('.program-input').addClass('is-invalid');
                    hasError = true;
                }
                if (weight === '') {
                    row.find('.weight-input').addClass('is-invalid');
                    hasError = true;
                }
                if (midyear === '') {
                    row.find('.midyear-input').addClass('is-invalid');
                    hasError = true;
                }
                if (oneyear === '') {
                    row.find('.oneyear-input').addClass('is-invalid');
                    hasError = true;
                }
                if (duedate === '') {
                    row.find('.duedate-input').addClass('is-invalid');
                    hasError = true;
                }

                if (hasError) {
                    isFormValid = false;
                    // Menambahkan pesan kesalahan di bawah input
                    row.find('td').each(function(){
                        if($(this).find('input, textarea').hasClass('is-invalid')){
                            $(this).append('<div class="invalid-feedback">Field cannot be empty.</div>');
                            $(this).find('.invalid-feedback').show();
                        }
                    });
                } else {
                    dataToSave.push({
                        idMain: idMain,
                        program: program,
                        weight: weight,
                        midyear: midyear,
                        oneyear: oneyear,
                        duedate: duedate
                    });
                }
            });

            if (!isFormValid) {
                alert('Semua field harus diisi.');
                return;
            }

            $.ajax({
                url: '<?= base_url('ipp/save_temporarily'); ?>', 
                type: 'POST',
                dataType: 'json',
                data: {
                    dataToSave: dataToSave
                },
                beforeSend: function(){
                    $('#simpan').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#simpan').hide();
                },
                success: function (response) {
                    if (response.sukses) {
                        // alert(response.message);
                        isDataSaved = true;
                        $('.saveAllButton').hide();
                        location.reload();
                    } else {
                        alert('Data cannot be saved. Double check it.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat mengirim data ke server.');
                }
            });
        });

        // Submit button
        $(document).on('click', '#saveAllButton', function () {
            var alerted = false;

            $('.thisTable').each(function () {
                var row = $(this);
                var id = row.find('.program').data('id');
                var idMain = row.find('input[name="id_main[]"]').val();

                var totalWeight = parseFloat($('#total_weight').val());
                if (isNaN(totalWeight) || totalWeight !== 100.00) {
                    if (!alerted) {
                        alert('Total Weight must be 100%. Currently, the total is ' + totalWeight + '%. Please check again.');
                        alerted = true; 
                    }
                    return false;
                }

                $.ajax({
                    url: '<?= base_url('ipp/insert_data') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        idMain: idMain
                    },
                    beforeSend: function(){
                        $('#saveAllButton').html('<i class="fas fa-spinner fa-spin"></i>');
                    },
                    complete: function(){
                        $('#saveAllButton').hide();
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.sukses) {
                            // alert(response.message);
                            location.reload();
                        } 
                    }
                });
            });
        });

        // Fungsi yang dijalankan saat tombol "Edit" pada halaman detail diklik
        $('.edit-btn').click(function () {
            var row = $(this).closest('tr');
            // console.log('Edit button clicked');
            var dueDateText = row.find('.duedate').text().trim();
            console.log('Due Date Text:', dueDateText); 

            row.find('.program').html('<textarea class="form-control program-input" data-id-main="<?= $id_main; ?>">' + row.find('.program').text().trim() + '</textarea>');
            row.find('.weight').html('<input type="number" class="form-control weight-input"data-id-main="<?= $id_main; ?>" value="' + row.find('.weight').text().trim() + '">');
            row.find('.midyear').html('<textarea class="form-control midyear-input" data-id-main="<?= $id_main; ?>">' + row.find('.midyear').text().trim() + '</textarea>');
            row.find('.oneyear').html('<textarea class="form-control oneyear-input" data-id-main="<?= $id_main; ?>">' + row.find('.oneyear').text().trim() + '</textarea>');
            row.find('.duedate').html('<input type="date" class="form-control duedate-input" data-id-main="<?= $id_main; ?>" value="' + dueDateText + '" oninput="validateDate(this)" min="<?= $periodeIPP !== null ? substr($periodeIPP['start_period'], 0, 10) : substr($periodeIPPNull['start_period'], 0, 10); ?> ">');

            // Menambahkan atribut data-id dengan ID yang sesuai
            row.find('.save-btn').data('id', row.find('.program').data('id'));
            row.find('.save-btn').data('id', row.find('.weight').data('id'));
            row.find('.save-btn').data('id', row.find('.midyear').data('id'));
            row.find('.save-btn').data('id', row.find('.oneyear').data('id'));
            row.find('.save-btn').data('id', row.find('.duedate').data('id'));

            row.find('.edit-btn').hide(); 
            row.find('.btn-hapus').hide(); 
            row.find('.save-btn').show();
            $('#addRowButton').hide();
            $('#saveAllButton').hide();
        });

        // Fungsi yang dijalankan saat ingin simpan baris yang diedit
        $(document).on('click', '.save-btn', function () {
            var row = $(this).closest('tr');
            var id = row.find('.program').data('id');
            var program = row.find('.program-input').val();
            var weight = row.find('.weight-input').val();
            var midyear = row.find('.midyear-input').val();
            var oneyear = row.find('.oneyear-input').val();
            var duedate = row.find('.duedate-input').val();
            var id_main = <?= $id_main; ?>;
            // console.log(id_main);

            $.ajax({
                url: '<?= base_url('ipp/saveDataEditIpp'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 
                    id: id,
                    id_main: id_main,
                    program: program,
                    weight: weight,
                    midyear: midyear,
                    oneyear: oneyear,
                    duedate: duedate
                },
                beforeSend: function(){
                    row.find('.save-btn').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    row.find('.save-btn').html('Simpan');
                },
                success: function (response) {
                    if (response.sukses) {
                        // alert(response.message);
                        isDataSaved = true;
                        row.find('.program').html(row.find('.program-input').val());
                        row.find('.weight').html(row.find('.weight-input').val());
                        row.find('.midyear').html(row.find('.midyear-input').val());
                        row.find('.oneyear').html(row.find('.oneyear-input').val());
                        row.find('.duedate').html(row.find('.duedate-input').val());
                        row.find('.edit-btn').show();
                        row.find('.btn-hapus').show(); 
                        row.find('.save-btn').hide(); 
                        $('#addRowButton').show();
                        $('#saveAllButton').show();
                    } else {
                        alert('Data cannot be saved because the total weight is not 100%. Please correct the weights.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat mengirim data ke server.');
                }
            });
        });

        $(document).on('click', '.edit-btn-revisi', function() {
            $('.thisTable').each(function () {
                var row = $(this);
                var id = row.find('.program').data('id');
                var idMain = row.find('input[name="id_main[]"]').val();

                $.ajax({
                    url: '<?= base_url('ipp/editRevisi') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        idMain: idMain
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.sukses) {
                            location.reload();
                        } 
                    }
                });
            });
        });

        $(document).on('click', '.edit-btn-one', function () {
            var id_main = <?= $id_main; ?>;
            var periode = '<?= $periode; ?>';

            $.ajax({
                url: '<?= base_url('ipp/newMainOne'); ?>',
                type: 'POST',
                data: {
                    id_main: id_main,
                    periode: periode
                },
                beforeSend: function(){
                    $('.edit-btn-one').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('.edit-btn-one').hide();
                },
                success: function(response){
                    console.log(id_main, response);
                    $('.editable').each(function () {
                        var row = $(this);
                        var id = row.find('.program').data('id');
                        var program = row.find('.program').text();
                        var weight = row.find('#weight').val();
                        var midyear = row.find('.midyear').text();
                        var oneyear = row.find('.oneyear').text();
                        // var duedate = row.find('.duedate').text();
                        var formattedDueDate = new Date(row.find('#duedate').val()).toLocaleDateString('en-US');

                        $.ajax({
                            url: '<?= base_url('ipp/saveEditIppMid'); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                id_main: response.id_main,
                                id: id,
                                program: program,
                                weight: weight,
                                midyear: midyear,
                                oneyear: oneyear,
                                duedate: formattedDueDate
                            },
                            beforeSend: function(){
                                $('.edit-btn-one').html('<i class="fas fa-spinner fa-spin"></i>');
                            },
                            complete: function(){
                                $('.edit-btn-one').hide();
                            },
                            success: function (response) {
                                if (response.sukses) {
                                    // alert(response.message);
                                    isDataSaved = true;
                                    // location.reload;
                                    let cekrevisi = 'Rev. One Year';
                                    if (periode.includes(cekrevisi)) {
                                        location.reload;
                                    } else {
                                        window.location = '<?= base_url('ipp/index'); ?>';
                                    }
                                    // $('#simpan-mid').hide();
                                    $('.edit-btn-mid').show();
                                    // $('#saveAllButton').show();
                                } 
                            }
                        });
                    });
                }
            });
        });

        // Fungsi yang dijalankan saat ingin simpan baris yang diedit saat periode midyear
        $(document).on('click', '.edit-btn-mid', function () {
            var id_main = <?= $id_main; ?>;
            var periode = '<?= $periode; ?>';

            $.ajax({
                url: '<?= base_url('ipp/newMain'); ?>',
                type: 'POST',
                data: {
                    id_main: id_main,
                    periode: periode
                },
                beforeSend: function(){
                    $('.edit-btn-mid').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('.edit-btn-mid').html('Edit');
                },
                success: function(response){
                    console.log(id_main, response);
                    $('.editable').each(function () {
                        var row = $(this);
                        var id = row.find('.program').data('id');
                        var program = row.find('.program').text();
                        var weight = row.find('#weight').val();
                        var midyear = row.find('.midyear').text();
                        var oneyear = row.find('.oneyear').text();
                        // var duedate = row.find('.duedate').text();
                        var formattedDueDate = new Date(row.find('#duedate').val()).toLocaleDateString('en-US');
                        console.log('formattedDueDate: ', formattedDueDate);
                        console.log(id);

                        $.ajax({
                            url: '<?= base_url('ipp/saveEditIppMid'); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                id_main: response.id_main,
                                id: id,
                                program: program,
                                weight: weight,
                                midyear: midyear,
                                oneyear: oneyear,
                                duedate: formattedDueDate
                            },
                            beforeSend: function(){
                                $('.edit-btn-mid').html('<i class="fas fa-spinner fa-spin"></i>');
                            },
                            complete: function(){
                                $('.edit-btn-mid').hide();
                            },
                            success: function (response) {
                                if (response.sukses) {
                                    // alert(response.message);
                                    isDataSaved = true;
                                    // location.reload;
                                    let cekrevisi = 'Rev. Mid Year';
                                    if (periode.includes(cekrevisi)) {
                                        location.reload;
                                    } else {
                                        window.location = '<?= base_url('ipp/index'); ?>';
                                    }
                                    $('#simpan-mid').hide();
                                    $('.edit-btn-mid').show();
                                    // $('#saveAllButton').show();
                                    // $('#simpan').show();
                                } 
                            }
                        });
                    });
                }
            });
        });

        // Fungsi untuk menghapus baris yang ada di halaman detail
        $(document).on('click', '.btn-hapus', function () {
            console.log('button diklik');
            var row = $(this).closest('tr');
            var id = row.find('.program').data('id');
            var id_main = row.find('input[name="id_main[]"]').val();
            
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: "<?= site_url('ipp/delete_data'); ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        id_main: id_main
                    },
                    success: function (response) {
                        var result = response;
                        if (result.sukses) {
                            row.remove();
                            calculateTotalScore();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error: " + status, error);
                    }
                });
            }
            calculateTotalScore();
        });

        // Fungsi untuk menamah data ipp baru
        function addRow() {
            var idMain = <?= $id_main; ?>;
            var nomorBaris = $('#isidetail tbody tr').length + 1;

            var newRow = '<tr>' +
                '<td>' + nomorBaris + '</td>' +
                '<td><textarea type="text" class="form-control program-input"></textarea><input type="hidden" class="form-control input-sm text-center edit-mode" id="id_main" name="id_main[]" value="' + idMain + '"></td>' +
                '<td><input type="number" class="form-control weight-input edit-mode"></td>' +
                '<td style="width: 400px;"><textarea type="text" class="form-control midyear-input edit-mode" style="width=100%"></textarea></td>' +
                '<td style="width: 400px;"><textarea type="text" class="form-control oneyear-input edit-mode"></textarea></td>' +
                '<td><input type="date" class="form-control duedate-input edit-mode" oninput="validateDate(this)" min="<?= $periodeIPP !== null ? substr($periodeIPP['start_period'], 0, 10) : substr($periodeIPPNull['start_period'], 0, 10); ?>"></td>' +
                '<td class="text-center">' +
                '<button type="button" class="btn btn-warning btn-sm edit-btn" style="idth: 40px; font-size: 10px; padding: 0; display: none;">Edit</button>'+
                '<button type="button" class="btn btn-danger btn-sm remove_row" style="width: 40px; font-size: 10px; padding: 0;">Hapus</button>' +
                '</td>' +
                '</tr>';
                
            $('#saveAllButton').hide();
            $('.save-btn').hide();
            $('#simpan').show();
            $('#isidetail tbody').append(newRow);
            calculateTotalScore();
            $('.edit-btn').hide();
        }

        $(document).on('click', '#addRowButton', function() {
            var idMain = <?= $id_main; ?>; 
            addRow(idMain);
            calculateTotalScore();
        });

        var row;

        $(document).on('click', '.remove_row', function(e){
            e.preventDefault();
            $(this).parents('tr').remove(); 
            calculateTotalScore();
        });

        // Fungsi untuk menghitung total weight
        function calculateTotalScore() {
            var totalScore = 0;

            $('.weight').each(function () {
                var score = parseFloat($(this).text());
                if (!isNaN(score)) {
                    totalScore += score;
                }
            });

            // Tambah nilai weight ke dalam total
            $('.weight-input').each(function () {
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
            $('.weight-input').on('input', function () {
                calculateTotalScore();
            });
        }

        $(document).on('input', '.weight-input', function () {
            console.log('Input event triggered for weight-input');
            var weightValue = $(this).val();
            console.log('Raw Weight Value:', weightValue);
            
            weightValue = parseFloat(weightValue);
            console.log('Parsed Weight Value:', weightValue);

            if (!isNaN(weightValue)) {
                calculateTotalScore();
            } else {
                console.log('Invalid weight value:', weightValue);
            }
        });

        calculateTotalScore();
        setupWeightInputHandlers();
        window.onbeforeunload = checkDataSaved;
    });

</script>
<?= $this->endSection('script'); ?>