<style type="text/css">
	#gallery,
	#upload {
		border: 1px solid #ccc;
		margin: 10px auto;
		width: 100%;
		padding: 10px;
	}

	#blank_gallery {
		font_family: Arial;
		font-size: 18px;
		font-weight: bold;
		text-align: center;
	}

	.thumbb {
		float: left;
		width: 160px;
		height: 120px;
		padding: 10px;
		margin: 10px;
		background-color: white;
	}

	.thumbb:hover {
		outline: 1px solid #999;
	}

	.thumbb img {
		width: 141px;
		height: 90px;
	}

	#gallery:after {
		content: ".";
		visibility: hidden;
		display: block;
		clear: both;
		height: 0;
		font-size: 0;
	}

	td {
		cursor: pointer;
	}

	.editor{
		display: none;
	}
</style>
<?php
$kode = $_GET['kodepj'];
$koderandom = random_string('nozero',9);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="clearfix"></div>
	<input type="hidden" id="kodepenjualan" name="kodepenjualan" required="required" readonly class="form-control col-md-7 col-xs-12" value="<?php echo $kode; ?>">
	<div class="row">
		<div class="col-md-12">

			<div class="col-md-7">
				<div class="x_panel">
					<div id="upload">
						<form action="#" method="post">
							<input type="text" class="form-control" placeholder="Scan Barcode" id="barcode" name="barcode" autocomplete="off">
							<input type="hidden" name="barcode_kode_penjualan" id="barcode_kode_penjualan" placeholder="Kode Penjualan" value="<?php echo $kode; ?>">
							<input type="hidden" name="barcode_hargajual" id="barcode_hargajual" placeholder="hargajual">
							<input type="hidden" name="barcode_profit" id="barcode_profit" placeholder="profit">
							<input type="hidden" name="barcode_stok" id="barcode_stok" placeholder="stok">
							<input type="hidden" name="barcode_id" id="barcode_id" placeholder="id">
							<input type="hidden" name="barcode_qty" id="barcode_qty" value="1">
							<input type="hidden" name="barcode_diskon" id="barcode_diskon" value="0">
						</form>
					</div>
					<div id="gallery">
						<?php foreach ($barang as $b) { ?>
							<div class="thumbb">
								<a href="#showmodal" data-toggle="modal" onclick="submit('<?php echo $b->id ?>')">
									<img src=" assets/images/barang/<?php echo $b->image; ?>" alt="" />
									<p style="text-align:center;"><b><?php echo $b->nama_barang ?></b></p>
									<input type="hidden" name="kode_barcode" id="kode_barcode" value="<?php echo $b->kode_barcode ?>">
								</a>
							</div>

						<?php } ?>
					</div>
				</div>
			</div>

			<div class="col-md-5">
				<div class="x_panel">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Qty</th>
								<th>Subtotal</th>
								<th>Diskon</th>
								<th>Total</th>
								<th>Aksi</th>
							</tr>
						</thead>

						<tbody>
							<?php $no = 1;
							foreach ($penjualan as $k) {
								$qty = $k->jumlah;
								$harga = $k->harga_jual;

								$total_subtotal = $total_subtotal + $k->subtotal;
								$total_diskon = $total_diskon + $k->diskon;
								$total_semua = $total_semua + $k->total;
								?>
								<tr data-id="<?php echo $k->id_penjualan ?>">
									<td>
										<a class = "btn btn-round btn-danger btn-sm" title="Hapus Data" onclick = "hapus('<?php echo $k->id_penjualan ?>','<?php echo $k->kode_barcode ?>','<?php echo $k->jumlah ?>','<?php echo $k->stok ?>')">X</a>
									</td>
									<td><?php echo $k->nama_barang ?></td>
									<td style="text-align:center;"><?php echo $k->jumlah ?></td>
									<td style="text-align:right;"><?php echo "Rp. " . number_format($k->subtotal, 0, ",", ".") ?></td>
									<td style="text-align:right;">
										<span class="span-diskon caption" data-id="<?php echo $k->id_penjualan ?>"><?php echo $k->diskon ?></span>
											<input type="text" class="field-diskon form-control editor" value="<?php echo $k->diskon ?>" data-id="<?php echo $k->id_penjualan ?>" data-profit="<?php echo $k->profit_penjualan ?>" data-total="<?php echo $k->total ?>" data-subtotal="<?php echo $k->subtotal ?>" data-diskon="<?php echo $k->diskon ?>">
										</span>
									</td>
									<td style="text-align:right;"><?php echo "Rp. ".number_format($k->total,0,",",".") ?></td>
									<td>
										<a class="btn btn-primary btn-sm" title="Tambah Qty" onclick = "tambahqty('<?php echo $k->id_penjualan ?>','<?php echo $k->kode_barcode ?>','<?php echo $k->jumlah ?>','<?php echo $k->stok ?>','<?php echo $harga ?>','<?php echo $k->subtotal ?>','<?php echo $k->profit ?>','<?php echo $k->profit_penjualan ?>','<?php echo $k->diskon ?>')">+</a>
										<a class="btn btn-success btn-sm" title="Tambah Qty" onclick = "kurangqty('<?php echo $k->id_penjualan ?>','<?php echo $k->kode_barcode ?>','<?php echo $k->jumlah ?>','<?php echo $k->stok ?>','<?php echo $harga ?>','<?php echo $k->subtotal ?>','<?php echo $k->profit ?>','<?php echo $k->profit_penjualan ?>','<?php echo $k->diskon ?>')">-</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="x_panel">
					<form class="form-horizontal">

						<div class="form-group">
							<label class="control-label col-md-4" for="first-name">Sub Total (RP) :</label>
							<div class="col-md-4">
								<input style="text-align: right" type="text" id="subtotal" name="subtotal" data-a-sign="Rp." data-a-sep="." data-a-dec="," required="required" class="form-control col-md-3 col-xs-3" value="<?php echo $total_subtotal ?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4" for="first-name">Total Diskon (RP) :</label>
							<div class="col-md-4">
								<input style="text-align: right" type="text" id="totaldiskon" name="totaldiskon" data-a-sign="Rp." data-a-sep="." data-a-dec="," required="required" class="form-control col-md-3 col-xs-3" value="<?php echo $total_diskon ?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4" for="first-name">Total (RP) :</label>
							<div class="col-md-4">
								<input style="text-align: right" type="text" id="totalsemua" name="totalsemua" data-a-sign="Rp." data-a-sep="." data-a-dec="," required="required" class="form-control col-md-3 col-xs-3" value="<?php echo $total_semua ?>" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4" for="first-name">Bayar (RP) :</label>
							<div class="col-md-4">
								<input style="text-align: right" type="text" id="bayar" data-a-sign="Rp." data-a-sep="." data-a-dec="," autocomplete="off" name="bayar" required="required" class="bayar form-control col-md-3 col-xs-3" onkeyup="hitungkembalian()">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-4" for="first-name">Kembali (RP) :</label>
							<div class="col-md-4">
								<input style="text-align: right" type="text" id="kembali" name="kembali" required="required" data-a-sign="Rp." data-a-sep="." data-a-dec="," class="form-control col-md-3 col-xs-3" readonly>
							</div>
							<div class="col-md-1 col-sm-1 col-xs-1">
								<a class="btn btn-primary btn-sm" onclick="simpan()">Bayar </a>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Modal Tambah Barang-->
<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="showmodal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel" name="namemodal"></h4>
				<center>
					<font color="red">
						<p id="pesan"></p>
					</font>
				</center>
			</div>
			<div class="modal-body">
				<form id="demo" data-parsley-validate class="form-horizontal form-label-left">

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Qty :<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="qty" name="qty" required="required" class="form-control col-md-7 col-xs-12" value="1">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Diskon :<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="diskon" name="diskon" required="required" class="form-control col-md-7 col-xs-12" value="0">
						</div>
					</div>

					
					<input type="hidden" name="kode_penjualan" id="kode_penjualan" placeholder="Kode Penjualan" value="<?php echo $kode; ?>">
					<input type="hidden" name="kode_barcode" id="kode_barcode" placeholder="Kode Barcode">
					<input type="hidden" name="hargajual" id="hargajual" placeholder="hargajual">
					<input type="hidden" name="profit" id="profit" placeholder="profit">
					<input type="hidden" name="stok" id="stok" placeholder="stok">
					<input type="hidden" name="id" id="id" placeholder="id">

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn-tambah" onclick="addcart()">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Tambah Barang -->
<script type="text/javascript">

	$(document).ready(function(){
        $('#barcode').on('input',function(){
                 
            var barcode=$(this).val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('penjualanv2/get_data_barang')?>",
                dataType : "JSON",
                data : {barcode: barcode},
                cache:false,
                success: function(data){
                    $.each(data,function(){
						$('[name="barcode_stok"]').val(data.stok);
						$('[name="barcode_hargajual"]').val(data.harga_jual);
						$('[name="barcode_profit"]').val(data.profit);
						$('[name="barcode_id"]').val(data.id);                 
                    });           
                }
            });
            return false;
		});
		$("#barcode").keypress(function(event){
			if (event.which == 13) {
				var barcode = $("[name = 'barcode']").val();
				var barcode_stok = $("[name = 'barcode_stok']").val();
				var barcode_kode_penjualan = $("[name = 'barcode_kode_penjualan']").val();
				var barcode_hargajual = $("[name = 'barcode_hargajual']").val();
				var barcode_profit = $("[name = 'barcode_profit']").val();
				var barcode_qty = $("[name = 'barcode_qty']").val();
				var barcode_diskon = $("[name = 'barcode_diskon']").val();

				if (barcode_stok == "")
				{
					alert('Barcode Tidak ditemukan');
					window.location.reload();
				}
				else
				{
					$.ajax({
						type : 'POST',
						data:'barcode='+barcode+'&barcode_stok='+barcode_stok+'&barcode_kode_penjualan='+barcode_kode_penjualan+'&barcode_hargajual='+barcode_hargajual+'&barcode_profit='+barcode_profit+'&barcode_qty='+barcode_qty+'&barcode_diskon='+barcode_diskon,
						url : '<?php echo base_url().'penjualanv2/tambah_data_by_barcode' ?>',
						dataType : 'json',
						success : function(hasil)
						{     
							location.reload(); 
						},
						error: function(hasil)
						{
							alert('Barcode Tidak Ditemukan');
							window.location.reload();
						}
					});
				}
			}
		});
		$("#bayar").keypress(function(event){
			if (event.which == 13) {
				simpan();
			}
		});
	});
	
	
	function hitungkembalian() {

		var total = $("#totalsemua").autoNumeric('get');
		var bayar = $("#bayar").autoNumeric('get');
		var result = parseInt(bayar) - parseInt(total);

		if (!isNaN(result)) {
			$("#kembali").val(result);
		}
	}

	<?php echo $jsArray; ?>

	function changeValue(kode_barcode) {
		document.getElementById("hargajual").value = hrg_brg[kode_barcode].hargajual;
		document.getElementById("profit").value = hrg_brg[kode_barcode].profit;
		document.getElementById("stok").value = hrg_brg[kode_barcode].stok;
		document.getElementById("pesanstok").value = hrg_brg[kode_barcode].stok;
	};

	function simpan() {
		var kodepenjualan = $("[name = 'kodepenjualan']").val();
		var subtotal = $("#subtotal").autoNumeric('get');
		var totaldiskon = $("#totaldiskon").autoNumeric('get');
		var totalsemua = $("#totalsemua").autoNumeric('get');
		var bayar = $("#bayar").autoNumeric('get');
		var kembali = $("#kembali").autoNumeric('get');

		if (subtotal == "") {
			swal("Belum ada transaksi", "Silahkan melakukan transaksi !!", "warning");
		} else if (bayar == "") {
			swal("Belum ada uang bayar", "Silahkan Masukkan Uang Bayar !!", "warning");
		} else {

			$.ajax({
				type: 'POST',
				data: 'kodepenjualan=' + kodepenjualan + '&subtotal=' + subtotal + '&totaldiskon=' + totaldiskon + '&totalsemua=' + totalsemua + '&bayar=' + bayar + '&kembali=' + kembali,
				url: '<?php echo base_url() . 'penjualanv2/simpan' ?>',
				dataType: 'json',
				success: function(hasil) {
					/*swal("Selesai!","Transaksi Berhasil","success");
					 window.setTimeout(function(){
					window.open('penjualan/struk?kodepj=<?php echo $kode ?>','mywindow','width=700px,height=400px,left=300px;')                     
					 window.location.href='<?php echo base_url() . "penjualan?kodepj=$koderandom" ?>'; 
					  },2700);*/
					swal({
						title: "Transaksi Selesai",
						text: "Apakah anda akan cetak Struk ??",
						type: "success",
						showCancelButton: true,
						confirmButtonColor: "#DD6855",
						confirmButtonText: "Ya, Cetak !",
						closeOnConfirm: false
					}, function(isConfirm) {

						if (!isConfirm) {
							window.location.href = '<?php echo base_url() . "penjualanv2?kodepj=$koderandom" ?>';
						} else {
							window.setTimeout(function() {
								window.open('penjualanv2/struk?kodepj=<?php echo $kode ?>', 'mywindow', 'width=700px,height=400px,left=300px;')
								window.location.href = '<?php echo base_url() . "penjualanv2?kodepj=$koderandom" ?>';
							});
						}
					});

				}
			});
		}

	}

	function submit(x) {
	

		$.ajax({ // mengambil data untuk ditampilkan di modal
			type:'POST',
			data:'id='+x,
			url:'<?php echo base_url().'penjualanv2/ambilid' ?>',
			dataType:'json',
			success:function(hasil)
			{
				$("[name = 'id']").val(hasil[0].id);
				$("[name = 'kode_barcode']").val(hasil[0].kode_barcode);
				$("[name = 'hargajual']").val(hasil[0].harga_jual);
				$("[name = 'stok']").val(hasil[0].stok);
				$("[name = 'profit']").val(hasil[0].profit);
				$("[name = 'namemodal']").html(hasil[0].nama_barang);
				addcart();
				$("#showmodal").modal('hide');
				
				
			}
		})
	}

	function addcart() {
		var kode_penjualan = $("[name = 'kode_penjualan']").val();
		var kode_barcode = $("[name = 'kode_barcode']").val();
		var hargajual = $("[name = 'hargajual']").val();
		var profit = $("[name = 'profit']").val();
		var stok = $("[name = 'stok']").val();
		var diskon = $("[name = 'diskon']").val();
		var qty = $("[name = 'qty']").val();

		if (qty == "")
		{
			swal("Belum ada Qty","Qty harus di isi !!","warning");
				window.setTimeout(function(){                   
				location.reload(); 
				},2700);  
		}
		else
		{
		
			$.ajax({
				type : 'POST',
				data:'kode_penjualan='+kode_penjualan+'&kode_barcode='+kode_barcode+'&hargajual='+hargajual+'&profit='+profit+'&stok='+stok+'&diskon='+diskon+'&qty='+qty,
				url : '<?php echo base_url().'penjualanv2/tambahdata' ?>',
				dataType : 'json',
				success : function(hasil)
				{     
					location.reload(); 
				}
			});
		}
	}

	function hapus(id, kode_barcode, jumlah, stok) {
		swal({
			title: "Apakah anda yakin ?",
			text: "Anda tidak dapat mengembalikan file yang sudah di hapus",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6855",
			confirmButtonText: "Ya, Hapus !",
			closeOnConfirm: false
		}, function(isConfirm) {

			if (isConfirm) {

				$.ajax({
					type: 'POST',
					data: 'id='+id+'&kode_barcode='+kode_barcode+'&jumlah='+jumlah+'&stok='+stok,
					url: '<?php echo base_url().'penjualanv2/hapusdata'?>',
					success: function() {
						swal("Selesai!", "File sudah terhapus", "success");
						window.setTimeout(function() {
							location.reload();
						}, 2700);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal("Error deleting", "Please try again", "error");
					}
				});
			} else {
				window.location.reload();
			}
		});
	}

	function tambahqty(id, kode_barcode, jumlah, stok, harga_jual, subtotal, profit, profit_penjualan, diskon) {
		$.ajax({
			type: 'POST',
			data: 'id='+id+'&kode_barcode='+kode_barcode+'&jumlah='+jumlah+'&stok='+stok+'&harga_jual='+harga_jual+'&subtotal='+subtotal+'&profit='+profit+'&profit_penjualan='+profit_penjualan+'&diskon='+diskon,
			url: '<?php echo base_url().'penjualanv2/tambahqty'?>',
			success: function() {
				window.location.reload();
			},
			error: function() {
				swal("Error deleting", "Please try again", "error");
			}
		});
	}

	function kurangqty(id, kode_barcode, jumlah, stok, harga_jual, subtotal, profit, profit_penjualan, diskon) {
		
		$.ajax({
			type: 'POST',
			data: 'id='+id+'&kode_barcode='+kode_barcode+'&jumlah='+jumlah+'&stok='+stok+'&harga_jual='+harga_jual+'&subtotal='+subtotal+'&profit='+profit+'&profit_penjualan='+profit_penjualan+'&diskon='+diskon,
			url: '<?php echo base_url().'penjualanv2/kurangqty'?>',
			success: function() {
				window.location.reload();
			},
			error: function(xhr, ajaxOptions, thrownError) {
				swal("Error deleting", "Please try again", "error");
			}
		});
	}

	$(document).ready(function(){

		$(document).on("click","td",function(){
			$(this).find("span[class~='caption']").hide();
			$(this).find("input[class~='editor']").fadeIn().focus();
		});


		$(document).on("keydown",".editor",function(e){
			if(e.keyCode==13){
				var target=$(e.target);

				var value=target.val();
				var id=target.attr("data-id");
				var profit=target.attr("data-profit");
				var total=target.attr("data-total");
				var subtotal=target.attr("data-subtotal");
				var diskon=target.attr("data-diskon");

				var data={id:id,value:value,profit:profit,total:total,subtotal:subtotal,diskon:diskon};
				if(target.is(".field-diskon")){
					data.modul="diskon";
				}

				$.ajax({
					data:data,
					type:"post",
					cache:false,
					dataType: "json",
					url:"<?php echo base_url('penjualanv2/inputdiskon'); ?>",
					success: function(a){
						target.hide();
						target.siblings("span[class~='caption']").html(value).fadeIn();
						location.reload(); 
					}
				})
			}
		});
	});
		
</script>
