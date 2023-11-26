<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header bg-muted text-black text-center">
                    One Year Result Review
                </div>

                <div class="card-body" style="overflow-x: auto;">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#datalama">
                            + Add History
                        </button>
                    </div>

                    <!-- Modal Form Tambah Data Mid Year LAMPAU -->
                    <div class="modal fade" id="datalama" tabindex="-1" aria-labelledby="datalamaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    Penambahan Data One Year Lampau
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label for="periodeInput" class="col-sm-6">Periode One Year</label>
                                        <div class="col-sm-4">
                                            <!-- <input type="date" class="date-year" id="date-year" name="date-year"> -->
                                            <select id="year" name="year">
                                                <?php
                                                // $currentYear = date("Y");
                                                for ($year = 2023; $year >= 1900; $year--) {
                                                    echo "<option value='One Year $year'>One Year $year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <label for="file" class="oneFileLabel col-sm-6" id="oneFileLabel">File One Year</label>
                                        <div style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; width: 230px;">
                                            <input type="file" id="oneFile" name="oneFile" accept=".pdf">
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
                                <th class="text-center" rowspan=2>No.</th>
                                <th class="text-center" rowspan=2>Periode</th>
                                <th class="text-center" rowspan=2>Tanggal Dibuat</th>
                                <th class="text-center" rowspan=2>Aksi</th>
                                <th class="text-center" rowspan=1 colspan=2>Status</th>
                            </tr>
                            <tr>
                                <?php if (session()->get('kode_jabatan') == 8 && !in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592])): ?>
                                    <th class="text-center">Kasie</th>
                                    <th class="text-center">Kadept</th>
                                <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592]))): ?>
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
                            <?php $i = 1;?>
                            <?php foreach($oneyear as $o): ?>
                                <?php
                                    $allowAccess = false;

                                    if (session()->get('kode_jabatan') == 8) {
                                        // Kode jabatan 8: Harus menunggu approval dari kasie dan kadept (kecuali npk=(960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592))
                                        if (!in_array(session()->get('npk'), [3651, 3659])) {
                                            $allowAccess = $o['approval_kasie_midyear'] && $o['approval_kadept_midyear'];
                                        } else {
                                            $allowAccess = $o['approval_kadept_midyear'] && $o['approval_kadiv_midyear'];
                                        }
                                    } elseif (session()->get('kode_jabatan') == 4) {
                                        $allowAccess = $o['approval_kadept_midyear'] && $o['approval_kadiv_midyear'];
                                    } elseif (session()->get('kode_jabatan') == 3) {
                                        $allowAccess = $o['approval_kadiv_midyear'] && $o['approval_bod_midyear'];
                                    } elseif (session()->get('kode_jabatan') == 2) {
                                        $allowAccess = $o['approval_bod_midyear'] && $o['approval_presdir_midyear'];
                                    } elseif (session()->get('kode_jabatan') <= 1) {
                                        $allowAccess = $o['approval_bod_midyear'] && $o['approval_presdir_midyear'];
                                    }
                                ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td> <?= $o['periode']; ?> </td>
                                <td> <?= $o['created_at']; ?> </td>
                                <td  class="text-center">
                                    <?php //if ($allowAccess): ?>
                                        <?php if (preg_match('/2023/', $o['periode'])): ?>
                                            <a href="<?= base_url('oneyear/detail/' . $o['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                                            <a href="<?= base_url('oneyear/logchanges/'.$o['id']) ?>" class="btn btn-secondary btn-sm">Log</a>
                                        <?php endif ?>
                                        <?php
                                            $allowAccessPdf = false;
                                            if (session()->get('kode_jabatan') == 8) {
                                                if (!in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592])) {
                                                    $allowAccessPdf = $o['approval_kasie_oneyear'] && $o['approval_kadept_oneyear'];
                                                } else {
                                                    $allowAccessPdf = $o['approval_kadept_oneyear'] && $o['approval_kadiv_oneyear'];
                                                }
                                            } elseif (session()->get('kode_jabatan') == 4) {
                                                $allowAccessPdf = $o['approval_kadept_oneyear'] && $o['approval_kadiv_oneyear'];
                                            } elseif (session()->get('kode_jabatan') == 3) {
                                                $allowAccessPdf = $o['approval_kadiv_oneyear'] && $o['approval_bod_oneyear'];
                                            } elseif (session()->get('kode_jabatan') == 2) {
                                                $allowAccessPdf = $o['approval_bod_oneyear'] && $o['approval_presdir_oneyear'];
                                            } elseif (session()->get('kode_jabatan') <= 1) {
                                                $allowAccessPdf = $o['approval_bod_oneyear'] && $o['approval_presdir_oneyear'];
                                            }

                                            if ($allowAccessPdf == true) {
                                                if (intval($o['periode']) < 2023) {
                                                    echo '<a href="' . htmlspecialchars(base_url('oneyear/viewPdf/' . $o['id'])) . '" target="_blank">
                                                        <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                    </a>';
                                                } else {
                                                    echo'
                                                    <a href="' . base_url('oneyear/oneyearpdf/' . $o['id']) . '" target="_blank">
                                                        <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                    </a>';
                                                }
                                            }
                                        ?>
                                    <?php //else: ?>
                                        <!-- <button class="btn btn-secondary btn-sm" disabled>Detail</button> -->
                                    <?php //endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (session()->get('kode_jabatan') == 8 && !in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592])): ?>
                                        <span class="badge <?= $o['approval_kasie_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_kasie_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && in_array(session()->get('npk'), [960, 4277, 3651, 3659, 1814, 2070, 2322, 2364, 2592]))): ?>
                                        <span class="badge <?= $o['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                
                                    <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                        <span class="badge <?= $o['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $o['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php endif ?>
                                </td>
                                <td class="text-center">
                                    <?php if (session()->get('kode_jabatan') == 8): ?>
                                        <span class="badge <?= $o['approval_kadept_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_kadept_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 4): ?>
                                        <span class="badge <?= $o['approval_kadiv_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_kadiv_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>
                                
                                    <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                        <span class="badge <?= $o['approval_bod_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_bod_oneyear'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $o['approval_presdir_oneyear'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $o['approval_presdir_oneyear'] ? "Approved" : "Pending" ?>
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

        $("#simpanLama").click(function() {
            var periode = $("#year").val();
            console.log(periode);
            var file = $("#oneFile")[0].files[0];

            var formData = new FormData();
            formData.append('periode', periode);
            formData.append('file', file);

            $.ajax({
                url: '<?= base_url('ipp/datalama'); ?>',
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false,
                beforeSend: function(){
                    $('#simpanLama').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#simpanLama').hide();
                },
                success: function(response) {
                    console.log(response); 
                    location.reload();
                },
                error: function() {
                    console.log("Gagal mengirim data ke server");
                }
            });
        });
    });
    
</script>
<?= $this->endSection('script'); ?>