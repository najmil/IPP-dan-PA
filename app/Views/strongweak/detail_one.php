<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- Form untuk menampilkan data -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Sembunyikan input jika data sudah ada -->
                                <?php if (isset($strongweak['strong_mid'])):?>
                                    <label class="form-label" for="strong_mid">Strong Point</label>
                                    <textarea class="form-control" id="strong_input" style="margin: 0; width: 100%; height: 300px;" name="strong_mid" readonly><?= $strongweak['strong_mid']; ?></textarea>
                                <?php else: ?>
                                    <label class="form-label" for="strong_mid">Strong Point</label>
                                    <textarea name="strong_mid" id="strong_mid_input" cols="30" rows="10" class="form-control <?= isset($errors['strong_mid']) ? 'is-invalid' : ''; ?>" autofocus></textarea>
                                    <!-- Tampilkan validation error jika ada -->
                                    <?php // if (isset($errors['strong_mid'])): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('strong_mid'); ?></div>
                                    <?php // endif; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Add similar code for 'weak_mid' and 'note_mid' fields -->

                            <div class="col-md-6">
                                <label class="form-label" for="weak_mid">Weak Point</label>
                                <!-- Sembunyikan input jika data sudah ada -->
                                <?php if (isset($strongweak['weak_mid'])): ?>
                                    <textarea class="form-control" id="weak_input" style="margin: 0; width: 100%; height: 300px;" name="weak_mid" readonly><?= $strongweak['weak_mid']; ?></textarea>
                                <?php else: ?>
                                    <textarea name="weak_mid" id="weak_mid_input" cols="30" rows="10" class="form-control <?= isset($errors['weak_mid']) ? 'is-invalid' : ''; ?>" autofocus></textarea>
                                    <!-- Tampilkan validation error jika ada -->
                                    <?php // if (isset($errors['weak_mid'])): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('weak_mid'); ?></div>
                                    <?php // endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="note_mid">Notes</label>
                            <?php if (isset($strongweak['note_mid'])): ?>
                                <textarea class="form-control" id="note_input" style="margin: 0; width: 100%; height: 300px;" name="note_mid" readonly><?= $strongweak['note_mid']; ?></textarea>
                            <?php else: ?>
                                <textarea name="note_mid" id="note_mid_input" cols="30" rows="10" class="form-control <?= isset($errors['note_mid']) ? 'is-invalid' : ''; ?>"></textarea>
                                <!-- Tampilkan validation error jika ada -->
                                <?php // if (isset($errors['note_mid'])): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('note_mid'); ?></div>
                                <?php // endif; ?>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="id_strongweak_main" name="id_strongweak_main" value="<?= $id_strongweak_main; ?>">
                        <div class="mt-3" id="submitBtnContainer">
                            <a href="<?= base_url('strongweak/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Kembali</a>
                            <?php
                                $periodeModel = new \App\Models\PeriodeModel();
                                $periodeOne = $periodeModel->getLatestOnePeriode();
                                // dd($periodeOne);

                                $currentDate = date('Y-m-d H:i:s');
                                if ($periodeOne !== null) {
                                    $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                                } else {
                                    $isWithinOnePeriode = false;
                                }

                                // dd($is_submitted);
                                if ($isWithinOnePeriode && !$is_submitted) {
                                    if (empty($strongweak)){
                                        echo '<button type="button" id="save" class="btn btn-success btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Save
                                        </button>';
                                    } else {
                                        echo '
                                        <button type="button" id="submitBtn" class="btn btn-danger btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Submit
                                        </button>
                                        <button type="button" id="edit" class="btn btn-warning btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Edit All
                                        </button>
                                        <button type="button" id="save-edit" class="btn btn-success btn-sm ml-2 mr-2" style="display: none; width: 100px; height: 30px;">
                                            Save
                                        </button>';
                                    }
                                }
                            ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
    // Your JavaScript code here
    $(document).ready(function() {

        $('#edit').on('click', function () {

            $('#strong_input').val;
            $('#strong_input').prop('readonly', false);

            $('#weak_input').val;
            $('#weak_input').prop('readonly', false);

            $('#note_input').val;
            $('#note_input').prop('readonly', false);

            $(this).hide();
            $('#save-edit').show(); 
            $('#submitBtn').hide(); 
        });

        // Function untuk menyimpan data saat tombol "Save" diklik
        $('#save').on('click', function () {
            var id_strongweak_main  = $('#id_strongweak_main').val();
            var strong_mid          = $('#strong_mid_input').val();
            var weak_mid            = $('#weak_mid_input').val();
            var note_mid            = $('#note_mid_input').val();

            let isAlertShown = false;
            if (!strong_mid.trim() || !weak_mid.trim() || !note_mid.trim()) {
                if (!isAlertShown) {
                    alert('Fields must be filled.');
                    isAlertShown = true;
                }
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?= base_url('strongweak/save_data'); ?>',
                data: {
                    id_strongweak_main  : id_strongweak_main,
                    strong_mid          : strong_mid,
                    weak_mid            : weak_mid,
                    note_mid            : note_mid
                },
                success: function (response) {
                    location.reload();
                }
            });
        });

        // Function untuk menyimpan data saat tombol "Save-Edit" diklik
        $('#save-edit').on('click', function () {
            var id_strongweak_main  = $('#id_strongweak_main').val();
            var strong_mid          = $('#strong_input').val();
            var weak_mid            = $('#weak_input').val();
            var note_mid            = $('#note_input').val();

            let isAlertShown = false;
            if (!strong_mid.trim() || !weak_mid.trim() || !note_mid.trim()) {
                if (!isAlertShown) {
                    alert('Fields must be filled.');
                    isAlertShown = true;
                }
                return;
            }

            $.ajax({
                url: '<?= base_url('strongweak/update_data'); ?>',
                type: 'post',
                data: {
                    id_strongweak_main  : id_strongweak_main,
                    strong_mid          : strong_mid,
                    weak_mid            : weak_mid,
                    note_mid            : note_mid
                },
                success: function (response) {
                    location.reload();
                }
            });
        });

        // Function for the submit button
        $('#submitBtn').on('click', function() {
            var id_strongweak_main  = $('#id_strongweak_main').val();
            var strong_mid          = $('#strong_input').val();
            var weak_mid            = $('#weak_input').val();
            var note_mid            = $('#note_input').val();

            $.ajax({
                url: '<?= base_url('strongweak/submit_data'); ?>',
                type: 'post',
                data: {
                    id_strongweak_main  : id_strongweak_main,
                    strong_mid          : strong_mid,
                    weak_mid            : weak_mid,
                    note_mid            : note_mid
                },
                success: function (response) {
                    console.log('data submitted');
                    location.reload();
                }
            });
        });
    });
</script>
<?= $this->endSection('script'); ?>
