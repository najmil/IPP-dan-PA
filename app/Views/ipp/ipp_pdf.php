<!DOCTYPE html>
<html>
<head>
    <title>Individual Performance Plan PDF</title>
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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
</head>
<body>
    <div class="custom-font">
        <table class="kop-surat">
            <tr>
                <td style="width: 150px;">
                    <div class="text-left"style="margin-right: 8px;">
                    <!-- Logo -->
                        <?php
                            // $path = FCPATH . 'img/astra-logo.png';
                            // $approved = FCPATH.'/img/approved-check.png';
                            // $approved2 = FCPATH.'/img/approved-check-2.png';
                            // $type = pathinfo($path, PATHINFO_EXTENSION);
                            // $data = file_get_contents($path);
                            // $approvedData = file_get_contents($approved);
                            // $approvedData2 = file_get_contents($approved2);
                            // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            // $approved64 = 'data:image/' . $type . ';base64,' . base64_encode($approvedData);
                            // $approved264 = 'data:image/' . $type . ';base64,' . base64_encode($approvedData2);
                            $path = FCPATH.'/img/icon-cbi.png';
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        ?>
                        <img src="<?php echo $base64?>" style="width: 90%; margin: auto;">
                    </div>
                </td>
                <td rowspan=2>
                    <div style="text-align: center;">
                        <h2 style="margin:auto; font-size: 20px;">Individual Performance Plan</h2>
                        <?php if ($kode_jabatan != 8 || $userNpk == [1814, 2070, 2322, 2592]): ?>
                            <h3 style="margin:auto;"><i>(With Subordinate)</i></h3>
                        <?php else: ?>
                            
                        <?php endif; ?>
                    </div>
                </td>
                <td rowspan=2>
                    <table class="info-table" style="font-size: 7px; margin:auto;">
                        <tr>
                            <td>No. Form</td>
                            <td>:</td>
                            <td>F/PDEV/04/001/001</td>
                        </tr>
                        <tr>
                            <td style="width: 80px;">Hal</td>
                            <td style="width: 5px;">:</td>
                            <td style="width: 100px;">1 dari 1</td>
                        </tr>
                        <tr>
                            <td style="width: 80px;">Revisi ke</td>
                            <td>:</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td style="width: 80px;">Tgl. Pembuatan</td>
                            <td>:</td>
                            <td>1 Agustus 2006</td>
                        </tr>
                    </table>
                    <?php helper('date');
                        $approvalDateKasie = date('j F Y', strtotime($approval['approval_date_kasie']));
                        $approvalDateKadept = date('j F Y', strtotime($approval['approval_date_kadept']));
                        $approvalDateKadiv = date('j F Y', strtotime($approval['approval_date_kadiv']));
                        $approvalDateBod = date('j F Y', strtotime($approval['approval_date_bod']));
                        $dateSubmittedIpp = date('j F Y', strtotime($approval['date_submitted_ipp']));
                        $dateSubmittedIppMid = date('j F Y', strtotime($approval['date_submitted_ipp_mid']));
                        $dateSubmittedIppOne = date('j F Y', strtotime($approval['date_submitted_ipp_one']));

                        $translatedDateKasie = translate_date($approvalDateKasie);
                        $translatedDateKadept = translate_date($approvalDateKadept);
                        $translatedDateKadiv = translate_date($approvalDateKadiv);
                        $translatedDateBod = translate_date($approvalDateBod);
                        $translatedDateIpp = translate_date($dateSubmittedIpp);
                        $translatedDateIppMid = translate_date($dateSubmittedIppMid);
                        $translatedDateIppOne = translate_date($dateSubmittedIppOne);
                    ?>
                    <table class="info-table" style="font-size: 9px; margin: 5px auto;">
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
                                    if($approval['kode_jabatan'] == 8){
                                        echo $translatedDateKasie;
                                    } elseif($approval['kode_jabatan'] == 4){
                                        echo $translatedDateKadept;
                                    } elseif($approval['kode_jabatan'] == 3){
                                        echo $translatedDateKadiv;
                                    } elseif($approval['kode_jabatan'] == 2){
                                        echo $translatedDateBod;
                                    }
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: left; width: 80px;">Superior</th>
                            <th style="text-align: left;">:</th>
                            <th style="text-align: left;">
                                <?php 
                                    if ($approval['kode_jabatan'] == 8){
                                        echo ucwords(strtolower($approval['approved_kasie_by']));
                                    } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){
                                        echo ucwords(strtolower($approval['approved_kadept_by']));
                                    } elseif ($approval['kode_jabatan'] == 3){
                                        echo ucwords(strtolower($approval['approved_kadiv_by']));
                                    } elseif ($approval['kode_jabatan'] == 2){
                                        echo ucwords(strtolower($approval['approved_bod_by']));
                                    } 
                                ?>
                            </th>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan=3>
                    <table style="margin-top: 15px; font-size: 9px; margin-left: 0; padding-left: 0; width: 250px" class="table-colapse">
                        <tr style="border: none;">
                            <th style="text-align: left; vertical-align: top; width: 30px;">Nama</th>
                            <th style="vertical-align: top; width: 10px;">: </th>
                            <th style="text-align: left"> <?= ucwords(strtolower($userNama)); ?></th>
                        </tr>
                        <tr style="border: none;">
                            <th style="text-align: left; width: 30px;">Department </th>
                            <th>: </th>
                            <th style="text-align: left"> <?= ucwords(strtolower($approval['department'])); ?></th>
                        </tr>
                        <tr style="border: none;">
                            <th style="text-align: left; width: 30px;">Division </th>
                            <th>: </th>
                            <th style="text-align: left"> <?= ucwords(strtolower($approval['division'])); ?></th>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <i style="margin-top: 20px; font-size: 9px; text-align: right; float: right;">Personal & Confidental</i>
        <div style="break-inside: auto; page-break-after: auto;">
            <table style="width: 100%; border: 1px solid black; font-size: 9px; border-collapse: collapse; margin-top: 32px;">
                <thead>
                    <tr>
                        <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 10px;">No.</th>
                        <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 150px;">Program/Activity</th>
                        <th rowspan="2" style="border-bottom: hidden; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 40px;">Weight (%)</th>
                        <th rowspan="1" colspan="2" style="border-bottom: hidden; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse;">Target</th>
                        <th rowspan="2" style="border-bottom: 1px solid #dee2e6; text-align: center; vertical-align: middle; border: 1px solid black; border-collapse: collapse; width: 50px;">Due Date</th>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid #dee2e6; border: 1px solid black; border-collapse: collapse; width: 150px;">Mid Year</th>
                        <th style="border-bottom: 1px solid #dee2e6; border: 1px solid black; border-collapse: collapse; width: 150px;">One Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 0;
                        foreach($ipp as $d):
                            // dd($d['program']);
                            $nomor++;
                    ?>
                    <tr>
                        <td style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;">
                            <?= $nomor; ?>
                        </td>
                        <td class="program" style="border-collapse: collapse; border-right: 1px solid black; text-align: left; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>">
                            <?= $d['program']; ?>
                        </td>
                        <td class="weight" style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>">
                            <?= $d['weight']; ?>%
                            <input type="hidden" id="id_main" name="id_main[]" value="<?= $id_main; ?>">
                        </td>
                        <td class="midyear" style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['midyear']; ?></td>
                        <td class="oneyear" style="border-collapse: collapse; border-right: 1px solid black; text-align: center; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['oneyear']; ?></td>
                        <td class="duedate" style="text-align: center; border-collapse: collapse; border-right: 1px solid black; vertical-align: top; position: relative; top: 0;" data-id="<?= $d['id']; ?>"><?= $d['duedate']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php 
                        $totalWeight = 0;

                        foreach($ipp as $d){
                            $weight = floatval($d['weight']);
                            if (!is_nan($weight)) {
                                $totalWeight += $weight;
                            }
                        }
                    ?>
                    <tr style="border-top: 1px solid #dee2e6; border: 1px solid black; border-collapse: collapse;">
                        <th style="border-bottom: 1px solid #dee2e6; border: 1px solid black; border-collapse: collapse;" colspan=2>Total</th>
                        <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; text-align: center; border-collapse: collapse;">
                            <span type="text" id="total_weight" style="width: 100%; border: none; padding: 0; text-align: center;"><?= number_format($totalWeight, 2) ?>%</span>
                        </td>
                        <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; border-collapse: collapse;"></td>
                        <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; border-collapse: collapse;"></td>
                        <td style="border-top: hidden; border-bottom: 1px solid #dee2e6; border-top:hidden; border: 1px solid black; border-collapse: collapse;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table style="border: 1px solid black; font-size: 9px; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td class="table-colapse" style="width: 170px; text-align: left;">
                    Superior of Superior: 
                    <?php
                         if ($approval['kode_jabatan'] == 8) { 
                            if ($approval['approval_kasie'] == 1 && $approval['approval_kadept'] == 1){
                                echo ucwords(strtolower($approval['approved_kadept_by']));
                            }
                        } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                            if ($approval['approval_kadept'] == 1 && $approval['approval_kadiv'] == 1){
                                echo ucwords(strtolower($approval['approved_kadiv_by']));
                            }
                        } elseif ($approval['kode_jabatan'] == 3){ 
                            if ($approval['approval_kadiv'] == 1 && $approval['approval_bod'] == 1){
                                echo ucwords(strtolower($approval['approved_bod_by']));
                            }
                        } elseif ($approval['kode_jabatan'] == 2){ 
                            if ($approval['approval_bod'] == 1 && $approval['approval_presdir'] == 1){
                                echo ucwords(strtolower($approval['approved_presdir_by']));
                            }
                        }
                    ?>
                </td>
                <td class="table-colapse" style="width: 170px; text-align: left;">
                    Superior: 
                    <?php
                         if ($approval['kode_jabatan'] == 8) { 
                            if ($approval['approval_kasie'] == 1 && $approval['approval_kadept'] == 1){
                                echo ucwords(strtolower($approval['approved_kasie_by']));
                            }
                        } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                            if ($approval['approval_kadept'] == 1 && $approval['approval_kadiv'] == 1){
                                echo ucwords(strtolower($approval['approved_kadept_by']));
                            }
                        } elseif ($approval['kode_jabatan'] == 3){ 
                            if ($approval['approval_kadiv'] == 1 && $approval['approval_bod'] == 1){
                                echo ucwords(strtolower($approval['approved_kadiv_by']));
                            }
                        } elseif ($approval['kode_jabatan'] == 2){ 
                            if ($approval['approval_bod'] == 1 && $approval['approval_presdir'] == 1){
                                echo ucwords(strtolower($approval['approved_bod_by']));
                            }
                        }
                    ?>
                </td>
                <td class="table-colapse" style="width: 170px; text-align: left;">Employee: <?= ucwords(strtolower($userNama)); ?></td>
            </tr>
            <tr>
                <?php
                    if ($approval['kode_jabatan'] == 8) { 
                        if ($approval['approval_kasie'] == 1 && $approval['approval_kadept'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_kadept_by'])) .'                               
                            </td>
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_kasie_by'])) .'                               
                            </td>
                            <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                            </td>
                        ';} 
                    } elseif ($approval['kode_jabatan'] == 4 || ($approval['kode_jabatan'] == 8 && $approval['created_by'] == [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])){ 
                        if ($approval['approval_kadept'] == 1 && $approval['approval_kadiv'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                <span style="text-align: center">Approved By</span><br>' . ucwords(strtolower($approval['approved_kadiv_by'])) . '
                            </td>
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_kadept_by'])) .'
                            </td>
                            <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                            </td>
                        '; }
                    } elseif ($approval['kode_jabatan'] == 3){ 
                        if ($approval['approval_kadiv'] == 1 && $approval['approval_bod'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;; position: relative;">
                                <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_bod_by'])) .'                               
                            </td>
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;; position: relative;"> 
                                <span style="text-align: center">Approved By</span><br>' . ucwords(strtolower($approval['approved_kadiv_by'])) . '                               
                            </td>
                            <td class="table-colapse" style="border-bottom: 0px; text-align: center;">
                                <span style="text-align: center">Signed By</span><br><span>'. ucwords(strtolower($approval['nama'])) .'</span>
                            </td>
                        ';}
                    } elseif ($approval['kode_jabatan'] == 2){ 
                        if ($approval['approval_bod'] == 1 && $approval['approval_presdir'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_presdir_by'])) .'</span>
                        
                            </td>
                            <td class="table-colapse" style="height: 50px; text-align: center; border-bottom: 0px;">
                                <span style="text-align: center">Approved By</span><br>'. ucwords(strtolower($approval['approved_bod_by'])) .'                               
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
                    if ($approval['kode_jabatan'] == 8) { 
                        if ($approval['approval_kasie'] == 1 && $approval['approval_kadept'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                <span>Date: ' . $translatedDateKadept . '</span>'.'
                            </td>
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                <span>Date: ' . $translatedDateKasie . '</span>'.'
                            </td>
                            <td class="table-colapse" style="border-top: 0px;">Date: ';
                                if ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] == NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                   echo $translatedDateIpp;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIppMid;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] != NULL) {
                                    echo $translatedDateIppOne;
                                }
                        echo '</td>';} 
                    } elseif ($approval['kode_jabatan'] == 4){ 
                        if ($approval['approval_kadept'] == 1 && $approval['approval_kadiv'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                <span class="text-left">Date: ' . $translatedDateKadiv . '</span>'.'
                            </td>
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                <span class="text-left">Date: ' . $translatedDateKadept . '</span>'.'
                            </td>
                            <td class="table-colapse" style="border-top: 0px;">Date: ';
                                if ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] == NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIpp;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIppMid;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] != NULL) {
                                    echo $translatedDateIppOne;
                                }
                        echo '</td>';} 
                    } elseif ($approval['kode_jabatan'] == 3){ 
                        if ($approval['approval_kadiv'] == 1 && $approval['approval_bod'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;; position: relative;">                                     
                                <span>Date: ' . $translatedDateBod . '</span>'.'
                            </td>
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;; position: relative;">                                      
                                <span>Date: ' . $translatedDateKadiv . '</span>'.'
                            </td>
                            <td class="table-colapse" style="border-top: 0px;">Date: ';
                                if ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] == NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIpp;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIppMid;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] != NULL) {
                                    echo $translatedDateIppOne;
                                }
                        echo '</td>';} 
                    } elseif ($approval['kode_jabatan'] == 2){ 
                        if ($approval['approval_bod'] == 1 && $approval['approval_presdir'] == 1){
                        echo '
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">
                                <span>Date: ' . date("d F Y", strtotime($approval['approval_date_presdir'])) . '</span>'.'
                            </td>
                            <td class="table-colapse" style="height: 20px; text-align: left; border-top: 0px;">                                     
                                <span>Date: ' . $translatedDateBod . '</span>'.'
                            </td>
                            <td class="table-colapse" style="border-top: 0px;">Date: ';
                                if ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] == NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIpp;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] == NULL) {
                                    echo $translatedDateIppMid;
                                } elseif ($approval['date_submitted_ipp'] != NULL && $approval['date_submitted_ipp_mid'] != NULL && $approval['date_submitted_ipp_one'] != NULL) {
                                    echo $translatedDateIppOne;
                                }
                        echo '</td>';} 
                    } 
                ?>
            </tr>
        </table>
    </div>
    <div style="clear: both;"></div>
    <!-- <p>User Name: <?php //echo $userNama ?></p>
    <p>User NPK: <?php //echo $userNpk ?></p> -->
</body>
</html>