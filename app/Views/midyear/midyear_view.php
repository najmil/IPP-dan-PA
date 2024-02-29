<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <section class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    PERFORMANCE APPRAISAL (Mid Year Result Review)
                    <div class="card-tools"></div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <!-- Card IPP point 1 -->
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            
                            <form action="/ipp/midyear" id="simpanmidyear">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <!-- <th rowspan="2">No.</th> -->
                                            <th>Program/Activity</th>
                                            <th>Weight (%)</th>
                                            <th>Mid Year Target</th>
                                            <th>Mid Year Achievement</th>
                                            <th>Score</th>
                                            <th>Total Score</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="show_item">
                                        <tr>
                                            <td><?= $nomor; ?></td>
                                            <td class="program" data-id="<?= $d['id']; ?>"><?= $d['program']; ?></td>
                                            <td class="weight" data-id="<?= $d['id']; ?>"><?= $d['weight']; ?></td>
                                            <td class="midyear" data-id="<?= $d['id']; ?>"><?= $d['midyear']; ?></td>
                                            <td class="midyear_achv" data-id="<?= $d['id']; ?>"><?= $d['midyear_achv']; ?></td>
                                            <td class="midyear_achv_score" data-id="<?= $d['id']; ?>"><?= $d['midyear_achv_score']; ?></td>
                                            <td class="midyear_achv_total" data-id="<?= $d['id']; ?>"><?= $d['midyear_achv_total']; ?></td>
                                            <td> <!-- Tombol -->
                                                <button type="button" class="btn btn-primary btn-sm edit-btn">Edit</button>
                                                <button type="button" class="btn btn-success btn-sm save-btn" style="display: none;">Simpan</button>
                                                <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary btnsave">Simpan</button>
                            </form>
                        </div>
                    </div>
                    
                    
                    <!-- Card IPP point 2 -->
                    
                    
                </div>
                <!-- /.card-body -->
                
            </div>
            <!-- /.card -->
            
        </section>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function(e){

        // Form simpan pada policy management
        // $('#formsimpan').submit(function(e){
        //     e.preventDefault();
        //     $.ajax({
        //         type: 'post',
        //         url: $(this).attr('action'),
        //         data: $(this).serialize(),
        //         dataType: "json",
        //         beforeSend: function(){
        //             $('.btnsave').attr('disable', 'disabled');
        //         },
        //         complete: function(){
        //             $('.btnsave').removeAttr('disable');
        //             $('.btnsave').html('Simpan');
        //         },
        //         success: function(response){
        //             if(response.sukses){
        //                 window.location.href=("<?= site_url('ipp/isi'); ?>")
        //             };
        //         },
        //         error: function(xhr, ajaxOptions, thrownError){
        //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        //         }
        //     });
        //     return false;
        // });

    });
        
    // Remove list point 1
    $(document).on('click', '.remove_row', function(e){
        e.preventDefault();
        $(this).parents('tr').remove();
    });

    // // Menghitung total weight
    function Calc() {
        var weights = 0;
        $('input.weight').each(function() {
            var weight = parseFloat($(this).val()) || 0;
            weights += weight;
        });
        $('#total_weight').val(weights.toFixed(2));
    }
</script>


<?= $this->endSection('script'); ?>
