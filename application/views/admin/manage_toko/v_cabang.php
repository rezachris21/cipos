

<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Data Cabang</h2>
          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>No</th>
                <th>Nama Cabang</th>
                <th>Lokasi Cabang</th>
                <th>Status</th>
                <th style="width:18%;text-align: center;" >Aksi</th>                   
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($cabangs as $cabang) {
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $cabang->nama_cabang ?></td>
                  <td><?php echo $cabang->lokasi_cabang ?></td>
                  <td><?php echo $cabang->status ?></td>                                
                  <td style="text-align: center;">
                    <a href = "#tambahCabang" title ="Edit Data" data-toggle = "modal" class = "btn btn-round btn-info btn-sm" onclick="submit('<?php echo $cabang->id ?>')"><i class="fa fa-pencil"> Edit</i></a>
                  
                    <a class = "btn btn-round btn-danger btn-sm" title="Hapus Data" onclick = "hapus('<?php echo $cabang->id ?>')"><i class="fa fa-trash-o"></i> Delete</a>
                  </td>
                </tr>
              <?php } ?>    
            </tbody>
          </table>
          <a href="#tambahCabang" data-toggle="modal" class="btn btn-primary btn-sm" onclick="submit('tambah')"><span class="glyphicon glyphicon-plus"></span> Cabang</a>

          <!--Modal Tambah Data-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="tambahCabang">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Data Cabang</h4>
                  <center><font color="red"><p id="pesan"></p></font></center>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Cabang :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtNamaCabang" name="txtNamaCabang" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lokasi Cabang :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtLokasiCabang" name="txtLokasiCabang" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>                    

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="slcStatus" id="slcStatus" class="form-control">
							<option value="">-Pilih-</option>
							<option value="1">Aktif</option>
							<option value="2">Non Aktif</option>
						</select>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btn-edit" onclick="editData()">Edit</button>
                      <button type="button" class="btn btn-primary" id="btn-tambah" onclick="tambahData()">Tambah</button>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>  
          </div> 
          <!-- End Modal Tambah Data -->     			        
        </div>  
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  function submit(x)
  {
    if (x == "tambah")
    {
      $("#btn-tambah").show();
      $("#btn-edit").hide();
    }
    else
    {
      $("#btn-tambah").hide();
      $("#btn-edit").show();

      $.ajax({
        type:'POST',
        data:'id='+x,
        url:'<?php echo base_url().'cabang/ambilid' ?>',
        dataType:'json',
        success:function(hasil)
        {
          $("[name = 'id']").val(hasil[0].id);
          $("[name = 'txtNamaCabang']").val(hasil[0].nama_cabang);
          $("[name = 'txtLokasiCabang']").val(hasil[0].lokasi_cabang);
          $("[name = 'slcStatus']").val(hasil[0].status);
        }
      });
    }
  }

  function tambahData()
  {
    var txtNamaCabang = $("[name = 'txtNamaCabang']").val();
    var txtLokasiCabang = $("[name = 'txtLokasiCabang']").val();
    var slcStatus = $("[name = 'slcStatus']").val();

    $.ajax({
      type :'POST',
      data :'txtNamaCabang='+txtNamaCabang+'&txtLokasiCabang='+txtLokasiCabang+'&slcStatus='+slcStatus,
      url :'<?php echo base_url().'cabang/tambahdata' ?>',
      dataType :'json',
      success:function(hasil)
      {
        $("#pesan").html(hasil.pesan);

        if (hasil.pesan == "")
        {
          $("tambahCabang").modal('hide');

          swal("Selesai!","Data berhasil di tambah","success");
            window.setTimeout(function(){       
            window.location.href="cabang";
            },2700);

          var txtNamaCabang = $("[name = 'txtNamaCabang']").val('');
          var txtLokasiCabang = $("[name = 'txtLokasiCabang']").val('');
          var slcStatus = $("[name = 'slcStatus']").val('');
        }
      }
    });
  }

  function editData()
  {
    var id = $("[name='id']").val();
	var txtNamaCabang = $("[name = 'txtNamaCabang']").val();
    var txtLokasiCabang = $("[name = 'txtLokasiCabang']").val();
    var slcStatus = $("[name = 'slcStatus']").val();

    $.ajax({
      type:'POST',
      data:'id='+id+'&txtNamaCabang='+txtNamaCabang+'&txtLokasiCabang='+txtLokasiCabang+'&slcStatus='+slcStatus,
      url:'<?php echo base_url().'cabang/editdata' ?>',
      dataType:'json',
      success:function(hasil)
      {
        $("#pesan").html(hasil.pesan);

        if (hasil.pesan == "")
        {
          $("#tambahCabang").modal('hide');
          swal("Selesai!","Data berhasil di ubah","success");
            window.setTimeout(function(){       
            window.location.href="cabang";
            },2700);
        }
      }
    });
  }

  function hapus(id)
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
        url : '<?php echo base_url().'cabang/hapusdata' ?>',
        success: function(){
          swal("Selesai!","File sudah terhapus","success");
          window.setTimeout(function(){
            window.location.href='cabang';
          },2700);
        },
        error:function (xhr,ajaxOptions,thrownError) {
          swal("Error deleting","Please try again","error");
        }
      });
    });
  }
</script>



        