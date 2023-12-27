<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Store</h1>
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
                <div class="col-lg-12 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $param['totalStore'] ?></h3>
                            <p>Store</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Store Data</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <table id="data_store" class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 10%">#</th>
                                <th>Store Name</th>
                                <th class="text-center">Territory Name</th>
                                <th class="text-center">Country Region Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($param['data'] as $ter) {
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $ter->store_name?></td>
                                <td class="text-center"><?php echo $ter->territory_name?></td>
                                <td class="text-center"><?php echo $ter->country_region_name?></td>
                            </tr>
                            <?php 
                            $no++;
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Store Region Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="chartStoreReg">
                            <div id="chartStoreRegion"></div>
                        </div>
                        <p class="highcharts-description"></p>
                    </figure>
                </div>
            </div>

        </div>
    </div>
</div>