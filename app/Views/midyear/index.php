<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header bg-muted text-black text-center">
                    Mid Year Result Review
                </div>

                <div class="card-body" style="overflow-x: auto;">

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#datalama">
                            + Add History
                        </button>
                    </div>

                    <!-- Modal Form Tambah Data Mid Year LAMPAU -->
                    <div class="modal fade" id="datalama" tabindex="-1" aria-labelledby="datalamaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    Penambahan Data Mid Year Lampau
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
                                        <label for="periodeInput" class="col-sm-6">Periode Mid Year</label>
                                        <div class="col-sm-4">
                                            <!-- <input type="date" class="date-year" id="date-year" name="date-year"> -->
                                            <select id="year" name="year">
                                                <?php
                                                // $currentYear = date("Y");
                                                for ($year = 2023; $year >= 1900; $year--) {
                                                    echo "<option value='Mid Year $year'>Mid Year $year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <label for="file" class="midFileLabel col-sm-6" id="midFileLabel">File Mid Year</label>
                                        <div style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; width: 230px;">
                                            <input type="file" id="midFile" name="midFile" accept=".pdf">
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
                    <!-- /Modal Form Tambah Data Mid Year LAMPAU -->  
                
                    <!-- Table Data -->
                    <table class="table mt-3" id="isidetail">
                        <thead>
                            <tr>
                                <th rowspan=2>No.</th>
                                <th rowspan=2>Periode</th>
                                <th rowspan=2>Tanggal Dibuat</th>
                                <th rowspan=2>Aksi</th>
                                <th rowspan=1 colspan=2>Status</th>
                            </tr>
                            <tr>
                                <?php if (session()->get('kode_jabatan') == 8 && !in_array(session()->get('npk'), [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])): ?>
                                    <th>Kasie</th>
                                    <th>Kadept</th>
                                <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && in_array(session()->get('npk'), [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]))): ?>
                                    <th>Kadept</th>
                                    <th>Kadiv</th>
                                <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                    <th>Kadiv</th>
                                    <th>BoD</th>
                                <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                    <th>BoD</th>
                                    <th>Presdir</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($midyear as $m): ?>
                                <?php
                                    $allowAccess = false;

                                    if (session()->get('kode_jabatan') == 8) {
                                        // Kode jabatan 8: Harus menunggu approval dari kasie dan kadept (kecuali npk=(960, 4277, 3659, 1814, 2070, 2322, 2364, 2592))
                                        if (!in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592])) {
                                            $allowAccess = $m['approval_kasie'] && $m['approval_kadept'];
                                        } else {
                                            $allowAccess = $m['approval_kadept'] && $m['approval_kadiv'];
                                        }
                                    } elseif (session()->get('kode_jabatan') == 4) {
                                        $allowAccess = $m['approval_kadept'] && $m['approval_kadiv'];
                                    } elseif (session()->get('kode_jabatan') == 3) {
                                        $allowAccess = $m['approval_kadiv'] && $m['approval_bod'];
                                    } elseif (session()->get('kode_jabatan') == 2) {
                                        $allowAccess = $m['approval_bod'] && $m['approval_presdir'];
                                    } elseif (session()->get('kode_jabatan') <= 1) {
                                        $allowAccess = $m['approval_bod'] && $m['approval_presdir'];
                                    };
                                    // dd($midyear);
                                ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td> <?= $m['periode']; ?> </td>
                                    <td> <?= $m['created_at']; ?> </td>
                                    <td>
                                        <?php if ($allowAccess): ?>
                                            <?php if (intval($m['periode']) > 2023): ?>
                                                <a href="<?= base_url('MidYear/detail/' . $m['id']) ?>" class="btn btn-primary btn-sm" style="width: 55px;">Detail</a>
                                            <?php endif; ?>
                                            <?php
                                                $allowAccessPdf = false;
                                                if (session()->get('kode_jabatan') == 8) {
                                                    if (!in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592])) {
                                                        $allowAccessPdf = $m['approval_kasie_midyear'] && $m['approval_kadept_midyear'];
                                                    } else {
                                                        $allowAccessPdf = $m['approval_kadept_midyear'] && $m['approval_kadiv_midyear'];
                                                    }
                                                } elseif (session()->get('kode_jabatan') == 4) {
                                                    $allowAccessPdf = $m['approval_kadept_midyear'] && $m['approval_kadiv_midyear'];
                                                } elseif (session()->get('kode_jabatan') == 3) {
                                                    $allowAccessPdf = $m['approval_kadiv_midyear'] && $m['approval_bod_midyear'];
                                                } elseif (session()->get('kode_jabatan') == 2) {
                                                    $allowAccessPdf = $m['approval_bod_midyear'] && $m['approval_presdir_midyear'];
                                                } elseif (session()->get('kode_jabatan') <= 1) {
                                                    $allowAccessPdf = $m['approval_bod_midyear'] && $m['approval_presdir_midyear'];
                                                }

                                                if ($allowAccessPdf == true) {
                                                    if (intval($m['periode']) < 2023) {
                                                        echo '<a href="' . htmlspecialchars(base_url('MidYear/viewPdf/' . $m['id'])) . '" target="_blank">
                                                            <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                        </a>';
                                                    } else {
                                                        echo'
                                                        <a href="' . base_url('MidYear/midyearpdf/' . $m['id']) . '" target="_blank">
                                                            <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                        </a>';
                                                    }
                                                }
                                            ?>
                                            <?php// if (preg_match('/2023/', $m['periode'])): ?>
                                            <?php if (intval($m['periode']) > 2023): ?>
                                                <a href="<?= base_url('MidYear/logchanges/'.$m['id']) ?>" class="btn btn-secondary btn-sm" style="width: 55px;">Log</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <button class="btn btn-secondary btn-sm" style="width: 55px;" disabled>Detail</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (session()->get('kode_jabatan') == 8 && !in_array(session()->get('npk'), [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])): ?>
                                            <span class="badge <?= $m['approval_kasie_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_kasie_midyear'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && in_array(session()->get('npk'), [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]))): ?>
                                            <span class="badge <?= $m['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                            </span>
                                    
                                        <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                            <span class="badge <?= $m['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                            <span class="badge <?= $m['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php if (session()->get('kode_jabatan') == 8): ?>
                                            <span class="badge <?= $m['approval_kadept_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_kadept_midyear'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php elseif (session()->get('kode_jabatan') == 4): ?>
                                            <span class="badge <?= $m['approval_kadiv_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_kadiv_midyear'] ? "Approved" : "Pending" ?>
                                            </span>
                                    
                                        <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                            <span class="badge <?= $m['approval_bod_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_bod_midyear'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                            <span class="badge <?= $m['approval_presdir_midyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $m['approval_presdir_midyear'] ? "Approved" : "Pending" ?>
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
        $('#isidetail').DataTable({
            lengthChange: false,
            lengthMenu: [[-1], ["All"]],
            pagingType: "simple"
        });

        $('#simpanLama').click(function () {
            var periode = $('#year').val();
            var fileInput = $('#midFile')[0].files[0];

            if (!fileInput || periode === '') {
                alert('File must be filled.');
            } else {
                var formData = new FormData();
                formData.append('periode', periode);
                formData.append('file', fileInput);

                $.ajax({
                    url: '<?= base_url('/midyear/datalama') ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#simpanLama').html('<i class="fas fa-spinner fa-spin"></i>');
                    },
                    complete: function () {
                        $('#simpanLama').prop('disabled', false).html('Simpan');
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
                            location.reload();
                        }
                    }
                });
            }
        });
    });

</script>
<?= $this->endSection('script'); ?>