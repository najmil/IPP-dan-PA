<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="card" style="max-width: 100%; overflow-y: auto;">
                <div class="card-header">
                    <h1 class="card-title">Detail IPPs</h1>
                </div>
                <div class="card-body">
                    <?php
                        $periodeModel = new \App\Models\PeriodeModel();
                        $periodeIPP = $periodeModel->getLatestIPPeriode();
                        $periodeIPPMid = $periodeModel->getLatestMidPeriode();
                        $periodeIPPOne = $periodeModel->getLatestOnePeriode();
                        $isWithinIPPeriode = false;
                        $editIppMid = false;
                        $editIppOne = false;
                        // dd($periodeIPP);

                        $currentDate = date('Y-m-d H:i:s');
                        if ($periodeIPP !== null) {
                            $isWithinIPPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
                        } elseif ($periodeIPPMid !== null){
                            $editIppMid = ($currentDate >= $periodeIPPMid['start_period'] && $currentDate <= $periodeIPPMid['end_period']);
                        } elseif ($periodeIPPOne !== null){
                            $editIppOne = ($currentDate >= $periodeIPPOne['start_period'] && $currentDate <= $periodeIPPOne['end_period']);
                        };

                        if (session()->get('npk') != 0 && $isWithinIPPeriode && !$is_approved_before && !$is_approved) {
                            echo '
                            <div class="d-flex justify-content-md-end">
                                <div class=mr-2 mb-2" style="clear: both">
                                    <button type="button" id="addRowButton" class="btn btn-primary btn-sm mb-3">
                                        + Add Row
                                    </button>
                                </div>
                                <div class=mr-2 mb-2" style="clear: both">
                                    <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                        Save Temporarily
                                    </button>
                                </div>
                            </div>
                            ';
                        } elseif (session()->get('npk') != 0 && $editIppMid && !$is_approved_before && !$is_approved) {
                            echo '
                            <div class="d-flex justify-content-md-end">
                                <div class=mr-2 mb-2" style="clear: both">
                                    <button type="button" id="addRowButton" class="btn btn-primary btn-sm mb-3">
                                        + Add Row
                                    </button>
                                </div>
                                <div class=mr-2 mb-2" style="clear: both">
                                    <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                        Save Temporarily
                                    </button>
                                </div>
                            </div>
                            ';
                        } elseif (session()->get('npk') != 0 && $editIppOne && !$is_approved_before && !$is_approved) {
                            echo '
                            <div class="d-flex justify-content-md-end">
                                <div class=mr-2 mb-2" style="clear: both">
                                    <button type="button" id="addRowButton" class="btn btn-primary btn-sm mb-3">
                                        + Add Row
                                    </button>
                                </div>
                                <div class=mr-2 mb-2" style="clear: both">
                                    <button type="button" id="simpan" class="btn btn-success btn-sm" style="display: none;">
                                        Save Temporarily
                                    </button>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                    <?php if (!empty($daftaripp)): ?>
                        <table class="table table-sm  table-bordered mt-2" id="isidetail" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 22%;">Program</th>
                                    <th rowspan="1"style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Weight (%)</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 22%;">Mid Year</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 22%;">One Year</th>
                                    <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Due Date</th>
                                    <?php
                                        $periodeModel = new \App\Models\PeriodeModel();
                                        $periodeIPP = $periodeModel->getLatestIPPeriode();
                                        // dd($periodeIPP);

                                        $currentDate = date('Y-m-d H:i:s');
                                        if ($periodeIPP !== null) {
                                            $isWithinIPPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
                                        } else {
                                            $isWithinIPPeriode = false;
                                        }

                                        if (session()->get('npk')!=0 && ($isWithinIPPeriode && !$is_approved && !$is_approved_before)||
                                        ($editIppMid && !$is_approved && !$is_approved_before) ||
                                        ($editIppOne && !$is_approved && !$is_approved_before)) {
                                            echo '
                                                <th rowspan="2" class="aksi" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; width: 10%;">Aksi</th>
                                            ';
                                        }
                                    ?>
                                </tr>
                                <tr>
                                    <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top: hidden;">
                                        <div style="width: 100px; align-items: center;">
                                            <input type="text" class="form-control input-sm text-center" id="total_weight" disabled="" style="width: 100%; border: none; padding: 0;">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($daftaripp as $ipp): ?>
                                    <tr data-id="<?= $ipp['id'] ?>">
                                        <td><span class="program" data-id="<?= $ipp['id'] ?>"><?= esc($ipp['program']) ?></span></td>
                                        <td class="text-center"><span class="weight" data-id="<?= $ipp['id'] ?>"><?= esc($ipp['weight']) ?></span></td>
                                        <td><span class="midyear" data-id="<?= $ipp['id'] ?>"><?= esc($ipp['midyear']) ?></span></td>
                                        <td><span class="oneyear" data-id="<?= $ipp['id'] ?>"><?= esc($ipp['oneyear']) ?></span></td>
                                        <td class="text-center">
                                            <span class="duedate" data-id="<?= $ipp['id'] ?>"><?= esc($ipp['duedate']) ?></span>
                                            <input type="hidden" class="form-control input-sm text-center edit-mode" id="id_main" name="id_main[]" value="<?= $id_main; ?>">
                                        </td>
                                        <?php
                                            $periodeModel = new \App\Models\PeriodeModel();
                                            $periodeIPP = $periodeModel->getLatestIPPeriode();
                                            // dd($periodeIPP);

                                            $currentDate = date('Y-m-d H:i:s');
                                            if ($periodeIPP !== null) {
                                                $isWithinIPPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
                                            } else {
                                                $isWithinIPPeriode = false;
                                            }

                                            if (session()->get('npk')!=0 && ($isWithinIPPeriode && !$is_approved && !$is_approved_before)||
                                            ($editIppMid && !$is_approved && !$is_approved_before) ||
                                            ($editIppOne && !$is_approved && !$is_approved_before)) {
                                                echo '
                                                    <td class="text-center">
                                                        <button class="btn btn-warning edit-btn btn-sm " style="width: 42px; font-size: 12px; padding: 0;">Edit</button>
                                                        <button class="btn btn-success save-btn btn-sm" style="display: none; width: 42px; font-size: 12px; padding: 0;">Simpan</button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-hapus" style="width: 42px; font-size: 12px; padding: 0;">Hapus</button>
                                                    </td>
                                                ';
                                            }
                                        ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Data IPP tidak ditemukan.</p>
                    <?php endif; ?>

                    <div class="d-flex justify-content mt-3">
                        <?php if (session()->get('npk') != 0){ ?>
                            <a href="<?= base_url('daftaripp/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a>
                        <?php } ?>
                        <?php
                        // dd($is_approved);
                            if (session()->get('npk') != 0 && $isWithinIPPeriode && !$is_approved_before && !$is_approved) {
                                foreach ($ippmain as $p){
                                    // Approval Kasie
                                    if (session()->get('kode_jabatan') == 4) {
                                        if ($p['kode_jabatan'] == 8 || $p['kode_jabatan'] == 5) {
                                            echo '<td class="text-center">';
                                            if (session()->get('kode_jabatan') == 4 && empty($p['approval_kasie'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKasie/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kasie
                                
                                    // Approval Kadept
                                    if (session()->get('kode_jabatan') == 3) {
                                        if ($p['kode_jabatan'] == 8 && $p['created_by'] != [3651, 3659]) {
                                            if ($p['approval_kasie'] == 1 && empty($p['approval_kadept'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadept/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])) {
                                            if (session()->get('kode_jabatan') == 3 && empty($p['approval_kadept'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadept/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kadept

                                    // Approval Kadiv
                                    if (session()->get('kode_jabatan') == 2) {
                                        if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])) {
                                            if ($p['approval_kadept'] == 1 && empty($p['approval_kadiv'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadiv/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 3) {
                                            if (session()->get('kode_jabatan') == 2 && empty($p['approval_kadiv'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadiv/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kadiv

                                    // Approval BoD
                                    if (session()->get('kode_jabatan') == 1) {
                                        if ($p['kode_jabatan'] == 3) {
                                            if ($p['approval_kadiv'] == 1 && empty($p['approval_bod'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveBod/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 2) {
                                            if (session()->get('kode_jabatan') == 1 && empty($p['approval_bod'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveBod/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval BoD

                                    // Approval presdir
                                    if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                        if ($p['kode_jabatan'] == 2) {
                                            echo '<td class="text-center">';
                                            if (empty($p['approval_presdir'])) {
                                                echo '<a href="' . base_url("/daftaripp/approvePresdir/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval presdir
                                }
                            } elseif (session()->get('npk') != 0 && $editIppMid && !$is_approved_before && !$is_approved) {
                                foreach ($ippmain as $p){
                                    // Approval Kasie
                                    if (session()->get('kode_jabatan') == 4) {
                                        if ($p['kode_jabatan'] == 8 || $p['kode_jabatan'] == 5) {
                                            echo '<td class="text-center">';
                                            if (session()->get('kode_jabatan') == 4 && empty($p['approval_kasie'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKasie/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kasie
                                
                                    // Approval Kadept
                                    if (session()->get('kode_jabatan') == 3) {
                                        if ($p['kode_jabatan'] == 8 && $p['created_by'] != [3651, 3659]) {
                                            if ($p['approval_kasie'] == 1 && empty($p['approval_kadept'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadept/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])) {
                                            if (session()->get('kode_jabatan') == 3 && empty($p['approval_kadept'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadept/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kadept

                                    // Approval Kadiv
                                    if (session()->get('kode_jabatan') == 2) {
                                        if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])) {
                                            if ($p['approval_kadept'] == 1 && empty($p['approval_kadiv'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadiv/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 3) {
                                            if (session()->get('kode_jabatan') == 2 && empty($p['approval_kadiv'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadiv/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kadiv

                                    // Approval BoD
                                    if (session()->get('kode_jabatan') == 1) {
                                        if ($p['kode_jabatan'] == 3) {
                                            if ($p['approval_kadiv'] == 1 && empty($p['approval_bod'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveBod/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 2) {
                                            if (session()->get('kode_jabatan') == 1 && empty($p['approval_bod'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveBod/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval BoD

                                    // Approval presdir
                                    if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                        if ($p['kode_jabatan'] == 2) {
                                            echo '<td class="text-center">';
                                            if (empty($p['approval_presdir'])) {
                                                echo '<a href="' . base_url("/daftaripp/approvePresdir/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval presdir
                                }
                            } elseif (session()->get('npk') != 0 && $editIppOne && !$is_approved_before && !$is_approved) {
                                foreach ($ippmain as $p){
                                    // Approval Kasie
                                    if (session()->get('kode_jabatan') == 4) {
                                        if ($p['kode_jabatan'] == 8 || $p['kode_jabatan'] == 5) {
                                            echo '<td class="text-center">';
                                            if (session()->get('kode_jabatan') == 4 && empty($p['approval_kasie'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKasie/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kasie
                                
                                    // Approval Kadept
                                    if (session()->get('kode_jabatan') == 3) {
                                        if ($p['kode_jabatan'] == 8 && $p['created_by'] != [3651, 3659]) {
                                            if ($p['approval_kasie'] == 1 && empty($p['approval_kadept'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadept/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])) {
                                            if (session()->get('kode_jabatan') == 3 && empty($p['approval_kadept'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadept/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kadept

                                    // Approval Kadiv
                                    if (session()->get('kode_jabatan') == 2) {
                                        if ($p['kode_jabatan'] == 4 || ($p['kode_jabatan'] == 8 && $p['created_by'] == [3651, 3659])) {
                                            if ($p['approval_kadept'] == 1 && empty($p['approval_kadiv'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadiv/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 3) {
                                            if (session()->get('kode_jabatan') == 2 && empty($p['approval_kadiv'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveKadiv/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval kadiv

                                    // Approval BoD
                                    if (session()->get('kode_jabatan') == 1) {
                                        if ($p['kode_jabatan'] == 3) {
                                            if ($p['approval_kadiv'] == 1 && empty($p['approval_bod'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveBod/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }

                                        if ($p['kode_jabatan'] == 2) {
                                            if (session()->get('kode_jabatan') == 1 && empty($p['approval_bod'])) {
                                                echo '<a href="' . base_url("/daftaripp/approveBod/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval BoD

                                    // Approval presdir
                                    if (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                                        if ($p['kode_jabatan'] == 2) {
                                            echo '<td class="text-center">';
                                            if (empty($p['approval_presdir'])) {
                                                echo '<a href="' . base_url("/daftaripp/approvePresdir/{$p['id']}") . '" class="approve-button btn btn-danger btn-sm mr-2" style="width: 100px; height: 30px;">
                                                    <i class="fas fa-check" style="color: white;">Approve</i>
                                                </a>';
                                            }
                                        }
                                    }
                                    // The end of approval presdir
                                }
                            }

                            if (session()->get('npk') == 0){
                                echo'
                                    <button class="btn btn-danger btn-sm unsubmitted" data-id="'. $mainData['id'] .'"  style="width: 70px; height: 30px;" title="Unsubmit IPP"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                ';
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
    $(document).ready(function () {
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

        $('.approve-button').click(function (event) {
            var alerted = false;
            console.log('clicked');
            event.preventDefault();

            var row = $(this);
            // var approvalStatus = row.siblings('.approval-status');
            var idMain = row.find('input[name="id_main[]"]').val();
            var program = row.data('program');
            var weight = row.data('weight');
            var midyear = row.data('midyear');
            var duedate = row.data('duedate');

            var totalWeight = parseFloat($('#total_weight').val());
            if (isNaN(totalWeight) || totalWeight !== 100.00) {
                if (!alerted) {
                    alert('Total Weight must be 100%. Currently, the total is ' + totalWeight + '%. Please check again.');
                    alerted = true; 
                }
                return false;
            }

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
                    $('.approve-button').html('<i class="fas fa-spinner fa-spin" style="color: white;"></i>');
                },
                complete: function(){
                    $('.approve-button').hide();
                },
                success: function(response) {
                    $('.approve-button').hide();
                    // approvalStatus.show(); 
                    // row.hide();
                    location.reload();
                }
            });
        });

        $('.edit-btn').click(function () {
            var row = $(this).closest('tr');
            console.log('Edit button clicked');

            // Mengubah tampilan kolom menjadi input dalam baris yang sesuai
            row.find('.program').html('<textarea class="form-control program-input">' + row.find('.program').text().trim() + '</textarea>');
            row.find('.weight').html('<input type="number" class="form-control weight-input" value="' + row.find('.weight').text().trim() + '">');
            row.find('.midyear').html('<textarea class="form-control midyear-input">' + row.find('.midyear').text().trim() + '</textarea>');
            row.find('.oneyear').html('<textarea class="form-control oneyear-input">' + row.find('.oneyear').text().trim() + '</textarea>');
            row.find('.duedate').html('<input type="date" class="form-control duedate-input" value="' + row.find('.duedate').text().trim() + '">');

            // Menambahkan atribut data-id dengan ID yang sesuai
            row.find('.save-btn').data('id', row.find('.program').data('id'));
            row.find('.save-btn').data('id', row.find('.weight').data('id'));
            row.find('.save-btn').data('id', row.find('.midyear').data('id'));
            row.find('.save-btn').data('id', row.find('.oneyear').data('id'));
            row.find('.save-btn').data('id', row.find('.duedate').data('id'));

            row.find('.edit-btn').hide(); 
            row.find('.btn-hapus').hide();
            row.find('.save-btn').show();
            $('.approve-button').hide();
            $('#addRowButton').hide();
        });

        // Fungsi yang dijalankan saat tombol "Simpan" pada halaman detail diklik
        $(document).on('click', '.save-btn', function () {
            var row = $(this).closest('tr');
            // Ambil ID dari atribut data-id
            var id = $(this).data('id');
            var id_main = row.find('input[name="id_main[]"]').val();
            // var id = row.find('.program').data('id'); // Mengambil ID dari atribut data-id
            console.log('Simpan button clicked for ID: ' + id);

            var newProgram = row.find('.program-input').val();
            var newWeight = row.find('.weight-input').val();
            var newMidYear = row.find('.midyear-input').val();
            var newOneYear = row.find('.oneyear-input').val();
            var newDueDate = row.find('.duedate-input').val();

            $.ajax({
                url: "<?= site_url('daftaripp/save_data'); ?>",
                type: 'POST',
                data: {
                    id: id,
                    id_main: id_main,
                    program: newProgram,
                    weight: newWeight,
                    midyear: newMidYear,
                    oneyear: newOneYear,
                    duedate: newDueDate
                },
                beforeSend: function(){
                    row.find('.save-btn').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    row.find('.save-btn').html('Simpan');
                },
                success: function (response) {
                    var result = response;
                    if (result.sukses) {
                        // alert('Data berhasil disimpan.');

                        row.find('.save-btn').hide();

                        // Mengembalikan kolom ke tampilan normal
                        row.find('.program').text(newProgram);
                        row.find('.weight').text(newWeight);
                        row.find('.midyear').text(newMidYear);
                        row.find('.oneyear').text(newOneYear);
                        row.find('.duedate').text(newDueDate);

                        // Mengembalikan input ke tampilan <span>
                        $('.btn-hapus').show();
                        row.find('.edit-btn').show();
                        row.find('.btn-hapus').show(); 
                        row.find('.save-btn').hide();
                        row.find('.program-input').hide();
                        row.find('.weight-input').hide();
                        row.find('.midyear-input').hide();
                        row.find('.oneyear-input').hide();
                        row.find('.duedate-input').hide();

                        location.reload();
                    } else {
                        alert('Gagal menyimpan data: ' + result.message);
                    }
                }
            });
        });

        $(document).on('click', '#simpan', function () {
            var dataToSave = [];
            var program;
            var weight;
            var midyear;
            var oneyear;
            var duedate;

            $('#isidetail tbody tr').each(function () {
                var row = $(this).closest('tr');
                var idMain = row.find('input[name="id_main[]"]').val();
                program = row.find('.program-input').val(); 
                weight = row.find('.weight-input').val();
                midyear = row.find('.midyear-input').val();
                oneyear = row.find('.oneyear-input').val();
                duedate = row.find('.duedate-input').val();

                if (program !== '' && weight !== '' && midyear !== '' && oneyear !== '' && duedate !== '') {
                    dataToSave.push({
                        idMain: idMain,
                        program: program,
                        weight: weight,
                        midyear: midyear,
                        oneyear: oneyear,
                        duedate: duedate
                    });
                }
            });

            var alerted = false;
            if (program == '' && weight == '' && midyear == '' && oneyear == '' && duedate == '') {
                if (!alerted) {
                    alert('Fields must be filled.');
                    alerted = true; 
                }
                return;
            }
            var row = $(this).closest('tr');

            $.ajax({
                url: '<?= base_url('daftaripp/save_temporarily'); ?>', 
                type: 'POST',
                dataType: 'json',
                data: {
                    dataToSave: dataToSave
                },
                beforeSend: function(){
                    $('#simpan').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                // complete: function(){
                //     $('#simpan').html('Save Temporarily');
                // },
                success: function (response) {
                    if (response.sukses) {
                        // alert(response.message);
                        // isDataSaved = true;
                        // $('.saveAllButton').hide();
                        // row.find('.program-input').text(program);
                        // row.find('.midyear-input').text(midyear);
                        // row.find('.oneyear-input').text(oneyear);
                        // row.find('.weight-input').text(weight);
                        // row.find('.duedate-input').text(duedate);
                        location.reload();
                    } else {
                        alert('Data cannot be saved. Double check it.');
                    }
                }
            });
        });
        
        // Fungsi untuk menghapus baris yang ada di halaman detail
        $(document).on('click', '.btn-hapus', function () {
            console.log('button diklik');
            var row = $(this).closest('tr');
            var id = row.find('.program').data('id');
            var id_main = <?= $id_main; ?>;
            
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: "<?= base_url('daftaripp/delete_data'); ?>",
                    type: 'POST',
                    data: {
                        id: id,
                        id_main: id_main
                    },
                    success: function (response) {
                        var result = response;
                        if (result.sukses) {
                            row.remove();
                            // location.reload();
                            calculateTotalScore();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error: " + status, error);
                    }
                });
            }
            calculateTotalScore();
        });

        var row;

        $(document).on('click', '.remove_row', function(e){
            e.preventDefault();
            $(this).parents('tr').remove(); 
            calculateTotalScore();
        });

        // Fungsi untuk menamah data ipp baru
        function addRow() {
            var idMain = <?= $id_main; ?>;
            var nomorBaris = $('#isidetail tbody tr').length + 1;

            var newRow = '<tr>' +
                '<td><textarea type="text" class="form-control program-input"></textarea><input type="hidden" class="form-control input-sm text-center edit-mode" id="id_main" name="id_main[]" value="' + idMain + '"></td>' +
                '<td><input type="number" class="form-control weight-input edit-mode"></td>' +
                '<td style="width: 400px;"><textarea type="text" class="form-control midyear-input edit-mode" style="width=100%"></textarea></td>' +
                '<td style="width: 400px;"><textarea type="text" class="form-control oneyear-input edit-mode"></textarea></td>' +
                '<td><input type="date" class="form-control duedate-input edit-mode"></td>' +
                '<td class="text-center">' +
                '<button type="button" class="btn btn-warning btn-sm edit-btn" style="display: none; width: 42px; font-size: 12px; padding: 0;">Edit</button>'+
                '<button type="button" class="btn btn-danger btn-sm remove_row" style="width: 42px; font-size: 12px; padding: 0;">Hapus</button>' +
                '</td>' +
                '</tr>';
                
            $('#saveAllButton').hide();
            $('.save-btn').hide();
            $('#simpan').show();
            $('#isidetail tbody').append(newRow);
            calculateTotalScore();
            $('.edit-btn').hide();
            // $('.btn-hapus').hide();
        }

        $(document).on('click', '#addRowButton', function() {
            var idMain = <?= $id_main; ?>; 
            addRow(idMain);
            calculateTotalScore();
            $('#addRowButton').hide();
        });

        var row;

        function approveRow(button) {
            var form = document.getElementById('detail-form');
            form.submit();
        }

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

            return true;
        }

        // Fungsi untuk menambahkan event handler ke input baru
        function setupWeightInputHandlers() {
            // Event handler saat input kolom "Weight" berubah
            $('.weight-input').on('input', function () {
                calculateTotalScore();
            });
        }

        $(document).on('input', '.weight-input', function () {
            console.log('Input event triggered for weight-input');
            calculateTotalScore();
        });

        calculateTotalScore();
        setupWeightInputHandlers();
    });

</script>

<?= $this->endSection('script'); ?>
