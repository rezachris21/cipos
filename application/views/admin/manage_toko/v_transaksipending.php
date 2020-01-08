<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Laporan Transaksi Pending</h2>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">    

          <form method="POST" action="<?php echo base_url().'pendingtoko' ?>">
            <div class="col-md-3">         
              <label>Dari Tanggal :</label>
              <input type="date" name="dari" id="dari" class="form-control" >
              <?php echo form_error('dari'); ?>
            </div>

            <div class="col-md-3">         
              <label>Sampai Tanggal :</label>
              <input type="date" name="sampai" id="sampai" class="form-control" >
              <?php echo form_error('sampai'); ?>
						</div>
						
						<div class="col-md-3">         
            	<label>Cabang</label>
							<select name="slcCabang" id="slcCabang" class="form-control">
								<option value="">Semua</option>
								<?php foreach($cabangs as $cabang) { ?>
								<option value="<?php echo $cabang->id ?>"><?php echo $cabang->nama_cabang ?></option>
								<?php } ?>
							</select>
            </div>

            <div class="col-md-3">         
              <br/>
              <input type="submit" value="CARI" name="cari" class="btn btn-md btn-primary">
            </div>
          </form>     
                   	        
        </div>  
      </div>
    </div>
  </div>
</div>

<!-- /page content -->
        