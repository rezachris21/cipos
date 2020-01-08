<!-- page content -->
<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<style type="text/css">
  table thead tr th {
    text-align: center;
  }
</style>
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

          <form method="POST" action="<?php echo base_url().'pending' ?>">
            <div class="col-md-3">         
              <label>Dari Tanggal :</label>
              <input type="date" name="dari" id="dari" class="form-control" value="<?php echo set_value('dari'); ?>" >
              <?php echo form_error('dari'); ?>
            </div>

            <div class="col-md-3">         
              <label>Sampai Tanggal :</label>
              <input type="date" name="sampai" id="sampai" class="form-control" value="<?php echo set_value('sampai'); ?>" >
              <?php echo form_error('sampai'); ?>
            </div>

            <div class="col-md-3">         
              <br/>
              <input type="submit" value="CARI" name="cari" class="btn btn-md btn-primary">
            </div>
          </form>
          <br>
          <div class="col-md-3">
            <a class="btn btn-warning btn-sm" href="<?php echo base_url().'pending/transaksipending_pdf/?dari='.set_value('dari').'&sampai='.set_value('sampai') ?>">
              <span class="glyphicon glyphicon-print"></span> Cetak PDF
            </a>
          </div>

          <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>No</th>
                <th>Tgl Penjualan</th>
                <th>Kode Penjualan</th>
                <th>Nama Kustomer</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Total</th>
                <th>Status</th>
                <th style="text-align: center;">Aksi</th>
                   
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($laporan as $l) {
                  $totalnetto = $totalnetto+$l->total;
                  $kodepenj = $l->kode_penjualan;            
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $l->tgl_penjualan ?></td>
                  <td><?php echo $l->kode_penjualan ?></td>
                  <td><?php echo $l->nama ?></td>
                  <td><?php echo $l->jumlah ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->subtotal,0,",",".") ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->diskon,0,",",".") ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->total,0,",",".") ?></td>
                  <td>
                    <?php
                      if ($l->status == "1")
                      {
                        echo "Sudah Lunas";
                      }
                      else{
                        echo "Belum Lunas";
                      }
                    ?>
                    
                  </td>
                  <td>
                    <a href="<?php echo base_url()."penjualan?kodepj=$kodepenj" ?>" class = "btn btn-round btn-success btn-sm" title="Lihat Detail"><i class="fa fa-shopping-cart"></i> Bayar</a>
                  </td>
                  
                </tr>
              <?php } ?>    
            </tbody>
          </table>
          <br><br>
          <table class="table table-striped">
            <tr>
              <td style="font-size: 16px; text-align: right;">Total Transaksi Pending :</td>
              
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalnetto,0,",",".") ?></td>
            </tr>
            
          </table>               	        
        </div>  
      </div>
    </div>
  </div>
</div>

<!--Modal Tambah Stok-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="bayar">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Bayar</h4>
                  <center><font color="red"><p id="pesan"></p></font></center>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode Penjualan :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="kodepj" name="kodepj" required="required" class="form-control col-md-7 col-xs-12" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="total" name="total" required="required" class="form-control col-md-7 col-xs-12" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bayar :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="bayar" name="bayar" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kembali :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="kembali" name="kembali" required="required" class="form-control col-md-7 col-xs-12" readonly>
                      </div>
                    </div>


                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btn-tambah" onclick="bayar()">Bayar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>  
          </div> 
          <!-- End Modal Tambah Stok -->  

<!-- /page content -->
        