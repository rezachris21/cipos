<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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

	<h3>Laporan Stok Barang</h3>
	<br/>
	<br/>
	<table class="table-data">
		<thead>
			<tr>
				<th>No</th>
        <th>Nama Barang</th>
        <th>Kode Barcode</th>
        <th>Satuan</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Profit</th>
        <th>Stok</th>
                
			</tr>
		</thead>
		<tbody>
			<?php
              $no = 1;
                foreach ($cetakbarang as $l) {

                  $totalbarang = $totalbarang+$l->stok;
                  
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $l->nama_barang ?></td>
                  <td><?php echo $l->kode_barcode ?></td>
                  <td><?php echo $l->satuan ?></td>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($l->harga_beli,0,",",".") ?></td>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($l->harga_jual,0,",",".") ?></td>
                  <td style="text-align: right;"><?php echo "Rp. ".number_format($l->profit,0,",",".") ?></td>
                  <td style="text-align: center;"><?php echo $l->stok ?></td>                
                </tr>
              <?php } ?>
		</tbody>
	</table>
	</table>
          <br><br>
          <table class="table table-striped">
            <tr>
              <td style="font-size: 16px; text-align: left;">Total Stok Barang :</td>
              <td style="font-size: 16px; text-align: right;"><?php echo $totalbarang ?></td>

            </tr>
          </table>
            <!--
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
            
          </table>   -->
</body>
</html>