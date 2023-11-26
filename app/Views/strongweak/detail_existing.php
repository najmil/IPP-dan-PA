<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="mb-4">Strength and Weakness</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="mb-4 text-center">Strong Point</h4>

                                    <!-- Menampilkan Strong Point jika tersedia -->
                                    <?php if (!empty($strongweak[0]['strong_mid'])): ?>
                                        <p class="text-justify"><?= $strongweak[0]['strong_mid']; ?></p>
                                    <?php else: ?>
                                        <p class="text-justify">Tidak tersedia.</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="mb-4 text-center">Weak Point</h4>

                                    <!-- Menampilkan Weak Point jika tersedia -->
                                    <?php if (!empty($strongweak[0]['weak_mid'])): ?>
                                        <p class="text-justify"><?= $strongweak[0]['weak_mid']; ?></p>
                                    <?php else: ?>
                                        <p class="text-justify">Tidak tersedia.</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-4 text-center">Notes</h4>

                                    <!-- Menampilkan Notes jika tersedia -->
                                    <?php if (!empty($strongweak[0]['note_mid'])): ?>
                                        <p class="text-justify"><?= $strongweak[0]['note_mid']; ?></p>
                                    <?php else: ?>
                                        <p class="text-justify">Tidak tersedia.</p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>