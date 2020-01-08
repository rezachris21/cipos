

<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Data Supplier</h2>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th style="width:18%;text-align: center;" >Aksi</th>                   
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($supplier as $s) {
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $s->nama ?></td>
                  <td><?php echo $s->alamat ?></td>
                  <td><?php echo $s->hp ?></td>                                     
                  <td style="text-align: center;">
                    <a href = "#tambahsupplier" title ="Edit Data" data-toggle = "modal" class = "btn btn-round btn-info btn-sm" onclick="submit('<?php echo $s->id ?>')"><i class="fa fa-pencil"> Edit</i></a>
                  
                    <a class = "btn btn-round btn-danger btn-sm" title="Hapus Data" onclick = "hapus('<?php echo $s->id ?>')"><i class="fa fa-trash-o"></i> Delete</a>
                  </td>
                </tr>
              <?php } ?>    
            </tbody>
          </table>
          <a href="#tambahsupplier" data-toggle="modal" class="btn btn-primary btn-sm" onclick="submit('tambah')"><span class="glyphicon glyphicon-plus"></span> Tambah Supplier</a>

          <!--Modal Tambah Data-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="tambahsupplier">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Data Supplier</h4>
                  <center><font color="red"><p id="pesan"></p></font></center>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="alamat" name="alamat" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>                    

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. HP :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hp" name="hp" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btn-tambah" onclick="tambahData()">Tambah</button>
                      <button type="button" class="btn btn-primary" id="btn-edit" onclick="editData()">Edit</button>
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


  function tambahData() // menambahkan data
  {

    var nama = $("[name = 'nama']").val();
    var alamat = $("[name = 'alamat']").val();
    var hp = $("[name = 'hp']").val();

    $.ajax({
      type : 'POST',
      data:'nama='+nama+'&alamat='+alamat+'&hp='+hp,
      url : '<?php echo base_url().'supplier/tambahdata' ?>',
        dataType : 'json',
        success : function(hasil)
        {
          $("#pesan").html(hasil.pesan);

          if (hasil.pesan == '')
          {
            $("#tambahsupplier").modal('hide');
            
            swal("Selesai!","Data berhasil di tambah","success");
            window.setTimeout(function(){       
            window.location.href="supplier";
            },2700);

            var nama = $("[name = 'nama']").val('');
            var alamat = $("[name = 'alamat']").val('');
            var hp = $("[name = 'hp']").val('');

          }
        }
    });
  }

  function submit(x) //switch tombol tambah/ubah di modal
  {
    if (x=='tambah')
    {
      $("#btn-tambah").show();
      $("#btn-edit").hide();
        var nama = $("[name = 'nama']").val('');
        var alamat = $("[name = 'alamat']").val('');
        var hp = $("[name = 'hp']").val('');
    }
    else
    {
      $("#btn-tambah").hide();
      $("#btn-edit").show();

      $.ajax({ // mengambil data untuk ditampilkan di modal
        type:'POST',
        data:'id='+x,
        url:'<?php echo base_url().'supplier/ambilid' ?>',
        dataType:'json',
        success:function(hasil)
        {
         $("[name = 'id']").val(hasil[0].id);
         $("[name = 'nama']").val(hasil[0].nama);
         $("[name = 'alamat']").val(hasil[0].alamat);
         $("[name = 'hp']").val(hasil[0].hp);
         
        }
      })
    }
  }

  function editData() // edit data
  {
    var id = $("[name = 'id']").val();
    var nama = $("[name = 'nama']").val();
    var alamat = $("[name = 'alamat']").val();
    var hp = $("[name = 'hp']").val();

    $.ajax({
      type:'POST',
      data:'id='+id+'&nama='+nama+'&alamat='+alamat+'&hp='+hp,
      url:'<?php echo base_url().'supplier/editdata' ?>',
      dataType:'json',
      success:function(hasil)
      {
        $("#pesan").html(hasil.pesan)
        {
          if (hasil.pesan == '')
          {
            $("#tambahsupplier").modal('hide');
            swal("Selesai!","Data berhasil di ubah","success");
            window.setTimeout(function(){       
            window.location.href="supplier";
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
        url : '<?php echo base_url().'supplier/hapusdata' ?>',
        success: function(){
          swal("Selesai!","File sudah terhapus","success");
          window.setTimeout(function(){
            window.location.href='supplier';
          },2700);
        },
        error:function (xhr,ajaxOptions,thrownError) {
          swal("Error deleting","Please try again","error");
        }
      });
    });
  }
</script>
<!-- /page content -->
        