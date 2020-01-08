<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Laporan Transaksi Sukses</h2>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">    

          <form method="POST" action="<?php echo base_url().'laporan' ?>">
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
        