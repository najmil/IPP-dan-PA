<!DOCTYPE html>
<html>
<head>
    <title>Strength and Weakness PDF</title>
    <style>
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

        .kop-surat .info-table {
            border-collapse: collapse;
            font-size: 10px;
            text-align: left;
            margin: 0;
            padding: 0;
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
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="kop-surat" style="border-collapse: collapse;">
                    <tr>
                        <td class="table-colapse">
                            <div class="text-left">
                            <!-- Logo -->
                                <img src="http://localhost/ipp/public/img/logo-cbi.png" alt="CBI Logo" style="width: 100%">
                            </div>
                        </td>
                        <td class="table-colapse">
                            <div style="text-align: center;">
                                <h1>Performance Appraisal</h1>
                                <h2>Strength and Weakness (One Year)</h2>
                            </div>
                        </td>
                        <td class="table-colapse">
                            <table class="info-table" style="border-collapse: collapse; font-size: 10px; margin: 35px auto;">
                                <tr>
                                    <td>No. Form:</td>
                                    <td>F/SOP/CHR/005-02</td>
                                </tr>
                                <tr>
                                    <td>Hal:</td>
                                    <td>2 dari 3</td>
                                </tr>
                                <tr>
                                    <td>Revisi ke:</td>
                                    <td>01</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Pembuatan:</td>
                                    <td>18 Oktober 2011</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table style="margin-top: 10px;" class="table-colapse">
                        <tr style="border: none;">
                            <th style="text-align: left">Nama</th>
                            <td>: </td>
                            <td style="width: 608px"> <?= session()->get('nama'); ?></td>
                        </tr>
                        <tr style="border: none;">
                            <th style="text-align: left">Department </th>
                            <td>: </td>
                            <td style="width: 608px"> <?= session()->get('department'); ?></td>
                        </tr>
                        <tr style="border: none;">
                            <th style="text-align: left">Division </th>
                            <td>: </td>
                            <td style="width: 608px"> <?= session()->get('division'); ?></td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <!-- <p>User Name: <?php //echo $userNama ?></p>
    <p>User NPK: <?php //echo $userNpk ?></p> -->
    <!-- Display data from your models here -->
    <table width="100%" style="margin-top: 20px; border-collapse: collapse;">
        <tr>
            <th class="table-colapse" style="width: 50%;">Strong Point</th>
            <th class="table-colapse" style="width: 50%;">Weak Point</th>
        </tr>
        <?php foreach ($strongweak as $s): ?>
        <tr>
            <td class="table-colapse" style="width: 50%; height: 350px; padding: 10px; text-align: left; vertical-align: top;"><?= $s['strong_mid'] ?></td>
            <td class="table-colapse" style="width: 50%; height: 350px; padding: 10px; text-align: left; vertical-align: top;"><?= $s['weak_mid'] ?></td>
        </tr>
        <tr>
            <th class="table-colapse" colspan="3" style="width: 100%;">Notes</th>
        </tr>
        <tr>
            <td class="table-colapse" colspan="3" style="height: 200px; padding: 10px; text-align: left; vertical-align: top;"><?= $s['note_mid'] ?></td>
        </tr>
        <tr>
            <th class="table-colapse" colspan="3" style="width: 100%;">Approval</th>
        </tr>
        <tr>
            <th class="table-colapse" style="width: 33.3%;">Employee</th>
            <th class="table-colapse" style="width: 33.3%;">Appraiser</th>
            <th class="table-colapse" style="width: 33.3%;">Appraiser Spv.</th>
        </tr>
        <tr>
            <?php
                if ($approval['kode_jabatan'] == 8 && !in_array($approval['npk'], [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592])) { 
                    echo '
                        <td class="table-colapse"></td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center">
                            <span style="text-align: center">'. $approval['approval_kasie_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_kasie_strongweak'] . '</span>'.'
                        </td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center">
                            <span style="text-align: center">'. $approval['approval_kadept_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_kadept_strongweak'] . '</span>'.'
                        </td>
                    '; 
                } elseif ($approval['kode_jabatan'] == 4 && ($approval['kode_jabatan'] == 8 && in_array($approval['npk'], [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592]))){ 
                    echo '
                        <td class="table-colapse"></td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center">
                            <span style="text-align: center">'. $approval['approval_kadept_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_kadept_strongweak'] . '</span>'.'
                        </td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center">
                            <span style="text-align: center">'. $approval['approval_kadiv_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_kadiv_strongweak'] . '</span>'.'
                        </td>
                    '; 
                } elseif ($approval['kode_jabatan'] == 3){ 
                    echo '
                        <td class="table-colapse"></td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center; position: relative;"> 
                            <span style="text-align: center">'. $approval['approval_kadiv_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_kadiv_strongweak'] . '</span>'.'
                        </td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center; position: relative;">
                        class="table-colapse"<span style="text-align: center">'. $approval['approval_bod_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_bod_strongweak'] . '</span>'.'
                        </td>
                    '; 
                } elseif ($approval['kode_jabatan'] == 2){ 
                    echo '
                        <td></td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center">
                            <span style="text-align: center">'. $approval['approval_bod_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_bod_strongweak'] . '</span>'.'
                        </td>
                        <td class="table-colapse" style="width: 50%; height: 100px; text-align: center">
                            <span style="text-align: center">'. $approval['approval_presdir_strongweak'] .'</span>
                            <span style="position: absolute; bottom: 0; left: 0;">Date: ' . $approval['approval_date_presdir_strongweak'] . '</span>'.'
                        </td>
                    '; 
                } 
            ?>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>