

<!-- barang content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Data Barang</h2>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">

            <thead>
              <tr>
								<th>No</th>
								<th>Image</th>
                <th>Kode Barcode</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Profit</th>
                <th style="text-align: center;">Aksi</th>
                
                
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($barang as $b) {
              ?>
                <tr>
									<td><?php echo $no++ ?></td>
									<td><img src="assets/images/barang/<?php echo $b->image; ?>" width="50" height="50" alt="Image"></td>
                  <td><?php echo $b->kode_barcode ?></td>
                  <td><?php echo $b->nama_barang ?></td>
                  <td><?php echo $b->satuan ?></td>
                  <td><?php echo $b->stok ?></td>
                  <td><?php echo "Rp.". number_format($b->harga_beli,0,",",".") ?></td>
                  <td><?php echo "Rp.". number_format($b->harga_jual,0,",",".") ?></td>
                  <td><?php echo "Rp.". number_format($b->profit,0,",",".") ?></td>
                  <td style="text-align: center">
                    <a href = "#tambahbarang" title ="Edit Data" data-toggle = "modal" class = "btn btn-round btn-info btn-sm" onclick="submit('<?php echo $b->id ?>')"><i class="fa fa-pencil"> Edit</i></a>
                  
                    <a class = "btn btn-round btn-danger btn-sm" title="Hapus Data" onclick = "hapus('<?php echo $b->id ?>')"><i class="fa fa-trash-o"> Delete</i></a>

                    <a href = "#tambahstok" title ="Edit Data" data-toggle = "modal" class = "btn btn-round btn-success btn-sm" onclick="submitstok('<?php echo $b->id ?>')"><i class="fa fa-plus"> Tambah Stok</i></a>
                  </td>
                </tr>
              <?php } ?>    
            </tbody>
          </table>

          <a href="#tambahbarang" data-toggle="modal" class="btn btn-primary btn-sm" onclick="submit('tambah')"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</a>

          <a href="<?php echo base_url().'barang/cetakbarang' ?>" data-toggle="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-print"></span> Cetak PDF</a>

          <!--Modal Tambah Barang-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="tambahbarang">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Data Barang</h4>
                  <center><font color="red"><p id="pesan"></p></font></center>
                </div>
                <div class="modal-body">
                  <form id="demo" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode Barang :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="kode" name="kode" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Barang :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="satuan" name="satuan">
                          <option value="">-Pilih Satuan-</option>
                          <option value="BOTOL">BOTOL</option>
                          <option value="PCS">PCS</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stok :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="stok" name="stok" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Harga Beli :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hbeli" name="hbeli"  required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Harga Jual :<span class="required" >*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hjual" name="hjual" required="required" class="form-control col-md-7 col-xs-12" onkeyup="sum()">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profit :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="profit" name="profit" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                      </div>
										</div>

										<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="file" name="file" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" id="btn-tambah">Tambah</button>
                      <button type="button" class="btn btn-primary" id="btn-edit" onclick="editData()">Edit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>  
          </div> 
          <!-- End Modal Tambah Barang -->

          <!--Modal Tambah Stok-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="tambahstok">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Tambah Stok Barang</h4>
                  <center><font color="red"><p id="pesan"></p></font></center>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode Barang :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="kodee" name="kodee" required="required" class="form-control col-md-7 col-xs-12" readonly>
                        <input type="hidden" id="idd" name="idd" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Barang :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="namaa" name="namaa" required="required" class="form-control col-md-7 col-xs-12" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stok Lama :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="stoklama" name="stoklama" required="required" class="form-control col-md-7 col-xs-12" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tambah Stok :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tstok" name="tstok" required="required" class="form-control col-md-7 col-xs-12" onkeyup="sumstok()">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stok Baru :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="stokbaru" name="stokbaru" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btn-tambah" onclick="tambahstok()">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>  
          </div> 
          <!-- End Modal Tambah Stok -->     			        
        </div>  
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){

		$('#demo').submit(function(e){
			e.preventDefault();
			$.ajax({
				url:'<?php echo base_url();?>barang/do_upload',
				type:'POST',
				data:new FormData(this),
				processData:false,
				contentType:false,
				cache:false,
				success:function(data)
				{
					$("#tambahbarang").modal('hide');
					
					swal("Selesai!","Data berhasil di tambah","success");
					window.setTimeout(function(){       
					window.location.href="barang";
					},2700);
				}
			});
		});
	});

  function sumstok() // menghitung profit di modal
  {
    var stoklama = $("[name = 'stoklama']").val();
    var tstok = $("[name = 'tstok']").val();
    var result = parseInt(stoklama)+parseInt(tstok);

    if (!isNaN(result)) 
    {
      $("[name = 'stokbaru']").val(result);
    }
  }

  function sum() // menghitung profit di modal
  {
    var hbeli = $("#hbeli").val();
    var hjual = $("#hjual").val();
    var result = parseInt(hjual)-parseInt(hbeli);

    if (!isNaN(result)) 
    {
      $("#profit").val(result);
    }
  }


  // function tambahData() 
  // {
  //   var kode = $("[name = 'kode']").val();
  //   var nama = $("[name = 'nama']").val();
  //   var satuan = $("[name = 'satuan']").val();
  //   var stok = $("[name = 'stok']").val();
  //   var hbeli = $("#hbeli").autoNumeric('get');
  //   var hjual = $("#hjual").autoNumeric('get');
  //   var profit = $("#profit").autoNumeric('get');

  //   $.ajax({
  //     type : 'POST',
  //     data:'kode='+kode+'&nama='+nama+'&satuan='+satuan+'&stok='+stok+'&hbeli='+hbeli+'&hjual='+hjual+'&profit='+profit,
  //     url : '<?php echo base_url().'barang/tambahdata' ?>',
  //       dataType : 'json',
  //       success : function(hasil)
  //       {
  //         $("#pesan").html(hasil.pesan);

  //         if (hasil.pesan == '')
  //         {
  //           $("#tambahbarang").modal('hide');
            
  //           swal("Selesai!","Data berhasil di tambah","success");
  //           window.setTimeout(function(){       
  //           window.location.href="barang";
  //           },2700);

  //           var pesan = $("[id = 'pesan']").val('');
  //           var kode = $("[name = 'kode']").val('');
  //           var nama = $("[name = 'nama']").val('');
  //           var satuan = $("[name = 'satuan']").val('');
  //           var stok = $("[name = 'stok']").val('');
  //           var hbeli = $("[name = 'hbeli']").val('');
  //           var hjual = $("[name = 'hjual']").val('');
  //           var profit = $("[name = 'profit']").val('');

  //         }
  //       }
  //   });
  // }

  function submit(x) //switch tombol tambah/ubah di modal
  {
    if (x=='tambah')
    {
      $("#btn-tambah").show();
      $("#btn-edit").hide();
      var kode = $("[name = 'kode']").val('');
      var nama = $("[name = 'nama']").val('');
      var satuan = $("[name = 'satuan']").val('');
      var stok = $("[name = 'stok']").val('');
      var hbeli = $("[name = 'hbeli']").val('');
      var hjual = $("[name = 'hjual']").val('');
      var profit = $("[name = 'profit']").val('');
    }
    else
    {
      $("#btn-tambah").hide();
      $("#btn-edit").show();

      $.ajax({ // mengambil data untuk ditampilkan di modal
        type:'POST',
        data:'id='+x,
        url:'<?php echo base_url().'barang/ambilid' ?>',
        dataType:'json',
        success:function(hasil)
        {
         $("[name = 'id']").val(hasil[0].id);
         $("[name = 'kode']").val(hasil[0].kode_barcode);
         $("[name = 'nama']").val(hasil[0].nama_barang);
         $("[name = 'satuan']").val(hasil[0].satuan);
         $("[name = 'stok']").val(hasil[0].stok);
         $("[name = 'hbeli']").val(hasil[0].harga_beli);
         $("[name = 'hjual']").val(hasil[0].harga_jual);
         $("[name = 'profit']").val(hasil[0].profit);
        }
      })
    }
  }

  function submitstok(x)
  {
    $.ajax({ // mengambil data untuk ditampilkan di modal tambah stok
        type:'POST',
        data:'id='+x,
        url:'<?php echo base_url().'barang/ambilid' ?>',
        dataType:'json',
        success:function(hasil)
        {
         $("[name = 'idd']").val(hasil[0].id);
         $("[name = 'kodee']").val(hasil[0].kode_barcode);
         $("[name = 'namaa']").val(hasil[0].nama_barang);
         $("[name = 'stoklama']").val(hasil[0].stok);         
        }
    });
  }

  function tambahstok()
  {
    var id = $("[name = 'idd']").val();
    var stokbaru = $("[name = 'stokbaru']").val();

    $.ajax({
      type:'POST',
      data:'idd='+id+'&stokbaru='+stokbaru,
      url: '<?php echo base_url().'barang/tambahstok' ?>',
      dataType:'json',
      success:function(hasil)
      {
        $("#pesan").html(hasil.pesan)
        {
          if (hasil.pesan == '')
          {
            $("#tambahstok").modal('hide');
            swal("Selesai!","Stok berhasil di tambah","success");
            window.setTimeout(function(){       
            window.location.href="barang";
            },2700);

          }
        }
      }
    });           
  }

  function editData() // edit data
  {
    var id = $("[name = 'id']").val();
    var kode = $("[name = 'kode']").val();
    var nama = $("[name = 'nama']").val();
    var satuan = $("[name = 'satuan']").val();
    var stok = $("[name = 'stok']").val();
    var hbeli = $("#hbeli").val();
    var hjual = $("#hjual").val();
    var profit = $("#profit").val();

    $.ajax({
      type:'POST',
      data:'id='+id+'&kode='+kode+'&nama='+nama+'&satuan='+satuan+'&stok='+stok+'&hbeli='+hbeli+'&hjual='+hjual+'&profit='+profit,
      url:'<?php echo base_url().'barang/editdata' ?>',
      dataType:'json',
      success:function(hasil)
      {
        $("#pesan").html(hasil.pesan)
        {
          if (hasil.pesan == '')
          {
            $("#tambahbarang").modal('hide');
            swal("Selesai!","Data berhasil di ubah","success");
            window.setTimeout(function(){       
            window.location.href="barang";
            },2700);
          }
        }
      }
    });
  }

  function hapus(id) // hapus data
  {
    swal({
      title: "Apakah anda yakin ?",
      text: "Anda tidak dapat mengembalikan file yang sudah di hapus",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6855",
      confirmButtonText: "Ya, Hapus !",
      closeOnConfirm: false
    },function (isConfirm){

      if (!isConfirm) return;

      $.ajax({
        type : 'POST',
        data : 'id='+id,
        url : '<?php echo base_url().'barang/hapusdata' ?>',
        success: function(){
          swal("Selesai!","File sudah terhapus","success");
          window.setTimeout(function(){
            window.location.href='barang';
          },2700);
        },
        error:function (xhr,ajaxOptions,thrownError) {
          swal("Error deleting","Please try again","error");
        }
      });
    });                       
  }
</script>
<!-- /barang content -->
        