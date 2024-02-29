<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="card" style="max-width: 100%; overflow-y: auto;">
                <div class="card-body">

                    <h3 class="mb-3 text-center">MID YEAR REVIEW RESULT</h3>
                    
                    <div class="showdata">

                        <a href="/pdf/kriteriapk.pdf" target="_blank">Kriteria PK (Lihat Di Sini)</a>

                        <table class="table table-sm table-striped table-hover" id="isidetail" style="width: 100%;">
                            <thead style="display: table-header-group; text-align: center;">
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">No.</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Program/Activity</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Weight (%)</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Mid Year Target</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Mid Year Achievement</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Score</th>
                                    <th rowspan="1" style=" border-bottom: hidden; text-align: center; vertical-align: middle;">Total Score</th>
                                    <!-- <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Aksi</th> -->
                                </tr>
                                <tr>
                                    <th style="border-bottom: 1px solid #dee2e6; border-top:hidden">
                                        <div style="width: 100px; align-items: center;">
                                        <input type="text" class="form-control input-sm text-center" id="total_score" disabled="" style="width: 100%; border: none; padding: 0;">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 0;
                                    foreach($midyear as $m):
                                        $nomor++;
                                ?>
                                <tr class="editable">
                                    <td><?= $nomor; ?></td>
                                    <td class="program">
                                        <?= $m['program']; ?>
                                    </td>
                                    <td class="weight" data-id="<?= $m['id']; ?>">
                                        <?= $m['weight']; ?>
                                    </td>
                                    <td class="midyear" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear']; ?>
                                    </td>
                                    <td class="midyear_achv" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear_achv']; ?>
                                    </td>
                                    <td class="midyear_achv_score" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear_achv_score']; ?>
                                    </td>
                                    <td class="midyear_achv_total" data-id="<?= $m['id']; ?>">
                                        <?= $m['midyear_achv_total']; ?>
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
</div>

<?= $this->endSection('content'); ?>


<?= $this->section('script'); ?>
<script>
    function isidetail(id){
        $.ajax({
            url: "<?php echo site_url('/midyear/detail'); ?>/" + id,
            dataType: "json",
            success: function(response){
                $('.showdata').html(response.data);
            }
        });
    }

    $(document).ready(function(){
        isidetail();
        isSubmitted = false;

        $('#isidetail').DataTable({
            lengthChange: false,
            lengthMenu: [[-1], ["All"]],
            pagingType: "simple"
        });

        // Event handler saat input kolom "Score" berubah
        $(document).on('change', '.midyear_achv_score-input', function () {
            var row = $(this).closest('tr');
            calculateTotalScore(row);
            $('.save-all-btn').show();
        });

        // Fungsi untuk menghitung total skor pada baris tertentu
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

            // Menyimpan total_score ke dalam tabel main
            // var idMain = $('#isidetail').data('id_main');
            // saveTotalScore(idMain, totalScore.toFixed(2));
        }


        // Hitung total skor saat dokumen pertama kali dimuat
        calculateTotalOverallScore();
    });


</script>
<?= $this->endSection('script'); ?>