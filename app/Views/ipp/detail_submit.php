<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="card" style="max-width: 100%; overflow-y: auto;">
                <div class="card-body">

                    <h3 class="mb-3 text-center">INDIVIDUAL PERFORMANCE PLANNING</h3>
                    
                    <div class="showdata">

                        <table class="table table-sm table-bordered table-hover" id="isidetail" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">No.</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Program/Activity</th>
                                    <th rowspan="1" style="border-bottom: hidden; text-align: center; vertical-align: middle;">Weight (%)</th>
                                    <th rowspan="1" colspan="2" style="border-bottom: hidden; text-align: center; vertical-align: middle;">Target</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Due Date</th>
                                </tr>
                                <tr>
                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden">
                                        <div style="width: 100px; align-items: center;">
                                        <input type="text" class="form-control input-sm text-center" id="total_weight" disabled="" style="width: 100%; border: none; padding: 0;">
                                        </div>
                                    </th>
                                    <th style="border-bottom: 1px solid #dee2e6;">Mid Year</th>
                                    <th style="border-bottom: 1px solid #dee2e6;">One Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 0;
                                    foreach($ipp as $d):
                                        $nomor++;
                                ?>
                                <tr>
                                    <td><?= $nomor; ?></td>
                                    <td class="program" data-id="<?= $d['id']; ?>">
                                        <?= $d['program']; ?>
                                        <input type="hidden" class="form-control input-sm text-center edit-mode" id="id_main" name="id_main[]" value="<?= $id_main; ?>">
                                    </td>
                                    <td class="weight" data-id="<?= $d['id']; ?>"><?= $d['weight']; ?></td>
                                    <td class="midyear" data-id="<?= $d['id']; ?>"><?= $d['midyear']; ?></td>
                                    <td class="oneyear" data-id="<?= $d['id']; ?>"><?= $d['oneyear']; ?></td>
                                    <td class="duedate" data-id="<?= $d['id']; ?>"><?= $d['duedate']; ?></td>
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
    $('#isidetail').DataTable({
            lengthChange: false,
            lengthMenu: [[-1], ["All"]],
            pagingType: "simple",
            searching: false
    });
    var isDataSaved = false;

    function checkDataSaved() {
        if (!isDataSaved) {
            return "Data hasn't saved. Sure to leave this page?";
        }
    }

    function isidetail(id){
        $.ajax({
            url: "<?php echo site_url('/ipp/detail_submit'); ?>/"+id,
            dataType: "json",
            success: function(response){
                $('.showdata').html(response.data);
            }
        });
    }

    $(document).ready(function(){
        isidetail();
        // var idMain = row.find('id_main').text();
        // console.log(idMain);
        $('#isidetail tbody tr').each(function() {
            console.log($(this).text());
        });

        var row;

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
    });

</script>
<?= $this->endSection('script'); ?>