<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header bg-muted text-black text-center">
                    Performance Appraisal (Process Review & Summary Sheet)
                </div>

                <div class="card-body">

                    <!-- Button Tambah Data Process Summary -->
                    <div class="d-flex justify-content-end">
                        <?php
                            $periodeModel = new \App\Models\PeriodeModel();
                            $periodeMid = $periodeModel->getLatestMidPeriode();
                            $periodeOne = $periodeModel->getLatestOnePeriode();                            
                            // dd($periodeProcess Summary);

                            $currentDate = date('Y-m-d H:i:s');
                            $isWithinMidPeriode = ($periodeMid !== null && $currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
                            $isWithinOnePeriode = ($periodeOne !== null && $currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);

                            if ($isWithinMidPeriode || $isWithinOnePeriode) {
                                echo '
                                    <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        + Add New
                                    </button>
                                ';
                            }
                        ?>

                        <button type="button" class="btn btn-primary btn-sm mb-3 ml-3" data-bs-toggle="modal" data-bs-target="#datalama">
                            + Add History
                        </button>
                    </div>
                    <!-- /Button Tambah Data Process Summary -->

                    <!-- Modal Form Tambah Data Process Summary -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Penambahan Data Performance Appraisal</h5>
                                    <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!--/ Modal Header -->
                                
                                <!-- Modal Body -->
                                <div class="modal-body">
                                <?php if (!empty($error)): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $error ?>
                                    </div>
                                <?php endif; ?>
                                    <!-- Jika gagal masukkan data -->
                                    <div class="alert alert-danger gagal" role="alert" style="display: none;"></div>
                                    <!-- Jika suskes masukkan data -->
                                    <div class="alert alert-success sukses" role="alert" style="display: none;"></div>

                                    <input type="hidden" id="inputId">
                                
                                    <div class="mb-3 row">
                                        <label for="periodeInput" class="col-sm-5">Periode Performance Appraisal</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="periodeInput" name="periodeInput" value="<?= date('Y'); ?>" readonly>
                                            <!-- <select class="form-select" style="width: 100%;" id="periodeInput" name="periodeInput">
                                                <option value="<?php // date('Y'); ?>" selected>Periode Performance Appraisal <?php // date('Y'); ?></option>
                                            </select> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /Modal Body -->
                                
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                                </div>
                                <!-- /Modal Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Form Tambah Data Process Summary -->

                    <!-- Modal Form Tambah Data IPP LAMPAU -->
                    <div class="modal fade" id="datalama" tabindex="-1" aria-labelledby="datalamaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    Penambahan Process And Summary Lampau
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Jika gagal masukkan data -->
                                    <div class="alert alert-danger gagal" role="alert" style="display: none;"></div>
                                    <!-- Jika suskes masukkan data -->
                                    <div class="alert alert-success sukses" role="alert" style="display: none;"></div>
                                    <div class="mb-3 row">
                                        <label for="periodeInput" class="col-sm-6">Periode PS</label>
                                        <div class="col-sm-4">
                                            <select id="year" name="year">
                                                <?php
                                                for ($year = 2023; $year >= 1971; $year--) {
                                                    echo "<option value='$year'>Process and Summary $year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <label for="file" class="psFileLabel col-sm-6" id="psFileLabel">File  </label>
                                        <div class="col-sm-4">
                                            <div style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; width: 230px;">
                                                <input type="file" id="psFile" name="psFile" accept=".pdf">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary" id="simpanLama">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Form Tambah Data IPP LAMPAU -->  
                    
                    <!-- Table Data -->
                    <table class="table mt-3" id="isidetail">
                        <thead>
                            <tr>
                                <th rowspan=3 class="text-center">No.</th>
                                <th rowspan=3 class="text-center">Periode</th>
                                <th rowspan=3 class="text-center">Tanggal Dibuat</th>
                                <th rowspan=3 class="text-center">Aksi</th>
                                <th rowspan=1 colspan=4 class="text-center">Status</th>
                            </tr>
                            <tr>
                                <th colspan=2 class="text-center">Mid Year</th>
                                <th colspan=2 class="text-center">One Year</th>
                            </tr>
                            <tr>
                                <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3651, 3659]): ?>
                                    <th class="text-center">Kasie</th>
                                    <th class="text-center">Kadept</th>
                                <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3651, 3659])): ?>
                                    <th class="text-center">Kadept</th>
                                    <th class="text-center">Kadiv</th>
                                <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                    <th class="text-center">Kadiv</th>
                                    <th class="text-center">BoD</th>
                                <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                    <th class="text-center">BoD</th>
                                    <th class="text-center">Presdir</th>
                                <?php endif ?>
                            
                                <!-- ONE YEAR -->
                                <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3651, 3659]): ?>
                                    <th class="text-center">Kasie</th>
                                    <th class="text-center">Kadept</th>
                                <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3651, 3659])): ?>
                                    <th class="text-center">Kadept</th>
                                    <th class="text-center">Kadiv</th>
                                <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                    <th class="text-center">Kadiv</th>
                                    <th class="text-center">BoD</th>
                                <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                    <th class="text-center">BoD</th>
                                    <th class="text-center">Presdir</th>
                                <?php endif ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $i = 1; 
                            ?>
                            <?php foreach($procsum as $p): 
                                $allowAccess = false;
                                // $disableDetail = true;
                                $disableDetail = true;
                                $disableDetailOne = false;
                                
                                $currentDate = date('Y-m-d H:i:s');
                                $periodeModel = new \App\Models\PeriodeModel();
                                $periodeMid = $periodeModel->getLatestMidPeriode();
                                $periodeMidNull = $periodeModel->getLatestMidPeriodeNull();
                                $periodeOneNull = $periodeModel->getLatestOnePeriodeNull();
                                $periodeOne = $periodeModel->getLatestOnePeriode();
                                // dd($currentDate);
                                // dd($periodeMidNull);
                            ?>
                            <tr class="text-center">
                                <th scope="row"><?= $i++; ?></th>
                                <td> <?= $p['periode']; ?> </td>
                                <td> 
                                    <?= $p['created_at']; ?>
                                    <input type="hidden" class="form-control input-sm text-center" id="nama" name="nama[]">
                                </td>
                                <td style="display: flex; justify-content: center; align-items: center;">
                                    <?php
                                        if ($isWithinOnePeriode){
                                            // foreach ($approval as $a) {
                                            //     if (session()->get('kode_jabatan') == 8) {
                                            //         if (!in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592])) {
                                            //             $allowAccess = $a['approval_kasie_midyear'] && $a['approval_kadept_midyear'];
                                            //         } else {
                                            //             $allowAccess = $a['approval_kadept_midyear'] && $a['approval_kadiv_midyear'];
                                            //         }
                                            //     } elseif (session()->get('kode_jabatan') == 4) {
                                            //         $allowAccess = $a['approval_kadept_midyear'] && $a['approval_kadiv_midyear'];
                                            //     } elseif (session()->get('kode_jabatan') == 3) {
                                            //         $allowAccess = $a['approval_kadiv_midyear'] && $a['approval_bod_midyear'];
                                            //     } elseif (session()->get('kode_jabatan') == 2) {
                                            //         $allowAccess = $a['approval_bod_midyear'] && $a['approval_presdir_midyear'];
                                            //     } elseif (session()->get('kode_jabatan') <= 1) {
                                            //         $allowAccess = $a['approval_bod_midyear'] && $a['approval_presdir_midyear'];
                                            //     }
                                            // }
                                            $disableDetail == true;
                                        } elseif($isWithinMidPeriode){
                                            $disableDetail == true;
                                        } elseif (($periodeOne !== null && $currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']) || ($periodeMid !== null && $currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period'])) {
                                            $allowAccess = true;
                                            $disableDetail = true;
                                        } elseif ((isset($periodeOneNull) && ($currentDate >= $periodeOneNull['start_period'] || $currentDate >= $periodeOneNull['end_period'])) || (isset($periodeMidNull) && ($currentDate >= $periodeMidNull['start_period'] || $currentDate >= $periodeMidNull['end_period']))) {
                                            $disableDetail = true;
                                        } elseif (($periodeOne !== null && $currentDate <= $periodeOne['start_period'] || ($periodeMid !== null && $currentDate <= $periodeMid['start_period']))) {
                                            $disableDetail = false;
                                        } 
                                    ?>
                                    <?php if ($disableDetail == true): ?>
                                        <?php if (intval($p['periode']) >= 2023): ?>
                                            <a href="<?= base_url('procsum/detail/' . $p['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                                        <?php endif ?>
                                        <?php
                                            $allowAccessPdf = false;
                                            if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3659, 3651]) {
                                                $allowAccessPdf = ($p['approval_kasie_midyear'] && $p['approval_kadept_midyear']) || ($p['approval_kasie_oneyear'] && $p['approval_kadept_oneyear']);
                                            } elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3659, 3651])) {
                                                $allowAccessPdf = ($p['approval_kadept_midyear'] && $p['approval_kadiv_midyear']) || ($p['approval_kadept_oneyear'] && $p['approval_kadiv_oneyear']);
                                            } elseif (session()->get('kode_jabatan') == 3) {
                                                $allowAccessPdf = ($p['approval_kadiv_midyear'] && $p['approval_bod_midyear']) || ($p['approval_kadiv_oneyear'] && $p['approval_bod_oneyear']);
                                            } elseif (session()->get('kode_jabatan') == 2) {
                                                $allowAccessPdf = ($p['approval_bod_midyear'] && $p['approval_presdir_midyear']) || ($allowAccessPdf = $p['approval_bod_oneyear'] && $p['approval_presdir_oneyear']);
                                            }
                                            
                                            if ($allowAccessPdf == true) {
                                                if (intval($p['periode']) < 2023) {
                                                    echo '<a href="' . htmlspecialchars(base_url('procsum/viewPdf/' . $p['id'])) . '" target="_blank">
                                                        <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                    </a>';
                                                } else {
                                                    echo'
                                                    <a href="' . base_url('procsum/procsumpdf/' . $p['id']) . '" target="_blank">
                                                        <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                    </a>'; 
                                                }
                                            }
                                        ?>
                                        <?php if (intval($p['periode']) >= 2023): ?>
                                            <a href="<?= base_url('procsum/logchanges/'.$p['id']) ?>" class="btn btn-secondary btn-sm ml-2">Log</a>
                                        <?php endif ?>
                                    <?php else : ?>
                                            <button class="btn btn-secondary btn-sm" disabled>Detail</button>
                                    <?php endif; ?>
                                </td>

                                <!-- MID YEAR APPROVAL -->
                                <td>
                                    <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3659, 3651]): ?>
                                        <span class="badge <?= $p['approval_kasie_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kasie_midyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3659, 3651])): ?>
                                        <span class="badge <?= $p['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                
                                    <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                        <span class="badge <?= $p['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $p['approval_presdir_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_presdir_midyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3659, 3651]): ?>
                                        <span class="badge <?= $p['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                    <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3659, 3651])): ?>
                                        <span class="badge <?= $p['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                    <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                        <span class="badge <?= $p['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $p['approval_presdir_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_presdir_midyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php endif ?>
                                </td>

                                <!-- ONE YEAR APPROVAL -->
                                <td>
                                    <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3659, 3651]): ?>
                                        <span class="badge <?= $p['approval_kasie_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kasie_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3659, 3651])): ?>
                                        <span class="badge <?= $p['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                
                                    <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                        <span class="badge <?= $p['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != [3659, 3651]): ?>
                                        <span class="badge <?= $p['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                    <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == [3659, 3651])): ?>
                                        <span class="badge <?= $p['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                    <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                        <span class="badge <?= $p['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $p['approval_presdir_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_presdir_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php endif ?>
                                </td>

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

    
    $(document).ready(function(){
        $('#isidetail').DataTable();
    
        // Mendapatkan elemen input periode IPP
        var periodeInput = document.getElementById('periodeInput');

        // Mendapatkan tahun saat ini
        var tahunSaatIni = new Date().getFullYear();

        // Mengisi inputan periode dengan format "IPP tahun saat ini"
        periodeInput.value = tahunSaatIni;

        $("#simpanLama").click(function() {
            var periode = $("#year").val();
            console.log(periode);
            var file = $("#psFile")[0].files[0];

            var formData = new FormData();
            formData.append('periode', periode);
            formData.append('file', file);

            $.ajax({
                url: '<?= base_url('procsum/datalama'); ?>',
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false,
                beforeSend: function () {
                    $('#simpanLama').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function () {
                    $('#simpanLama').prop('disabled', false).html('Simpan');
                },
                success:  function(hasil){
                    var $obj = $.parseJSON(hasil);
                    if ($obj.sukses == false){
                        $('.sukses').hide();
                        $('.gagal').show();
                        $('.gagal').html($obj.gagal);
                    } else {
                        $('.gagal').hide();
                        $('.sukses').show();
                        $('.sukses').html($obj.sukses);
                        location.reload();
                    }
                },
                error: function() {
                    console.log("Gagal mengirim data ke server");
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

    $('#tombolSimpan').on('click', function () {
        var periodeInput = $('#periodeInput').val();
        console.log('AJAX request is being sent.');
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("procsum/save") ?>', 
            data: { periodeInput: periodeInput },
            dataType: 'json',
            success: function (response) {
                if (response.sukses) {
                    $('.sukses').text(response.sukses).show();
                    $('.gagal').hide();
                    $('#exampleModal').modal('hide');
                    location.reload();
                } else {
                    $('.sukses').hide();
                    $('.gagal').text(response.gagal).show();
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    });

    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');

        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: "<?= site_url('procsum/delete'); ?>",
                type: 'POST',
                data: {
                    id: id
                },
                success: function (response) {
                    try {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert('Data berhasil dihapus.');
                            // Reload the page to reflect the changes
                            window.location.reload();
                        } else {
                            alert('Gagal menghapus data: ' + result.message);
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan dalam respons dari server.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat mengirim data ke server.');
                }
            });
        }
    });
</script>
<?= $this->endSection('script'); ?>