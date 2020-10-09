<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <?php 
            $cur1 = $this->uri->segment(2);
            $cur2 = $this->uri->segment(3);
        ?>

        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/dashboard/') ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/pengguna/daftar') ?>" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Pengguna</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/data_covid/all_data') ?>" aria-expanded="false"><i class="mdi mdi-star-circle"></i><span class="hide-menu">Data Covid</span></a></li>
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/kmeans/daftar_kmeans') ;?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">K-means</span></a></li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>