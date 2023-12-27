<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Sales') ?>">Sales</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
                            foreach ($param['data'] as $ter) {
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