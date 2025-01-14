<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3 text-center">Log Perubahan IPP</h3>

                    <!-- Tampilkan log perubahan dalam tabel -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Tanggal Perubahan</th>
                                <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Perubahan Oleh</th>
                                <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Jenis Perubahan</th>
                                <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Data Lama</th>
                                <th style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle;">Data Baru</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($logData)) : ?>
                            <?php foreach ($logData as $log) : ?>
                                <?php
                                $dataChanges = json_decode($log['data_changes'], true);

                                $oldData = [];
                                $newData = [];

                                if (isset($dataChanges['old_data'])) {
                                    $oldData = $dataChanges['old_data'];
                                }
                                if (isset($dataChanges['new_data'])) {
                                    $newData = $dataChanges['new_data'];
                                }
                                ?>

                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $log['created_at']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $log['by']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $log['action']; ?></td>
                                    <td>
                                        <?php if ($log['action'] === 'delete') : ?>
                                            <?php
                                            $dataChanges = json_decode($log['data_changes'], true);
                                            if (isset($dataChanges['deleted_data'])) {
                                                $deletedData = $dataChanges['deleted_data'];

                                                foreach ($deletedData as $key => $value) {
                                                    if ($key !== 'id' && $key !== 'id_main') {
                                                        if (!empty($value)) {
                                                            echo '<em>' . $key . ':</em> ' . $value . '<br>';
                                                        }
                                                    }
                                                }
                                            } else {
                                                echo 'No deleted data available.';
                                            }
                                            ?>
                                        <?php else : ?>
                                            <?php
                                            if (isset($dataChanges['old_data'])) {
                                                $oldData = $dataChanges['old_data'];

                                                foreach ($oldData as $key => $value) {
                                                    // Check if the key is not 'id' or 'id_main'
                                                    if ($key !== 'id' && $key !== 'id_main') {
                                                        echo '<em>' . $key . ':</em> ' . $value . '<br>';
                                                    }
                                                }
                                            } else {
                                                echo 'No old data available.';
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php foreach ($newData as $key => $value) : ?>
                                            <em><?= $key; ?>:</em> <?= $value; ?><br>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Tidak ada log perubahan yang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<!-- Tambahkan script JavaScript jika diperlukan -->
<?= $this->endSection('script'); ?>
