
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

	function submit(x)
	{
	

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

	function addcart()
  	{
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

	function hapus(id, kode_barcode, jumlah, stok) // hapus data
	{
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

	function tambahqty(id, kode_barcode, jumlah, stok) // hapus data
	{
		$.ajax({
			type: 'POST',
			data: 'id='+id+'&kode_barcode='+kode_barcode+'&jumlah='+jumlah+'&stok='+stok,
			url: '<?php echo base_url().'penjualanv2/tambahqty'?>',
			success: function() {
				window.location.reload();
			},
			error: function() {
				swal("Error deleting", "Please try again", "error");
			}
		});
	}

	function kurangqty(id, kode_barcode, jumlah, stok) // hapus data
	{
		
		$.ajax({
			type: 'POST',
			data: 'id='+id+'&kode_barcode='+kode_barcode+'&jumlah='+jumlah+'&stok='+stok,
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
				var data={id:id,value:value};
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
		