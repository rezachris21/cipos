<!-- page content -->

        <div class="right_col" role="main">
          

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dashboard</h2>

                    
                    <div class="clearfix"></div>

                  </div>
                  
                  <div class="x_content">
                      <!-- top tiles -->

                      
		          <div class="row tile_count">

		            <!--<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                		<div class="tile-stats">
                  			<div class="icon"><i class="fa fa-archive"></i></div>
                  			<div class="count"><?php echo $this->m->ambildata('tb_barang')->num_rows(); ?></div>
                  			<h3>Barang</h3>
                  			<p>Total semua barang yang terdaftar</p>
                		</div>
              		</div>

              		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                		<div class="tile-stats">
                  			<div class="icon"><i class="fa fa-users"></i></div>
                  			<div class="count"><?php echo $this->m->ambildata('tb_kustomer')->num_rows(); ?></div>
                  			<h3>Kustomer</h3>
                  			<p>Total semua kustomer yang terdaftar</p>
                		</div>
              		</div>-->

              		<?php
              			foreach ($penjualan as $p) {
           			
              			}
              		?>
              		<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                		<div class="tile-stats">
                  			<div class="icon"><i class="fa fa-shopping-cart"></i></div>
                  			<div class="count"><?php echo "Rp. ".number_format($p->totalpenjualan,0,",",".") ?></div>
                  			<h3>Penjualan Hari ini</h3>
                  			<p>Total semua penjualan hari ini</p>
                		</div>
              		</div>

              		<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                		<div class="tile-stats">
                  			<div class="icon"><i class="fa fa-dollar"></i></div>
                  			<div class="count"><?php echo "Rp. ".number_format($p->totalprofit,0,",",".") ?></div>
                  			<h3>Profit Hari ini</h3>
                  			<p>Total semua profit hari ini</p>
                		</div>
              		</div>


              		<?php
              			foreach ($pending as $pd) {
           			
              			}
              		?>
                  <a href="<?php echo base_url().'pending/transaksipending_pdf' ?>">
              		<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                		<div class="tile-stats">
                  			<div class="icon"><i class="fa fa-envelope-o"></i></div>
                  			<div class="count"><?php echo "Rp. ".number_format($pd->totalpending,0,",",".") ?></div>
                  			<h3>Transaksi Pending</h3>
                  			<p>Total semua transaksi pending</p>
                		</div>
              		</div>
                  </a>


		    	</div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
		        <div>
					     <canvas id="myChart"></canvas>
				    </div>
          </div>


          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            
              <div class="x_title">
                <h2>Top 10 Item Sale</h2>
                <div class="clearfix"></div>
              </div>
              
              <div class="col-md-12 col-sm-12 col-xs-6">
                <div>
                  <?php foreach($topteen as $k){ ?>
                  <p><?php echo $k->nama_barang; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="badge badge-secondary"><?php echo $k->jumlah ?></span></p>
                  <div class="">
                    <div class="progress progress_sm" style="width: 76%;">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $k->jumlah; ?>"></div>
                    </div>            
                  </div>
                  <?php } ?>
                </div>
              <div>         
          </div>

        </div>
      </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            
              <div class="x_title">
                <h2>Top 10 Kustomer</h2>
                <div class="clearfix"></div>
              </div>
              
              <div class="col-md-12 col-sm-12 col-xs-6">
                <div>
                  <?php 
                  $no = 1;
                  foreach($topkustomer as $k){ 
                    
                    ?>
                  <p><?php echo $no++."." ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $k->nama; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="badge badge-secondary"><?php echo "Rp. ".number_format($k->total,0,",",".") ?></span></p>
                  <?php } ?>
                </div>
              <div>         
          </div>
        </div>







          <!--<div class="col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-user o"></i> Kostumer Terbaru</h3>
              </div>
              <div class="panel-body">
                <div class="list-group">
                  <?php foreach($topteen as $k){ ?>
                    <a href="#" class="list-group-item">
                      <span class="badge"><?php echo $k->jumlah ?></span>
                      <i class="glyphicon glyphicon-user"></i> <?php echo $k->nama_barang; ?>
                    </a>        
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          </div>-->





				<script>
					var ctx = document.getElementById("myChart").getContext('2d');
					var myChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: [<?php foreach($tanggal as $t){echo '"' . $t->tgl_penjualan . '",';} ?>],
							datasets: [{
								label: '# Rp.',
								data: [<?php foreach($penjualan1 as $p1){echo '"' . $p1->totjual . '",';} ?>],
								backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
								],
								borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
								],
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero:true
									}
								}]
							}
						}
					});
				</script>
          			<!-- /top tiles -->
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

