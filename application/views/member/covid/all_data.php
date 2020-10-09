<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Covid</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Covid</li>
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
                <form class="form-horizontal" method="post" action="<?php echo base_url('admin/data_covid/uploads'); ?>" enctype="multipart/form-data">
                  <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h4 class="card-title">Input Data Covid</h4>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">Provinsi</label>
                      <div class="col-sm-9">
                        <select name="id_province" class="form-control" required>
                            <?php foreach ($lokasi as $key => $value){ ?>
                            <option value="<?php echo $value->province_id ?>"><?php echo $value->province_name ?></option>    
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="fname" class="col-sm-3 text-right control-label col-form-label">File</label>
                      <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-offset-2 col-sm-9">
                        <button type="submit" class="btn btn-default">Submit</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>

            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('msgbox') ?>
                    <h5 class="card-title">Data Covid</h5>
                    <form class="form-horizontal" method="get" action="<?php echo base_url('admin/data_covid/all_data'); ?>" enctype="multipart/form-data">
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 text-right control-label col-form-label">Provinsi</label>
                          <div class="col-sm-9">
                            <select name="id_province" class="form-control" required>
                                <?php foreach ($lokasi as $key => $value){ ?>
                                <option value="<?php echo $value->province_id ?>" <?php if($_GET['id_province']){if($_GET['id_province'] == $value->province_id){echo "selected";}} ?>><?php echo $value->province_name ?></option>    
                                <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 text-right control-label col-form-label">Tanggal</label>
                          <div class="col-sm-9">
                            <input type="date" name="date" class="form-control" value="<?php if($_GET['date']){echo $_GET['date'];} ?>" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 text-right control-label col-form-label"></label>
                          <div class="col-sm-9">
                            <input type="radio" name="date_type" value="tanggal"  <?php if($_GET['date_type']){if($_GET['date_type'] == "tanggal"){echo "checked";}}else if(empty($_GET['date_type'])){echo "checked";} ?> >&nbsp;Tanggal Data Real<br>
                            <input type="radio" name="date_type" value ="created_date" <?php if($_GET['date_type']){if($_GET['date_type'] == "created_date"){echo "checked";}}else if(empty($_GET['date_type'])){echo "checked";} ?> >&nbsp;Tanggal Data Disimpan<br>
                            <input type="radio" name="date_type" value ="updated_date" <?php if($_GET['date_type']){if($_GET['date_type'] == "updated_date"){echo "checked";}}else if(empty($_GET['date_type'])){echo "checked";} ?> >&nbsp;Tanggal Data Diupdate<br>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-offset-2 col-sm-9">
                            <button type="submit" class="btn btn-default">Filter</button>
                            <a href="<?php echo base_url('admin/data_covid/all_data'); ?>" class="btn btn-secondary">Reset</a>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Provinsi</th>
                                    <th>Kasus</th>
                                    <th>Akumulasi Kasus</th>
                                    <th>Rawat / Isolasi </th>
                                    <th>Akumulasi Sembuh</th>
                                    <th>Akumulasi Meninggal</th>
                                    <th>Tanggal Data Disimpan</th>
                                    <th>Tanggal Data Diupdate</th>
                                </tr>
                            </thead> 
                            <tbody>
                                 <?php
                                 $no = 0 ;
                                 foreach($listData as $value){
                                    $no++;
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $value->tanggal ?></td>
                                        <td><?php echo $value->province_name ?></td>
                                        <td><?php echo $value->kasus ?></td>
                                        <td><?php echo $value->akumulasi_kasus ?></td>
                                        <td><?php echo $value->rawat_isolasi ?></td>
                                        <td><?php echo $value->akumulasi_sembuh ?></td>
                                        <td><?php echo $value->akumulasi_meninggal ?></td>
                                        <td><?php echo $value->created_date ?></td>
                                        <td><?php echo $value->updated_date ?></td>
                                    </tr>
                                    <?php 
                                }
                                ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
