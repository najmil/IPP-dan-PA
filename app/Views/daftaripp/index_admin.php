<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-muted text-black text-center">
                    Daftar Individual Performance Plan Karyawan
                </div>
                <div class="card-body" style="overflow-x: auto;">
                <!-- <div class="row text-center" style="width: 100%;"> -->
                    <div class="col-sm-12 text-center mb-3" style="width: 100%; height: 150px; margin-top: 100px;">
                        <a href="#" class="btn-primary btn-sm mr-3" style="width: 50%; height: 100%; font-size: 35px; padding: 50px 73px;">Administration</a>
                        <a href="#" class="btn-success btn-sm ml-3" style="width: 50%; height: 100%; font-size: 35px; padding: 50px 100px;">Engineering</a>
                    </div>
                    <!-- </div> -->
                    <!-- <div class="row" style="width: 100%; height: 150px;"> -->
                        <div class="col-sm-12 text-center mb-3" style="width: 100%; height: 150px; margin-top: 50px;">
                            <a href="#" class="btn-primary btn-sm mr-3" style="width: 50%; height: 100%; font-size: 35px; padding: 50px;">Fin, Acc, Mark, Mis</a>
                            <a href="#" class="btn-success btn-sm ml-3" style="width: 50%; height: 100%; font-size: 35px; padding: 50px 150px;">Plant</a>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="row" style="width: 100%; height: 150px;"> -->
                    <div class="col-sm-12 text-center mb-3" style="width: 100%; height: 150px; margin-top: 50px;">
                        <a href="#" class="btn-warning btn-sm" style="width: 100px; height: 100%; font-size: 35px; padding: 50px;">Plant Service</a>
                    </div>
                    <!-- </div> -->
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
            "bInfo": false
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
                    row.find('.approve-button').html('<i class="fas fa-spinner fa-spin" style="color: green;"></i>');
                },
                complete: function(){
                    row.find('.approve-button').html('<span class="badge btn-sm"> Approved </span>');
                },
                success: function(response) {
                    // approvalStatus.show(); 
                    // row.hide();
                    location.reload();
                }
            });
        });

        function approveRow(button) {
            var form = document.getElementById('detail-form');
            form.submit();
        }

        $(document).on('click', '.unsubmitted', function() {
            var id = $(this).data('id');
            console.log(id);

            $.ajax({
                url: "<?= base_url("daftaripp/unsubmit") ?>",
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
        var $created_by = $('#created_by').val();
        var $nama = $('#nama').val();

        $.ajax({
            url: "<?php echo site_url("ipp/save") ?>",
            type: "POST",
            data: {
                created_by: $created_by,
                nama: $nama
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
                }
            }
        });
        bersihkan();
    }) ;

    function hapus($id){
        var result = confirm('Apakah anda yakin untuk menghapus data ini?');
        if (result){
            window.location="<?php echo site_url("ipp/hapus") ?>/"+ $id;
        }
    }
</script>
<?= $this->endSection('script'); ?>
