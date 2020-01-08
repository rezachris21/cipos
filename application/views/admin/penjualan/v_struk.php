<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<style>
	* {
		font-family:monospace;
	}

	@media print{
		input.noPrint{
			display: none;
		}
	}
</style>
<center><h4 style="text-decoration:underline; ">STRUK BELANJA</h4></center>

<center><table>
	
	<tr>
		<td style="text-align: center;">COZY VAPE STORE</td>
	</tr>	
	<?php foreach($cabang as $cbg) { ?>
	<tr>
		<td style="text-align: center"><?php echo $cbg->lokasi_cabang ?></td>
	</tr>
	<?php } ?>

</table></center>
<td><hr></td>

<table>

	<?php
	foreach ($struk as $s)
	?>
	
	<tr>
		<td>Kode Penjualan &nbsp&nbsp</td>
		<td>:&nbsp&nbsp <?php echo $s->kode_penjualan; ?></td>
	</tr>

	<tr>
		<td>Tanggal &nbsp&nbsp</td>
		<td>:&nbsp&nbsp <?php echo $s->tgl_penjualan; ?></td>
	</tr>

</table>

	<td><hr></td>
	
<table>
	<thead>
		<tr>
			<th style="text-align:left;">#</th>
			<th style="text-align:left;">Nama Barang</th>
			<th style="text-align:center;">Bruto</th>
			<th style="text-align:right;">Qty</th>
			<th style="text-align:center;">Diskon</th>
			<th style="text-align:center;">Netto</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($struk as $st){
			$no = 1;  
		?>
			<tr>
				<td><?php echo  $no++ .'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td>
				<td style="text-align:left;"><?php echo $st->nama_barang; ?></td>
				<td style="text-align:right;"><?php echo '&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'."Rp.".number_format($st->harga_jual).',-' ?></td>

				<td><?php echo '&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.$st->jumlah ?></td>
				<td style="text-align:right;"><?php echo '&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'."Rp.".number_format($st->diskon).',-' ?></td>

				<td style="text-align:right;"><?php echo '&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'."Rp.".number_format($st->total).',-'; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<td><hr></td>
<center>
<table >
	<tr >
		<th style="text-align:left;">Bruto</th>
		<td>:</td>
		<td>Rp.</td>
		<td style="text-align: right;"><?php echo number_format($st->sub_total).",-"; ?></td>
	</tr>

	<tr>
		<th style="text-align:left;">Diskon</th>
		<td>:</td>
		<td>Rp.</td>
		<td style="text-align: right;"><?php echo number_format($st->total_diskon).",-"; ?></td>
	</tr>

	<tr>
		<th style="text-align:left;">Netto</th>
		<td>:</td>
		<td>Rp.</td>
		<td style="text-align: right;"><?php echo number_format($st->total_all).",-"; ?></td>
	</tr>

	<tr>
		<th style="text-align:left;">Bayar</th>
		<td>:</td>
		<td>Rp.</td>
		<td style="text-align: right;"><?php echo number_format($st->total_bayar).",-"; ?></td>
	</tr>

	<tr>
		<th style="text-align:left;">Kembali</th>
		<td>:</td>
		<td>Rp.</td>
		<td style="text-align: right;"><?php echo number_format($st->total_kembali).",-"; ?></td>
	</tr>
</table>
</center>
<hr>
<center>
	<table>
		<p>TERIMAKASIH TELAH BERBELANJA DI COZY VAPE</p>
		<P>BARANG YANG SUDAH DIBELI TIDAK DAPAT DI TUKAR !!</P>
	</table>
</center>
	


<br>

<input type="button" class="noPrint" value="Print" onclick="window.print()"></input>
