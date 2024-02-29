<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <!-- Button Tambah Periode Pengisian IPP -->
                        <div class="col-md-auto mt-3 mb-3">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ippModal">
                                Periode IPP
                            </button>
                        </div>
                        <!-- /Button Tambah Periode Pengisian IPP -->

                        <!-- Button Tambah Periode Pengisian Midyear -->
                        <div class="col-md-auto mt-3 mb-3">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#midyearModal">
                                Periode Midyear
                            </button>
                        </div>
                        <!-- /Button Tambah Periode Pengisian Midyear -->

                        <!-- Button Tambah Periode Pengisian Oneyear -->
                        <div class="col-md-auto mt-3 mb-3">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#oneyearModal">
                                Periode Oneyear
                            </button>
                        </div>
                        <!-- /Button Tambah Periode Pengisian Oneyear -->
                    </div>

                    <!-- Modal Form Tambah Periode Pengisian IPP -->
                    <div class="modal fade" id="ippModal" tabindex="-1" aria-labelledby="ippModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ippModalLabel">Edit Periode IPP</h5>
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
                                    <!-- Jika sukses masukkan data -->
                                    <div class="alert alert-success sukses" role="alert" style="display: none;"></div>
                                
                                    <div class="mb-3 row">
                                        <label for="start_period" class="col-sm-2">Start Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" id="start_period" name="start_period">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="end_period" class="col-sm-2">End Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" id="end_period" name="end_period"> 
                                        </div>
                                    </div>

                                </div>
                                <!-- /Modal Body -->
                                
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="tombolSimpan">Simpan</button>
                                    <button type="submit" class="btn btn-primary" id="tombolUpdate" style="display: none;" data-id="">Update</button>
                                </div>
                                <!-- /Modal Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Form Tambah Periode Pengisian IPP -->  

                    <!-- Modal Form Tambah Periode Pengisian Midyear -->
                    <div class="modal fade" id="midyearModal" tabindex="-1" aria-labelledby="midyearModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="midyearModalLabel">Edit Periode Midyear</h5>
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
                                    <!-- Jika sukses masukkan data -->
                                    <div class="alert alert-success sukses" role="alert" style="display: none;"></div>
                                
                                    <div class="mb-3 row">
                                        <label for="start_period_midyear" class="col-sm-2">Start Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" id="start_period_midyear" name="start_period_midyear">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="end_period" class="col-sm-2">End Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" id="end_period_midyear" name="end_period_midyear"> 
                                        </div>
                                    </div>

                                </div>
                                <!-- /Modal Body -->
                                
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="tombolSimpanMidyear">Simpan</button>
                                    <button type="submit" class="btn btn-primary" id="tombolUpdate" style="display: none;" data-id="">Update</button>
                                </div>
                                <!-- /Modal Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Form Tambah Periode Pengisian Midyear -->  

                    <!-- Modal Form Tambah Periode Pengisian Oneyear -->
                    <div class="modal fade" id="oneyearModal" tabindex="-1" aria-labelledby="oneyearModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="oneyearModalLabel">Edit Periode Oneyear</h5>
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
                                    <!-- Jika sukses masukkan data -->
                                    <div class="alert alert-success sukses" role="alert" style="display: none;"></div>
                                
                                    <div class="mb-3 row">
                                        <label for="start_period_oneyear" class="col-sm-2">Start Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" id="start_period_oneyear" name="start_period_oneyear">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="end_period" class="col-sm-2">End Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" class="form-control" id="end_period_oneyear" name="end_period_oneyear"> 
                                        </div>
                                    </div>

                                </div>
                                <!-- /Modal Body -->
                                
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary tombol-tutup" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" id="tombolSimpanOneyear">Simpan</button>
                                    <button type="submit" class="btn btn-primary" id="tombolUpdate" style="display: none;" data-id="">Update</button>
                                </div>
                                <!-- /Modal Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Form Tambah Periode Pengisian Oneyear -->  

                    <table class="table" id="isiTable">
                        <thead>
                            <tr>
                                <th>Dibuat Pada</th>
                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($periode as $p): ?>
                                <tr data-id="<?= $p['id']; ?>">
                                    <td><?= $p['created_at']; ?></td>
                                    <td><?= $p['name']; ?></td>
                                    <td><?= $p['start_period']; ?></td>
                                    <td><?= $p['end_period']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm edit-btn" data-id="<?= $p['id']; ?>" data-name="<?= $p['name']; ?>">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
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
        $('#isiTable').DataTable();
        
        $('.edit-btn').on('click', function() {
            var rowId = $(this).data('id');
            var name = $(this).data('name');
            var start_period_exist = $('#isiTable tbody tr[data-id="' + rowId + '"] td:nth-child(3)').text();
            var end_period_exist = $('#isiTable tbody tr[data-id="' + rowId + '"] td:nth-child(4)').text();
            console.log(rowId);
            console.log(end_period_exist);

            var currentYear = new Date().getFullYear();
            var modalType = '';

            if (name.includes('Periode Mid Year ' + currentYear)) {
                modalType = 'midyear';
            } else if (name.includes('Periode One Year ' + currentYear)) {
                modalType = 'oneyear';
            } else if (name.includes('Periode IPP ' + currentYear)) {
                modalType = 'ipp';
            }

            if (modalType === 'ipp') {
                $('#ippModal #ippModalLabel').text('Edit Periode IPP');
                $('#ippModal #start_period').val(start_period_exist);
                $('#ippModal #end_period').val(end_period_exist);
                $('#ippModal #tombolUpdate').data('id', rowId);

                $('#ippModal').modal('show');
                $('#tombolUpdate').show();
                $('#tombolSimpan').hide();
            } else if (modalType === 'midyear') {
                $('#midyearModal #midyearModalLabel').text('Edit Periode Mid Year');
                $('#midyearModal #start_period_midyear').val(start_period_exist);
                $('#midyearModal #end_period_midyear').val(end_period_exist);
                $('#midyearModal #tombolUpdate').data('id', rowId);

                $('#midyearModal').modal('show');
                $('#midyearModal #tombolUpdate').show();
                $('#tombolSimpanMidyear').hide();
            } else if (modalType === 'oneyear') {
                $('#oneyearModal #oneyearModalLabel').text('Edit Periode One Year');
                $('#oneyearModal #start_period_oneyear').val(start_period_exist);
                $('#oneyearModal #end_period_oneyear').val(end_period_exist);
                $('#oneyearModal #tombolUpdate').data('id', rowId);

                $('#oneyearModal').modal('show');
                $('#oneyearModal #tombolUpdate').show();
                $('#tombolSimpanOneyear').hide();
            }
        });

        $('#tombolUpdate').on('click', function () {
            var rowId = $(this).data('id');
            var start_period = $('#start_period').val();
            var end_period = $('#end_period').val();

            console.log("Row ID: " + rowId);
            console.log("Start Period: " + start_period);
            console.log("End Period: " + end_period);

            $.ajax({
                url: "<?php echo site_url('periode/updatePeriodeIpp') ?>",
                type: "POST",
                data: {
                    id: rowId,
                    start_period: start_period,
                    end_period: end_period
                },
                beforeSend: function(){
                    $('#tombolUpdate').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#tombolUpdate').html('Update');
                },
                success: function (hasil) {
                    // var $obj = $.parseJSON(hasil);
                    // $('.gagal').hide();
                    // $('.sukses').show();
                    // $('.sukses').html($obj.sukses);
                    location.reload();
                }
            });
        });

        $('#midyearModal #tombolUpdate').on('click', function () {
            var rowId = $(this).data('id');
            var start_period = $('#start_period_midyear').val();
            var end_period = $('#end_period_midyear').val();

            console.log("Row ID: " + rowId);
            console.log("Start Period: " + start_period);
            console.log("End Period: " + end_period);

            $.ajax({
                url: "<?php echo site_url('periode/updatePeriodeIpp') ?>",
                type: "POST",
                data: {
                    id: rowId,
                    start_period: start_period,
                    end_period: end_period
                },
                beforeSend: function(){
                    $('#midyearModal #tombolUpdate').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#midyearModal #tombolUpdate').html('Update');
                },
                success: function (hasil) {
                    // var $obj = $.parseJSON(hasil);
                    // $('.gagal').hide();
                    // $('.sukses').show();
                    // $('.sukses').html($obj.sukses);
                    location.reload();
                }
            });
        });

        $('#oneyearModal #tombolUpdate').on('click', function () {
            var rowId = $(this).data('id');
            var start_period = $('#start_period_oneyear').val();
            var end_period = $('#end_period_oneyear').val();

            console.log("Row ID: " + rowId);
            console.log("Start Period: " + start_period);
            console.log("End Period: " + end_period);

            $.ajax({
                url: "<?php echo site_url('periode/updatePeriodeIpp') ?>",
                type: "POST",
                data: {
                    id: rowId,
                    start_period: start_period,
                    end_period: end_period
                },
                beforeSend: function(){
                    $('#oneyearModal #tombolUpdate').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#oneyearModal #tombolUpdate').html('Update');
                },
                success: function (hasil) {
                    // var $obj = $.parseJSON(hasil);
                    // $('.gagal').hide();
                    // $('.sukses').show();
                    // $('.sukses').html($obj.sukses);
                    location.reload();
                }
            });
        });
    });

    function bersihkan(){
            $('#start_period').val('');
            $('#end_period').val('');
    }

    $('.tombol-tutup').on('click', function(){
        if($('.sukses').is(":visible")){
            window.location.href = "<?= current_url()."?".$_SERVER['QUERY_STRING']; ?>";
        }
        $('.alert').hide();
    });

    $('#tombolSimpan').on('click', function () {
        var currentYear = new Date().getFullYear();
        var name        = 'Periode IPP ' + currentYear;

        var start_period   = $('#start_period').val();
        var end_period     = $('#end_period').val();

        $.ajax({
            url: "<?php echo site_url('periode/savePeriodeIpp') ?>",
            type: "POST",
            data: {
                name: name,
                start_period: start_period,
                end_period: end_period
            },
            beforeSend: function(){
                $('#tombolSimpan').html('<i class="fas fa-spinner fa-spin"></i>');
            },
            complete: function(){
                $('#tombolSimpan').html('Simpan');
            },
            success: function (hasil) {
                var $obj = $.parseJSON(hasil);
                $('.gagal').hide();
                $('.sukses').show();
                $('.sukses').html($obj.sukses);
                location.reload();
            }
        });
    });

    $('#tombolSimpanMidyear').on('click', function () {
        var currentYear = new Date().getFullYear();
        var name        = 'Periode Mid Year ' + currentYear;

        var start_period = $('#start_period_midyear').val();
        var end_period   = $('#end_period_midyear').val();

        $.ajax({
            url: "<?php echo site_url('periode/savePeriodeIpp') ?>",
            type: "POST",
            data: {
                name: name,
                start_period: start_period,
                end_period: end_period
            },
            beforeSend: function(){
                $('#tombolSimpanMidyear').html('<i class="fas fa-spinner fa-spin"></i>');
            },
            complete: function(){
                $('#tombolSimpanMidyear').html('Simpan');
            },
            success: function (hasil) {
                var $obj = $.parseJSON(hasil);
                $('.gagal').hide();
                $('.sukses').show();
                $('.sukses').html($obj.sukses);
                location.reload();
            }
        });
        bersihkan();
    });

    $('#tombolSimpanOneyear').on('click', function () {
        var currentYear = new Date().getFullYear();
        var name        = 'Periode One Year ' + currentYear;

        var start_period = $('#start_period_oneyear').val();
        var end_period   = $('#end_period_oneyear').val();

        $.ajax({
            url: "<?php echo site_url('periode/savePeriodeIpp') ?>",
            type: "POST",
            data: {
                name: name,
                start_period: start_period,
                end_period: end_period
            },
                beforeSend: function(){
                    $('#tombolSimpanOneyear').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#tombolSimpanOneyear').html('Simpan');
                },
            success: function (hasil) {
                var $obj = $.parseJSON(hasil);
                $('.gagal').hide();
                $('.sukses').show();
                $('.sukses').html($obj.sukses);
                location.reload();
            }
        });
        bersihkan();
    });
</script>
<?= $this->endSection('script'); ?>