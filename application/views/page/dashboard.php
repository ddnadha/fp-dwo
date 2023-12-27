<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard') ?>">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Filter</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control" id="tahun">
                                    <option value="all" selected>Semua</option>
                                    <option value="2011">2001</option>
                                    <option value="2012">2002</option>
                                    <option value="2013">2003</option>
                                    <option value="2014">2004</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control" id="bulan">
                                    <option value="all" selected>Semua</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button class="btn btn-primary float-right" role="button" id="gen">Generate</button>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3 id="srevenue"></h3>                            
                            <p>Sales Revenue</p>
                        </div>
                        <div class="icon"><i class="ion ion-cash"></i></div>
                        <a href="<?php echo base_url('Sales') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="pexpanses"></h3>
                            <p>Purchase Expense</p>
                        </div>
                        <div class="icon"><i class="ion ion-stats-bars"></i></div>
                        <a href="<?php echo base_url('Purchase') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $param['totalStore']  ?></h3>
                            <p>Store</p>
                        </div>
                        <div class="icon"><i class="fas fa-store"></i></div>
                        <a href="<?php echo base_url('Store') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $param['totalProduct']  ?></h3>
                            <p>Product</p>
                        </div>
                        <div class="icon"><i class="fas fa-box"></i></div>
                        <a href="<?php echo base_url('Produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $param['totalShipment']  ?></h3>
                            <p>Store</p>
                        </div>
                        <div class="icon"><i class="fas fa-truck"></i></div>
                        <a href="<?php echo base_url('Shipment') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $param['totalStore']  ?></h3>
                            <p>Store</p>
                        </div>
                        <div class="icon"><i class="fas fa-store"></i></div>
                        <a href="<?php echo base_url('Territory') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>