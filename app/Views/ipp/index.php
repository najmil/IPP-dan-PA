<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card" style="overflow-x: auto;">
                <div class="card-header bg-muted text-black text-center">
                    Individual Performance Plan
                </div>

                <div class="card-body">

                    <!-- Button Tambah Data IPP -->
                    <div class="d-flex justify-content-end">
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

                            if ($isWithinIPPeriode) {
                                echo '<button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    + Add New
                                </button>';
                            }
                        ?>

                        <button type="button" class="btn btn-primary btn-sm mb-3 ml-3" data-bs-toggle="modal" data-bs-target="#datalama">
                            + Add History
                        </button>
                    </div>
                    <!-- /Button Tambah Data IPP -->

                    <!-- Modal Form Tambah Data IPP -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Penambahan Data IPP</h5>
                                    <button type="button" class="btn-close tombol-tutup" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal Header -->
                                
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
                                        <label for="periodeInput" class="col-sm-2">Periode IPP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="periodeInput" name="periodeInput" value="IPP <?= date('Y'); ?>" readonly>
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
                    <!-- /Modal Form Tambah Data IPP -->  

                    <!-- Modal Form Tambah Data IPP LAMPAU -->
                    <div class="modal fade" id="datalama" tabindex="-1" aria-labelledby="datalamaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    Penambahan Data IPP Lama
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
                                        <label for="periodeInput" class="col-sm-6">Periode IPP</label>
                                        <div class="col-sm-4">
                                            <select id="year" name="year">
                                                <?php
                                                for ($year = 2023; $year >= 1900; $year--) {
                                                    echo "<option value='$year'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <label for="file" class="ippFileLabel col-sm-6" id="ippFileLabel">File IPP</label>
                                        <div class="col-sm-4">
                                            <div style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; width: 230px;">
                                                <input type="file" id="ippFile" name="ippFile" accept=".pdf">
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
                                <th class="text-center" rowspan=2>No.</th>
                                <th class="text-center" rowspan=2>Periode</th>
                                <th class="text-center" rowspan=2>Tanggal Dibuat</th>
                                <th class="text-center" rowspan=2>Aksi</th>
                                <th class="text-center" rowspan=1 <?= session()->get('id_department') == 27 ? '' : 'colspan=2' ?>>Status</th>
                            </tr>
                            <tr>
                                
                                <?php if (session()->get('kode_jabatan') == 8 && session()->get('id_department') != 27): ?>
                                    <th class="text-center">Kasie</th>
                                    <th class="text-center">Kadept</th>
                                <?php elseif (session()->get('kode_jabatan') == 4 && session()->get('id_department') != 27): ?>
                                    <th class="text-center">Kadept</th>
                                    <th class="text-center">Kadiv</th>
                                <?php elseif (session()->get('kode_jabatan') == 3 && session()->get('id_department') != 27): ?>
                                    <th class="text-center">Kadiv</th>
                                    <th class="text-center">BoD</th>
                                <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                    <th class="text-center">BoD</th>
                                    <th class="text-center">Presdir</th>
                                <!-- ISD -->
                                <?php elseif (session()->get('kode_jabatan') == 4 && session()->get('id_department') == 27): ?>
                                    <th class="text-center">Kadept</th>
                                <?php elseif (session()->get('kode_jabatan') == 3 && session()->get('id_department') == 27): ?>
                                    <th class="text-center">BoD</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($ipp as $p): ?>
                            <tr>
                                <th class="text-center" scope="row"><?= $i++; ?></th>
                                <td class="text-center"><?= $p['periode']; ?> </td>
                                <td class="text-center"> <?= $p['created_at']; ?> </td>
                                <td class="text-center">
                                    <?php if (intval($p['periode']) > 2023): ?>
                                        <a href="<?= base_url('ipp/detail/'.$p['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                                    <?php endif; ?>
                                    <input type="hidden" class="form-control input-sm text-center" id="nama" name="nama[]">

                                    <?php
                                        $allowAccessPdf = false;
                                        if (session()->get('kode_jabatan') == 8 && session()->get('npk') != 4276) {
                                            if (!in_array(session()->get('npk'), [3659, 3651])) {
                                                $allowAccessPdf = $p['approval_kasie'] && $p['approval_kadept'];
                                            } else {
                                                $allowAccessPdf = $p['approval_kadept'] && $p['approval_kadiv'];
                                            }
                                        } elseif ((session()->get('kode_jabatan') == 4 && session()->get('id_department') != 27) || (session()->get('kode_jabatan') == 8 && in_array(session()->get('npk'), [3659, 3651]))) {
                                            $allowAccessPdf = $p['approval_kadept'] && $p['approval_kadiv'];
                                        } elseif (session()->get('kode_jabatan') == 3) {
                                            $allowAccessPdf = $p['approval_kadiv'] && $p['approval_bod'];
                                        } elseif (session()->get('kode_jabatan') == 2) {
                                            $allowAccessPdf = $p['approval_bod'] && $p['approval_presdir'];
                                        } elseif (session()->get('kode_jabatan') == 1) {
                                            $allowAccessPdf = $p['approval_bod'] && $p['approval_presdir'];
                                        } elseif (session()->get('kode_jabatan') == 4 && session()->get('id_department') == 27) {
                                            $allowAccessPdf = $p['approval_kadept'];
                                        } elseif (session()->get('kode_jabatan') == 3 && session()->get('id_department') == 27) {
                                            $allowAccessPdf = $p['approval_bod'];
                                        } // Larissa
                                        elseif ($p['kode_jabatan'] == 8 && $p['created_by'] == 4276) {
                                            $allowAccessPdf = $p['approval_kadept'];
                                        } 
                                        // ISD
                                        elseif ($p['kode_jabatan'] == 4 && $p['id_department'] == 27) {
                                            $allowAccessPdf = $p['approval_kadept'];
                                        } elseif ($p['kode_jabatan'] == 3 && $p['id_department'] == 27) {
                                            $allowAccessPdf = $p['approval_bod'];
                                        }

                                        if ($allowAccessPdf == true) {
                                            if (intval($p['periode']) < 2023) {
                                                echo '<a href="' . htmlspecialchars(base_url('ipp/viewPdf/' . $p['id'])) . '" target="_blank">
                                                    <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                </a>';
                                            } else {
                                                echo'
                                                <a href="' . base_url('ipp/generatePdf/' . $p['id']) . '" target="_blank">
                                                    <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                                </a>'; 
                                            }
                                        }
                                    ?>

                                    <?php if (intval($p['periode']) > 2023): ?>
                                        <a href="<?= base_url('ipp/viewLogChanges/'.$p['id']) ?>" class="btn btn-secondary btn-sm">Log</a>
                                    <?php endif; ?>
                                </td>
                                <?php if(session()->get('id_department') != 27): ?>
                                    <td class="text-center">
                                        <?php if (session()->get('kode_jabatan') == 8 && session()->get('npk') != 4276): ?>
                                            <span class="badge <?= $p['approval_kasie'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $p['approval_kasie'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php elseif (session()->get('kode_jabatan') == 4 || (session()->get('kode_jabatan') == 8 && session()->get('npk') == 4276)): ?>
                                            <span class="badge <?= $p['approval_kadept'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $p['approval_kadept'] ? "Approved" : "Pending" ?>
                                            </span>
                                    
                                        <?php elseif (session()->get('kode_jabatan') == 3): ?>
                                            <span class="badge <?= $p['approval_kadiv'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $p['approval_kadiv'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                            <span class="badge <?= $p['approval_bod'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                                <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                            </span>

                                        <?php endif ?>
                                    </td>
                                <?php endif ?>
                                <td class="text-center">
                                    <?php if (session()->get('kode_jabatan') == 8 && session()->get('id_department') != 27): ?>
                                        <span class="badge <?= $p['approval_kadept'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadept'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 4 && session()->get('id_department') != 27): ?>
                                        <span class="badge <?= $p['approval_kadiv'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_kadiv'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <!-- ISD -->
                                    <?php elseif (session()->get('kode_jabatan') == 4 && session()->get('id_department') == 27): ?>
                                        <span class="badge <?= $p['approval_kadept'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                        </span>
                                    <?php elseif (session()->get('kode_jabatan') == 3 && session()->get('id_department') == 27): ?>
                                        <span class="badge <?= $p['approval_bod'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                        </span>
                                
                                    <?php elseif (session()->get('kode_jabatan') == 3 && session()->get('id_department') != 27): ?>
                                        <span class="badge <?= $p['approval_bod'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_bod'] ? "Approved" : "Pending" ?>
                                        </span>

                                    <?php elseif (session()->get('kode_jabatan') == 2): ?>
                                        <span class="badge <?= $p['approval_presdir'] ? 'badge-primary' : 'badge-secondary' ?> btn-sm">
                                            <?= $p['approval_presdir'] ? "Approved" : "Pending" ?>
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
    
        // Mendapatkan elemen input periode IPP
        var periodeInput = document.getElementById('periodeInput');

        // Mendapatkan tahun saat ini
        var tahunSaatIni = new Date().getFullYear();

        // Mengisi inputan periode dengan format "IPP tahun saat ini"
        periodeInput.value = 'IPP ' + tahunSaatIni;

        $('#simpanLama').click(function () {
            var periode = $('#year').val();
            var fileInput = $('#ippFile')[0].files[0];

            if (!fileInput || periode === '') {
                alert('File must be filled.');
            } else {
                var formData = new FormData();
                formData.append('periode', periode);
                formData.append('ippFile', fileInput);

                $.ajax({
                    url: '<?= base_url('/ipp/datalama') ?>',
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
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat menyimpan data');
                    }
                });
            }
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

    $('#tombolSimpan').on('click', function(){
        // alert('telah diklik');
        var $npk_user = $('#npk_user').val();
        var $nama = $('#nama').val();

        $.ajax({
            url: "<?php echo site_url("ipp/save") ?>", 
            type: "POST",
            data: {
                npk_user: $npk_user,
                nama: $nama
            },
            beforeSend: function(){
                $('#tombolSimpan').html('<i class="fas fa-spinner fa-spin"></i>');
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
        bersihkan();
    }) ;
</script>
<?= $this->endSection('script'); ?>