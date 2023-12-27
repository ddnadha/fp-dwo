<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo base_url('Home') ?>" class="brand-link"><span class="brand-text font-weight-light">Adventure Works</span></a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><img src="<?php echo base_url() ?>/assets/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image"></div>
            <div class="info"><a href="#" class="d-block"><?php echo $this->session->userdata('username') ?></a></div>
        </div>
        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo base_url('Dashboard') ?>" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a>
                </li>
                
                <li class="nav-item">
                    <a href="<?php echo base_url('Produk') ?>" class="nav-link">
                    <i class="nav-icon fas fa-box"></i><p>Product</p></a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('Store') ?>" class="nav-link">
                    <i class="nav-icon fas fa-store"></i><p>Store</p></a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('Shipment') ?>" class="nav-link">
                    <i class="nav-icon fas fa-truck"></i><p>Shipment</p></a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('Sales') ?>" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i><p>Sales</p></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>