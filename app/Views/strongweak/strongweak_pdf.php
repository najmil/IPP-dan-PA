<!DOCTYPE html>
<html>
<head>
    <title>Strength and Weakness PDF</title>
    <style>
        @font-face {
            font-family: 'CustomFont';
            src: url('/font/calibri-font-family/calibri-regular.ttf') format('truetype');
        }

        .custom-font {
            font-family: 'Calibri-Regular', sans-serif;
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

        .kop-surat .text-center td {
            text-align: center;
        }

        .table-colapse {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .pdca tr td {
            border-right: 1px solid black;
            height: 25px;
        }

        .pm tr td {
            border-right: 1px solid black;
            height: 25px;
        }

        .kriteria td{
            border: 1px solid black;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="custom-font">
        <table class="kop-surat" style="border-collapse: collapse;">
            <tr>
                <td style="width: 150px;">
                    <div class="text-left"style="margin-right: 8px;">
                    <!-- Logo -->
                        <?php
                            $path = 'C:/xampp/htdocs/ipp/public/img/astra-logo.png';
                            $approved = 'C:/xampp/htdocs/ipp/public/img/approved-check.png';
                            $approved2 = 'C:/xampp/htdocs/ipp/public/img/approved-check-2.png';
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $approvedData = file_get_contents($approved);
                            $approvedData2 = file_get_contents($approved2);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            $approved64 = 'data:image/' . $type . ';base64,' . base64_encode($approvedData);
                            $approved264 = 'data:image/' . $type . ';base64,' . base64_encode($approvedData2);
                        ?>
                        <!-- Logo -->
                        <!-- <img src="C:/xampp/htdocs/ipp/public/img/astra-logo.png" alt="astra-logo" style="width: 100%;"> -->
                        <img src="<?php echo $base64?>" style="width: 90%; margin: auto;">
                    </div>
                </td>
                <td rowspan=2>
                    <div style="text-align: center;">
                        <h2 style="margin:auto; font-size: 20px;">PERFORMANCE APPRAISAL <br><span style="font-size: 13px; font-weight: normal;"><i>Process Review and Summary Sheet</i></span></h2>
                        <!-- <h3 style="margin:auto;"><i>(With Subordinate)</i></h3> -->
                    </div>
                </td>
                <td rowspan=2>
                    <table class="info-table" style="font-size: 8px; margin:auto;">
                        <tr>
                            <td>No. Form</td>
                            <td>:</td>
                            <td>F/SOP/CHR/005-3</td>
                        </tr>
                        <tr>
                            <td style="width: 80px;">Hal</td>
                            <td style="width: 5px;">:</td>
                            <td style="width: 100px;">3 dari 3</td>
                        </tr>
                        <tr>
                            <td style="width: 80px;">Revisi ke</td>
                            <td>:</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td style="width: 80px;">Tgl. Pembuatan</td>
                            <td>:</td>
                            <td>25 Juli 2017</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <!-- MID YEAR -->
        <table class="col-sm-12" style="margin-top: 20px; border-collapse: collapse; width: 703px;">
            <tr>
                <td style="font-size: 13px;">
                    <b>MID YEAR REVIEW</b>
                </td>
                <td style="text-align: right;">
                    <i style="font-size: 13px;">Personal and Confidential</i>
                </td>
            </tr>
            <tr style="border-right: 2px black solid; border-left: 2px black solid; border-top: 2px black solid;">
                <td class="table-colapse" style="width: 50%; border-right: 1px black solid; font-size: 14px; text-align: center;">Strong Point</td>
                <td class="table-colapse" style="width: 50%; border-right: 1px black solid; font-size: 14px; text-align: center;">Weak Point</td>
            </tr>
            <?php foreach ($strongweak as $s): ?>
            <tr style="border-right: 2px black solid; border-left: 2px black solid;">
                <td class="table-colapse" style="width: 50%; height: 120px; padding: 10px; text-align: left; vertical-align: top; border-right: 1px black solid; font-size: 13px; box-sizing: border-box;">
                    <div style="width: 100%; height: auto; margin-left: 0px; box-sizing: border-box;">
                        <ul style="margin: 0; padding: 0; padding-left: 3px; padding-right: 3px; box-sizing: border-box;"> 
                            <li style="box-sizing: border-box;">
                                <?= $s['alc_mid'] ?><br>
                                <?= $s['sub_alc_mid'] ?><br>
                                "<i><?= $s['strong_mid_alc'] ?></i>"<br>
                            </li>
                            <li style="margin-top: 5px; box-sizing: border-box;">
                                <?= $s['technical_mid'] ?><br>
                                "<i><?= $s['technical_value_mid'] ?></i>"<br>
                            </li>
                        </ul>
                    </div>
                </td>

                <td class="table-colapse" style="width: 50%; height: 120px; padding: 10px; text-align: left; vertical-align: top; border-right: 1px black solid; font-size: 13px; box-sizing: border-box;">
                    <div style="width: 100%; height: auto; margin-left: 0px; box-sizing: border-box;">
                        <ul style="margin: 0; padding: 0; padding-left: 3px; padding-right: 3px; box-sizing: border-box;"> 
                            <li style="box-sizing: border-box;">
                                <?= $s['weak_alc_mid'] ?><br>
                                <?= $s['weak_sub_alc_mid'] ?><br>
                                <i>"<?= $s['weak_mid_alc'] ?>"</i><br>
                            </li>
                            <li style="margin-top: 5px; box-sizing: border-box;">
                                <?= $s['weak_technical_mid'] ?><br>
                                <i>"<?= $s['weak_technical_value_mid'] ?>"</i><br>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr style="border-right: 2px black solid; border-left: 2px black solid;">
                <td class="table-colapse" colspan=2 style="width: 100%; font-size: 14px; text-align: center;">Note:</td>
            </tr>
            <tr style="border-right: 2px black solid; border-left: 2px black solid;">
                <td class="table-colapse" colspan=2 style="height: 60px; padding: 10px; text-align: left; vertical-align: top; width: 100%; font-size: 13px;"><?= $s['note_mid'] ?></td>
            </tr>
            <?php endforeach ?>
        </table>

        <table style="margin-top: 0px; border-collapse: collapse; border: 1px black solid; width: 100%; border-left: 2px black solid; border-right: 2px black solid; border-bottom: 2px black solid;">
            <tr style="text-align: center; font-size: 14px;">
                <td colspan=3 style="border-bottom: 1px black solid;">APPROVAL</td>
            </tr>
            <tr style="text-align: center; font-size: 14px;">
                <td colspan=3 style="border-bottom: 1px black solid;">Mid Year Review</td>
            </tr>
            <tr style="text-align: center; font-size: 14px;">
                <td style="border-right: 1px black solid;">Employee</td>
                <td style="border-right: 1px black solid;">Appraiser</td>
                <td>Appraiser Spv.</td>
            </tr>
            <tr style="font-size: 13px;">
                <?php
                    // dd($approval['kode_jabatan']);
                    if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                        echo '
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['date_submitted'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Approved By '. ucwords(strtolower($approval['approved_kasie_by'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_kasie_strongweak'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Approved By '. ucwords(strtolower($approval['approved_kasie_by'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_kadept_strongweak'])) . '</span>'.'
                            </td>
                        '; 
                    } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && in_array($approval['created_by'], [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]))) {
                        echo '
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['date_submitted'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Approved By ' . ucwords(strtolower($approval['approved_kadept_by'])) . '</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_kadept_strongweak'])) . '</span>
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Approved By ' . ucwords(strtolower($approval['approved_kadiv_by'])) . '</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_kadiv_strongweak'])) . '</span>
                            </td>
                        ';
                    } elseif ($approval['kode_jabatan'] == 3){ 
                        echo '
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['date_submitted'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;"> 
                                <span style="text-align: center">Approved By '. ucwords(strtolower($approval['approved_kadiv_by'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_kadiv_strongweak'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                            class="table-colapse"
                                <span style="text-align: center">Approved By '. ucwords(strtolower($approval['approved_bod_by'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_bod_strongweak'])) . '</span>'.'
                            </td>
                        ';
                    } elseif ($approval['kode_jabatan'] == 2){ 
                        echo '
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['date_submitted'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Approved By '. ucwords(strtolower($approval['approved_bod_by'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_bod_strongweak'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                <span style="text-align: center">Approved By '. ucwords(strtolower($approval['approved_presdir_by'])) .'</span>
                                <span style="position: absolute; bottom: 0; left: 0;">  Date: ' . date("d F Y", strtotime($approval['approval_date_presdir_strongweak'])) . '</span>'.'
                            </td>
                        '; 
                    } 
                ?>
            </tr>
        </table>

        <!-- ONE YEAR -->
        <table class="col-sm-12" style="margin-top: 8px; border-collapse: collapse; width: 100%; border-right: 2px black solid; border-bottom: 1px black solid; ">
            <tr>
                <td style="font-size: 13px;">
                    <b>ONE YEAR REVIEW</b>
                </td>
            </tr>
            <tr style="border-top: 2px black solid; border-left: 2px black solid;">
                <td class="table-colapse" style="width: 50%; border-right: 1px black solid; font-size: 14px; text-align: center;">Strong Point</td>
                <td class="table-colapse" style="width: 50%; border-right: 1px black solid; font-size: 14px; text-align: center;">Weak Point</td>
            </tr>
            <?php foreach ($strongweak as $s): ?>
            <tr style="border-top: 1px black solid; border-left: 2px black solid;">
                <td class="table-colapse" style="width: 50%; height: 120px; padding: 10px; text-align: left; vertical-align: top; border-right: 1px black solid; font-size: 13px; box-sizing: border-box;">
                    <div style="width: 100%; height: auto; margin-left: 0px; box-sizing: border-box;">
                        <?php if (!empty($s['alc_one'])) : ?>
                            <ul style="margin: 0; padding: 0; padding-left: 3px; padding-right: 3px; box-sizing: border-box;"> 
                                <li style="box-sizing: border-box;">
                                    <?= $s['alc_one'] ?><br>
                                    <?= $s['sub_alc_one'] ?><br>
                                    <i>"<?= $s['strong_one_alc'] ?>"</i><br>
                                </li>
                                <li style="margin-top: 5px; box-sizing: border-box;">
                                    <?= $s['technical_one'] ?><br>
                                    <i>"<?= $s['technical_value_one'] ?>"</i><br>
                                </li>
                            </ul>
                        <?php endif ?>
                    </div>
                </td>

                <td class="table-colapse" style="width: 50%; height: 120px; padding: 10px; text-align: left; vertical-align: top; border-right: 1px black solid; font-size: 13px; box-sizing: border-box;">
                    <div style="width: 100%; height: auto; margin-left: 0px; box-sizing: border-box;">
                        <?php if (!empty($s['alc_one'])) : ?>
                            <ul style="margin: 0; padding: 0; padding-left: 3px; padding-right: 3px; box-sizing: border-box;"> 
                                <li style="box-sizing: border-box;">
                                    <?= $s['weak_alc_one'] ?><br>
                                    <?= $s['weak_sub_alc_one'] ?><br>
                                    <i>"<?= $s['weak_one_alc'] ?>"</i><br>
                                </li>
                                <li style="margin-top: 5px; box-sizing: border-box;">
                                    <?= $s['weak_technical_one'] ?><br>
                                    <i>"<?= $s['weak_technical_value_one'] ?>"</i><br>
                                </li>
                            </ul>
                        <?php endif ?>
                    </div>
                </td>
            </tr>
            <tr style="border-left: 2px black solid;">
                <td class="table-colapse" colspan=2 style="width: 100%; font-size: 14px; text-align: center;">Note:</td>
            </tr>
            <tr style="border-left: 2px black solid;">
                <?php
                    if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                        if ($approval['approval_kasie_oneyear'] == 1 && $approval['approval_kadept_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" colspan=2 style="height: 60px; padding: 10px; text-align: left; vertical-align: top; width: 100%; font-size: 13px;">'. $s['note_one'] .'</td>
                            ';
                        } else {
                            echo '<td colspan=2 class="table-colapse" style="height: 60px; vertical-align: top; width: 100%; padding: 10px;"></td>';
                        }
                    } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])) {
                        if($approval['approval_kadept_oneyear'] == 1 && $approval['approval_kadiv_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" colspan=2 style="height: 60px; padding: 10px; text-align: left; vertical-align: top; width: 100%; font-size: 13px;">'. $s['note_one'] .'</td>
                            ';
                        } else {
                            echo '<td colspan=2 class="table-colapse" style="height: 60px; vertical-align: top; width: 100%; padding: 10px;"></td>';
                        }
                    } elseif ($approval['kode_jabatan'] == 3){ 
                        if($approval['approval_kadiv_oneyear'] == 1 && $approval['approval_bod_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" colspan=2 style="height: 60px; padding: 10px; text-align: left; vertical-align: top; width: 100%; font-size: 13px;">'. $s['note_one'] .'</td>
                            ';
                        } else {
                            echo '<td colspan=2 class="table-colapse" style="height: 60px; vertical-align: top; width: 100%; padding: 10px;"></td>';
                        }
                    } elseif ($approval['kode_jabatan'] == 2){ 
                        if($approval['approval_bod_oneyear'] == 1 && $approval['approval_presdir_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" colspan=2 style="height: 60px; padding: 10px; text-align: left; vertical-align: top; width: 100%; font-size: 13px;">'. $s['note_one'] .'</td>
                            ';
                        } else {
                            echo '<td colspan=2 class="table-colapse" style="height: 60px; vertical-align: top; width: 100%; padding: 10px;"></td>';
                        }
                    } 
                ?>
                
            </tr>
            <?php endforeach ?>
        </table>

        <table style="margin-top: 0px; border-collapse: collapse; border-top: 1px black solid; border-right: 2px black solid; border-left: 2px black solid; border-bottom: 2px black solid; width: 100%;">
            <tr style="text-align: center; font-size: 14px;">
                <td colspan=3 style="border-bottom: 1px black solid;">APPROVAL</td>
            </tr>
            <tr style="text-align: center; font-size: 14px;">
                <td colspan=3 style="border-bottom: 1px black solid;">One Year Review</td>
            </tr>
            <tr style="text-align: center; font-size: 14px;">
                <td style="border-right: 1px black solid;">Employee</td>
                <td style="border-right: 1px black solid;">Appraiser</td>
                <td>Appraiser Spv.</td>
            </tr>
            <tr style="font-size: 13px;">
                <?php
                    if ($approval['kode_jabatan'] == 8 && $approval['created_by'] != [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]) { 
                        if ($approval['approval_kasie_oneyear'] == 1 && $approval['approval_kadept_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['date_submitted_one'] !== null ? date("d F Y", strtotime($approval['date_submitted_one'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">'. ($approval['kasie_by_oneyear'] !== null ? 'Approved By '. ucwords(strtolower($approval['kasie_by_oneyear'])) : '') .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_kasie_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_kasie_oneyear'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">'. ($approval['kadept_by_oneyear'] !== null ? 'Approved By ' . ucwords(strtolower($approval['kadept_by_oneyear'])) : '') .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_kadept_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_kadept_oneyear'])) : '') . '</span>'.'
                                </td>
                            '; 
                        } else{
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                            ';
                        }
                    } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && in_array($approval['created_by'], [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]))) {
                        if ($approval['approval_kadiv_oneyear'] == 1 && $approval['approval_kadept_oneyear'] == 1){
                        // dd($approval['kadept_by_oneyear']);
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['date_submitted_one'] !== null ? date("d F Y", strtotime($approval['date_submitted_one'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">' . ($approval['approved_kadept_by'] !== null ? 'Approved By ' . ucwords(strtolower($approval['approved_kadept_by'])) : '') . '</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_kadept_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_kadept_oneyear'])) : '') . '</span>
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">' . ($approval['approved_kadiv_by'] !== null ? 'Approved By ' . ucwords(strtolower($approval['approved_kadiv_by'])) : '') . '</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_kadiv_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_kadiv_oneyear'])) : '') . '</span>
                                </td>
                            ';
                        } else {
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                            ';
                        }
                    } elseif ($approval['kode_jabatan'] == 3){ 
                        if ($approval['approval_kadiv_oneyear'] == 1 && $approval['approval_bod_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['date_submitted_one'] !== null ? date("d F Y", strtotime($approval['date_submitted_one'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;"> 
                                    <span style="text-align: center">'. ($approval['kadept_by_oneyear'] !== null ? 'Approved By ' . ucwords(strtolower($approval['kadept_by_oneyear'])) : '') .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_kadiv_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_kadiv_oneyear'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                class="table-colapse"
                                    <span style="text-align: center">'. ($approval['bod_by_oneyear'] !== null ? 'Approved By ' . ucwords(strtolower($approval['bod_by_oneyear'])) : '') .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_bod_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_bod_oneyear'])) : '') . '</span>'.'
                                </td>
                            '; 
                        } else{
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                            ';
                        }
                    } elseif ($approval['kode_jabatan'] == 2){ 
                        if ($approval['approval_bod_oneyear'] == 1 && $approval['approval_presdir_oneyear'] == 1){
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">Signed By '. ucwords(strtolower($approval['nama'])) .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['date_submitted_one'] !== null ? date("d F Y", strtotime($approval['date_submitted_one'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">'. ($approval['bod_by_oneyear'] !== null ? 'Approved By ' . ucwords(strtolower($approval['bod_by_oneyear'])) : '') .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_bod_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_bod_oneyear'])) : '') . '</span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="text-align: center">'. ($approval['presdir_by_oneyear'] !== null ? 'Approved By ' . ucwords(strtolower($approval['presdir_by_oneyear'])) : '') .'</span>
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: ' . ($approval['approval_date_presdir_oneyear'] !== null ? date("d F Y", strtotime($approval['approval_date_presdir_oneyear'])) : '') . '</span>'.'
                                </td>
                            '; 
                        } else{
                            echo '
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>'.'
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                                <td class="table-colapse" style="width: 33.3%; height: 100px; text-align: center; position: relative;">
                                    <span style="position: absolute; bottom: 0; left: 0;"> Date: </span>
                                </td>
                            ';
                        }
                    } 
                ?>
            </tr>
        </table>
    </div>
</body>
</html>