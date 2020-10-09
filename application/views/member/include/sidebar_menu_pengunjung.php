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
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('admin/kmeans/daftar_kmeans') ;?>" aria-expanded="false"><i class="mdi mdi-login-variant"></i><span class="hide-menu">Login</span></a></li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>