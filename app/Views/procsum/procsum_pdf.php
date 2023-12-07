<!DOCTYPE html>
<html>
<head>
    <title>Process Summary PDF</title>
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
        <table class="kop-surat custom-font">
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
            <!-- TABEL NAMA -->
            <tr>
                <td colspan=3>
                    <table style="margin-top: 30px; font-size: 10px; margin-left: 0; padding-left: 0; width: 250px" class="table-colapse">
                        <tr style="border: none;">
                            <th style="text-align: left; vertical-align: top; width: 30px;">Nama</th>
                            <th style="vertical-align: top; width: 10px;">: </th>
                            <th style="text-align: left"> <?= ucwords(strtolower($mainprocsum['nama'])); ?></th>
                        </tr>
                        <tr style="border: none;">
                            <th style="text-align: left; width: 30px;">Department </th>
                            <th>: </th>
                            <th style="text-align: left"> <?= ucwords(strtolower($mainprocsum['department'])); ?> </th>
                        </tr>
                        <tr style="border: none;">
                            <th style="text-align: left; width: 30px;">Division </th>
                            <th>: </th>
                            <th style="text-align: left"> <?= ucwords(strtolower($mainprocsum['division'])); ?> </th>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <i style="margin-top: 20px; font-size: 10px; text-align: right; float: right;">Personal & Confidental</i>
        <table style="width: 100%; border: 2px solid black; font-size: 11px; border-collapse: collapse; margin-top: 32px;">
            <tbody>
                <tr style="text-align: center;">
                    <td colspan=3 style="border-bottom: 1px solid black; height: 20px;">
                        <span style="font-size: 13px;"><b>Process</b></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        <span style="font-size: 13px;"><br>B1. PDCA & VALUES</span>
                    </td>
                    <td style="width: 8px;"></td>
                    <td style="width: 50%;">
                        <span style="font-size: 13px;"><br>B2. PEOPLE MANAGEMENT</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="pdca" style="width: 100%; border: 1px solid black; font-size: 11px; border-collapse: collapse; margin-left: 0px; padding-left: 0px;">
                            <thead style="text-align: center; border: 1px solid black; border-right: 1px solid black;">
                                <tr>
                                    <td rowspan=2 style="border-right: 1px solid black;">Aspect</td>
                                    <td rowspan=1 colspan=2 style="border-bottom: 1px solid black">Achievement</td>
                                </tr>
                                <tr>
                                    <td colspan=1 style="border-right: 1px solid black;">Mid Year</td>
                                    <td colspan=1>One Year</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1. Plan</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['plan_mid']) ? $procsum['plan_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['plan_one']) ? $procsum['plan_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>2. Do</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['do_mid']) ? $procsum['do_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['do_one']) ? $procsum['do_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>3. Check</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['check_mid']) ? $procsum['check_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['check_one']) ? $procsum['check_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>4. Action</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['act_mid']) ? $procsum['act_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['act_one']) ? $procsum['act_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>5. Teamwork</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['teamwork_mid']) ? $procsum['teamwork_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['teamwork_one']) ? $procsum['teamwork_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>6. Customer Focus</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['cust_mid']) ? $procsum['cust_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['cust_one']) ? $procsum['cust_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>7. Passion for Excellence</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['passion_mid']) ? $procsum['passion_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['passion_one']) ? $procsum['passion_one'] : ''; ?></td>
                                </tr>
                                <tr style="border-top: 1px solid black;">
                                    <td style="text-align: center;">
                                        <span>Rata-Rata</span>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['b1_average']) ? number_format($procsum['b1_average'], 2) : ''; ?></td>
                                    <td style="text-align: center;"><?= isset($procsum['b1_average_one']) ? number_format($procsum['b1_average_one'], 2) : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                    <td style="display: flex; flex-direction: column; align-items: flex-start; font-size: 11px;">   
                        <table class="pm" style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                            <thead style="text-align: center; border: 1px solid black; border-right: 1px solid black;">
                                <tr>
                                    <td rowspan=2 style="border-right: 1px solid black;">Aspect</td>
                                    <td rowspan=1 colspan=2 style="border-bottom: 1px solid black">Achievement</td>
                                </tr>
                                <tr>
                                    <td colspan=1 style="border-right: 1px solid black;">Mid Year</td>
                                    <td colspan=1>One Year</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1. Getting Commitment on IPP</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['gc_mid']) ? $procsum['gc_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['gc_one']) ? $procsum['gc_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>2. Delegating</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['delegating_mid']) ? $procsum['delegating_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['delegating_one']) ? $procsum['delegating_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>3. Coaching and Counseling</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['couch_mid']) ? $procsum['couch_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['couch_one']) ? $procsum['couch_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>4. Developing Subordinate</td>
                                    <td style="text-align: center;">
                                        <?= isset($procsum['develop_mid']) ? $procsum['develop_mid'] : ''; ?>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['develop_one']) ? $procsum['develop_one'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr style="border-top: 1px solid black;">
                                    <td style="text-align: center;">
                                        <span>Rata-Rata</span>
                                    </td>
                                    <td style="text-align: center;"><?= isset($procsum['b2_average']) ? number_format($procsum['b2_average'], 2) : ''; ?></td>
                                    <td style="text-align: center;"><?= isset($procsum['b2_average_one']) ? number_format($procsum['b2_average_one'], 2) : ''; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
            foreach ($sum_midyear_total as $d){
                $value = isset($d['sum_midyear_total']) ? $d['sum_midyear_total'] : 0;
                // echo number_format($value, 2);
            }

            foreach ($sum_oneyear_total as $o){
                $value_one = isset($o['sum_oneyear_total']) ? $o['sum_oneyear_total'] : 0;
                // echo number_format($value, 2);
            }

            $percentage_b1_average = 0;
            if ($kode_jabatan == 2) {
                $percentage_b1_average = 0.3;
            } else if ($kode_jabatan == 3) {
                $percentage_b1_average = 0.35; 
            } else if ($kode_jabatan == 4) {
                $percentage_b1_average = 0.4;
            } else if ($kode_jabatan == 8  || ($kode_jabatan == 4 && $userNpk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) {
                $percentage_b1_average = 0.5;
            }
            $percentage_b2_average = 0;

            if ($kode_jabatan == 2) {
                $percentage_b2_average = 0.2;
            } elseif ($kode_jabatan == 3) {
                $percentage_b2_average = 0.15;
            } elseif ($kode_jabatan == 4 && $userNpk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592]) {
                $percentage_b2_average = 0.1;
            }

            // Hitung hasil sesuai dengan persentase
            $pdca_mid = $procsum['b1_average'] * $percentage_b1_average;
            $pm_mid = $procsum['b2_average'] * $percentage_b2_average;
            foreach ($sum_midyear_total as $d){
                $result_mid = $d['sum_midyear_total'] * 0.5;
            }

            $pdca_one = $procsum['b1_average_one'] * $percentage_b1_average;
            $pm_one = $procsum['b2_average_one'] * $percentage_b2_average;
            foreach ($sum_oneyear_total as $o){
                $result_one = $o['sum_oneyear_total'] * 0.5;
            }

            // Hitung dan tampilkan nilai Mid Year Value
            $midyear_value = $pdca_mid + $pm_mid + $result_mid;
            $value2 = number_format($midyear_value, 2);

            // Hitung dan tampilkan nilai One Year Value
            $oneyear_value = $pdca_one + $pm_one + $result_one;
            $value2_one = number_format($oneyear_value, 2);

            function calculateGrade($value2) {
                if ($value2 < 2) {
                    return "K";
                } else if ($value2 >= 1.99 && $value2 <= 2.495) {
                    return "C";
                } else if ($value2 > 2.494 && $value2 < 3) {
                    return "C+";
                } else if ($value2 >= 2.99 && $value2 <= 3.495) {
                    return "B";
                } else if ($value2 > 3.494 && $value2 < 4) {
                    return "B+";
                } else if ($value2 >= 3.99 && $value2 <= 4.37) {
                    return "BS";
                } else if ($value2 > 4.36 && $value2 <= 4.75) {
                    return "BS+";
                } else if ($value2 > 4.74 && $value2 < 5.01) {
                    return "IST";
                } else {
                    return "";
                }
            }

            function calculateGradeOne($value2_one) {
                if ($value2_one < 2) {
                    return "K";
                } else if ($value2_one >= 1.99 && $value2_one <= 2.495) {
                    return "C";
                } else if ($value2_one > 2.494 && $value2_one < 3) {
                    return "C+";
                } else if ($value2_one >= 2.99 && $value2_one <= 3.495) {
                    return "B";
                } else if ($value2_one > 3.494 && $value2_one < 4) {
                    return "B+";
                } else if ($value2_one >= 3.99 && $value2_one <= 4.37) {
                    return "BS";
                } else if ($value2_one > 4.36 && $value2_one <= 4.75) {
                    return "BS+";
                } else if ($value2_one > 4.74 && $value2_one < 5.01) {
                    return "IST";
                } else {
                    return "";
                }
            }

            // Hitung grade dan tampilkan di elemen input
            $grade = calculateGrade($value2);
            $grade_one = calculateGrade($value2_one);
        ?>

        <table style="width: 100%; font-size: 11px; margin-top: 32px;">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <table style="width: 100%; border-collapse: collapse; border: 2px solid black;">
                            <tbody>
                                <tr style="border-bottom: 1px solid black;">
                                    <th colspan=6 style="height: 25px;">MID YEAR REVIEW</th>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; height: 25px;">A. Result</th>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black; width: 40px;"><?= number_format($value, 2); ?></td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black; width: 40px;">50%</td>
                                    <td style="text-align: center;">=</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black; width: 40px;"><?= isset($procsum['result_mid']) ? number_format($procsum['result_mid'], 2) : '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 30px;"></td>
                                </tr>
                                <tr>
                                    <th colspan=6 style="text-align: left;">B. Process*</th>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 5px;"></td>
                                </tr>
                                <tr>
                                    <td style=" height: 30px;">B1. PDCA & Values</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?= isset($procsum['b1_average']) ? number_format($procsum['b1_average'], 2) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?php
                                            switch ($kode_jabatan) {
                                                case 2:
                                                    echo '30%';
                                                    break;
                                                case 3:
                                                    echo '35%';
                                                    break;
                                                case 4:
                                                    echo '40%';
                                                    break;
                                                case 8:
                                                    echo '50%';
                                                    break;
                                                default:
                                                    echo '40%';
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">=</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;"><?= isset($procsum['pdca_mid']) ? number_format($procsum['pdca_mid'], 2) : ''; ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td style="height: 30px;">B2. People Management</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?= isset($procsum['b2_average']) ? number_format($procsum['b2_average'], 2) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?php
                                            switch ($kode_jabatan) {
                                                case 2:
                                                    echo '20%';
                                                    break;
                                                case 3:
                                                    echo '15%';
                                                    break;
                                                case 4:
                                                    echo '10%';
                                                    break;
                                                default:
                                                    echo '10%';
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">=</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;"><?= isset($procsum['pm_mid']) ? number_format($procsum['pm_mid'], 2) : ''; ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 20px;"></td>
                                </tr>
                                <tr>
                                    <td colspan=4 style="text-align: right;">Mid Year Value</td>
                                    <td></td>
                                    <td style="border: 1px solid black; border-collapse: collapse; text-align: center; height: 25px; width: 40px;"><?= number_format($midyear_value, 2); ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 80px;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width: 8px;"></td>
                    <td style="width: 50%;">
                        <table style="width: 100%; border-collapse: collapse; border: 2px solid black;">
                            <tbody>
                                <tr style=" border-bottom: 1px solid black;">
                                    <th colspan=6 style="height: 25px;">ONE YEAR REVIEW</th>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; height: 25px;">A. Result</th>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black; width: 40px;"><?= isset($procsum['result_one']) ? number_format($value_one, 2) : ''; ?></td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black; width: 40px;"><?= isset($procsum['result_one']) ? '50%' : '' ?></td>
                                    <td style="text-align: center;">=</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black; width: 40px;"><?= isset($procsum['result_one']) ? number_format($procsum['result_one'], 2) : '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 30px;"></td>
                                </tr>
                                <tr>
                                    <th colspan=6 style="text-align: left;">B. Process</th>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 5px;"></td>
                                </tr>
                                <tr>
                                    <td style=" height: 30px;">B1. PDCA & Values</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?= isset($procsum['b1_average_one']) ? number_format($procsum['b1_average_one'], 2) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?php
                                            if(isset($procsum['b1_average_one'])){
                                                switch ($kode_jabatan) {
                                                    case 2:
                                                        echo '30%';
                                                        break;
                                                    case 3:
                                                        echo '35%';
                                                        break;
                                                    case 4:
                                                        echo '40%';
                                                        break;
                                                    case 8:
                                                        echo '50%';
                                                        break;
                                                    default:
                                                        echo '40%';
                                                }
                                            } else {

                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">=</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;"><?= isset($procsum['pdca_one']) ? number_format($procsum['pdca_one'], 2) : ''; ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 15px;"></td>
                                </tr>
                                <tr>
                                    <td style="height: 30px;">B2. People Management</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?= isset($procsum['b2_average_one']) ? number_format($procsum['b2_average_one'], 2) : ''; ?>
                                    </td>
                                    <td style="text-align: center;">X</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;">
                                        <?php
                                            if(isset($procsum['pm_one'])){
                                                switch ($kode_jabatan) {
                                                    case 2:
                                                        echo '20%';
                                                        break;
                                                    case 3:
                                                        echo '15%';
                                                        break;
                                                    case 4:
                                                        echo '10%';
                                                        break;
                                                    default:
                                                        echo '10%';
                                                }
                                            } else {

                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">=</td>
                                    <td style="text-align: center; border-collapse: collapse; border: 1px solid black;"><?= isset($procsum['pm_one']) ? number_format($procsum['pm_one'], 2) : ''; ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 20px;"></td>
                                </tr>
                                <tr>
                                    <td colspan=4 style="text-align: right;">Final Value</td>
                                    <td></td>
                                    <td style="border: 1px solid black; border-collapse: collapse; text-align: center; height: 25px; width: 40px;"><?= isset($procsum['pm_one']) ? number_format($oneyear_value, 2) : '' ; ?></td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 10px;"></td>
                                </tr>
                                <tr>
                                    <td colspan=4 style="text-align: right;">Grade</td>
                                    <td></td>

                                    <td style="border: 1px solid black; border-collapse: collapse; text-align: center; height: 25px; width: 40px;">
                                        <?= isset($procsum['oneyear_value']) ? $grade_one : $grade; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=6 style="height: 40px;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <b style="font-size: 8px;">(*) Untuk PDCA & Values serta People Management di bagian Process diberi bobot berdasarkan<br>
        <span>Golongan karyawan yang dinilai</span></b>

        <table class="kriteria" style="text-align: center; font-size: 8px; border-collapse: collapse;">
            <thead style="border: 1px solid black;">
                <tr>
                    <th>Golongan</th>
                    <th>PDCA-Values</th>
                    <th>People Mgt</th>
                </tr>
            </thead>
            <tbody style="border: 1px solid black;">
                <tr style="border-bottom: 1px solid black;">
                    <td style="border-bottom: 1px solid black;">VI</td>
                    <td>50%</td>
                    <td></td>
                </tr>
                <tr>
                    <td>V</td>
                    <td>30%</td>
                    <td>20%</td>
                </tr>
                <tr>
                    <td>IV E-F</td>
                    <td>35%</td>
                    <td>15%</td>
                </tr>
                <tr>
                    <td>IV A-D</td>
                    <td>40%</td>
                    <td>10%</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>