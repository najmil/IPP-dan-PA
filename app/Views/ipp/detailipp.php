<table class="table table-sm table-striped" id="detail">
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Program/Activity</th>
                                    <th rowspan="2">Weight (%)</th>
                                    <th rowspan="1" colspan="2">Target</th>
                                    <th rowspan="2">Due Date</th>
                                </tr>
                                <tr>
                                    <th>Mid Year</th>
                                    <th>One Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor = 0;
                                    foreach($isidata as $d):
                                        $nomor++;
                                ?>
                                <tr>
                                    <td><?= $nomor; ?></td>
                                    <td><?= $d['program']; ?></td>
                                    <td><?= $d['weight']; ?></td>
                                    <td><p style="white-space:pre-wrap;"><?= $d['midyear']; ?></p></td>
                                    <td><p style="white-space:pre-wrap;"><?= $d['oneyear']; ?></p></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>