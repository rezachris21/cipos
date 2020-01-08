<!-- page content -->
<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
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
            <a class="btn btn-warning btn-sm" href="<?php echo base_url().'laporan/laporan_pdf/?dari='.set_value('dari').'&sampai='.set_value('sampai') ?>">
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
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Total</th>
                <th>Profit</th>
                <th>Status</th>
                <th></th>         
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($laporan as $l) {
                  $totalbarang = $totalbarang+$l->jumlah;
                  $totalbruto = $totalbruto+$l->subtotal;
                  $totaldiskon = $totaldiskon+$l->diskon;
                  $totalnetto = $totalnetto+$l->total;
                  $totalprofit = $totalprofit+$l->profitt;
                  $kode = $l->kode_penjualan;
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $l->tgl_penjualan ?></td>
                  <td><?php echo $l->kode_penjualan ?></td>
                  <td><?php echo $l->nama_barang ?></td>
                  <td><?php echo $l->jumlah ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->subtotal,0,",",".") ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->diskon,0,",",".") ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->total,0,",",".") ?></td>
                  <td style="text-align: right"><?php echo "Rp. ".number_format($l->profitt,0,",",".") ?></td>
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
                    <a onclick="window.open('penjualanv2/struk?kodepj=<?php echo $kode ?>','mywindow','width=700px,height=400px,left=300px;')" class = "btn btn-round btn-success btn-sm" title="Lihat Detail"><i class="glyphicon glyphicon-print"></i> Cetak Struk</a>
                  </td>
                  
                </tr>
              <?php } ?>    
            </tbody>
          </table>
          <br><br>
          <table class="table table-striped">
            <tr>
              <td style="font-size: 16px; text-align: right;">Total Barang Keluar :</td>
              <td style="font-size: 16px; text-align: right;"><?php echo $totalbarang ?></td>

            </tr>
            <tr>
              <td style="font-size: 16px; text-align: right;">Total Bruto :</td>         
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalbruto,0,",",".") ?></td>
            </tr>
            <tr>
              <td style="font-size: 16px; text-align: right;">Total Diskon :</td>
              
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totaldiskon,0,",",".") ?></td>
            </tr>
            <tr>
              <td style="font-size: 16px; text-align: right;">Total Netto :</td>
             
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalnetto,0,",",".") ?></td>
            </tr>
            <tr>
              <td style="font-size: 16px; text-align: right;">Total Profit :</td>
              
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalprofit,0,",",".") ?></td>
            </tr>
            
          </table>               	        
        </div>  
      </div>
    </div>
  </div>
</div>

<!-- /page content -->
        