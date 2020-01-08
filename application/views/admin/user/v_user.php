

<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Data User</h2>

          <div class="clearfix"></div>
        </div>

        <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered">

            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
								<th>Level</th>
							
                <th>Foto</th>
               
                <th style="width:18%;text-align: center;">Aksi</th>
                
                
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($user as $u) {
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $u->nama ?></td>
                  <td><?php echo $u->username ?></td>
									<td><?php echo $u->password ?></td>
									<td><?php echo $u->level ?></td>
						
                  <td><img src="assets/images/<?php echo $u->foto; ?>" width="50" height="50" alt="Image"></td>
                  
                  
                  <td style="text-align: center;">
                    <a href = "#tambahuser" title ="Edit Data" data-toggle = "modal" class = "btn btn-round  btn-info btn-sm" onclick="submit('<?php echo $u->id ?>')"><i class="fa fa-pencil"> Edit</i></a>
                  
                    <a class = "btn btn-round btn-danger btn-sm" title="Hapus Data" onclick = "hapus('<?php echo $u->id ?>')"><i class="fa fa-trash-o"> Delete</i></a>

                  </td>
                </tr>
              <?php } ?>    
            </tbody>
          </table>
          <a href="#tambahuser" data-toggle="modal" class="btn btn-primary btn-sm" onclick="submit('tambah')"><span class="glyphicon glyphicon-plus"></span> Tambah User</a>

          <!--Modal Tambah Barang-->
          <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="tambahuser">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                  <h4 class="modal-title" id="myModalLabel">Data User</h4>
                  <center><font color="red"><p id="pesan"></p></font></center>
                </div>
                <div class="modal-body">
                  <form id="demo" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nama" name="nama" required="required" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" id="id" name="id" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ulangi Password :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="upassword" name="upassword" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Level :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="level" name="level" required="">
													<option value="">-Pilih Level-</option>
													<?php if ($this->session->userdata('level')=='owner') { ?>
													<option value="owner">Owner</option>
													<?php } ?>
													<?php if ($this->session->userdata('level')=='admin') { ?>
                          <option value="admin">Admin</option>
													<option value="kasir">Kasir</option>
													<?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto :<span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="file" name="file" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    

                    
                    <div class="modal-footer">
                      
                      <button type="submit" class="btn btn-info" id="btn-tambah">Tambah</button>
                      <button type="button" class="btn btn-info" id="btn-edit" onclick="editData()">Edit</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>  
          </div> 
          <!-- End Modal Tambah Barang -->   

          

        </div>  
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">


  /*function tambahData() // menambahkan data
  {

    var nama = $("[name = 'nama']").val();
    var username = $("[name = 'username']").val();
    var password = $("[name = 'password']").val();
    var upassword = $("[name = 'upassword']").val();
    var level = $("[name = 'level']").val();

    $.ajax({
      type : 'POST',
      data:new FormData(this),
      url : '<?php echo base_url().'user/tambahdata' ?>',
      processData:false,
      contentType:false,
      cache:false,
      async:false,
        success : function(hasil)
        {
          $("#pesan").html(hasil.pesan);

          if (hasil.pesan == '')
          {
            $("#tambahuser").modal('hide');
            
            swal("Selesai!","Data berhasil di tambah","success");
            window.setTimeout(function(){       
            window.location.href="user";
            },2700);

             var nama = $("[name = 'nama']").val('');
             var username = $("[name = 'username']").val('');
             var password = $("[name = 'password']").val('');
             var upassword = $("[name = 'upassword']").val('');
             var level = $("[name = 'level']").val('');

          }
        }
    });
  }*/
   $(document).ready(function(){

      $('#demo').submit(function(e){
        e.preventDefault();
        $.ajax({
          url:'<?php echo base_url();?>user/do_upload',
          type:'POST',
          data:new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          success:function(data)
          {
            $("#tambahuser").modal('hide');
            
            swal("Selesai!","Data berhasil di tambah","success");
            window.setTimeout(function(){       
            window.location.href="user";
            },2700);
          }
        });
      });
    });

  function submit(x) //switch tombol tambah/ubah di modal
  {
    if (x=='tambah')
    {
      $("#btn-tambah").show();
      $("#btn-edit").hide();
            var nama = $("[name = 'nama']").val('');
            var username = $("[name = 'username']").val('');
            var password = $("[name = 'password']").val('');
            var upassword = $("[name = 'upassword']").val('');
            var level = $("[name = 'level']").val('');
    }
    else
    {
      $("#btn-tambah").hide();
      $("#btn-edit").show();

      $.ajax({ // mengambil data untuk ditampilkan di modal
        type:'POST',
        data:'id='+x,
        url:'<?php echo base_url().'user/ambilid' ?>',
        dataType:'json',
        success:function(hasil)
        {
         $("[name = 'id']").val(hasil[0].id);
         $("[name = 'nama']").val(hasil[0].nama);
         $("[name = 'username']").val(hasil[0].username);
         $("[name = 'password']").val(hasil[0].password);
         $("[name = 'upassword']").val(hasil[0].password);
         $("[name = 'level']").val(hasil[0].level);
        
         
        }
      })
    }
  }

  function editData() // edit data
  {
    var id = $("[name = 'id']").val();
    var nama = $("[name = 'nama']").val();
    var username = $("[name = 'username']").val();
    var password = $("[name = 'password']").val();
    var upassword = $("[name = 'upassword']").val();
    var level = $("[name = 'level']").val();
    var foto = $("[name = 'foto']").val();

    $.ajax({
      type:'POST',
      data:'id='+id+'&nama='+nama+'&username='+username+'&password='+password+'&upassword='+upassword+'&level='+level+'&foto='+foto,
      url:'<?php echo base_url().'user/editdata' ?>',
      dataType:'json',
      success:function(hasil)
      {
        $("#pesan").html(hasil.pesan)
        {
          if (hasil.pesan == '')
          {
            $("#tambahuser").modal('hide');
            swal("Selesai!","Data berhasil di ubah","success");
            window.setTimeout(function(){       
            window.location.href="user";
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
        url : '<?php echo base_url().'user/hapusdata' ?>',
        success: function(){
          swal("Selesai!","File sudah terhapus","success");
          window.setTimeout(function(){
            window.location.href='user';
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
        