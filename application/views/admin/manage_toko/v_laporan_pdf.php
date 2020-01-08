<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>

	<style type="text/css">
		.table-data{
			width: 100%;			
			border-collapse: collapse;			
		}

		.table-data tr th,
		.table-data tr td{
			border:1px solid black;
			font-size: 10pt;
		}		
	</style>

	<h3>Laporan Transaksi Sukses</h3>
	<br/>
	<table>
		<tr>
			<td>Dari Tgl</td>
			<td>:</td>
			<td><?php echo date('d/m/Y',strtotime($_GET['dari'])); ?></td>
		</tr>
		<tr>
			<td>Sampai Tgl</td>
			<td>:</td>
			<td><?php echo date('d/m/Y',strtotime($_GET['sampai'])); ?></td>
		</tr>
	</table>
	<br/>
	<table class="table-data">
		
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
			</tr>
	
			<?php
              $no = 1;
                foreach ($laporan as $l) {
                  $totalbarang = $totalbarang+$l->jumlah;
                  $totalbruto = $totalbruto+$l->subtotal;
                  $totaldiskon = $totaldiskon+$l->diskon;
                  $totalnetto = $totalnetto+$l->total;
                  $totalprofit = $totalprofit+$l->profitt;
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
                  
                </tr>
              <?php } ?>
	
	</table>
	</table>
          <br><br>
          <table class="table table-striped">
            <tr>
              <td style="font-size: 16px; text-align: left;">Total Barang Keluar :</td>
              <td style="font-size: 16px; text-align: right;"><?php echo $totalbarang ?></td>

            </tr>
            <tr>
              <td style="font-size: 16px; text-align: left;">Total Bruto :</td>         
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalbruto,0,",",".") ?></td>
            </tr>
            <tr>
              <td style="font-size: 16px; text-align: left;">Total Diskon :</td>
              
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totaldiskon,0,",",".") ?></td>
            </tr>
            <tr>
              <td style="font-size: 16px; text-align: left;">Total Netto :</td>
             
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalnetto,0,",",".") ?></td>
            </tr>
            <tr>
              <td style="font-size: 16px; text-align: left;">Total Profit :</td>
              
              <td style="font-size: 16px; text-align: right;"><?php echo "Rp. ".number_format($totalprofit,0,",",".") ?></td>
            </tr>
            
          </table>   
