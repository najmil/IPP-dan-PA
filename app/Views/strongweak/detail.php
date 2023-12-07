<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <?php
                        // dd(!$is_submitted);
                        $periodeModel = new \App\Models\PeriodeModel();
                        $periodeMid = $periodeModel->getLatestMidPeriode();
                        $periodeOne = $periodeModel->getLatestOnePeriode();
                        $isWithinMidPeriode = null;
                        $isWithinOnePeriode = null;
                        // dd($periodeMid);

                        $currentDate = date('Y-m-d H:i:s');
                        if ($periodeMid !== null) {
                            $isWithinMidPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
                        } elseif ($periodeOne !== null) {
                            $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
                        } else {
                            $isWithinMidPeriode = false;
                            $isWithinOnePeriode = false;
                        }
                    ?>

                    <!-- MID YEAR -->
                    <?php if($isWithinMidPeriode || $is_saved_midyear || $is_submitted): ?>
                        <div class="card">
                            <div class="card-header text-center"><b>MID YEAR</b></div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- STRONG POINT -->
                                    <div class="card col-md-6">
                                        <div class="card-header text-center">
                                            <b for="strong_mid">Strong Point</b>
                                        </div>
                                        <div class="card-body">
                                            <!-- Sembunyikan input jika data sudah ada -->
                                            <?php if (isset($strongweak['alc_mid'])):?>
                                                <!-- <textarea class="form-control" id="strong_input" style="margin: 0; width: 100%; height: 300px;" name="strong_mid" readonly><?php// echo $strongweak['strong_mid']; ?></textarea> -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="alc_mid_text">ALC</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="alc_mid_text" data-value="<?= $strongweak['alc_mid']; ?>"><?= $strongweak['alc_mid']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="sub_alc_mid">Key Behavior</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="sub_alc_mid_text" data-value="<?= $strongweak['sub_alc_mid']; ?>"><?= $strongweak['sub_alc_mid']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="strong_mid_alc_text" style="margin: 0; width: 100%; height: 300px;" name="strong_mid_alc" readonly><?= $strongweak['strong_mid_alc']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4" for="technical_mid"><b>Technical</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="technical_mid_text"><?= $strongweak['technical_mid']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="technical_value_mid_text" style="margin: 0; width: 100%; height: 300px;" name="technical_value_mid" readonly><?= $strongweak['technical_value_mid']; ?></textarea>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- <label class="form-label" for="strong_mid">Strong Point</label> -->
                                                <!-- ALC STRONG POINT -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>ALC</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="alc_mid" id="alc_mid" onchange="updateOptions()" style="width: 100%;">
                                                            <option value="" disable>-- Pilih Kategori ALC --</option>
                                                            <option value="Vision & Business Sense">Vision & Business Sense</option>
                                                            <option value="Customer Focus">Customer Focus</option>
                                                            <option value="Interpersonal Skill">Interpesonal Skill</option>
                                                            <option value="Analysis & Judgement">Analysis & Judgement</option>
                                                            <option value="Planning & Driving Action">Planning & Driving Action</option>
                                                            <option value="Leading & Motivating">Leading & Motivating</option>
                                                            <option value="Teamwork">Teamwork</option>
                                                            <option value="Drive & Courage">Drive & Courage</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>Key Behavior</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="sub_alc_mid" id="sub_alc_mid" style="width: 100%;">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea name="strong_mid_alc" id="strong_mid_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['strong_mid_alc']) ? 'is-invalid' : ''; ?>" autofocus placeholder="Keterangan Strong Point (ALC)" oninput="limitCharacters('strong_mid_alc-input', 71)"></textarea>
                                                </div>
                                                
                                                <!-- TECHNICAL STRONG POINT -->
                                                <div class="form-group row mt-3">
                                                    <span class="col-sm-4"><b for="alc_mid">Technical</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <?php //dd(session()->get('id_department'));?>
                                                        <?php
                                                            // dd(session()->get('id_department'));
                                                            if (session()->get('id_department') == 6){
                                                                // MAINTENANCE
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Perpajakan">Perpajakan</option>
                                                                //         <option value="Aset Management">Aset Management</option>
                                                                //         <option value="Accounting Principles">Accounting Principles</option>
                                                                //         <option value="Planning & Budgeting">Planning & Budgeting</option>
                                                                //         <option value="Financial Analysis Skill">Financial Analysis Skill</option>
                                                                //         <option value="Cash Management">Cash Management</option>
                                                                //         <option value="Feasibility Study">Feasibility Study</option>
                                                                //         <option value="Cost Accounting">Cost Accounting</option>
                                                                //         <option value="Kebijakan Standar Akuntansi">Kebijakan Standar Akuntansi</option>
                                                                //         <option value="Business Analysis Skill">Business Analysis Skill</option>
                                                                //         <option value="Corporate Treasury">Corporate Treasury</option>
                                                                //         <option value="Corporate Finance">Corporate Finance</option>
                                                                //         <option value="Financial Modelling">Financial Modelling</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Maintenance management">Maintenance management</option>
                                                                        <option value="Equipment management">Equipment management</option>
                                                                        <option value="Tools management">Tools management</option>
                                                                        <option value="Teknik produksi (bubut, las, milling, drilling, dll)">Teknik produksi (bubut, las, milling, drilling, dll)</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Robotic & automatic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 7){
                                                                // MARKETING
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Negotiation Skill">Negotiation Skill</option>
                                                                //         <option value="Pricing Strategy">Pricing Strategy</option>
                                                                //         <option value="Market Analysis">Market Analysis</option>
                                                                //         <option value="Customer Management">Customer Management</option>
                                                                //         <option value="Branding & Promotion">Branding & Promotion</option>
                                                                //         <option value="Kontrak Kerja">Kontrak Kerja (Customer)</option>
                                                                //         <option value="Networking">Networking</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Pricing strategy">Pricing strategy</option>
                                                                        <option value="Market analysis">Market analysis</option>
                                                                        <option value="Customer management">Customer management</option>
                                                                        <option value="Branding & promotion">Branding & promotion</option>
                                                                        <option value="Kontrak kerja (customer)">Kontrak kerja (customer)</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // FAC & RISK MGT CTRL
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Aset management">Aset management</option>
                                                                        <option value="Accounting principles">Accounting principles</option>
                                                                        <option value="Planning & budgeting">Planning & budgeting</option>
                                                                        <option value="Financial analysis">Financial analysis</option>
                                                                        <option value="Cash management">Cash management</option>
                                                                        <option value="Cost accounting">Cost accounting</option>
                                                                        <option value="Corporate treasury">Corporate treasury</option>
                                                                        <option value="Corporate finance">Corporate finance</option>
                                                                        <option value="Financial modeling">Financial modeling</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 8){
                                                                // MIS
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="General Software">General Software</option>
                                                                //         <option value="Database Management">Database Management</option>
                                                                //         <option value="IoT Infrastructure">IoT Infrastructure</option>
                                                                //         <option value="IT Infrastruktur">IT Infrastruktur</option>
                                                                //         <option value="Human Computer Interaction">Human Computer Interaction</option>
                                                                //         <option value="ERP System">ERP System</option>
                                                                //         <option value="IT Security">IT Security</option>
                                                                //         <option value="System Analyst">System Analyst</option>
                                                                //         <option value="Programming">Programming</option>
                                                                //         <option value="Baan Administration">Baan Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="General software">General software</option>
                                                                        <option value="Database management">Database management</option>
                                                                        <option value="IoT infrastructure">IoT infrastructure</option>
                                                                        <option value="IT infrastruktur">IT infrastruktur</option>
                                                                        <option value="Human computer interaction">Human computer interaction</option>
                                                                        <option value="ERP system">ERP system</option>
                                                                        <option value="IT security">IT security</option>
                                                                        <option value="System analyst">System analyst</option>
                                                                        <option value="Programming">Programming</option>
                                                                        <option value="Baan administration">Baan administration</option>
                                                                        <option value="Business process management">Business process management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production knowledge">Production knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 4){
                                                                // HRD
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="Organization Development">Organization Development</option>
                                                                //         <option value="Recruitment">Recruitment</option>
                                                                //         <option value="People Development">People Development</option>
                                                                //         <option value="Performance & Reward Management">Performance & Reward Management</option>
                                                                //         <option value="Training Management">Training Management</option>
                                                                //         <option value="HR Administration">HR Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Organizationd development">Organizationd development</option>
                                                                        <option value="Recruitment management">Recruitment management</option>
                                                                        <option value="People development">People development</option>
                                                                        <option value="Performance & reward management">Performance & reward management</option>
                                                                        <option value="Training management">Training management</option>
                                                                        <option value="HR administration">HR administration</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 3){
                                                                // GA & IR
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="GA Administration">GA Administration</option>
                                                                //         <option value="Infrastructure Management">Infrastructure Management</option>
                                                                //         <option value="Security Management (ASMS)">Security Management (ASMS)</option>
                                                                //         <option value="CSR (AFC)">CSR (AFC)</option>
                                                                //         <option value="Public Relation Management">Public Relation Management</option>
                                                                //         <option value="Legal Management">Legal Management</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Legal management">Legal management</option>
                                                                        <option value="Public relation management">Public relation management</option>
                                                                        <option value="GA administration">GA administration</option>
                                                                        <option value="Infrastructure management">Infrastructure management</option>
                                                                        <option value="Security management (ASMS)">Security management (ASMS)</option>
                                                                        <option value="CSR (AFC)">CSR (AFC)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 11){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Procurement administration">Procurement administration</option>
                                                                        <option value="Export import">Export import</option>
                                                                        <option value="Price analysis">Price analysis</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Delivery management">Delivery management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 15){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Quality Management">Quality Management</option>
                                                                        <option value="Quality System (QSA)">Quality System (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufactoring Process">Manufactoring Process</option>
                                                                        <option value="Part & component knowlede">Part & component knowlede</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // EHS
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Waste management">Waste management</option>
                                                                        <option value="Pollution control management">Pollution control management</option>
                                                                        <option value="Management energy dan sumber daya alam">Management energy dan sumber daya alam</option>
                                                                        <option value="Fire management system">Fire management system</option>
                                                                        <option value="Safety riding knowledge">Safety riding knowledge</option>
                                                                        <option value="Investigasi dan mitigasi accident/incident skill">Investigasi dan mitigasi accident/incident skill</option>
                                                                        <option value="Emergency respond management">Emergency respond management</option>
                                                                        <option value="Ergonomy">Ergonomy</option>
                                                                        <option value="Behavior based safety">Behavior based safety</option>
                                                                        <option value="Working hazard & risk reduction skill">Working hazard & risk reduction skill</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(in_array(session()->get('id_department'), [13, 14])){
                                                                // PRODUCTION 1 & 2
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronic & control system">Electronic & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 9){
                                                                // PPIC
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Costing">Costing</option>
                                                                        <option value="Warehouse management system">Warehouse management system</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 12){
                                                                // PRODUCT ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing Method">Testing Method</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // PROCESS ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // QUALITY
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Quality system (QSA)">Quality system (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 5){
                                                                // ISD
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 16){
                                                                // SPV S2 & S3
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } //elseif (in_array(session()->get('id_department'), [11, 15, 13, 14, 9, 12, 5, 6, 5])) {
                                                            //     echo '
                                                            //         <select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid">
                                                            //             <option value="" disable>-- Pilih Technical Competency --</option>
                                                            //             <option value="People Management">People Management</option>
                                                            //             <option value="Quality Management">Quality Management</option>
                                                            //             <option value="Environment Management System">Environment Management System</option>
                                                            //             <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                            //             <option value="Equipment Management">Equipment Management</option>
                                                            //             <option value="Tools Management">Tools Management</option>
                                                            //             <option value="Production Planning & Control">Production Planning & Control</option>
                                                            //             <option value="Inventory Control">Inventory Control</option>
                                                            //             <option value="Costing">Costing</option>
                                                            //             <option value="Budget">Budget</option>
                                                            //             <option value="other">Others...</option>
                                                            //         </select>
                                                            //     ';
                                                            // }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea name="technical_value_mid" id="technical_value_mid-input" cols="30" rows="10" class="form-control" <?= isset($errors['technical_value_mid']) ? 'is-invalid' : '' ?> autofocus placeholder="Keterangan Strong Point (Technical Competency)" oninput="limitCharacters('technical_value_mid-input', 71)"></textarea>
                                                </div>
                                                <!-- Tampilkan validation error jika ada -->
                                                <?php // if (isset($errors['strong_mid'])): ?>
                                                    <div class="invalid-feedback"><?= $validation->getError('strong_mid'); ?></div>
                                                <?php // endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- WEAKNESS POINT -->
                                    <div class="card col-md-6">
                                        <div class="card-header text-center">
                                            <label class="form-label">Weakness Point</label>
                                        </div>

                                        <div class="card-body">
                                            <!-- Sembunyikan input jika data sudah ada -->
                                            <?php if (isset($strongweak['weak_alc_mid'])): ?>
                                                <!-- <textarea class="form-control" id="weak_input" style="margin: 0; width: 100%; height: 300px;" name="weak_mid" readonly><?php //echo $strongweak['weak_mid']; ?></textarea> -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="sub_alc_mid">ALC</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="weak_alc_mid_text"><?= $strongweak['weak_alc_mid']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="sub_alc_mid">Key Behavior</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="weak_sub_alc_mid_text"><?= $strongweak['weak_sub_alc_mid']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="weak_mid_alc_text" style="margin: 0; width: 100%; height: 300px;" name="weak_mid_alc_text" readonly><?= $strongweak['weak_mid_alc']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>Technical</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="weak_technical_mid_text"><?= $strongweak['weak_technical_mid']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="weak_technical_value_mid_text" style="margin: 0; width: 100%; height: 300px;" name="weak_technical_value_mid_text" readonly><?= $strongweak['weak_technical_value_mid']; ?></textarea>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- <textarea name="weak_mid" id="weak_mid_input" cols="30" rows="10" class="form-control <?php // isset($errors['weak_mid']) ? 'is-invalid' : ''; ?>" autofocus></textarea> -->
                                                <!-- ALC WEAK POINT -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="alc_mid">ALC</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="weak_alc_mid-input" id="weak_alc_mid-input" onchange="updateOptionsWeak()" style="width: 100%;">
                                                            <option value="" disable>-- Pilih Kategori ALC --</option>
                                                            <option value="Vision & Business Sense">Vision & Business Sense</option>
                                                            <option value="Customer Focus">Customer Focus</option>
                                                            <option value="Interpersonal Skill">Interpersonal Skill</option>
                                                            <option value="Analysis & Judgement">Analysis & Judgement</option>
                                                            <option value="Planning & Driving Action">Planning & Driving Action</option>
                                                            <option value="Leading & Motivating">Leading & Motivating</option>
                                                            <option value="Teamwork">Teamwork</option>
                                                            <option value="Drive & Courage">Drive & Courage</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>Key Behavior</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="weak_sub_alc_mid" id="weak_sub_alc_mid" style="width: 100%;">
                                                            <!-- This select will be populated dynamically based on the choice in the first select. -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea name="weak_mid_alc-input" id="weak_mid_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['weak_mid_alc']) ? 'is-invalid' : ''; ?>" autofocus placeholder="Keterangan Strong Point (ALC)" oninput="limitCharacters('weak_mid_alc-input', 71)"></textarea>
                                                </div>
                                                
                                                <!-- TECHNICAL WEAK POINT -->
                                                <div class="form-group row mt-3">
                                                    <span class="col-sm-4"><b>Technical</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <?php
                                                            // dd(session()->get('id_department'));
                                                            if (session()->get('id_department') == 6){
                                                                // MAINTENANCE
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Perpajakan">Perpajakan</option>
                                                                //         <option value="Aset Management">Aset Management</option>
                                                                //         <option value="Accounting Principles">Accounting Principles</option>
                                                                //         <option value="Planning & Budgeting">Planning & Budgeting</option>
                                                                //         <option value="Financial Analysis Skill">Financial Analysis Skill</option>
                                                                //         <option value="Cash Management">Cash Management</option>
                                                                //         <option value="Feasibility Study">Feasibility Study</option>
                                                                //         <option value="Cost Accounting">Cost Accounting</option>
                                                                //         <option value="Kebijakan Standar Akuntansi">Kebijakan Standar Akuntansi</option>
                                                                //         <option value="Business Analysis Skill">Business Analysis Skill</option>
                                                                //         <option value="Corporate Treasury">Corporate Treasury</option>
                                                                //         <option value="Corporate Finance">Corporate Finance</option>
                                                                //         <option value="Financial Modelling">Financial Modelling</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Maintenance management">Maintenance management</option>
                                                                        <option value="Equipment management">Equipment management</option>
                                                                        <option value="Tools management">Tools management</option>
                                                                        <option value="Teknik produksi (bubut, las, milling, drilling, dll)">Teknik produksi (bubut, las, milling, drilling, dll)</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Robotic & automatic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 15){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Quality Management">Quality Management</option>
                                                                        <option value="Quality System (QSA)">Quality System (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufactoring Process">Manufactoring Process</option>
                                                                        <option value="Part & component knowlede">Part & component knowlede</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 7){
                                                                // MARKETING
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Negotiation Skill">Negotiation Skill</option>
                                                                //         <option value="Pricing Strategy">Pricing Strategy</option>
                                                                //         <option value="Market Analysis">Market Analysis</option>
                                                                //         <option value="Customer Management">Customer Management</option>
                                                                //         <option value="Branding & Promotion">Branding & Promotion</option>
                                                                //         <option value="Kontrak Kerja">Kontrak Kerja (Customer)</option>
                                                                //         <option value="Networking">Networking</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Pricing strategy">Pricing strategy</option>
                                                                        <option value="Market analysis">Market analysis</option>
                                                                        <option value="Customer management">Customer management</option>
                                                                        <option value="Branding & promotion">Branding & promotion</option>
                                                                        <option value="Kontrak kerja (customer)">Kontrak kerja (customer)</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // FAC & RISK MGT CTRL
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Aset management">Aset management</option>
                                                                        <option value="Accounting principles">Accounting principles</option>
                                                                        <option value="Planning & budgeting">Planning & budgeting</option>
                                                                        <option value="Financial analysis">Financial analysis</option>
                                                                        <option value="Cash management">Cash management</option>
                                                                        <option value="Cost accounting">Cost accounting</option>
                                                                        <option value="Corporate treasury">Corporate treasury</option>
                                                                        <option value="Corporate finance">Corporate finance</option>
                                                                        <option value="Financial modeling">Financial modeling</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 8){
                                                                // MIS
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="General Software">General Software</option>
                                                                //         <option value="Database Management">Database Management</option>
                                                                //         <option value="IoT Infrastructure">IoT Infrastructure</option>
                                                                //         <option value="IT Infrastruktur">IT Infrastruktur</option>
                                                                //         <option value="Human Computer Interaction">Human Computer Interaction</option>
                                                                //         <option value="ERP System">ERP System</option>
                                                                //         <option value="IT Security">IT Security</option>
                                                                //         <option value="System Analyst">System Analyst</option>
                                                                //         <option value="Programming">Programming</option>
                                                                //         <option value="Baan Administration">Baan Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="General software">General software</option>
                                                                        <option value="Database management">Database management</option>
                                                                        <option value="IoT infrastructure">IoT infrastructure</option>
                                                                        <option value="IT infrastruktur">IT infrastruktur</option>
                                                                        <option value="Human computer interaction">Human computer interaction</option>
                                                                        <option value="ERP system">ERP system</option>
                                                                        <option value="IT security">IT security</option>
                                                                        <option value="System analyst">System analyst</option>
                                                                        <option value="Programming">Programming</option>
                                                                        <option value="Baan administration">Baan administration</option>
                                                                        <option value="Business process management">Business process management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production knowledge">Production knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 4){
                                                                // HRD
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="Organization Development">Organization Development</option>
                                                                //         <option value="Recruitment">Recruitment</option>
                                                                //         <option value="People Development">People Development</option>
                                                                //         <option value="Performance & Reward Management">Performance & Reward Management</option>
                                                                //         <option value="Training Management">Training Management</option>
                                                                //         <option value="HR Administration">HR Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Organizationd development">Organizationd development</option>
                                                                        <option value="Recruitment management">Recruitment management</option>
                                                                        <option value="People development">People development</option>
                                                                        <option value="Performance & reward management">Performance & reward management</option>
                                                                        <option value="Training management">Training management</option>
                                                                        <option value="HR administration">HR administration</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 3){
                                                                // GA & IR
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="GA Administration">GA Administration</option>
                                                                //         <option value="Infrastructure Management">Infrastructure Management</option>
                                                                //         <option value="Security Management (ASMS)">Security Management (ASMS)</option>
                                                                //         <option value="CSR (AFC)">CSR (AFC)</option>
                                                                //         <option value="Public Relation Management">Public Relation Management</option>
                                                                //         <option value="Legal Management">Legal Management</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Legal management">Legal management</option>
                                                                        <option value="Public relation management">Public relation management</option>
                                                                        <option value="GA administration">GA administration</option>
                                                                        <option value="Infrastructure management">Infrastructure management</option>
                                                                        <option value="Security management (ASMS)">Security management (ASMS)</option>
                                                                        <option value="CSR (AFC)">CSR (AFC)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 11){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Procurement administration">Procurement administration</option>
                                                                        <option value="Export import">Export import</option>
                                                                        <option value="Price analysis">Price analysis</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Delivery management">Delivery management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // EHS
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Waste management">Waste management</option>
                                                                        <option value="Pollution control management">Pollution control management</option>
                                                                        <option value="Management energy dan sumber daya alam">Management energy dan sumber daya alam</option>
                                                                        <option value="Fire management system">Fire management system</option>
                                                                        <option value="Safety riding knowledge">Safety riding knowledge</option>
                                                                        <option value="Investigasi dan mitigasi accident/incident skill">Investigasi dan mitigasi accident/incident skill</option>
                                                                        <option value="Emergency respond management">Emergency respond management</option>
                                                                        <option value="Ergonomy">Ergonomy</option>
                                                                        <option value="Behavior based safety">Behavior based safety</option>
                                                                        <option value="Working hazard & risk reduction skill">Working hazard & risk reduction skill</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(in_array(session()->get('id_department'), [13, 14])){
                                                                // PRODUCTION 1 & 2
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronic & control system">Electronic & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 9){
                                                                // PPIC
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Costing">Costing</option>
                                                                        <option value="Warehouse management system">Warehouse management system</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 12){
                                                                // PRODUCT ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing Method">Testing Method</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // PROCESS ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // QUALITY
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Quality system (QSA)">Quality system (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 5){
                                                                // ISD
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 16){
                                                                // SPV S2 & S3
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid">
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea name="weak_technical_value_mid-input"id="weak_technical_value_mid-input" cols="30" rows="10" class="form-control" <?= isset($errors['weak_technical_value_mid']) ? 'is-invalid' : '' ?> autofocus placeholder="Keterangan Weakness Point (Technical Competency)" oninput="limitCharacters('weak_technical_value_mid-input', 71)"></textarea>
                                                </div>
                                                <!-- Tampilkan validation error jika ada -->
                                                <?php // if (isset($errors['weak_mid'])): ?>
                                                    <div class="invalid-feedback"><?= $validation->getError('weak_mid'); ?></div>
                                                <?php // endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- NOTES -->
                                <div class="mt-3">
                                    <label for="note_input">Notes</label>
                                    <?php if (isset($strongweak['note_mid'])): ?>
                                        <textarea class="form-control" id="note_input" style="margin: 0; width: 100%; height: 300px;" name="note_mid" readonly><?= $strongweak['note_mid']; ?></textarea>
                                    <?php else: ?>
                                        <textarea name="note_mid" id="note_mid_input" cols="30" rows="10" class="form-control <?= isset($errors['note_mid']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters('note_mid_input', 376)"></textarea>
                                        <!-- Tampilkan validation error jika ada -->
                                        <?php // if (isset($errors['note_mid'])): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('note_mid'); ?></div>
                                        <?php // endif; ?>
                                    <?php endif; ?>
                                </div>

                                <input type="hidden" id="id_strongweak_main" name="id_strongweak_main" value="<?= $id_strongweak_main; ?>">
                                <!-- /MID YEAR -->
                            </div>
                        </div>
                    <?php endif;?>

                    <!-- ONE YEAR -->
                    <?php if($is_saved_oneyear || $is_submitted_one || $isWithinOnePeriode): ?>
                        <div class="card" styles="margin-top: 500px;">
                            <div class="card-header text-center"><b>ONE YEAR</b></div>
                            <div class="card-body">
                                <!-- Strength and Weakness -->
                                <div class="row">
                                    <!-- STRENGTH POINT -->
                                    <div class="card col-md-6">
                                        <div class="card-header text-center">
                                            <label class="form-label">Strong Point</label>
                                        </div>
                                        <div class="card-body">
                                            <?php if (isset($strongweak['alc_one'])):?>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="alc_mid">ALC</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="alc_one_text" data-value="<?= $strongweak['alc_one'] ?>"><?= $strongweak['alc_one']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="sub_alc_one">Key Behavior</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="sub_alc_one_text" data-value="<?= $strongweak['alc_one'] ?>"><?= $strongweak['sub_alc_one']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <textarea class="form-control" id="strong_one_alc_text" style="margin: 0; width: 100%; height: 300px;" name="strong_one_alc_text" readonly><?= $strongweak['strong_one_alc']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>Technical</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="technical_one_text"><?= $strongweak['technical_one']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="technical_value_one_text" style="margin: 0; width: 100%; height: 300px;" name="technical_value_one" readonly><?= $strongweak['technical_value_one']; ?></textarea>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- <label class="form-label" for="strong_one">Strong Point</label> -->
                                                <!-- ALC STRONG POINT -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b >ALC</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="alc_one" id="alc_one" onchange="updateOptionsOne()" style="width: 100%;" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?>>
                                                            <option value="" disable>-- Pilih Kategori ALC --</option>
                                                            <option value="Vision & Business Sense">Vision & Business Sense</option>
                                                            <option value="Customer Focus">Customer Focus</option>
                                                            <option value="Interpersonal Skill">Interpersonal Skill</option>
                                                            <option value="Analysis & Judgement">Analysis & Judgement</option>
                                                            <option value="Planning & Driving Action">Planning & Driving Action</option>
                                                            <option value="Leading & Motivating">Leading & Motivating</option>
                                                            <option value="Teamwork">Teamwork</option>
                                                            <option value="Drive & Courage">Drive & Courage</option>
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b >Key Behavior</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="sub_alc_one" id="sub_alc_one" style="width: 100%;"<?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?>>
                                                            <!-- This select will be populated dynamically based on the choice in the first select. -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <textarea name="strong_one_alc" id="strong_one_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['strong_one_alc']) ? 'is-invalid' : ''; ?>" autofocus placeholder="Keterangan Strong Point (ALC)"<?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?> oninput="limitCharacters('strong_one_alc-input', 71)"></textarea>
                                                
                                                <!-- TECHNICAL STRONG POINT -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4 mt-3"><b>Technical</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <?php
                                                            // dd(session()->get('id_department'));
                                                            if (session()->get('id_department') == 6){
                                                                // MAINTENANCE
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Perpajakan">Perpajakan</option>
                                                                //         <option value="Aset Management">Aset Management</option>
                                                                //         <option value="Accounting Principles">Accounting Principles</option>
                                                                //         <option value="Planning & Budgeting">Planning & Budgeting</option>
                                                                //         <option value="Financial Analysis Skill">Financial Analysis Skill</option>
                                                                //         <option value="Cash Management">Cash Management</option>
                                                                //         <option value="Feasibility Study">Feasibility Study</option>
                                                                //         <option value="Cost Accounting">Cost Accounting</option>
                                                                //         <option value="Kebijakan Standar Akuntansi">Kebijakan Standar Akuntansi</option>
                                                                //         <option value="Business Analysis Skill">Business Analysis Skill</option>
                                                                //         <option value="Corporate Treasury">Corporate Treasury</option>
                                                                //         <option value="Corporate Finance">Corporate Finance</option>
                                                                //         <option value="Financial Modelling">Financial Modelling</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Maintenance management">Maintenance management</option>
                                                                        <option value="Equipment management">Equipment management</option>
                                                                        <option value="Tools management">Tools management</option>
                                                                        <option value="Teknik produksi (bubut, las, milling, drilling, dll)">Teknik produksi (bubut, las, milling, drilling, dll)</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Robotic & automatic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 7){
                                                                // MARKETING
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Negotiation Skill">Negotiation Skill</option>
                                                                //         <option value="Pricing Strategy">Pricing Strategy</option>
                                                                //         <option value="Market Analysis">Market Analysis</option>
                                                                //         <option value="Customer Management">Customer Management</option>
                                                                //         <option value="Branding & Promotion">Branding & Promotion</option>
                                                                //         <option value="Kontrak Kerja">Kontrak Kerja (Customer)</option>
                                                                //         <option value="Networking">Networking</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Pricing strategy">Pricing strategy</option>
                                                                        <option value="Market analysis">Market analysis</option>
                                                                        <option value="Customer management">Customer management</option>
                                                                        <option value="Branding & promotion">Branding & promotion</option>
                                                                        <option value="Kontrak kerja (customer)">Kontrak kerja (customer)</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // FAC & RISK MGT CTRL
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Aset management">Aset management</option>
                                                                        <option value="Accounting principles">Accounting principles</option>
                                                                        <option value="Planning & budgeting">Planning & budgeting</option>
                                                                        <option value="Financial analysis">Financial analysis</option>
                                                                        <option value="Cash management">Cash management</option>
                                                                        <option value="Cost accounting">Cost accounting</option>
                                                                        <option value="Corporate treasury">Corporate treasury</option>
                                                                        <option value="Corporate finance">Corporate finance</option>
                                                                        <option value="Financial modeling">Financial modeling</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 15){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="Quality Management">Quality Management</option>
                                                                        <option value="Quality System (QSA)">Quality System (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufactoring Process">Manufactoring Process</option>
                                                                        <option value="Part & component knowlede">Part & component knowlede</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 8){
                                                                // MIS
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="General Software">General Software</option>
                                                                //         <option value="Database Management">Database Management</option>
                                                                //         <option value="IoT Infrastructure">IoT Infrastructure</option>
                                                                //         <option value="IT Infrastruktur">IT Infrastruktur</option>
                                                                //         <option value="Human Computer Interaction">Human Computer Interaction</option>
                                                                //         <option value="ERP System">ERP System</option>
                                                                //         <option value="IT Security">IT Security</option>
                                                                //         <option value="System Analyst">System Analyst</option>
                                                                //         <option value="Programming">Programming</option>
                                                                //         <option value="Baan Administration">Baan Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="General software">General software</option>
                                                                        <option value="Database management">Database management</option>
                                                                        <option value="IoT infrastructure">IoT infrastructure</option>
                                                                        <option value="IT infrastruktur">IT infrastruktur</option>
                                                                        <option value="Human computer interaction">Human computer interaction</option>
                                                                        <option value="ERP system">ERP system</option>
                                                                        <option value="IT security">IT security</option>
                                                                        <option value="System analyst">System analyst</option>
                                                                        <option value="Programming">Programming</option>
                                                                        <option value="Baan administration">Baan administration</option>
                                                                        <option value="Business process management">Business process management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production knowledge">Production knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 4){
                                                                // HRD
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="Organization Development">Organization Development</option>
                                                                //         <option value="Recruitment">Recruitment</option>
                                                                //         <option value="People Development">People Development</option>
                                                                //         <option value="Performance & Reward Management">Performance & Reward Management</option>
                                                                //         <option value="Training Management">Training Management</option>
                                                                //         <option value="HR Administration">HR Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                    <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Organizationd development">Organizationd development</option>
                                                                        <option value="Recruitment management">Recruitment management</option>
                                                                        <option value="People development">People development</option>
                                                                        <option value="Performance & reward management">Performance & reward management</option>
                                                                        <option value="Training management">Training management</option>
                                                                        <option value="HR administration">HR administration</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 3){
                                                                // GA & IR
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="GA Administration">GA Administration</option>
                                                                //         <option value="Infrastructure Management">Infrastructure Management</option>
                                                                //         <option value="Security Management (ASMS)">Security Management (ASMS)</option>
                                                                //         <option value="CSR (AFC)">CSR (AFC)</option>
                                                                //         <option value="Public Relation Management">Public Relation Management</option>
                                                                //         <option value="Legal Management">Legal Management</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Legal management">Legal management</option>
                                                                        <option value="Public relation management">Public relation management</option>
                                                                        <option value="GA administration">GA administration</option>
                                                                        <option value="Infrastructure management">Infrastructure management</option>
                                                                        <option value="Security management (ASMS)">Security management (ASMS)</option>
                                                                        <option value="CSR (AFC)">CSR (AFC)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 11){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Procurement administration">Procurement administration</option>
                                                                        <option value="Export import">Export import</option>
                                                                        <option value="Price analysis">Price analysis</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Delivery management">Delivery management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // EHS
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Waste management">Waste management</option>
                                                                        <option value="Pollution control management">Pollution control management</option>
                                                                        <option value="Management energy dan sumber daya alam">Management energy dan sumber daya alam</option>
                                                                        <option value="Fire management system">Fire management system</option>
                                                                        <option value="Safety riding knowledge">Safety riding knowledge</option>
                                                                        <option value="Investigasi dan mitigasi accident/incident skill">Investigasi dan mitigasi accident/incident skill</option>
                                                                        <option value="Emergency respond management">Emergency respond management</option>
                                                                        <option value="Ergonomy">Ergonomy</option>
                                                                        <option value="Behavior based safety">Behavior based safety</option>
                                                                        <option value="Working hazard & risk reduction skill">Working hazard & risk reduction skill</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(in_array(session()->get('id_department'), [13, 14])){
                                                                // PRODUCTION 1 & 2
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronic & control system">Electronic & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 9){
                                                                // PPIC
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Costing">Costing</option>
                                                                        <option value="Warehouse management system">Warehouse management system</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 12){
                                                                // PRODUCT ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing Method">Testing Method</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // PROCESS ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // QUALITY
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Quality system (QSA)">Quality system (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 5){
                                                                // ISD
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 16){
                                                                // SPV S2 & S3
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="technical_one" id="technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } //elseif (in_array(session()->get('id_department'), [11, 15, 13, 14, 9, 12, 5, 6, 5])) {
                                                            //     echo '
                                                            //         <select class="form-control" name="technical_one" id="technical_one"'. ($isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled' : '') .'>
                                                            //             <option value="" disable>-- Pilih Technical Competency --</option>
                                                            //             <option value="People Management">People Management</option>
                                                            //             <option value="Quality Management">Quality Management</option>
                                                            //             <option value="Environment Management System">Environment Management System</option>
                                                            //             <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                            //             <option value="Equipment Management">Equipment Management</option>
                                                            //             <option value="Tools Management">Tools Management</option>
                                                            //             <option value="Production Planning & Control">Production Planning & Control</option>
                                                            //             <option value="Inventory Control">Inventory Control</option>
                                                            //             <option value="Costing">Costing</option>
                                                            //             <option value="Budget">Budget</option>
                                                            //             <option value="other">Others...</option>
                                                            //         </select>
                                                            //     ';
                                                            // }

                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea name="technical_value_one" id="technical_value_one-input" cols="30" rows="10" class="form-control" autofocus placeholder="Keterangan Strong Point (Technical Competency)" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled' : '' ?> oninput="limitCharacters('technical_value_one-input', 71)"></textarea>
                                                </div>
                                                <!-- Tampilkan validation error jika ada -->
                                                <?php // if (isset($errors['strong_one'])): ?>
                                                    <div class="invalid-feedback"><?= $validation->getError('technical_value_one'); ?></div>
                                                <?php // endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- WEAKNESS POINT -->
                                    <div class="card col-md-6">
                                        <div class="card-header text-center">
                                            <label class="form-label" for="weak_one">Weak Point</label>
                                        </div>

                                        <div class="card-body">
                                            <!-- Sembunyikan input jika data sudah ada -->
                                            <?php if (isset($strongweak['weak_alc_one'])): ?>
                                                <!-- <textarea class="form-control" id="weak_input" style="margin: 0; width: 100%; height: 300px;" name="weak_one" readonly><?php //echo $strongweak['weak_one']; ?></textarea> -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>ALC</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="weak_alc_one_text"><?= $strongweak['weak_alc_one']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>Key Behaviour</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="weak_sub_alc_one_text"><?= $strongweak['weak_sub_alc_one']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="weak_one_alc_text" style="margin: 0; width: 100%; height: 300px;" name="weak_one_alc_text" readonly><?= $strongweak['weak_one_alc']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b>Technical</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <span id="weak_one_alc_text"><?= $strongweak['weak_technical_one']; ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="weak_technical_value_one_text" style="margin: 0; width: 100%; height: 300px;" name="weak_technical_value_one_text" readonly><?= $strongweak['weak_technical_value_one']; ?></textarea>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <!-- <textarea name="weak_one" id="weak_one_input" cols="30" rows="10" class="form-control <?php // isset($errors['weak_one']) ? 'is-invalid' : ''; ?>" autofocus></textarea> -->
                                                <!-- ALC WEAK POINT -->
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="alc_mid">ALC</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="weak_alc_one" id="weak_alc_one-input" onchange="updateOptionsWeakOne()" style="width: 100%;" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?>>
                                                            <option value="" disable>-- Pilih Kategori ALC --</option>
                                                            <option value="Vision & Business Sense">Vision & Business Sense</option>
                                                            <option value="Customer Focus">Customer Focus</option>
                                                            <option value="Interpersonal Skill">Interpersonal Skill</option>
                                                            <option value="Analysis & Judgement">Analysis & Judgement</option>
                                                            <option value="Planning & Driving Action">Planning & Driving Action</option>
                                                            <option value="Leading & Motivating">Leading & Motivating</option>
                                                            <option value="Teamwork">Teamwork</option>
                                                            <option value="Drive & Courage">Drive & Courage</option>
                                                        </select>
                                                    </div> 
                                                </div> 
                                                <div class="form-group row">
                                                    <span class="col-sm-4"><b for="alc_mid">Key Behavior</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <select class="form-control mb-2" name="weak_sub_alc_one" id="weak_sub_alc_one" style="width: 100%;" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?>>
                                                            <!-- This select will be populated dynamically based on the choice in the first select. -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <textarea name="weak_one_alc-input" id="weak_one_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['weak_one_alc']) ? 'is-invalid' : ''; ?>" autofocus placeholder="Keterangan Weak Point (ALC)" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?> oninput="limitCharacters('weak_one_alc-input', 71)"></textarea>
                                                
                                                <!-- TECHNICAL WEAK POINT -->
                                                <div class="form-group row mt-3">
                                                    <span class="col-sm-4"><b>Technical</b><b style="color: red; font-size: 15px; vertical-align: top; margin-left: 5px;">*</b></span>
                                                    <span class="col-sm-1"><b>:</b></span>
                                                    <div class="col-sm-7">
                                                        <?php
                                                            if (session()->get('id_department') == 6){
                                                                // MAINTENANCE
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Perpajakan">Perpajakan</option>
                                                                //         <option value="Aset Management">Aset Management</option>
                                                                //         <option value="Accounting Principles">Accounting Principles</option>
                                                                //         <option value="Planning & Budgeting">Planning & Budgeting</option>
                                                                //         <option value="Financial Analysis Skill">Financial Analysis Skill</option>
                                                                //         <option value="Cash Management">Cash Management</option>
                                                                //         <option value="Feasibility Study">Feasibility Study</option>
                                                                //         <option value="Cost Accounting">Cost Accounting</option>
                                                                //         <option value="Kebijakan Standar Akuntansi">Kebijakan Standar Akuntansi</option>
                                                                //         <option value="Business Analysis Skill">Business Analysis Skill</option>
                                                                //         <option value="Corporate Treasury">Corporate Treasury</option>
                                                                //         <option value="Corporate Finance">Corporate Finance</option>
                                                                //         <option value="Financial Modelling">Financial Modelling</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Maintenance management">Maintenance management</option>
                                                                        <option value="Equipment management">Equipment management</option>
                                                                        <option value="Tools management">Tools management</option>
                                                                        <option value="Teknik produksi (bubut, las, milling, drilling, dll)">Teknik produksi (bubut, las, milling, drilling, dll)</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Robotic & automatic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 15){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="Quality Management">Quality Management</option>
                                                                        <option value="Quality System (QSA)">Quality System (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufactoring Process">Manufactoring Process</option>
                                                                        <option value="Part & component knowlede">Part & component knowlede</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 7){
                                                                // MARKETING
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Negotiation Skill">Negotiation Skill</option>
                                                                //         <option value="Pricing Strategy">Pricing Strategy</option>
                                                                //         <option value="Market Analysis">Market Analysis</option>
                                                                //         <option value="Customer Management">Customer Management</option>
                                                                //         <option value="Branding & Promotion">Branding & Promotion</option>
                                                                //         <option value="Kontrak Kerja">Kontrak Kerja (Customer)</option>
                                                                //         <option value="Networking">Networking</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Pricing strategy">Pricing strategy</option>
                                                                        <option value="Market analysis">Market analysis</option>
                                                                        <option value="Customer management">Customer management</option>
                                                                        <option value="Branding & promotion">Branding & promotion</option>
                                                                        <option value="Kontrak kerja (customer)">Kontrak kerja (customer)</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // FAC & RISK MGT CTRL
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Aset management">Aset management</option>
                                                                        <option value="Accounting principles">Accounting principles</option>
                                                                        <option value="Planning & budgeting">Planning & budgeting</option>
                                                                        <option value="Financial analysis">Financial analysis</option>
                                                                        <option value="Cash management">Cash management</option>
                                                                        <option value="Cost accounting">Cost accounting</option>
                                                                        <option value="Corporate treasury">Corporate treasury</option>
                                                                        <option value="Corporate finance">Corporate finance</option>
                                                                        <option value="Financial modeling">Financial modeling</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part and component knowledge">Part and component knowledge</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 8){
                                                                // MIS
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Equipment Management">Equipment Management</option>
                                                                //         <option value="Production Planning & Control">Production Planning & Control</option>
                                                                //         <option value="Inventory Control">Inventory Control</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="General Software">General Software</option>
                                                                //         <option value="Database Management">Database Management</option>
                                                                //         <option value="IoT Infrastructure">IoT Infrastructure</option>
                                                                //         <option value="IT Infrastruktur">IT Infrastruktur</option>
                                                                //         <option value="Human Computer Interaction">Human Computer Interaction</option>
                                                                //         <option value="ERP System">ERP System</option>
                                                                //         <option value="IT Security">IT Security</option>
                                                                //         <option value="System Analyst">System Analyst</option>
                                                                //         <option value="Programming">Programming</option>
                                                                //         <option value="Baan Administration">Baan Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="General software">General software</option>
                                                                        <option value="Database management">Database management</option>
                                                                        <option value="IoT infrastructure">IoT infrastructure</option>
                                                                        <option value="IT infrastruktur">IT infrastruktur</option>
                                                                        <option value="Human computer interaction">Human computer interaction</option>
                                                                        <option value="ERP system">ERP system</option>
                                                                        <option value="IT security">IT security</option>
                                                                        <option value="System analyst">System analyst</option>
                                                                        <option value="Programming">Programming</option>
                                                                        <option value="Baan administration">Baan administration</option>
                                                                        <option value="Business process management">Business process management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production knowledge">Production knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 4){
                                                                // HRD
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="Organization Development">Organization Development</option>
                                                                //         <option value="Recruitment">Recruitment</option>
                                                                //         <option value="People Development">People Development</option>
                                                                //         <option value="Performance & Reward Management">Performance & Reward Management</option>
                                                                //         <option value="Training Management">Training Management</option>
                                                                //         <option value="HR Administration">HR Administration</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Organizationd development">Organizationd development</option>
                                                                        <option value="Recruitment management">Recruitment management</option>
                                                                        <option value="People development">People development</option>
                                                                        <option value="Performance & reward management">Performance & reward management</option>
                                                                        <option value="Training management">Training management</option>
                                                                        <option value="HR administration">HR administration</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 3){
                                                                // GA & IR
                                                                // echo '
                                                                //     <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                //         <option value="" disable>-- Pilih Technical Competency --</option>
                                                                //         <option value="People Management">People Management</option>
                                                                //         <option value="Quality Management">Quality Management</option>
                                                                //         <option value="Environment Management System">Environment Management System</option>
                                                                //         <option value="Health and Safety Management System">Health and Safety Management System</option>
                                                                //         <option value="Costing">Costing</option>
                                                                //         <option value="Budget">Budget</option>
                                                                //         <option value="Industrial Relation & Termination">Industrial Relation & Termination</option>
                                                                //         <option value="GA Administration">GA Administration</option>
                                                                //         <option value="Infrastructure Management">Infrastructure Management</option>
                                                                //         <option value="Security Management (ASMS)">Security Management (ASMS)</option>
                                                                //         <option value="CSR (AFC)">CSR (AFC)</option>
                                                                //         <option value="Public Relation Management">Public Relation Management</option>
                                                                //         <option value="Legal Management">Legal Management</option>
                                                                //         <option value="other">Others...</option>
                                                                //     </select>
                                                                // ';
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Industrial relation & termination">Industrial relation & termination</option>
                                                                        <option value="Legal management">Legal management</option>
                                                                        <option value="Public relation management">Public relation management</option>
                                                                        <option value="GA administration">GA administration</option>
                                                                        <option value="Infrastructure management">Infrastructure management</option>
                                                                        <option value="Security management (ASMS)">Security management (ASMS)</option>
                                                                        <option value="CSR (AFC)">CSR (AFC)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 11){
                                                                // PROCUREMENT
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Negotiation skill">Negotiation skill</option>
                                                                        <option value="Perpajakan">Perpajakan</option>
                                                                        <option value="Procurement administration">Procurement administration</option>
                                                                        <option value="Export import">Export import</option>
                                                                        <option value="Price analysis">Price analysis</option>
                                                                        <option value="Networking">Networking</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Delivery management">Delivery management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // EHS
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Waste management">Waste management</option>
                                                                        <option value="Pollution control management">Pollution control management</option>
                                                                        <option value="Management energy dan sumber daya alam">Management energy dan sumber daya alam</option>
                                                                        <option value="Fire management system">Fire management system</option>
                                                                        <option value="Safety riding knowledge">Safety riding knowledge</option>
                                                                        <option value="Investigasi dan mitigasi accident/incident skill">Investigasi dan mitigasi accident/incident skill</option>
                                                                        <option value="Emergency respond management">Emergency respond management</option>
                                                                        <option value="Ergonomy">Ergonomy</option>
                                                                        <option value="Behavior based safety">Behavior based safety</option>
                                                                        <option value="Working hazard & risk reduction skill">Working hazard & risk reduction skill</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Process knowledge">Process knowledge</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(in_array(session()->get('id_department'), [13, 14])){
                                                                // PRODUCTION 1 & 2
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronic & control system">Electronic & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 9){
                                                                // PPIC
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Costing">Costing</option>
                                                                        <option value="Warehouse management system">Warehouse management system</option>
                                                                        <option value="Vendor management">Vendor management</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 12){
                                                                // PRODUCT ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing Method">Testing Method</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 2){
                                                                // PROCESS ENGINEERING
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 1){
                                                                // QUALITY
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="Quality system (QSA)">Quality system (QSA)</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Part & component knowledge">Part & component knowledge</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Testing method">Testing method</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Inventory management">Inventory management</option>
                                                                        <option value="EHS management">EHS management</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 5){
                                                                // ISD
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Robotic & automatic system">Robotic & automatic system</option>
                                                                        <option value="Manufacturing process design">Manufacturing process design</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component design">Part & component design</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product design">Product design</option>
                                                                        <option value="Prototyping">Prototyping</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Delivery system">Delivery system</option>
                                                                        <option value="Electrical & power system">Electrical & power system</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Piping system">Piping system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            } elseif(session()->get('id_department') == 16){
                                                                // SPV S2 & S3
                                                                echo '
                                                                    <select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one">
                                                                        <option value="" disable>-- Pilih Technical Competency --</option>
                                                                        <option value="Production system">Production system</option>
                                                                        <option value="Manufacturing process">Manufacturing process</option>
                                                                        <option value="Technical drawing">Technical drawing</option>
                                                                        <option value="Part & component">Part & component</option>
                                                                        <option value="Material knowledge">Material knowledge</option>
                                                                        <option value="Product knowledge">Product knowledge</option>
                                                                        <option value="Quality management">Quality management</option>
                                                                        <option value="EHS management system">EHS management system</option>
                                                                        <option value="Inventory control">Inventory control</option>
                                                                        <option value="Production planning & control">Production planning & control</option>
                                                                        <option value="Failure analysis">Failure analysis</option>
                                                                        <option value="Pengelolaan material B3">Pengelolaan material B3</option>
                                                                        <option value="Electronical & control system">Electronical & control system</option>
                                                                        <option value="Pneumatic & hydrolic system">Pneumatic & hydrolic system</option>
                                                                        <option value="other">Others...</option>
                                                                    </select>
                                                                ';
                                                            }

                                                            // dd(session()->get('id_department'));
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea name="weak_technical_value_one" id="weak_technical_value_one-input" cols="30" rows="10" class="form-control" autofocus placeholder="Keterangan Weak Point (Technical Competency)" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled' : ''?> oninput="limitCharacters('weak_technical_value_one-input', 71)"></textarea>
                                                </div>
                                                <!-- Tampilkan validation error jika ada -->
                                                <?php // if (isset($errors['weak_one'])): ?>
                                                    <div class="invalid-feedback"><?= $validation->getError('weak_technical_value_one-input'); ?></div>
                                                <?php // endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="mt-3">
                                    <label for="note_one_input">Notes</label>
                                    <?php if (isset($strongweak['note_one'])): ?>
                                        <textarea class="form-control" id="note_one_input" style="margin: 0; width: 100%; height: 300px;" name="note_one_input" readonly><?= $strongweak['note_one']; ?></textarea>
                                    <?php else: ?>
                                        <textarea name="note_one" id="note_one_input" cols="30" rows="10" class="form-control <?= isset($errors['note_one']) ? 'is-invalid' : ''; ?>" <?= $isWithinMidPeriode || !$isWithinOnePeriode ? 'disabled': '';?> oninput="limitCharacters('note_one_input', 376)"></textarea>
                                        <!-- Tampilkan validation error jika ada -->
                                        <?php // if (isset($errors['note_one'])): ?>
                                            <div class="invalid-feedback"><?= $validation->getError('note_one'); ?></div>
                                        <?php // endif; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- /ONE YEAR -->
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mt-3" id="submitBtnContainer">
                        <a href="<?= base_url('strongweak/index') ?>" class="btn btn-primary mr-2 btn-sm" style="width: 100px; height: 30px;">Back</a>
                            <?php      
                                // dd($is_submitted);                          
                                if ($isWithinMidPeriode && !$is_submitted) {
                                    if (empty($strongweak)){
                                        echo '<button type="button" id="save" class="btn btn-success btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Save
                                        </button>';
                                    } else {
                                        echo '<button type="button" id="submitBtn" class="btn btn-danger btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Submit
                                        </button>
                                        <button type="button" id="edit" class="btn btn-warning btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Edit All
                                        </button>
                                        <button type="button" id="save-edit" class="btn btn-success btn-sm ml-2 mr-2" style="display: none; width: 100px; height: 30px;">
                                            Save
                                        </button>';
                                    }
                                } elseif ($isWithinOnePeriode && !$is_submitted_one){
                                    if($is_saved_oneyear == null || $is_saved_oneyear == 0){
                                        echo '<button type="button" id="save-one" class="btn btn-success btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Save
                                        </button>';
                                    } else {
                                        echo '<button type="button" id="submitone" class="btn btn-danger btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Submit
                                        </button>
                                        <button type="button" id="edit-one" class="btn btn-warning btn-sm mr-2 ml-2" style="width: 100px; height: 30px;">
                                            Edit All
                                        </button>
                                        <button type="button" id="save-edit-one" class="btn btn-success btn-sm ml-2 mr-2" style="display: none; width: 100px; height: 30px;">
                                            Save
                                        </button>';
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$selectedTechnicalMid = isset($strongweak['technical_mid']) ? $strongweak['technical_mid'] : ''; 
$selectedWeakTechMid = isset($strongweak['weak_technical_mid']) ? $strongweak['weak_technical_mid'] : ''; 
$selectedTechnicalOne = isset($strongweak['technical_one']) ? $strongweak['technical_one'] : ''; 
$selectedWeakTechOne = isset($strongweak['weak_technical_one']) ? $strongweak['weak_technical_one'] : ''; 

// dd($selectedTechnicalMid); ?>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>

    // Untuk memberikan jumlah maksimal kata yang boleh dimasukkan ke dalam textarea
    function limitCharacters(textareaId, limit) {
        var textarea = document.getElementById(textareaId);

        // Menampilkan pesan peringatan jika mencapai batas karakter saat keyboard aktif
        textarea.addEventListener('keyup', function() {
            var inputText = textarea.value;

            // Menghapus kelas 'is-invalid' jika input valid
            textarea.classList.remove('is-invalid');

            // Menghapus pesan peringatan
            var existingFeedback = textarea.nextElementSibling;
            if (existingFeedback && existingFeedback.classList.contains('invalid-feedback')) {
                existingFeedback.parentNode.removeChild(existingFeedback);
            }

            // Menampilkan pesan peringatan jika mencapai batas karakter
            if (inputText.length >= limit) {
                // Menambahkan kelas 'is-invalid' untuk menandai bahwa input tidak valid
                textarea.classList.add('is-invalid');

                // Menampilkan pesan peringatan dalam elemen dengan kelas 'invalid-feedback'
                var invalidFeedback = document.createElement('div');
                invalidFeedback.classList.add('invalid-feedback');
                invalidFeedback.innerHTML = 'Maksimal ' + (limit-1) + ' karakter diizinkan.';
                
                // Mencari atau membuat elemen dengan kelas 'invalid-feedback'
                var existingFeedback = textarea.nextElementSibling;
                if (existingFeedback && existingFeedback.classList.contains('invalid-feedback')) {
                    existingFeedback.innerHTML = 'Maksimal ' + limit + ' karakter diizinkan.';
                } else {
                    textarea.parentNode.appendChild(invalidFeedback);
                }
            }
        });

        // Menghapus kelas 'is-invalid' dan pesan peringatan jika pengguna mencoba mengetik lagi
        textarea.addEventListener('input', function() {
            // Menghapus kelas 'is-invalid' jika input valid
            textarea.classList.remove('is-invalid');

            // Menghapus pesan peringatan
            var existingFeedback = textarea.nextElementSibling;
            if (existingFeedback && existingFeedback.classList.contains('invalid-feedback')) {
                existingFeedback.parentNode.removeChild(existingFeedback);
            }
        });

        // Memastikan bahwa teks tidak melebihi batas karakter saat pertama kali dimuat
        if (textarea.value.length > limit) {
            textarea.value = textarea.value.substring(0, limit);
        }
    }

    function updateOptions() {
        var alcSelect = document.getElementById("alc_mid");
        var subOptionsSelect = document.getElementById("sub_alc_mid");

        subOptionsSelect.innerHTML = "";

        var selectedValue = alcSelect.value;

        if (selectedValue === "Vision & Business Sense") {
            var options = ["Vision, turunan inisiatif kunci", "Kemungkinan perubahan \"peluang & risiko\"", "Data & fakta keuangan, cost & benefit - operational excellence"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Customer Focus") {
            var options = ["Memahami kebutuhan pelanggan", "Antisipasi perubahan kebutuhan stakeholder", "Merespon perubahan kebutuhan stakeholder", "Membina hubungan dengan stakeholder", "Memberikan layanan yang unggul", "Ide improvement untuk mencapai standar kualitas layanan", "Memonitor tingkat kepuasan pelaggan"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Interpersonal Skill") {
            var options = ["Membangun hubungan yang konstruktif dan efektif", "Meyakinakan orang lain dengan menggunakan data, fakta, dan media", "Mengelola emosi dalam menghadapi permasalahan", "Peka terhadap kebutuhan rekan kerja"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Analysis & Judgement") {
            var options = ["Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.", "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.", "Mengajukan solusi yang cepat dan tepat.", "Mengantisipasi permasalahan yang akan muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Planning & Driving Action") {
            var options = ["Menerjemahkan AP dept ke AP unit kerja", "Keselarasan AP seksi dengan goal organisasi", "Pemantauan kemajuan kerja berkala (PDCA).", "Mengidentifikasi sumber daya.", "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Leading & Motivating") {
            var options = ["Pemetaan kebutuhan kompetensi bawahan.", "Mendelegasikan tugas kepada bawahan.", "Menakar potensi bawahan agar beban kerja optimal.", "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.", "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.", "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.", "Melakukan pengembangan kader penerus kepemimpinannya.", "Menerapkan perilaku yang sesuai dengan nilai perusahaan.", "Membangun suasana kerja yang positif.", "Mampu mengelola perubahan yang muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Teamwork") {
            var options = ["Dukungan semangat dan moril ke anggota kelompok.", "Kesediaan saling berbagi informasi maupun sumber daya.", "Bekerjasama dengan siapa saja dalam keragaman generasi.", "Memahami kebutuhan stakeholder.", "Kerjasama yang efektif atau tepat sasaran.", "Dukungan dari unit kerja lain."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Drive & Courage") {
            var options = ["Menuntaskan pekerjaan meskipun ada hambatan.", "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.", "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.", "Menetapkan target yang lebih tinggi dari sebelumnya.", "Mengambil risiko untuk memutuskan permasalahan genting.", "Melakukan cara di luar kebiasaan dalam mencapai tujuan.", "Bertanggungjawab atas kesalahan yang pernah dibuat."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        }
    }
    
    function updateOptionsWeak() {
        var alcSelect = document.getElementById("weak_alc_mid-input");
        var subOptionsSelect = document.getElementById("weak_sub_alc_mid");

        subOptionsSelect.innerHTML = "";

        var selectedValue = alcSelect.value;

        if (selectedValue === "Vision & Business Sense") {
            var options = ["Vision, turunan inisiatif kunci", "Kemungkinan perubahan \"peluang & risiko\"", "Data & fakta keuangan, cost & benefit - operational excellence"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Customer Focus") {
            var options = ["Memahami kebutuhan pelanggan", "Antisipasi perubahan kebutuhan stakeholder", "Merespon perubahan kebutuhan stakeholder", "Membina hubungan dengan stakeholder", "Memberikan layanan yang unggul", "Ide improvement untuk mencapai standar kualitas layanan", "Memonitor tingkat kepuasan pelaggan"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Interpersonal Skill") {
            var options = ["Membangun hubungan yang konstruktif dan efektif", "Meyakinakan orang lain dengan menggunakan data, fakta, dan media", "Mengelola emosi dalam menghadapi permasalahan", "Peka terhadap kebutuhan rekan kerja"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Analysis & Judgement") {
            var options = ["Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.", "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.", "Mengajukan solusi yang cepat dan tepat.", "Mengantisipasi permasalahan yang akan muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Planning & Driving Action") {
            var options = ["Menerjemahkan AP dept ke AP unit kerja", "Keselarasan AP seksi dengan goal organisasi", "Pemantauan kemajuan kerja berkala (PDCA).", "Mengidentifikasi sumber daya.", "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Leading & Motivating") {
            var options = ["Pemetaan kebutuhan kompetensi bawahan.", "Mendelegasikan tugas kepada bawahan.", "Menakar potensi bawahan agar beban kerja optimal.", "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.", "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.", "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.", "Melakukan pengembangan kader penerus kepemimpinannya.", "Menerapkan perilaku yang sesuai dengan nilai perusahaan.", "Membangun suasana kerja yang positif.", "Mampu mengelola perubahan yang muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Teamwork") {
            var options = ["Dukungan semangat dan moril ke anggota kelompok.", "Kesediaan saling berbagi informasi maupun sumber daya.", "Bekerjasama dengan siapa saja dalam keragaman generasi.", "Memahami kebutuhan stakeholder.", "Kerjasama yang efektif atau tepat sasaran.", "Dukungan dari unit kerja lain."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Drive & Courage") {
            var options = ["Menuntaskan pekerjaan meskipun ada hambatan.", "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.", "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.", "Menetapkan target yang lebih tinggi dari sebelumnya.", "Mengambil risiko untuk memutuskan permasalahan genting.", "Melakukan cara di luar kebiasaan dalam mencapai tujuan.", "Bertanggungjawab atas kesalahan yang pernah dibuat."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        }

        // You can add more conditions for other options as needed.
    }

    function updateOptionsOne() {
        var alcSelect = document.getElementById("alc_one");
        var subOptionsSelect = document.getElementById("sub_alc_one");

        subOptionsSelect.innerHTML = "";

        var selectedValue = alcSelect.value;

        if (selectedValue === "Vision & Business Sense") {
            var options = ["Vision, turunan inisiatif kunci", "Kemungkinan perubahan \"peluang & risiko\"", "Data & fakta keuangan, cost & benefit - operational excellence"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Customer Focus") {
            var options = ["Memahami kebutuhan pelanggan", "Antisipasi perubahan kebutuhan stakeholder", "Merespon perubahan kebutuhan stakeholder", "Membina hubungan dengan stakeholder", "Memberikan layanan yang unggul", "Ide improvement untuk mencapai standar kualitas layanan", "Memonitor tingkat kepuasan pelaggan"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Interpersonal Skill") {
            var options = ["Membangun hubungan yang konstruktif dan efektif", "Meyakinakan orang lain dengan menggunakan data, fakta, dan media", "Mengelola emosi dalam menghadapi permasalahan", "Peka terhadap kebutuhan rekan kerja"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Analysis & Judgement") {
            var options = ["Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.", "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.", "Mengajukan solusi yang cepat dan tepat.", "Mengantisipasi permasalahan yang akan muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Planning & Driving Action") {
            var options = ["Menerjemahkan AP dept ke AP unit kerja", "Keselarasan AP seksi dengan goal organisasi", "Pemantauan kemajuan kerja berkala (PDCA).", "Mengidentifikasi sumber daya.", "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Leading & Motivating") {
            var options = ["Pemetaan kebutuhan kompetensi bawahan.", "Mendelegasikan tugas kepada bawahan.", "Menakar potensi bawahan agar beban kerja optimal.", "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.", "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.", "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.", "Melakukan pengembangan kader penerus kepemimpinannya.", "Menerapkan perilaku yang sesuai dengan nilai perusahaan.", "Membangun suasana kerja yang positif.", "Mampu mengelola perubahan yang muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Teamwork") {
            var options = ["Dukungan semangat dan moril ke anggota kelompok.", "Kesediaan saling berbagi informasi maupun sumber daya.", "Bekerjasama dengan siapa saja dalam keragaman generasi.", "Memahami kebutuhan stakeholder.", "Kerjasama yang efektif atau tepat sasaran.", "Dukungan dari unit kerja lain."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Drive & Courage") {
            var options = ["Menuntaskan pekerjaan meskipun ada hambatan.", "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.", "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.", "Menetapkan target yang lebih tinggi dari sebelumnya.", "Mengambil risiko untuk memutuskan permasalahan genting.", "Melakukan cara di luar kebiasaan dalam mencapai tujuan.", "Bertanggungjawab atas kesalahan yang pernah dibuat."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        }

        // You can add more conditions for other options as needed.
    }
    
    function updateOptionsWeakOne() {
        var alcSelect = document.getElementById("weak_alc_one-input");
        var subOptionsSelect = document.getElementById("weak_sub_alc_one");

        subOptionsSelect.innerHTML = "";

        var selectedValue = alcSelect.value;

        if (selectedValue === "Vision & Business Sense") {
            var options = ["Vision, turunan inisiatif kunci", "Kemungkinan perubahan \"peluang & risiko\"", "Data & fakta keuangan, cost & benefit - operational excellence"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Customer Focus") {
            var options = ["Memahami kebutuhan pelanggan", "Antisipasi perubahan kebutuhan stakeholder", "Merespon perubahan kebutuhan stakeholder", "Membina hubungan dengan stakeholder", "Memberikan layanan yang unggul", "Ide improvement untuk mencapai standar kualitas layanan", "Memonitor tingkat kepuasan pelaggan"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Interpersonal Skill") {
            var options = ["Membangun hubungan yang konstruktif dan efektif", "Meyakinakan orang lain dengan menggunakan data, fakta, dan media", "Mengelola emosi dalam menghadapi permasalahan", "Peka terhadap kebutuhan rekan kerja"];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Analysis & Judgement") {
            var options = ["Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.", "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.", "Mengajukan solusi yang cepat dan tepat.", "Mengantisipasi permasalahan yang akan muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Planning & Driving Action") {
            var options = ["Menerjemahkan AP dept ke AP unit kerja", "Keselarasan AP seksi dengan goal organisasi", "Pemantauan kemajuan kerja berkala (PDCA).", "Mengidentifikasi sumber daya.", "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Leading & Motivating") {
            var options = ["Pemetaan kebutuhan kompetensi bawahan.", "Mendelegasikan tugas kepada bawahan.", "Menakar potensi bawahan agar beban kerja optimal.", "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.", "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.", "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.", "Melakukan pengembangan kader penerus kepemimpinannya.", "Menerapkan perilaku yang sesuai dengan nilai perusahaan.", "Membangun suasana kerja yang positif.", "Mampu mengelola perubahan yang muncul."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Teamwork") {
            var options = ["Dukungan semangat dan moril ke anggota kelompok.", "Kesediaan saling berbagi informasi maupun sumber daya.", "Bekerjasama dengan siapa saja dalam keragaman generasi.", "Memahami kebutuhan stakeholder.", "Kerjasama yang efektif atau tepat sasaran.", "Dukungan dari unit kerja lain."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        } else if (selectedValue === "Drive & Courage") {
            var options = ["Menuntaskan pekerjaan meskipun ada hambatan.", "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.", "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.", "Menetapkan target yang lebih tinggi dari sebelumnya.", "Mengambil risiko untuk memutuskan permasalahan genting.", "Melakukan cara di luar kebiasaan dalam mencapai tujuan.", "Bertanggungjawab atas kesalahan yang pernah dibuat."];
            options.forEach(function(optionValue) {
                var option = document.createElement("option");
                option.value = optionValue;
                option.text = optionValue;
                subOptionsSelect.appendChild(option);
            });
        }

        // You can add more conditions for other options as needed.
    }

    $(document).ready(function() {
        $('#edit').on('click', function () {
            var subAlcMid = document.getElementById('sub_alc_mid_text').innerText;
            var strongMidAlc = document.getElementById('strong_mid_alc_text').innerText;
            var techMidAlc = document.getElementById('technical_mid_text').innerText;
            var techMidAlcValue = document.getElementById('technical_value_mid_text').innerText;
            var alcMidOriginalValue = document.getElementById('alc_mid_text').getAttribute('data-value');
            document.getElementById('alc_mid_text').value = alcMidOriginalValue;
            var subAlcValue = document.getElementById('sub_alc_mid_text').getAttribute('data-value');
            document.getElementById('sub_alc_mid_text').value = subAlcValue;
            var alcMidSelect = '<select class="form-control mb-2" name="alc_mid" id="alc_mid" onchange="updateOptions()" style="width: 100%;">' +
                '<option value="Vision & Business Sense" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Vision & Business Sense' ? 'selected' : '' )?> + '>Vision & Business Sense</option>' +
                '<option value="Customer Focus" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Customer Focus' ? 'selected' : '' )?> + '>Customer Focus</option>' +
                '<option value="Interpersonal Skill" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Interpersonal Skill' ? 'selected' : '' )?> + '>Interpersonal Skill</option>' +
                '<option value="Analysis & Judgement" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Analysis & Judgement' ? 'selected' : '' )?> + '>Analysis & Judgement</option>' +
                '<option value="Planning & Driving Action" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Planning & Driving Action' ? 'selected' : '' )?> + '>Planning & Driving Action</option>' +
                '<option value="Leading & Motivating" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Leading & Motivating' ? 'selected' : '' )?> + '>Leading & Motivating</option>' +
                '<option value="Teamwork" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Teamwork' ? 'selected' : '' )?> + '>Teamwork</option>' +
                '<option value="Drive & Courage" ' + <?= json_encode(isset($strongweak['alc_mid']) && $strongweak['alc_mid'] == 'Drive & Courage' ? 'selected' : '' )?> + '>Drive & Courage</option>' +
                '</select>';
            var weakAlcMidSelect = '<select class="form-control mb-2" name="weak_alc_mid-input" id="weak_alc_mid-input" onchange="updateOptionsWeak()" style="width: 100%;">' +
                '<option value="Vision & Business Sense" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Vision & Business Sense' ? 'selected' : '' )?> + '>Vision & Business Sense</option>' +
                '<option value="Customer Focus" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Customer Focus' ? 'selected' : '' )?> + '>Customer Focus</option>' +
                '<option value="Interpersonal Skill" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Interpersonal Skill' ? 'selected' : '' )?> + '>Interpersonal Skill</option>' +
                '<option value="Analysis & Judgement" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Analysis & Judgement' ? 'selected' : '' )?> + '>Analysis & Judgement</option>' +
                '<option value="Planning & Driving Action" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Planning & Driving Action' ? 'selected' : '' )?> + '>Planning & Driving Action</option>' +
                '<option value="Leading & Motivating" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Leading & Motivating' ? 'selected' : '' )?> + '>Leading & Motivating</option>' +
                '<option value="Teamwork" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Teamwork' ? 'selected' : '' )?> + '>Teamwork</option>' +
                '<option value="Drive & Courage" ' + <?= json_encode(isset($strongweak['weak_alc_mid']) && $strongweak['weak_alc_mid'] == 'Drive & Courage' ? 'selected' : '' )?> + '>Drive & Courage</option>' +
                '</select>';
            
            // STRENGTH
                document.getElementById('alc_mid_text').outerHTML = alcMidSelect;
                var selectedAlcMidValue = document.getElementById('alc_mid').value;

                // SUB_ALC_MID
                var subAlcMidSelect = '<select class="form-control mb-2" name="sub_alc_mid" id="sub_alc_mid" style="width: 100%;">';

                // Assuming you have access to the array of subOptions from PHP
                var subOptions = {
                    "Vision & Business Sense": [
                        "Vision, turunan inisiatif kunci",
                        "kemungkinan perubahan \"peluang & risiko\"",
                        "Data & fakta keuangan, cost & benefit - operational excellence"
                    ],
                    "Customer Focus": [
                        "Memahami kebutuhan pelanggan",
                        "Antisipasi perubahan kebutuhan Sstakeholder",
                        "Merespon perubahan kebutuhan stakeholder",
                        "Membina hubungan dengan stakeholder",
                        "Memberikan layanan yang unggul",
                        "Ide improvement untuk mencapai standar kualitas layanan",
                        "Memonitor tingkat kepuasan pelaggan"
                    ],
                    "Interpersonal Skill": [
                        "Membangun hubungan yang konstruktif dan efektif",
                        "Meyakinakan orang lain dengan menggunakan data, fakta, dan media",
                        "Mengelola emosi dalam menghadapi permasalahan",
                        "Peka terhadap kebutuhan rekan kerja"
                    ],
                    "Analysis & Judgement": [
                        "Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.",
                        "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.",
                        "Mengajukan solusi yang cepat dan tepat.",
                        "Mengantisipasi permasalahan yang akan muncul."
                    ],
                    "Planning & Driving Action": [
                        "Menerjemahkan AP dept ke AP unit kerja",
                        "Keselarasan AP seksi dengan goal organisasi",
                        "Pemantauan kemajuan kerja berkala (PDCA).",
                        "Mengidentifikasi sumber daya.",
                        "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."
                    ],
                    "Leading & Motivating": [
                        "Pemetaan kebutuhan kompetensi bawahan.",
                        "Mendelegasikan tugas kepada bawahan.",
                        "Menakar potensi bawahan agar beban kerja optimal.",
                        "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.",
                        "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.",
                        "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.",
                        "Melakukan pengembangan kader penerus kepemimpinannya.",
                        "Menerapkan perilaku yang sesuai dengan nilai perusahaan.",
                        "Membangun suasana kerja yang positif.",
                        "Mampu mengelola perubahan yang muncul."
                    ],
                    "Teamwork": [
                        "Dukungan semangat dan moril ke anggota kelompok.",
                        "Kesediaan saling berbagi informasi maupun sumber daya.",
                        "Bekerjasama dengan siapa saja dalam keragaman generasi.",
                        "Memahami kebutuhan stakeholder.",
                        "Kerjasama yang efektif atau tepat sasaran.",
                        "Dukungan dari unit kerja lain."
                    ],
                    "Drive & Courage": [
                        "Menuntaskan pekerjaan meskipun ada hambatan.",
                        "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.",
                        "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.",
                        "Menetapkan target yang lebih tinggi dari sebelumnya.",
                        "Mengambil risiko untuk memutuskan permasalahan genting.",
                        "Melakukan cara di luar kebiasaan dalam mencapai tujuan.",
                        "Bertanggungjawab atas kesalahan yang pernah dibuat."
                    ]
                };
              
                var selectedSubValue = "<?php echo isset($strongweak['sub_alc_mid']) ? htmlspecialchars($strongweak['sub_alc_mid'], ENT_QUOTES, 'UTF-8') : ''; ?>";

                var subAlcMidSelect = '<select class="form-control mb-2" name="sub_alc_mid" id="sub_alc_mid" style="width: 100%;">';

                for (var key in subOptions) {
                    if (subOptions.hasOwnProperty(key)) {
                        var options = subOptions[key];

                        // Menggunakan key alc_mid yang terpilih untuk mendapatkan array subOptions yang sesuai
                        if (key === selectedAlcMidValue) {
                            options.forEach(function (optionValue) {
                                var selected = (optionValue === selectedSubValue) ? 'selected' : '';
                                subAlcMidSelect += '<option value="' + optionValue + '" ' + selected + '>' + optionValue + '</option>';
                            });
                        }
                    }
                }

                subAlcMidSelect += '</select>';

                document.getElementById('sub_alc_mid_text').outerHTML = subAlcMidSelect;
                
                document.getElementById('strong_mid_alc_text').outerHTML = '<textarea name="strong_mid_alc" id="strong_mid_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['strong_mid_alc']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'strong_mid_alc-input\', 71)"><?= isset($strongweak['strong_mid_alc']) ? htmlspecialchars(($strongweak['strong_mid_alc']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';

                var departmentId = <?= $strongweakmain['id_department']; ?>;

                var technicalOptions = {
                    6: ["Maintenance management", "Equipment management", "Tools management", "Teknik produksi (bubut, las, milling, drilling, dll)", "Quality management", "Product knowledge", "Manufacturing process", "Part & component design", "Material knowledge", "Technical drawing", "Electrical & power system", "Electronical & control system", "Robotic & automatic system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    7: ["Negotiation skill", "Pricing strategy", "Market analysis", "Customer management", "Branding & promotion", "Kontrak kerja (customer)", "Networking", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Quality management", "other"],
                    8: ["Perpajakan", "Aset management", "Accounting principles", "Planning & budgeting", "Financial analysis", "Cash management", "Cost accounting", "Corporate treasury", "Corporate finance", "Financial modeling", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Inventory management", "other"],
                    4: ["Industrial relation & termination", "Organizationd development", "Recruitment management", "People development", "Performance & reward management", "Training management", "HR administration", "Product knowledge", "Process knowledge", "Production system", "other"],
                    3: ["Industrial relation & termination", "Legal management", "Public relation management", "GA administration", "Infrastructure management", "Security management (ASMS)", "CSR (AFC)", "Product knowledge", "Process knowledge", "Pengelolaan material B3", "other"],
                    11: ["Negotiation skill", "Perpajakan", "Procurement administration", "Export import", "Price analysis", "Networking", "Vendor management", "Product knowledge", "Material knowledge", "Process knowledge", "Part & component knowledge", "Delivery management", "other"],
                    1: ["EHS management system", "Waste management", "Pollution control management", "Management energy dan sumber daya alam", "Fire management system", "Safety riding knowledge", "Investigasi dan mitigasi accident/incident skill", "Emergency respond management", "Ergonomy", "Behavior based safety", "Working hazard & risk reduction skill", "Pengelolaan material B3", "Product knowledge", "Material knowledge", "Process knowledge", "other"],
                    13: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    14: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    9: ["Production planning & control", "Production system", "Manufacturing process", "Product knowledge", "Part & component knowledge", "Material knowledge", "Quality management", "EHS management system", "Inventory control", "Pengelolaan material B3", "Costing", "Warehouse management system", "Vendor management", "Delivery system", "other"],
                    12: ["Quality management", "Product design", "Part & component", "Material knowledge", "Prototyping", "Testing Method", "Technical drawing", "Manufacturing process design", "Failure analysis", "other"],
                    2: ["Manufacturing process design", "Robotic & automatic system", "Production system", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Testing method", "Failure analysis", "Electrical & power system", "Electronical & control system", "Pneumatic & hydrolic system", "other"],
                    15: ["Quality management", "Quality system (QSA)", "Product knowledge", "Manufacturing process", "Part & component knowledge", "Material knowledge", "Testing method", "Production system", "Failure analysis", "Inventory management", "EHS management", "other"
                    ],
                    5:  ["Robotic & automatic system", "Manufacturing process design", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Production planning & control", "Production system", "Inventory control", "Delivery system", "Electrical & power system", "Electronical & control system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    16: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "EHS management system", "Inventory control", "Production planning & control", "Failure analysis", "Pengelolaan material B3", "Electronical & control system", "Pneumatic & hydrolic system", "other"]
                };

                var selectedTechnicalMid = '<?= $selectedTechnicalMid; ?>';
                var technicalSelectHTML = '';

                if (technicalOptions.hasOwnProperty(departmentId)) {
                    var options = technicalOptions[departmentId];

                    technicalSelectHTML += '<select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid" style="width: 100%;">';

                    options.forEach(function (option) {
                        var isSelected = selectedTechnicalMid === option ? 'selected' : '';
                        technicalSelectHTML += '<option value="' + option + '" ' + isSelected + '>' + option + '</option>';
                    });

                    // Close the select tag
                    technicalSelectHTML += '</select>';
                } else {
                    technicalSelectHTML = '<select class="form-control mt-2 mb-2" name="technical_mid" id="technical_mid" style="width: 100%;"><option value="" disable>-- Pilih Technical Competency --</option></select>';
                }

                document.getElementById('technical_mid_text').outerHTML = technicalSelectHTML;
                
                document.getElementById('technical_value_mid_text').outerHTML = '<textarea name="technical_value_mid" id="technical_value_mid-input" cols="30" rows="10" class="form-control <?= isset($errors['technical_value_mid']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'technical_value_mid-input\', 71)"><?= isset($strongweak['technical_value_mid']) ? htmlspecialchars(($strongweak['technical_value_mid']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';
            //END OF STRENGTH

            // WEAKNESS
                document.getElementById('weak_alc_mid_text').outerHTML = weakAlcMidSelect;
                var weakSelectedAlcMidValue = document.getElementById('weak_alc_mid-input').value;

                // SUB_ALC_MID
                var weakSubAlcMidSelect = '<select class="form-control mb-2" name="weak_sub_alc_mid" id="weak_sub_alc_mid" style="width: 100%;">';

                // Assuming you have access to the array of weakSubOptions from PHP
                var weakSubOptions = {
                    "Vision & Business Sense": [
                        "Vision, turunan inisiatif kunci",
                        "kemungkinan perubahan \"peluang & risiko\"",
                        "Data & fakta keuangan, cost & benefit - operational excellence"
                    ],
                    "Customer Focus": [
                        "Memahami kebutuhan pelanggan",
                        "Antisipasi perubahan kebutuhan Sstakeholder",
                        "Merespon perubahan kebutuhan stakeholder",
                        "Membina hubungan dengan stakeholder",
                        "Memberikan layanan yang unggul",
                        "Ide improvement untuk mencapai standar kualitas layanan",
                        "Memonitor tingkat kepuasan pelaggan"
                    ],
                    "Interpersonal Skill": [
                        "Membangun hubungan yang konstruktif dan efektif",
                        "Meyakinakan orang lain dengan menggunakan data, fakta, dan media",
                        "Mengelola emosi dalam menghadapi permasalahan",
                        "Peka terhadap kebutuhan rekan kerja"
                    ],
                    "Analysis & Judgement": [
                        "Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.",
                        "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.",
                        "Mengajukan solusi yang cepat dan tepat.",
                        "Mengantisipasi permasalahan yang akan muncul."
                    ],
                    "Planning & Driving Action": [
                        "Menerjemahkan AP dept ke AP unit kerja",
                        "Keselarasan AP seksi dengan goal organisasi",
                        "Pemantauan kemajuan kerja berkala (PDCA).",
                        "Mengidentifikasi sumber daya.",
                        "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."
                    ],
                    "Leading & Motivating": [
                        "Pemetaan kebutuhan kompetensi bawahan.",
                        "Mendelegasikan tugas kepada bawahan.",
                        "Menakar potensi bawahan agar beban kerja optimal.",
                        "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.",
                        "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.",
                        "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.",
                        "Melakukan pengembangan kader penerus kepemimpinannya.",
                        "Menerapkan perilaku yang sesuai dengan nilai perusahaan.",
                        "Membangun suasana kerja yang positif.",
                        "Mampu mengelola perubahan yang muncul."
                    ],
                    "Teamwork": [
                        "Dukungan semangat dan moril ke anggota kelompok.",
                        "Kesediaan saling berbagi informasi maupun sumber daya.",
                        "Bekerjasama dengan siapa saja dalam keragaman generasi.",
                        "Memahami kebutuhan stakeholder.",
                        "Kerjasama yang efektif atau tepat sasaran.",
                        "Dukungan dari unit kerja lain."
                    ],
                    "Drive & Courage": [
                        "Menuntaskan pekerjaan meskipun ada hambatan.",
                        "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.",
                        "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.",
                        "Menetapkan target yang lebih tinggi dari sebelumnya.",
                        "Mengambil risiko untuk memutuskan permasalahan genting.",
                        "Melakukan cara di luar kebiasaan dalam mencapai tujuan.",
                        "Bertanggungjawab atas kesalahan yang pernah dibuat."
                    ]
                };
              
                var weakSelectedSubValue = "<?php echo isset($strongweak['weak_sub_alc_mid']) ? htmlspecialchars($strongweak['weak_sub_alc_mid'], ENT_QUOTES, 'UTF-8') : ''; ?>";

                var weakSubAlcMidSelect = '<select class="form-control mb-2" name="weak_sub_alc_mid" id="weak_sub_alc_mid" style="width: 100%;">';

                for (var key in weakSubOptions) {
                    if (weakSubOptions.hasOwnProperty(key)) {
                        var options = weakSubOptions[key];

                        // Menggunakan key alc_mid yang terpilih untuk mendapatkan array weakSubOptions yang sesuai
                        if (key === weakSelectedAlcMidValue) {
                            options.forEach(function (optionValue) {
                                var selected = (optionValue === weakSelectedSubValue) ? 'selected' : '';
                                weakSubAlcMidSelect += '<option value="' + optionValue + '" ' + selected + '>' + optionValue + '</option>';
                            });
                        }
                    }
                }

                weakSubAlcMidSelect += '</select>';

                document.getElementById('weak_sub_alc_mid_text').outerHTML = weakSubAlcMidSelect;
                
                document.getElementById('weak_mid_alc_text').outerHTML = '<textarea name="weak_mid_alc_text" id="weak_mid_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['weak_mid_alc']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'weak_mid_alc-input\', 71)"s><?= isset($strongweak['weak_mid_alc']) ? htmlspecialchars(($strongweak['weak_mid_alc']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';

                var weakTechOpts = {
                    6: ["Maintenance management", "Equipment management", "Tools management", "Teknik produksi (bubut, las, milling, drilling, dll)", "Quality management", "Product knowledge", "Manufacturing process", "Part & component design", "Material knowledge", "Technical drawing", "Electrical & power system", "Electronical & control system", "Robotic & automatic system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    7: ["Negotiation skill", "Pricing strategy", "Market analysis", "Customer management", "Branding & promotion", "Kontrak kerja (customer)", "Networking", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Quality management", "other"],
                    8: ["Perpajakan", "Aset management", "Accounting principles", "Planning & budgeting", "Financial analysis", "Cash management", "Cost accounting", "Corporate treasury", "Corporate finance", "Financial modeling", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Inventory management", "other"],
                    4: ["Industrial relation & termination", "Organizationd development", "Recruitment management", "People development", "Performance & reward management", "Training management", "HR administration", "Product knowledge", "Process knowledge", "Production system", "other"],
                    3: ["Industrial relation & termination", "Legal management", "Public relation management", "GA administration", "Infrastructure management", "Security management (ASMS)", "CSR (AFC)", "Product knowledge", "Process knowledge", "Pengelolaan material B3", "other"],
                    11: ["Negotiation skill", "Perpajakan", "Procurement administration", "Export import", "Price analysis", "Networking", "Vendor management", "Product knowledge", "Material knowledge", "Process knowledge", "Part & component knowledge", "Delivery management", "other"],
                    1: ["EHS management system", "Waste management", "Pollution control management", "Management energy dan sumber daya alam", "Fire management system", "Safety riding knowledge", "Investigasi dan mitigasi accident/incident skill", "Emergency respond management", "Ergonomy", "Behavior based safety", "Working hazard & risk reduction skill", "Pengelolaan material B3", "Product knowledge", "Material knowledge", "Process knowledge", "other"],
                    13: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    14: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    9: ["Production planning & control", "Production system", "Manufacturing process", "Product knowledge", "Part & component knowledge", "Material knowledge", "Quality management", "EHS management system", "Inventory control", "Pengelolaan material B3", "Costing", "Warehouse management system", "Vendor management", "Delivery system", "other"],
                    12: ["Quality management", "Product design", "Part & component", "Material knowledge", "Prototyping", "Testing Method", "Technical drawing", "Manufacturing process design", "Failure analysis", "other"],
                    2: ["Manufacturing process design", "Robotic & automatic system", "Production system", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Testing method", "Failure analysis", "Electrical & power system", "Electronical & control system", "Pneumatic & hydrolic system", "other"],
                    15: ["Quality management", "Quality system (QSA)", "Product knowledge", "Manufacturing process", "Part & component knowledge", "Material knowledge", "Testing method", "Production system", "Failure analysis", "Inventory management", "EHS management", "other"
                    ],
                    5:  ["Robotic & automatic system", "Manufacturing process design", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Production planning & control", "Production system", "Inventory control", "Delivery system", "Electrical & power system", "Electronical & control system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    16: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "EHS management system", "Inventory control", "Production planning & control", "Failure analysis", "Pengelolaan material B3", "Electronical & control system", "Pneumatic & hydrolic system", "other"]
                };

                var selectedWeakTechMid = '<?= $selectedWeakTechMid; ?>';
                var weakSelectMid = '';

                if (weakTechOpts.hasOwnProperty(departmentId)) {
                    var options = weakTechOpts[departmentId];

                    weakSelectMid += '<select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid" style="width: 100%;">';

                    options.forEach(function (option) {
                        var isSelected = selectedWeakTechMid === option ? 'selected' : '';
                        weakSelectMid += '<option value="' + option + '" ' + isSelected + '>' + option + '</option>';
                    });

                    // Close the select tag
                    weakSelectMid += '</select>';
                } else {
                    weakSelectMid = '<select class="form-control mt-2 mb-2" name="weak_technical_mid" id="weak_technical_mid" style="width: 100%;"><option value="" disable>-- Pilih Technical Competency --</option></select>';
                }

                document.getElementById('weak_technical_mid_text').outerHTML = weakSelectMid;

                document.getElementById('weak_technical_value_mid_text').outerHTML = '<textarea name="weak_technical_value_mid" id="weak_technical_value_mid-input" cols="30" rows="10" class="form-control <?= isset($errors['weak_technical_value_mid']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'weak_technical_value_mid-input\', 71)"><?= isset($strongweak['weak_technical_value_mid']) ? htmlspecialchars(($strongweak['weak_technical_value_mid']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';
            // END OF WEAKNESS

            // NOTES
            document.getElementById('note_input').outerHTML = '<textarea name="note_input" id="note_mid_input" cols="30" rows="10" class="form-control <?= isset($errors['note_mid']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'note_mid_input\', 376)"><?= isset($strongweak['note_mid']) ? htmlspecialchars(($strongweak['note_mid']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';

            $('#edit').hide();
            $('#submitBtn').hide();
            $('.approve-button').hide();
            $('#save-edit').show();
        });

        $('#edit-one').on('click', function () {
            // Mendeteksi klik pada tombol edit
            // Mendapatkan nilai dari elemen span
            // var alcMidText = document.getElementById('alc_mid_text').innerText;
            var subAlcone = document.getElementById('sub_alc_one_text').innerText;
            var strongoneAlc = document.getElementById('strong_one_alc_text').innerText;
            var techoneAlc = document.getElementById('technical_one_text').innerText;
            var techoneAlcValue = document.getElementById('technical_value_one_text').innerText;
            var alconeOriginalValue = document.getElementById('alc_one_text').getAttribute('data-value');
            document.getElementById('alc_one_text').value = alconeOriginalValue;
            var subAlcValue = document.getElementById('sub_alc_one_text').getAttribute('data-value');
            document.getElementById('sub_alc_one_text').value = subAlcValue;
            var alconeSelect = '<select class="form-control mb-2" name="alc_one" id="alc_one" onchange="updateOptionsOne()" style="width: 100%;">' +
                '<option value="Vision & Business Sense" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Vision & Business Sense' ? 'selected' : '' )?> + '>Vision & Business Sense</option>' +
                '<option value="Customer Focus" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Customer Focus' ? 'selected' : '' )?> + '>Customer Focus</option>' +
                '<option value="Interpersonal Skill" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Interpersonal Skill' ? 'selected' : '' )?> + '>Interpersonal Skill</option>' +
                '<option value="Analysis & Judgement" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Analysis & Judgement' ? 'selected' : '' )?> + '>Analysis & Judgement</option>' +
                '<option value="Planning & Driving Action" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Planning & Driving Action' ? 'selected' : '' )?> + '>Planning & Driving Action</option>' +
                '<option value="Leading & Motivating" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Leading & Motivating' ? 'selected' : '' )?> + '>Leading & Motivating</option>' +
                '<option value="Teamwork" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Teamwork' ? 'selected' : '' )?> + '>Teamwork</option>' +
                '<option value="Drive & Courage" ' + <?= json_encode(isset($strongweak['alc_one']) && $strongweak['alc_one'] == 'Drive & Courage' ? 'selected' : '' )?> + '>Drive & Courage</option>' +
                '</select>';
            var weakAlconeSelect = '<select class="form-control mb-2" name="weak_alc_one-input" id="weak_alc_one-input" onchange="updateOptionsWeakOne()" style="width: 100%;">' +
                '<option value="Vision & Business Sense" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Vision & Business Sense' ? 'selected' : '' )?> + '>Vision & Business Sense</option>' +
                '<option value="Customer Focus" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Customer Focus' ? 'selected' : '' )?> + '>Customer Focus</option>' +
                '<option value="Interpersonal Skill" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Interpersonal Skill' ? 'selected' : '' )?> + '>Interpersonal Skill</option>' +
                '<option value="Analysis & Judgement" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Analysis & Judgement' ? 'selected' : '' )?> + '>Analysis & Judgement</option>' +
                '<option value="Planning & Driving Action" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Planning & Driving Action' ? 'selected' : '' )?> + '>Planning & Driving Action</option>' +
                '<option value="Leading & Motivating" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Leading & Motivating' ? 'selected' : '' )?> + '>Leading & Motivating</option>' +
                '<option value="Teamwork" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Teamwork' ? 'selected' : '' )?> + '>Teamwork</option>' +
                '<option value="Drive & Courage" ' + <?= json_encode(isset($strongweak['weak_alc_one']) && $strongweak['weak_alc_one'] == 'Drive & Courage' ? 'selected' : '' )?> + '>Drive & Courage</option>' +
                '</select>';
            
            // STRENGTH
                document.getElementById('alc_one_text').outerHTML = alconeSelect;
                var selectedAlconeValue = document.getElementById('alc_one').value;

                // SUB_ALC_one
                var subAlconeSelect = '<select class="form-control mb-2" name="sub_alc_one" id="sub_alc_one" style="width: 100%;">';

                // Assuming you have access to the array of subOptions from PHP
                var subOptions = {
                    "Vision & Business Sense": [
                        "Vision, turunan inisiatif kunci",
                        "kemungkinan perubahan \"peluang & risiko\"",
                        "Data & fakta keuangan, cost & benefit - operational excellence"
                    ],
                    "Customer Focus": [
                        "Memahami kebutuhan pelanggan",
                        "Antisipasi perubahan kebutuhan Sstakeholder",
                        "Merespon perubahan kebutuhan stakeholder",
                        "Membina hubungan dengan stakeholder",
                        "Memberikan layanan yang unggul",
                        "Ide improvement untuk mencapai standar kualitas layanan",
                        "Memonitor tingkat kepuasan pelaggan"
                    ],
                    "Interpersonal Skill": [
                        "Membangun hubungan yang konstruktif dan efektif",
                        "Meyakinakan orang lain dengan menggunakan data, fakta, dan media",
                        "Mengelola emosi dalam menghadapi permasalahan",
                        "Peka terhadap kebutuhan rekan kerja"
                    ],
                    "Analysis & Judgement": [
                        "Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.",
                        "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.",
                        "Mengajukan solusi yang cepat dan tepat.",
                        "Mengantisipasi permasalahan yang akan muncul."
                    ],
                    "Planning & Driving Action": [
                        "Menerjemahkan AP dept ke AP unit kerja",
                        "Keselarasan AP seksi dengan goal organisasi",
                        "Pemantauan kemajuan kerja berkala (PDCA).",
                        "Mengidentifikasi sumber daya.",
                        "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."
                    ],
                    "Leading & Motivating": [
                        "Pemetaan kebutuhan kompetensi bawahan.",
                        "Mendelegasikan tugas kepada bawahan.",
                        "Menakar potensi bawahan agar beban kerja optimal.",
                        "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.",
                        "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.",
                        "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.",
                        "Melakukan pengembangan kader penerus kepemimpinannya.",
                        "Menerapkan perilaku yang sesuai dengan nilai perusahaan.",
                        "Membangun suasana kerja yang positif.",
                        "Mampu mengelola perubahan yang muncul."
                    ],
                    "Teamwork": [
                        "Dukungan semangat dan moril ke anggota kelompok.",
                        "Kesediaan saling berbagi informasi maupun sumber daya.",
                        "Bekerjasama dengan siapa saja dalam keragaman generasi.",
                        "Memahami kebutuhan stakeholder.",
                        "Kerjasama yang efektif atau tepat sasaran.",
                        "Dukungan dari unit kerja lain."
                    ],
                    "Drive & Courage": [
                        "Menuntaskan pekerjaan meskipun ada hambatan.",
                        "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.",
                        "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.",
                        "Menetapkan target yang lebih tinggi dari sebelumnya.",
                        "Mengambil risiko untuk memutuskan permasalahan genting.",
                        "Melakukan cara di luar kebiasaan dalam mencapai tujuan.",
                        "Bertanggungjawab atas kesalahan yang pernah dibuat."
                    ]
                };
              
                var selectedSubValue = "<?php echo isset($strongweak['sub_alc_one']) ? htmlspecialchars($strongweak['sub_alc_one'], ENT_QUOTES, 'UTF-8') : ''; ?>";

                var subAlconeSelect = '<select class="form-control mb-2" name="sub_alc_one" id="sub_alc_one" style="width: 100%;">';

                for (var key in subOptions) {
                    if (subOptions.hasOwnProperty(key)) {
                        var options = subOptions[key];

                        // Menggunakan key alc_one yang terpilih untuk mendapatkan array subOptions yang sesuai
                        if (key === selectedAlconeValue) {
                            options.forEach(function (optionValue) {
                                var selected = (optionValue === selectedSubValue) ? 'selected' : '';
                                subAlconeSelect += '<option value="' + optionValue + '" ' + selected + '>' + optionValue + '</option>';
                            });
                        }
                    }
                }

                subAlconeSelect += '</select>';

                document.getElementById('sub_alc_one_text').outerHTML = subAlconeSelect;
                
                document.getElementById('strong_one_alc_text').outerHTML = '<textarea name="strong_one_alc" id="strong_one_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['strong_one_alc']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'strong_one_alc-input\', 71)"><?= isset($strongweak['strong_one_alc']) ? htmlspecialchars(($strongweak['strong_one_alc']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';

                var departmentId = <?= $strongweakmain['id_department']; ?>;
                <?php $selectedtechnicalOne = isset($strongweak['technical_one']) ? $strongweak['technical_one'] : ''; ?>

                var techOptsOne = {
                    6: ["Maintenance management", "Equipment management", "Tools management", "Teknik produksi (bubut, las, milling, drilling, dll)", "Quality management", "Product knowledge", "Manufacturing process", "Part & component design", "Material knowledge", "Technical drawing", "Electrical & power system", "Electronical & control system", "Robotic & automatic system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    7: ["Negotiation skill", "Pricing strategy", "Market analysis", "Customer management", "Branding & promotion", "Kontrak kerja (customer)", "Networking", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Quality management", "other"],
                    8: ["Perpajakan", "Aset management", "Accounting principles", "Planning & budgeting", "Financial analysis", "Cash management", "Cost accounting", "Corporate treasury", "Corporate finance", "Financial modeling", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Inventory management", "other"],
                    4: ["Industrial relation & termination", "Organizationd development", "Recruitment management", "People development", "Performance & reward management", "Training management", "HR administration", "Product knowledge", "Process knowledge", "Production system", "other"],
                    3: ["Industrial relation & termination", "Legal management", "Public relation management", "GA administration", "Infrastructure management", "Security management (ASMS)", "CSR (AFC)", "Product knowledge", "Process knowledge", "Pengelolaan material B3", "other"],
                    11: ["Negotiation skill", "Perpajakan", "Procurement administration", "Export import", "Price analysis", "Networking", "Vendor management", "Product knowledge", "Material knowledge", "Process knowledge", "Part & component knowledge", "Delivery management", "other"],
                    1: ["EHS management system", "Waste management", "Pollution control management", "Management energy dan sumber daya alam", "Fire management system", "Safety riding knowledge", "Investigasi dan mitigasi accident/incident skill", "Emergency respond management", "Ergonomy", "Behavior based safety", "Working hazard & risk reduction skill", "Pengelolaan material B3", "Product knowledge", "Material knowledge", "Process knowledge", "other"],
                    13: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    14: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    9: ["Production planning & control", "Production system", "Manufacturing process", "Product knowledge", "Part & component knowledge", "Material knowledge", "Quality management", "EHS management system", "Inventory control", "Pengelolaan material B3", "Costing", "Warehouse management system", "Vendor management", "Delivery system", "other"],
                    12: ["Quality management", "Product design", "Part & component", "Material knowledge", "Prototyping", "Testing Method", "Technical drawing", "Manufacturing process design", "Failure analysis", "other"],
                    2: ["Manufacturing process design", "Robotic & automatic system", "Production system", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Testing method", "Failure analysis", "Electrical & power system", "Electronical & control system", "Pneumatic & hydrolic system", "other"],
                    15: ["Quality management", "Quality system (QSA)", "Product knowledge", "Manufacturing process", "Part & component knowledge", "Material knowledge", "Testing method", "Production system", "Failure analysis", "Inventory management", "EHS management", "other"
                    ],
                    5:  ["Robotic & automatic system", "Manufacturing process design", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Production planning & control", "Production system", "Inventory control", "Delivery system", "Electrical & power system", "Electronical & control system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    16: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "EHS management system", "Inventory control", "Production planning & control", "Failure analysis", "Pengelolaan material B3", "Electronical & control system", "Pneumatic & hydrolic system", "other"]
                };

                var selectedTechnicalOne = '<?= $selectedTechnicalOne; ?>';
                var techSelectOne = '';

                if (techOptsOne.hasOwnProperty(departmentId)) {
                    var options = techOptsOne[departmentId];

                    techSelectOne += '<select class="form-control mt-2 mb-2" name="technical_one" id="technical_one" style="width: 100%;">';

                    options.forEach(function (option) {
                        var isSelected = selectedTechnicalOne === option ? 'selected' : '';
                        techSelectOne += '<option value="' + option + '" ' + isSelected + '>' + option + '</option>';
                    });

                    techSelectOne += '</select>';
                } else {
                    techSelectOne = '<select class="form-control mt-2 mb-2" name="technical_one" id="technical_one" style="width: 100%;"><option value="" disable>-- Pilih Technical Competency --</option></select>';
                }

                document.getElementById('technical_one_text').outerHTML = techSelectOne;

                document.getElementById('technical_value_one_text').outerHTML = '<textarea name="technical_value_one" id="technical_value_one-input" cols="30" rows="10" class="form-control <?= isset($errors['technical_value_one']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'technical_value_one-input\', 71)"><?= isset($strongweak['technical_value_one']) ? htmlspecialchars(($strongweak['technical_value_one']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';
            //END OF STRENGTH

            // WEAKNESS
                document.getElementById('weak_alc_one_text').outerHTML = weakAlconeSelect;
                var weakSelectedAlconeValue = document.getElementById('weak_alc_one-input').value;

                // SUB_ALC_one
                var weakSubAlconeSelect = '<select class="form-control mb-2" name="weak_sub_alc_one" id="weak_sub_alc_one" style="width: 100%;">';

                // Assuming you have access to the array of weakSubOptions from PHP
                var weakSubOptions = {
                    "Vision & Business Sense": [
                        "Vision, turunan inisiatif kunci",
                        "kemungkinan perubahan \"peluang & risiko\"",
                        "Data & fakta keuangan, cost & benefit - operational excellence"
                    ],
                    "Customer Focus": [
                        "Memahami kebutuhan pelanggan",
                        "Antisipasi perubahan kebutuhan Sstakeholder",
                        "Merespon perubahan kebutuhan stakeholder",
                        "Membina hubungan dengan stakeholder",
                        "Memberikan layanan yang unggul",
                        "Ide improvement untuk mencapai standar kualitas layanan",
                        "Memonitor tingkat kepuasan pelaggan"
                    ],
                    "Interpersonal Skill": [
                        "Membangun hubungan yang konstruktif dan efektif",
                        "Meyakinakan orang lain dengan menggunakan data, fakta, dan media",
                        "Mengelola emosi dalam menghadapi permasalahan",
                        "Peka terhadap kebutuhan rekan kerja"
                    ],
                    "Analysis & Judgement": [
                        "Analisa permasalahan secara sistematis didukung dengan data-data untuk identifikasi akar masalah.",
                        "Mengusulkan alternatif solusi dengan mempertimbangkan peluang dan risikonya.",
                        "Mengajukan solusi yang cepat dan tepat.",
                        "Mengantisipasi permasalahan yang akan muncul."
                    ],
                    "Planning & Driving Action": [
                        "Menerjemahkan AP dept ke AP unit kerja",
                        "Keselarasan AP seksi dengan goal organisasi",
                        "Pemantauan kemajuan kerja berkala (PDCA).",
                        "Mengidentifikasi sumber daya.",
                        "Menyusun AP dengan melibatkan sumber daya yang tersedia di dalam maupun lintas unit kerja."
                    ],
                    "Leading & Motivating": [
                        "Pemetaan kebutuhan kompetensi bawahan.",
                        "Mendelegasikan tugas kepada bawahan.",
                        "Menakar potensi bawahan agar beban kerja optimal.",
                        "Memberikan coaching, mentoring, dan umpan balik kepada bawahan.",
                        "Memberikan apresiasi dan recognition bagi karyawan yang berprestasi.",
                        "Memberikan dorongan kepada bawahan untuk berani mengambil risiko.",
                        "Melakukan pengembangan kader penerus kepemimpinannya.",
                        "Menerapkan perilaku yang sesuai dengan nilai perusahaan.",
                        "Membangun suasana kerja yang positif.",
                        "Mampu mengelola perubahan yang muncul."
                    ],
                    "Teamwork": [
                        "Dukungan semangat dan moril ke anggota kelompok.",
                        "Kesediaan saling berbagi informasi maupun sumber daya.",
                        "Bekerjasama dengan siapa saja dalam keragaman generasi.",
                        "Memahami kebutuhan stakeholder.",
                        "Kerjasama yang efektif atau tepat sasaran.",
                        "Dukungan dari unit kerja lain."
                    ],
                    "Drive & Courage": [
                        "Menuntaskan pekerjaan meskipun ada hambatan.",
                        "Membuat keputusan yang mempertimbangkan aspek yang jadi kewenangannya.",
                        "Cepat mempelajari pengetahuan, keterampilan, dan budaya baru.",
                        "Menetapkan target yang lebih tinggi dari sebelumnya.",
                        "Mengambil risiko untuk memutuskan permasalahan genting.",
                        "Melakukan cara di luar kebiasaan dalam mencapai tujuan.",
                        "Bertanggungjawab atas kesalahan yang pernah dibuat."
                    ]
                };
              
                var weakSelectedSubValue = "<?php echo isset($strongweak['weak_sub_alc_one']) ? htmlspecialchars($strongweak['weak_sub_alc_one'], ENT_QUOTES, 'UTF-8') : ''; ?>";

                // var weakSubAlconeSelect = '<select class="form-control mb-2" name="weak_sub_alc_one" id="weak_sub_alc_one" style="width: 100%;">';

                for (var key in weakSubOptions) {
                    if (weakSubOptions.hasOwnProperty(key)) {
                        var options = weakSubOptions[key];

                        // Menggunakan key alc_one yang terpilih untuk mendapatkan array weakSubOptions yang sesuai
                        if (key === weakSelectedAlconeValue) {
                            options.forEach(function (optionValue) {
                                var selected = (optionValue === weakSelectedSubValue) ? 'selected' : '';
                                weakSubAlconeSelect += '<option value="' + optionValue + '" ' + selected + '>' + optionValue + '</option>';
                            });
                        }
                    }
                }

                weakSubAlconeSelect += '</select>';

                document.getElementById('weak_sub_alc_one_text').outerHTML = weakSubAlconeSelect;
                
                document.getElementById('weak_one_alc_text').outerHTML = '<textarea name="weak_one_alc_text" id="weak_one_alc-input" cols="30" rows="10" class="form-control <?= isset($errors['weak_one_alc']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'weak_one_alc-input\', 71)"><?= isset($strongweak['weak_one_alc']) ? htmlspecialchars(($strongweak['weak_one_alc']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';

                <?php $selectedWeakTechnicalOne = isset($strongweak['weak_technical_one']) ? $strongweak['weak_technical_one'] : ''; ?>

                var weakTechOptsOne = {
                    6: ["Maintenance management", "Equipment management", "Tools management", "Teknik produksi (bubut, las, milling, drilling, dll)", "Quality management", "Product knowledge", "Manufacturing process", "Part & component design", "Material knowledge", "Technical drawing", "Electrical & power system", "Electronical & control system", "Robotic & automatic system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    7: ["Negotiation skill", "Pricing strategy", "Market analysis", "Customer management", "Branding & promotion", "Kontrak kerja (customer)", "Networking", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Quality management", "other"],
                    8: ["Perpajakan", "Aset management", "Accounting principles", "Planning & budgeting", "Financial analysis", "Cash management", "Cost accounting", "Corporate treasury", "Corporate finance", "Financial modeling", "Product knowledge", "Material knowledge", "Process knowledge", "Part and component knowledge", "Inventory management", "other"],
                    4: ["Industrial relation & termination", "Organizationd development", "Recruitment management", "People development", "Performance & reward management", "Training management", "HR administration", "Product knowledge", "Process knowledge", "Production system", "other"],
                    3: ["Industrial relation & termination", "Legal management", "Public relation management", "GA administration", "Infrastructure management", "Security management (ASMS)", "CSR (AFC)", "Product knowledge", "Process knowledge", "Pengelolaan material B3", "other"],
                    11: ["Negotiation skill", "Perpajakan", "Procurement administration", "Export import", "Price analysis", "Networking", "Vendor management", "Product knowledge", "Material knowledge", "Process knowledge", "Part & component knowledge", "Delivery management", "other"],
                    1: ["EHS management system", "Waste management", "Pollution control management", "Management energy dan sumber daya alam", "Fire management system", "Safety riding knowledge", "Investigasi dan mitigasi accident/incident skill", "Emergency respond management", "Ergonomy", "Behavior based safety", "Working hazard & risk reduction skill", "Pengelolaan material B3", "Product knowledge", "Material knowledge", "Process knowledge", "other"],
                    13: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    14: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "Failure analysis", "EHS management system", "Inventory control", "Production planning & control", "Pengelolaan material B3", "Electronic & control system", "Pneumatic & hydrolic system", "other"],
                    9: ["Production planning & control", "Production system", "Manufacturing process", "Product knowledge", "Part & component knowledge", "Material knowledge", "Quality management", "EHS management system", "Inventory control", "Pengelolaan material B3", "Costing", "Warehouse management system", "Vendor management", "Delivery system", "other"],
                    12: ["Quality management", "Product design", "Part & component", "Material knowledge", "Prototyping", "Testing Method", "Technical drawing", "Manufacturing process design", "Failure analysis", "other"],
                    2: ["Manufacturing process design", "Robotic & automatic system", "Production system", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Testing method", "Failure analysis", "Electrical & power system", "Electronical & control system", "Pneumatic & hydrolic system", "other"],
                    15: ["Quality management", "Quality system (QSA)", "Product knowledge", "Manufacturing process", "Part & component knowledge", "Material knowledge", "Testing method", "Production system", "Failure analysis", "Inventory management", "EHS management", "other"
                    ],
                    5:  ["Robotic & automatic system", "Manufacturing process design", "Technical drawing", "Part & component design", "Material knowledge", "Product design", "Prototyping", "Production planning & control", "Production system", "Inventory control", "Delivery system", "Electrical & power system", "Electronical & control system", "Piping system", "Pneumatic & hydrolic system", "other"],
                    16: ["Production system", "Manufacturing process", "Technical drawing", "Part & component", "Material knowledge", "Product knowledge", "Quality management", "EHS management system", "Inventory control", "Production planning & control", "Failure analysis", "Pengelolaan material B3", "Electronical & control system", "Pneumatic & hydrolic system", "other"]
                };

                var selectedWeakTechOne = '<?= $selectedWeakTechOne; ?>';
                var weakSelectMid = '';

                if (weakTechOptsOne.hasOwnProperty(departmentId)) {
                    var options = weakTechOptsOne[departmentId];

                    weakSelectMid += '<select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one" style="width: 100%;">';

                    options.forEach(function (option) {
                        var isSelected = selectedWeakTechOne === option ? 'selected' : '';
                        weakSelectMid += '<option value="' + option + '" ' + isSelected + '>' + option + '</option>';
                    });

                    weakSelectMid += '</select>';
                } else {
                    weakSelectMid = '<select class="form-control mt-2 mb-2" name="weak_technical_one" id="weak_technical_one" style="width: 100%;"><option value="" disable>-- Pilih Technical Competency --</option></select>';
                }

                document.getElementById('weak_technical_one_text').outerHTML = weakSelectMid;

                document.getElementById('weak_technical_value_one_text').outerHTML = '<textarea name="weak_technical_value_one" id="weak_technical_value_one-input" cols="30" rows="10" class="form-control <?= isset($errors['weak_technical_value_one']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'weak_technical_value_one-input\', 71)"><?= isset($strongweak['weak_technical_value_one']) ? htmlspecialchars(($strongweak['weak_technical_value_one']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';
            // END OF WEAKNESS

            // NOTES
            document.getElementById('note_one_text').outerHTML = '<textarea name="note_one_input" id="note_one_input" cols="30" rows="10" class="form-control <?= isset($errors['note_one']) ? 'is-invalid' : ''; ?>" oninput="limitCharacters(\'note_one_input\', 376)"><?= isset($strongweak['note_one']) ? htmlspecialchars(($strongweak['note_one']), ENT_QUOTES, 'UTF-8') : ''; ?></textarea>';

            $('#edit-one').hide();
            $('#submitBtn').hide();
            $('.approve-button').hide();
            $('#save-edit-one').show();
        });        

        // Function untuk menyimpan data saat tombol "Save-Edit" diklik saat mid  year
        $('#save-edit').on('click', function () {
            var id_strongweak_main      = $('#id_strongweak_main').val();
            var alc_mid                  = $('#alc_mid').val();
            var sub_alc_mid              = $('#sub_alc_mid').val();
            var strong_mid_alc           = $('#strong_mid_alc-input').val(); // Textarea for the alc in strength
            var technical_mid            = $('#technical_mid').val();
            var technical_value_mid      = $('#technical_value_mid-input').val();
            var weak_alc_mid             = $('#weak_alc_mid-input').val();
            var weak_sub_alc_mid         = $('#weak_sub_alc_mid').val();
            var weak_mid_alc             = $('#weak_mid_alc-input').val();
            var weak_technical_mid       = $('#weak_technical_mid').val();
            var weak_technical_value_mid = $('#weak_technical_value_mid-input').val();
            var note_mid                 = $('#note_mid_input').val();

            $.ajax({
                method: 'POST',
                url: '<?= base_url('strongweak/update_data'); ?>',
                data: {
                    id_strongweak_main      : id_strongweak_main,
                    alc_mid                 : alc_mid,
                    sub_alc_mid             : sub_alc_mid,
                    strong_mid_alc          : strong_mid_alc,
                    technical_mid           : technical_mid,
                    technical_value_mid     : technical_value_mid,
                    weak_alc_mid            : weak_alc_mid,
                    weak_sub_alc_mid        : weak_sub_alc_mid,
                    weak_mid_alc            : weak_mid_alc,
                    weak_technical_mid      : weak_technical_mid,
                    weak_technical_value_mid: weak_technical_value_mid,
                    note_mid                : note_mid
                },
                beforeSend: function(){
                    $('#save-edit').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save-edit').hide();
                },
                success: function (response) {
                    console.log('Save successful:', response);
                    location.reload();
                    // $('#edit').show();
                    // $('#submitBtn').show();
                },
                error: function (error) {
                    console.error('Save failed:', error);
                }
            });
        });

        // Function untuk menyimpan data saat tombol "Save-Edit" diklik saat one year
        $('#save-edit-one').on('click', function () {
            var id_strongweak_main       = $('#id_strongweak_main').val();
            var alc_one                  = $('#alc_one').val();
            var sub_alc_one              = $('#sub_alc_one').val();
            var strong_one_alc           = $('#strong_one_alc-input').val();
            var technical_one            = $('#technical_one').val();
            var technical_value_one      = $('#technical_value_one-input').val();
            var weak_alc_one             = $('#weak_alc_one-input').val();
            var weak_sub_alc_one         = $('#weak_sub_alc_one').val();
            var weak_one_alc             = $('#weak_one_alc-input').val();
            var weak_technical_one       = $('#weak_technical_one').val();
            var weak_technical_value_one = $('#weak_technical_value_one-input').val();
            var note_one                 = $('#note_one_input').val();

            $.ajax({
                method: 'POST',
                url: '<?= base_url('strongweak/update_data_one'); ?>',
                data: {
                    id_strongweak_main      : id_strongweak_main,
                    alc_one                 : alc_one,
                    sub_alc_one             : sub_alc_one,
                    strong_one_alc          : strong_one_alc,
                    technical_one           : technical_one,
                    technical_value_one     : technical_value_one,
                    weak_alc_one            : weak_alc_one,
                    weak_sub_alc_one        : weak_sub_alc_one,
                    weak_one_alc            : weak_one_alc,
                    weak_technical_one      : weak_technical_one,
                    weak_technical_value_one: weak_technical_value_one,
                    note_one                : note_one
                },
                beforeSend: function(){
                    $('#save-edit-one').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save-edit-one').hide();
                },
                success: function (response) {
                    // console.log('Save successful:', response);
                    // console.log(id_strongweak_main);
                    location.reload();
                },
                error: function (error) {
                    console.error('Save failed:', error);
                }
            });
        });
        

        // Function untuk menyimpan data saat tombol "Save" diklik
        $('#save').on('click', function () {
            var id_strongweak_main  = $('#id_strongweak_main').val();
            var note_mid            = $('#note_mid_input').val();
            // var strong_mid          = $('#strong_mid_input').val();
            // var weak_mid            = $('#weak_mid_input').val();

            // mid year strong
            var alc_mid             = $('#alc_mid').val();
            var sub_alc_mid         = $('#sub_alc_mid').val();
            var technical_mid       = $('#technical_mid').val();
            var strong_mid_alc      = $('#strong_mid_alc-input').val(); // textarea milik alc MIDYEAR (inputan atau saat tidak ada isinya)
            var technical_value_mid = $('#technical_value_mid-input').val(); // textarea milik technical MIDYEAR (inputan atau saat tidak ada isinya)

            // mid year weak
            var weak_alc_mid             = $('#weak_alc_mid-input').val();
            var weak_sub_alc_mid         = $('#weak_sub_alc_mid').val();
            var weak_technical_mid       = $('#weak_technical_mid').val();
            var weak_mid_alc             = $('#weak_mid_alc-input').val(); // textarea milik alc weakness MIDYEAR
            var weak_technical_value_mid = $('#weak_technical_value_mid-input').val(); // textarea milik technical weakness MIDYEAR

            // Jika "Other" yang dipilih, atur nilai textarea ke "-"
            // if (alc === 'other' || technical === 'other') {
            //     textareaValue = '-';
            // }

            let isAlertShown = false;
            if (!alc_mid || !sub_alc_mid || !technical_mid || !strong_mid_alc.trim() || !technical_value_mid.trim() || !weak_alc_mid || !weak_sub_alc_mid || !weak_technical_mid || !weak_mid_alc.trim() || !weak_technical_value_mid.trim()) {
                if (!isAlertShown) {
                    alert('Fields must be filled.');
                    isAlertShown = true;
                }
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?= base_url('strongweak/save_data'); ?>',
                data: {
                    id_strongweak_main       : id_strongweak_main,
                    note_mid                 : note_mid,
                    alc_mid                  : alc_mid,
                    sub_alc_mid              : sub_alc_mid,
                    technical_mid            : technical_mid,
                    strong_mid_alc           : strong_mid_alc,
                    technical_value_mid      : technical_value_mid,
                    weak_alc_mid             : weak_alc_mid,
                    weak_sub_alc_mid         : weak_sub_alc_mid,
                    weak_technical_mid       : weak_technical_mid,
                    weak_mid_alc             : weak_mid_alc,
                    weak_technical_value_mid : weak_technical_value_mid
                },
                beforeSend: function(){
                    $('#save').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save').hide();
                },
                success: function (response) {
                    location.reload();
                }
            });
        });

        // Function untuk menyimpan data saat tombol "Save" saat One year
        $('#save-one').on('click', function () {
            var id_strongweak_main  = $('#id_strongweak_main').val();
            var note_one            = $('#note_one_input').val();
            // One year strong
            var alc_one             = $('#alc_one').val();
            var sub_alc_one         = $('#sub_alc_one').val();
            var technical_one       = $('#technical_one').val();
            var strong_one_alc      = $('#strong_one_alc-input').val(); // textarea milik alc ONEYEAR
            var technical_value_one = $('#technical_value_one-input').val(); // textarea milik technical ONEYEAR

            // One year weak
            var weak_alc_one             = $('#weak_alc_one-input').val();
            var weak_sub_alc_one         = $('#weak_sub_alc_one').val();
            var weak_technical_one       = $('#weak_technical_one').val();
            var weak_one_alc             = $('#weak_one_alc-input').val(); // textarea milik alc weakness ONEYEAR
            var weak_technical_value_one = $('#weak_technical_value_one-input').val(); // textarea milik technical weakness ONEYEAR
            console.log(note_one);
            console.log(alc_one);
            console.log(sub_alc_one);
            console.log(technical_one);
            console.log(strong_one_alc);
            console.log(weak_alc_one);
            console.log(weak_technical_one);
            console.log(weak_sub_alc_one);
            console.log(weak_one_alc);
            console.log(weak_technical_value_one);

            // Jika "Other" yang dipilih, atur nilai textarea ke "-"
            // if (alc === 'other' || technical === 'other') {
            //     textareaValue = '-';
            // }

            let isAlertShown = false;
            if (!alc_one || !sub_alc_one || !technical_one || !strong_one_alc.trim() || !technical_value_one.trim() || !weak_alc_one || !weak_sub_alc_one || !weak_technical_one || !weak_one_alc.trim() || !weak_technical_value_one.trim()) {
                if (!isAlertShown) {
                    alert('Fields must be filled.');
                    isAlertShown = true;
                }
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?= base_url('strongweak/save_data_one'); ?>',
                data: {
                    id_strongweak_main       : id_strongweak_main,
                    alc_one                  : alc_one,
                    note_one                 : note_one,
                    sub_alc_one              : sub_alc_one,
                    technical_one            : technical_one,
                    strong_one_alc           : strong_one_alc,
                    technical_value_one      : technical_value_one,
                    weak_alc_one             : weak_alc_one,
                    weak_sub_alc_one         : weak_sub_alc_one,
                    weak_technical_one       : weak_technical_one,
                    weak_one_alc             : weak_one_alc,
                    weak_technical_value_one : weak_technical_value_one,
                },
                beforeSend: function(){
                    $('#save-one').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#save-one').hide();
                },
                success: function (response) {
                    location.reload();
                }
            });
        });

        // Function for the submit button when mid year
        $('#submitBtn').on('click', function() {
            var id_strongweak_main  = $('#id_strongweak_main').val();

            $.ajax({
                url: '<?= base_url('strongweak/submit_data'); ?>',
                type: 'post',
                data: {
                    id_strongweak_main  : id_strongweak_main
                },
                beforeSend: function(){
                    $('#submitBtn').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#submitBtn').hide();
                },
                success: function (response) {
                    console.log('data submitted');
                    location.reload();
                    $('#edit').hide();
                }
            });
        });

        // Function for the submit button when one year
        $('#submitone').on('click', function() {
            var id_strongweak_main  = $('#id_strongweak_main').val();

            $.ajax({
                url: '<?= base_url('strongweak/submit_data_one'); ?>',
                type: 'post',
                data: {
                    id_strongweak_main  : id_strongweak_main
                },
                beforeSend: function(){
                    $('#submitone').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function(){
                    $('#submitone').hide();
                },
                success: function (response) {
                    console.log('data submitted');
                    location.reload();
                }
            });
        });
    });
</script>
<?= $this->endSection('script'); ?>
