<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="overflow-x: auto;">
                <div class="card-header bg-muted text-black text-center">
                    Individual Performance Plan
                </div>

                <div class="card-body">
                    <!-- Buttom tambah data ipp lampau -->
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#datalama">
                        + Tambah Data IPP Lama
                    </button>

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
                                    <div class="mb-3 row">
                                        <label for="periodeInput" class="col-sm-6">Periode IPP</label>
                                        <div class="col-sm-4">
                                            <!-- <input type="date" class="date-year" id="date-year" name="date-year"> -->
                                            <select id="year" name="year">
                                                <?php
                                                // $currentYear = date("Y");
                                                for ($year = 2023; $year >= 1900; $year--) {
                                                    echo "<option value='$year'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <label for="file" class="ippFileLabel col-sm-6" id="ippFileLabel">File IPP</label>
                                        <div class="col-sm-4">
                                            <input type="file" id="ippFile" name="ippFile" accept=".pdf">
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
                </div>

                <table class="table mt-3" id="isidetail">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan=2>No.</th>
                            <th class="text-center" rowspan=2>Periode</th>
                            <th class="text-center" rowspan=2>Tanggal Dibuat</th>
                            <th class="text-center" rowspan=2>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($ipp as $p): ?>
                        <tr>
                            <th class="text-center" scope="row"><?= $i++; ?></th>
                            <td class="text-center"> <?= $p['periode']; ?> </td>
                            <td class="text-center"> <?= $p['created_at']; ?> </td>
                            <td class="text-center">
                                <input type="hidden" class="form-control input-sm text-center" id="nama" name="nama[]">
                                <a href='<?= htmlspecialchars(base_url('ipp/viewPdf/' . $p['id'])); ?>' target="_blank">
                                    <i class="fas fa-file-pdf ml-2 mr-2" style="color: red; font-size: 20px;"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function(){
        // $('#isidetail').DataTable();

        $("#simpanLama").click(function() {
            var periode = $("#year").val();
            console.log(periode);
            var file = $("#ippFile")[0].files[0];

            var formData = new FormData();
            formData.append('periode', periode);
            formData.append('file', file);

            $.ajax({
                url: '<?= base_url('ipp/datalama'); ?>',
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false,
                success: function(response) {
                    // Tindakan yang akan diambil ketika permintaan berhasil
                    console.log(response); // Anda dapat menampilkan pesan sukses atau melakukan tindakan lainnya di sini
                    location.reload();
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
</script>
<?= $this->endSection('script'); ?>