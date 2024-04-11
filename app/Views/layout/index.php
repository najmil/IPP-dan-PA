<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col text-center">
            <div class="row d-flex align-items-center justify-content-center mt-5">
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <div style="height: 100px; width: 100%;">
                                <i class="fa fa-pen" style="font-size: 80px; opacity: 20%;"></i>
                            </div>
                        </div>
                        <a href="<?= base_url('ipp/index') ?>" class="small-box-footer">Individual Performance Planning <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <div style="height: 100px; width: 100%; opacity: 20%; margin-bottom: 0px;">
                                <i class="fa fa-file-alt" style="font-size: 60px;"></i><br>
                            </div>
                        </div>
                        <a href="<?= $accessible_pgm ? base_url('midyear/index') : '#' ?>" class="small-box-footer">Mid Year Review Result <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <div style="height: 100px; width: 100%; opacity: 20%; margin-bottom: 0px;">
                                <i class="fa fa-file-alt" style="font-size: 60px;"></i><br>
                            </div>
                        </div>
                        <a href="<?= $accessible_pgm ? base_url('oneyear/index') : '#' ?>" class="small-box-footer">One Year Review Result <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <div style="height: 100px; width: 100%; opacity: 20%; margin-bottom: 0px;">
                                <i class="fa fa-file-alt" style="font-size: 60px;"></i><br>
                            </div>
                        </div>
                        <a href="<?= $accessible_pgm ? base_url('strongweak/index') : '#' ?>" class="small-box-footer">Strength And Weakness <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <div style="height: 100px; width: 100%; opacity: 20%; margin-bottom: 0px;">
                                <i class="fa fa-file-alt" style="font-size: 60px;"></i><br>
                            </div>
                        </div>
                        <a href="<?= $accessible_pgm ? base_url('procsum/index') : '#' ?>" class="small-box-footer">Process And Summary <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
