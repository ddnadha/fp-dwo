<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sales <?php echo @$_GET['year'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Store') ?>">Store</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-6 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= "$ " . number_format($param['revenue'], 2);  ?></h3>
                            <p>Sales Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $param['total'] ?></h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Filter Tahun
                        </div>
                        <div class="card-body">
                            <div>
                                <form>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select name="year" class="select2 form-control">
                                            <?php foreach(range(2011, 2014) as $c): ?>
                                                <option><?php echo $c ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            Penjualan Berdasarkan Kategori
                        </div>
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="chartByCategory">
                                    <div id="chartPsalesCategory"></div>
                                </div>
                                <p class="highcharts-description"></p>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            Penjualan Berdasarkan Wilayah
                        </div>
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="chartByRegion">
                                    <div id="chartPsalesRegion"></div>
                                </div>
                                <p class="highcharts-description"></p>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                <div class="card">
                        <div class="card-header">
                            Penjualan Berdasarkan Pengiriman
                        </div>
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="chartByShipment">
                                    <div id="chartPsalesShipment"></div>
                                </div>
                                <p class="highcharts-description"></p>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Sales Per Store
                        </div>
                        <div class="card-body">
                            <div>
                                <form>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="select2 form-control">
                                            <?php foreach($param['category'] as $c): ?>
                                                <option><?php echo $c->category ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                    
                                </form>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Store Name</th>
                                    <th>Sales Qty</th>
                                    <th>Sales Total</th>
                                </thead>
                                <tbody>
                                    <?php foreach($param['store'] as $s => $store): ?>
                                        <tr>
                                            <td><?php echo $s + 1 ?></td>
                                            <td><?php echo $store->store_name ?></td>
                                            <td><?php echo $store->qty ?></td>
                                            <td><?php echo $store->total ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Sales Data</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <table id="data_sales" class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 10%">#</th>
                                <th>fact sales id</th>
                                <th class="text-center">order quantity</th>
                                <th class="text-center">total due</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($param['dataSales'] as $ter) {
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $ter->fact_sales_id?></td>
                                <td class="text-center"><?php echo $ter->quantity?></td>
                                <td class="text-center"><?php echo $ter->total?></td>
                            </tr>
                            <?php 
                            $no++;
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card  collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Sales Revenue Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10"><center><h1>Sales Revenue</h1></center><br>
                    <figure class="highcharts-figure">
                        <div id="chartku">
                            <div id="chartRev"></div>
                        </div>
                        <p class="highcharts-description"></p>
                    </figure>
                </div>
            </div>

            <div class="card  collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Sales Trend Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10"><center><h1>Sales Trend</h1></center><br>
                    <figure class="highcharts-figure">
                        <div id="chartku2">
                            <div id="chartT"></div>
                        </div>
                        <p class="highcharts-description"></p>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let byCategory = JSON.parse(`<?php echo json_encode($param['category']); ?>`);
    let byRegion = JSON.parse(`<?php echo json_encode($param['region']); ?>`);
    let byShipment = JSON.parse(`<?php echo json_encode($param['shipment']); ?>`);
</script>
