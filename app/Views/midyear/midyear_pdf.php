<!DOCTYPE html>
<html>
<head>
    <title>Mid Year Result Review PDF</title>
    <style>
        @font-face {
            font-family: 'CustomFont';
            src: url('/font/calibri-font-family/calibri-regular.ttf') format('truetype');
        }

        .custom-font {
            font-family: 'Calibri-Regular', sans-serif;
            color: black;
        }

        .kop-surat {
            width: 100%;
        }

        .kop-surat td {
            vertical-align: top;
        }

        .kop-surat .text-left {
            text-align: left;
            margin: 0;
            padding: 0;
        }

        .kop-surat .text-center {
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .kop-surat .info-table{
            border: 1px solid black;
            font-size: 10px;
            text-align: left;
            margin: 0;
            padding: 0;
            width: 200px;
        }

        .kop-surat tr td {
            vertical-align: top;
        }

        /* CSS untuk sel-sel dalam <tr> yang berisi teks rata tengah */
        .kop-surat .text-center td {
            text-align: center;
        }

        .table-colapse {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container custom-font">
        <div class="row">
            <div class="col-md-12">
                <table class="kop-surat">
                    <tr>
                        <td style="width: 180px">
                            <div class="text-left">
                                <?php
                                    $path = 'C:/xampp/htdocs/ipp/public/img/astra-logo.png';
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                ?>
                                <!-- Logo -->
                                <!-- <img src="C:/xampp/htdocs/ipp/public/img/astra-logo.png" alt="astra-logo" style="width: 100%;"> -->
                                <img src="<?php echo $base64?>" style="width: 100%; margin: auto;">
                            </div>
                            <table style="margin-top: 15px; font-size: 10px; border: 1px solid black; margin-left: 0; padding-left: 0; border-collapse: collapse; width: 250px;">
                                <tr style="border: none;">
                                    <th style="text-align: left; vertical-align: top; width: 30px;">Nama</th>
                                    <th style="vertical-align: top;">: </th>
                                    <th style="text-align: left"><?= ucwords(strtolower($approval['nama'])); ?></th>
                                </tr>
                                <tr style="border: none;">
                                    <th style="text-align: left; vertical-align: top;">Department</th>
                                    <th style="vertical-align: top;">: </th>
                                    <th style="text-align: left"><?= ucwords(strtolower($approval['department'])); ?></th>
                                </tr>
                                <tr style="border: none;">
                                    <th style="text-align: left; vertical-align: top;">Division</th>
                                    <th style="vertical-align: top;">: </th>
                                    <th style="text-align: left"><?= ucwords(strtolower($approval['division'])); ?></th>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <div style="text-align: center;">
                                <h2 style="margin:auto;">Performance Appraisal</h2>
                                <h3 style="margin:auto;"><i>Mid Year Result Review</i></h3>
                            </div>
                        </td>
                        <td>
                            <table class="info-table" style="border-collapse: collapse; font-size: 8px; margin:auto;">
                                <tr>
                                    <td>No. Form</td>
                                    <td>:</td>
                                    <td>F/SOP/CHR/005-01</td>
                                </tr>
                                <tr>
                                    <td style="width: 80px;">Hal</td>
                                    <td style="width: 5px;">:</td>
                                    <td style="width: 100px;">1 dari 3</td>
                                </tr>
                                <tr>
                                    <td style="width: 80px;">Revisi ke</td>
                                    <td>:</td>
                                    <td>01</td>
                                </tr>
                                <tr>
                                    <td style="width: 80px;">Tgl. Pembuatan</td>
                                    <td>:</td>
                                    <td>25 Juli 2017</td>
                                </tr>
                            </table>
                            <table class="info-table" style="border-collapse: collapse; font-size: 9px; margin: 5px auto;">
                                <tr>
                                    <th style="text-align: left; width: 80px;">Company</th>
                                    <th style="text-align: left; width: 5px;">:</th>
                                    <th style="text-align: left; width: 100px;">PT. CBI</th>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 80px;">Date of Review</th>
                                    <th style="text-align: left;">:</th>
                                    <th style="text-align: left;">
                                        <?php
                                            if($approval['kode_jabatan'] == 8 && (!in_array($approval['created_by'], [3659, 3651]))){echo date("d F Y", strtotime($approval['approval_date_kadept_midyear']));}
                                            elseif($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && !in_array($approval['created_by'], [3651, 3659]))) {echo date("d F Y", strtotime($approval['approval_date_kadiv_midyear']));}
                                            elseif($approval['kode_jabatan'] == 3) {echo date("d F Y", strtotime($approval['approval_date_bod_midyear']));}
                                            elseif($approval['kode_jabatan'] == 2) {echo date("d F Y", strtotime($approval['approval_date_presdir_midyear']));}
                                        ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="text-align: left; width: 80px;">Superior</th>
                                    <th style="text-align: left;">:</th>
                                    <th style="text-align: left;">
                                        <?php 
                                            if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]){
                                                echo ucwords(strtolower($approval['approved_kasie_by_mid']));
                                            } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){
                                                echo ucwords(strtolower($approval['approved_kadept_by_mid']));
                                            } elseif ($approval['kode_jabatan'] == 3){
                                                echo ucwords(strtolower($approval['approved_kadiv_by_mid']));
                                            } elseif ($approval['kode_jabatan'] == 2){
                                                echo ucwords(strtolower($approval['approved_bod_by_mid']));
                                            } 
                                        ?>
                                    </th>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <i style="margin-top: 20px; font-size: 10px; text-align: right; float: right;">Personal & Confidental</i>
                <table id="isidetail" style="width: 100%; font-size: 9px; border: 1px solid black; border-collapse: collapse; margin-top: 32px;">
                    <thead>
                        <tr>
                            <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 10px;">No.</th>
                            <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 90px;">Program/Activity</th>
                            <th rowspan="1" style="border-bottom: hidden; text-align: center; vertical-align: middle; border-collapse: collapse; width: 15px;">Weight</th>
                            <th rowspan="2" style="border-bottom: hidden; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 130px;">Mid Year Target</th>
                            <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 130px;">Mid Year Achievement</th>
                            <th rowspan="1" style="text-align: center; border-right: 1px solid black; vertical-align: middle; border-collapse: collapse; width: 20px;">Score</th>
                            <th rowspan="1" style="text-align: center; vertical-align: middle; border-collapse: collapse; width: 20px;">Total</th>
                        </tr>
                        <tr>
                            <th style="border-bottom: 1px solid black; border-collapse: collapse; font-size: 8px;">(w)</th>
                            <th style="border-bottom: 1px solid black; border-right: 1px solid black; border-collapse: collapse; font-size: 8px;">(R)</th>
                            <th style="border-bottom: 1px solid black; border-collapse: collapse; font-size: 8px;">(W x R)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nomor = 0;
                            foreach($midyear as $d):
                                $nomor++;
                        ?>
                        <tr>
                            <td style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;">
                                <?= $nomor; ?>
                            </td>
                            <td style="border-collapse: collapse; border-right: 1px solid black; text-align: left; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>">
                                <?= $d['program']; ?>
                            </td>
                            <td style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>">
                                <?= $d['weight']; ?>%
                                <input type="hidden" id="id_main" name="id_main[]" value="<?= $id_main; ?>">
                            </td>
                            <td style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['midyear']; ?></td>
                            <td style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['midyear_achv']; ?></td>
                            <td style="text-align: center; border-collapse: collapse; border-right: 1px solid black; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['midyear_achv_score']; ?></td>
                            <td style="text-align: center; border-collapse: collapse; border-right: 1px solid black; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['midyear_achv_total']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php 
                            $totalWeight = 0;
                            $totalScore = 0;

                            foreach($midyear as $d){
                                $weight = floatval($d['weight']);
                                $score = floatval($d['midyear_achv_total']);
                                if (!is_nan($weight)) {
                                    $totalWeight += $weight;
                                }
                                if (!is_nan($score)){
                                    $totalScore += $score;
                                }
                            }
                        ?>
                        <tr style="border-top: 1px solid #dee2e6; border: 1px solid black; border-collapse: collapse;">
                            <th style="border-bottom: 1px solid #dee2e6; border: 1px solid black; border-collapse: collapse;" colspan=2>Total</th>
                            <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; text-align: center; border-collapse: collapse;">
                                <span type="text" id="total_weight" style="border: none; padding: 0;"><?= number_format($totalWeight, 2) ?>%</span>
                            </td>
                            <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; border-collapse: collapse;"></td>
                            <th style="border-top: hidden; border-bottom: 1px solid #dee2e6; text-align: center; border-top:hidden; border: 1px solid black; border-collapse: collapse;">Total</th>
                            <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; border-collapse: collapse;"></td>
                            <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; border-collapse: collapse; text-align: center;">
                                <span type="text" id="total_weight" style="border: none; padding: 0; text-align: center;"><?= number_format($totalScore, 2) ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table style="border: 1px solid black; font-size: 9px; border-collapse: collapse; margin-top: 10px;">
                    <tr>
                        <td class="table-colapse" style="width: 170px; text-align: left;">
                            Superior of Superior: 
                            <?php
                                if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                                    if ($approval['approval_kasie_midyear'] == 1 && $approval['approval_kadept_midyear'] == 1){
                                        echo (ucwords(strtolower($approval['approved_kadept_by_mid'])));
                                    }
                                } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                                    if ($approval['approval_kadept_midyear'] == 1 && $approval['approval_kadiv_midyear'] == 1){
                                        echo (ucwords(strtolower($approval['approved_kadiv_by_mid'])));
                                    }
                                } elseif ($approval['kode_jabatan'] == 3){ 
                                    if ($approval['approval_kadiv_midyear'] == 1 && $approval['approval_bod_midyear'] == 1){
                                        echo (ucwords(strtolower($approval['approved_bod_by_mid'])));
                                    }
                                } elseif ($approval['kode_jabatan'] == 2){ 
                                    if ($approval['approval_bod_midyear'] == 1 && $approval['approval_presdir_midyear'] == 1){
                                        echo (ucwords(strtolower($approval['approved_presdir_by_mid'])));
                                    }
                                }
                            ?>
                        </td>
                        <td class="table-colapse" style="width: 170px; text-align: left;">
                            Superior: 
                            <?php
                                if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                                    if ($approval['approval_kasie_midyear'] == 1 && $approval['approval_kadept_midyear'] == 1){
                                        echo ucwords(strtolower(ucwords(strtolower($approval['approved_kasie_by_mid']))));
                                    }
                                } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                                    if ($approval['approval_kadept_midyear'] == 1 && $approval['approval_kadiv_midyear'] == 1){
                                        echo ucwords(strtolower(ucwords(strtolower($approval['approved_kadept_by_mid']))));
                                    }
                                } elseif ($approval['kode_jabatan'] == 3){ 
                                    if ($approval['approval_kadiv_midyear'] == 1 && $approval['approval_bod_midyear'] == 1){
                                        echo ucwords(strtolower(ucwords(strtolower($approval['approved_kadiv_by_mid']))));
                                    }
                                } elseif ($approval['kode_jabatan'] == 2){ 
                                    if ($approval['approval_bod_midyear'] == 1 && $approval['approval_presdir_midyear'] == 1){
                                        echo ucwords(strtolower(ucwords(strtolower($approval['approved_bod_by_mid']))));
                                    }
                                }
                            ?>
                        </td>
                        <td class="table-colapse" style="width: 170px; text-align: left;">Employee: <?= ucwords(strtolower($approval['nama'])); ?></td>
                    </tr>
                    <tr>
                        <?php
                            if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                                if ($approval['approval_kasie_midyear'] == 1 && $approval['approval_kadept_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                        <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_kadept_by_mid'])) .'                               
                                    </td>
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                        <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_kasie_by_mid'])) .'                               
                                    </td>
                                    <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                        <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                                    </td>
                                ';} 
                            } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                                if ($approval['approval_kadept_midyear'] == 1 && $approval['approval_kadiv_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                        <span style="text-align: center">Approved By</span><br>' . ucwords(strtolower($approval['approved_kadiv_by_mid'])) . '
                                    </td>
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                        <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_kadept_by_mid'])) .'
                                    </td>
                                    <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                        <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                                    </td>
                                '; }
                            } elseif ($approval['kode_jabatan'] == 3){ 
                                if ($approval['approval_kadiv_midyear'] == 1 && $approval['approval_bod_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;; position: relative;">
                                        <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_bod_by_mid'])) .'                               
                                    </td>
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;; position: relative;"> 
                                        <span style="text-align: center">Approved By</span><br>' . ucwords(strtolower($approval['approved_kadiv_by_mid'])) . '                               
                                    </td>
                                    <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                        <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                                    </td>
                                ';}
                            } elseif ($approval['kode_jabatan'] == 2){ 
                                if ($approval['approval_bod_midyear'] == 1 && $approval['approval_presdir_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                        <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_presdir_by_mid'])) .'</span>
                                
                                    </td>
                                    <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                        <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_bod_by_mid'])) .'                               
                                    </td>
                                    <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                        <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                                    </td>
                                '; }
                            } 
                        ?>
                    </tr>
                    <tr>
                        <?php
                            if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                                if ($approval['approval_kasie_midyear'] == 1 && $approval['approval_kadept_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                        <span>Date: ' . date("d F Y", strtotime($approval['approval_date_kadept'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                        <span>Date: ' . date("d F Y", strtotime($approval['approval_date_kasie'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="border-top: 0px;">Date: ';
                                echo date("d F Y", strtotime($approval['date_submitted']));
                                echo '</td>';} 
                            } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                                if ($approval['approval_kadept_midyear'] == 1 && $approval['approval_kadiv_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                        <span class="text-left">Date: ' . date("d F Y", strtotime($approval['approval_date_kadiv'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                        <span class="text-left">Date: ' . date("d F Y", strtotime($approval['approval_date_kadept'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="border-top: 0px;">Date: ';
                                echo date("d F Y", strtotime($approval['date_submitted']));
                                echo '</td>';} 
                            } elseif ($approval['kode_jabatan'] == 3){ 
                                if ($approval['approval_kadiv_midyear'] == 1 && $approval['approval_bod_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;; position: relative;">                                     
                                        <span>Date: ' . date("d F Y", strtotime($approval['approval_date_bod'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;; position: relative;">                                      
                                        <span>Date: ' . date("d F Y", strtotime($approval['approval_date_kadiv'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="border-top: 0px;">Date: ';
                                echo date("d F Y", strtotime($approval['date_submitted']));
                                echo '</td>';} 
                            } elseif ($approval['kode_jabatan'] == 2){ 
                                if ($approval['approval_bod_midyear'] == 1 && $approval['approval_presdir_midyear'] == 1){
                                echo '
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">
                                        <span>Date: ' . date("d F Y", strtotime($approval['approval_date_presdir'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                        <span>Date: ' . date("d F Y", strtotime($approval['approval_date_bod'])) . '</span>'.'
                                    </td>
                                    <td class="table-colapse" style="border-top: 0px;">Date: ';
                                echo date("d F Y", strtotime($approval['date_submitted']));
                                echo '</td>';} 
                            } 
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</body>
</html>