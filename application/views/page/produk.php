<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('Produk') ?>">Produk</a></li>
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
                            <h3><?= $param['totalProduk'] ?></h3>
                            <p>Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Product Data</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <table id="data_produk" class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 10%">#</th>
                                <th>Product Name</th>
                                <th class="text-center">Sub Category</th>
                                <th class="text-center">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($param['data'] as $ter) {
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $ter->product_name?></td>
                                <td class="text-center"><?php echo $ter->sub_category?></td>
                                <td class="text-center"><?php echo $ter->category?></td>
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
                    <h3 class="card-title">Product Category Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="chartku3">
                            <div id="chartKat"></div>
                        </div>
                        <p class="highcharts-description"></p>
                    </figure>
                </div>
            </div>
            
            <div class="card  collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Top 5 Product Sales Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Filter</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" id="tahun">
                                            <option value="all" selected>Semua</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
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
                        
                        <div class="card-footer"><button class="btn btn-primary float-right" role="button" id="gen">Generate</button></div>
                        <br><center><h1>Top 5 Product Sales</h1></center><br>
                        <figure class="highcharts-figure">
                            <div id="chartku">
                                <div id="chartPsales"></div>
                            </div>
                            <p class="highcharts-description"></p>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="card  collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Top 5 Product Purchase Chart</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Filter</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" id="tahun2">
                                            <option value="all" selected>Semua</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control" id="bulan2">
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
                        
                        <div class="card-footer"><button class="btn btn-primary float-right" role="button" id="gen2">Generate</button></div>
                        <br><center><h1>Top 5 Product Purchase</h1></center><br>
                        <figure class="highcharts-figure">
                            <div id="chartku2">
                                <div id="chartPpur"></div>
                            </div>
                            <p class="highcharts-description"></p>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>