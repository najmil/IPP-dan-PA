<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-muted text-black text-center">
                    Period Settings
                </div>

                <div class="card-body">
                    <!-- Form untuk mengatur periode IPP dengan "Start Date" dan "End Date" -->
                    <form action="<?= base_url('periode/savePeriodeIpp'); ?>" method="post">
                        <label for="start_date">Start Date:</label>
                        <input type="datetime-local" name="start_date">
                        <br>
                        <label for="end_date">End Date:</label>
                        <input type="datetime-local" name="end_date">
                        <br>
                        <button type="submit">Update IPP Period</button>
                    </form>

                    <!-- Tabel untuk menampilkan data periode IPP -->
                    <table>
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($periode as $p): ?>
                                <tr>
                                    <td><?= $p['start_date']; ?></td>
                                    <td><?= $p['end_date']; ?></td>
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
