<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">K-means</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Analisa K-means</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h5 class="card-title">Data Covid</h5>
                    <form class="form-horizontal" method="get" action="<?php echo base_url('admin/kmeans/daftar_kmeans'); ?>" enctype="multipart/form-data">
                      <div class="card-body">
                        
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tanggal</label>
                          <div class="col-sm-9">
                            <input type="date" name="date" class="form-control" value="<?php if($_GET['date']){echo $_GET['date'];} ?>" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <div class="col-sm-offset-2 col-sm-9">
                            <button type="submit" class="btn btn-default">Analisa</button>
                            <a href="<?php echo base_url('admin/kmeans/daftar_kmeans'); ?>" class="btn btn-secondary">Reset</a>
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
                <?php if($kmeans !== null) { ?>
                    <div class="card-body">
                        <?php echo $this->session->flashdata('msgbox') ?>
                        <h5 class="card-title">Perhitungan K-means</h5>

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headinggOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Step #1
                                    </button>
                                </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headinggOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Provinsi</th>
                                                    <th>Tanggal</th>
                                                    <th>Kasus</th>
                                                    <th>Akumulasi Meninggal</th>
                                                    <th>Akumulasi Sembuh</th>
                                                    <th>Rawat Isolasi</th>
                                                    <th>Akumulasi Kasus</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                <?php
                                                $nor=1;
                                                foreach ($kmeans['data_kumpul'] as $key => $value) { ?>
                                                <tr>
                                                    <th><?= $nor++ ?></th>
                                                    <th><?= $value['data_province']['province_name'] ?></th>
                                                    <th><?= $value['tanggal'] ?></th>
                                                    <th><?= number_format($value['kasus'],0) ?></th>
                                                    <th><?= number_format($value['akumulasi_meninggal'],3) ?></th>
                                                    <th><?= number_format($value['akumulasi_sembuh'],3) ?></th>
                                                    <th><?= number_format($value['rawat_isolasi'],3) ?></th>
                                                    <th><?= number_format($value['akumulasi_kasus'],3) ?></th>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                            <?php
                                $numbering = [];
                                $totalIterasi = count($kmeans['cluster']['dataCluster']);
                                foreach ($kmeans['cluster']['dataCluster'] as $key => $value) { 
                                    $dataCluster = [];
                                    foreach ($value as $keys => $values) {
                                        foreach ($values as $keyss => $valuess) {
                                            $dataBaru = ['province_name'=>$valuess['data_province']['province_name'],'c1'=>null,'c2'=>null,'c3'=>null,'hasil'=>$keys];
                                            $dataBaru[$keys] = $valuess['nilaiCluster'][$key][$keys];
                                            $dataCluster[] = $dataBaru;

                                            if ($key == $totalIterasi) {
                                                if (empty($numbering[$keys])) {
                                                    $numbering[$keys] = 0;
                                                }
                                                $numbering[$keys]++;
                                            }
                                        }
                                    }
                            ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo $key; ?>">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="collap <?php echo $key; ?>">
                                    Iterasi <?php echo $key; ?>
                                    </button>
                                </h2>
                                </div>
                                <div id="collapse<?php echo $key; ?>" class="collapse" aria-labelledby="heading<?php echo $key; ?>" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Provinsi</th>
                                                    <th>C1 (Tinggi)</th>
                                                    <th>C2 (Sedang)</th>
                                                    <th>C3 (Rendah)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($dataCluster as $keys => $values) { ?>
                                                <tr>
                                                    <th><?= $keys+1 ?></th>
                                                    <th><?= $values['province_name'] ?> (<?= $values['hasil'] ?> )</th>
                                                    <th><?= (!is_null($values['c1'])?number_format(floatval($values['c1']),2):'') ?>
                                                    </th>
                                                    <th><?= (!is_null($values['c2'])?number_format(floatval($values['c2']),2):'') ?>
                                                    </th>
                                                    <th><?= (!is_null($values['c3'])?number_format(floatval($values['c3']),2):'') ?>
                                                    </th>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        
                        
                            <p>Jumlah Keseluruhan</p>
                            <?php 
                            $hitungTotal = 0;
                            foreach ($numbering as $key => $value):
                                $hitungTotal+=$value;
                                if($key == "c1"){
                                    $key = "Kasus covid-19 Tinggi, total ";
                                }else if($key == "c2"){
                                    $key = "Kasus covid-19 Sedang, total ";
                                }else{
                                    $key = "Kasus covid-19 Rendah, total ";
                                }
                            ?>
                            <p><?= $key ?> = <?= $value ?></p>
                            <?php endforeach ?>
                            <p>Total <?= $hitungTotal ?></p>
                        </div>
                    </div>
                <?php } else { ?>
                    <p class="text-center"><i>data tidak ditemukan</i></p>
                <?php } ?>
            </div>
        </div>
    
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
