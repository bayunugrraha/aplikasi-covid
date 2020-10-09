<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Admin</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
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
                    <h5 class="card-title">Data Admin</h5>
                    <a href="<?php echo base_url('admin/pengguna/add/') ?>" class="button-pull-right"  >
                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" >
                            <i class="ace-icon fa fa-plus"></i>
                            Tambah Data
                        </button>
                    </a> 
                    <div class="table-responsive" style="margin-top: 20px;">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
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
                                        <td><?php echo $value->username; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/pengguna/edit/'.$value->admin_id) ?>"><button class="btn btn-primary btn-sm btnEmptySaldo"   style="margin-left:2px"><i class="fa fa-pencil-square" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Lihat/Edit</span></button></a>
                                            <a href="<?php echo base_url('admin/pengguna/doDelete/'.$value->admin_id) ?>"><button class="btn btn-danger btn-sm"   style="margin-left:2px" onclick="return confirm('Anda yakin ingin menghapus data ini ? ')"><i class="fa fa-trash" style="font-size: 14px;"></i>&nbsp;&nbsp;<span>Hapus</span></button></a>
                                        </td>

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
