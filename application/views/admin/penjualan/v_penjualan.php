<style type="text/css">
  table thead tr th {
    text-align:center;
  }
</style>
<?php
$kode = $_GET['kodepj'];
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!-- page content -->
<div class="right_col" role="main">

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">

        <div class="x_title">
          <h2>Penjualan Pending</h2>

          <div class="clearfix"></div>
        </div>
        

        <div class="x_content">
          <!-- <form>
            <div class="form-group">    
              <div class="col-md-2 col-sm-2 col-xs-2">
                <label class="control-label" for="first-name">Kode Penjualan :<span class="required">*</span></label>
                <input type="text" id="kodepenjualan" name="kodepenjualan" required="required" readonly class="form-control col-md-7 col-xs-12" value="<?php echo $kode; ?>">

              </div>
            </div>

            <div class="form-group">    
              <div class="col-md-2 col-sm-2 col-xs-2">
                <label class="control-label" for="first-name">Nama Kustomer :<span class="required">*</span></label>
                <div>
                        <select class="form-control" id="namakustomer" name="namakustomer">
                          <option value="">-Pilih Kustomer-</option>
                          <?php foreach ($kustomer as $k){ ?>
                          <option value="<?php echo $k->id ?>"><?php echo $k->nama; ?></option>     
                          <?php } ?>
                        </select>
                      </div>
              </div>
            </div>

            <?php
              $jsArray = "var hrg_brg = new Array();\n"; 
            ?>
            <div class="form-group">    
              <div class="col-md-2 col-sm-2 col-xs-2">
                <label class="control-label" for="first-name">Nama Barang :<span class="required">*</span></label>
                <div>
                        <select class="form-control" id="namabarang" name="namabarang" onchange="changeValue(this.value)">
                          <option value="">-Pilih Barang-</option>
                          <?php foreach ($barang as $b){ ?>
                          <option value="<?php echo $b->kode_barcode ?>"><?php echo $b->nama_barang; ?></option>
                            
                         <?php $jsArray .= "hrg_brg['" . $b->kode_barcode . "'] = 
                         {
                          hargajual:'" . addslashes($b->harga_jual) . "',
                          profit:'" . addslashes($b->profit) . "',
                          stok:'" . addslashes($b->stok) . "',
                         };\n"; } 
                        


                         ?>
                        </select>
                        <?php echo form_error('namabarang'); ?>
                  </div>

              </div>
            </div>

         
  
              


            <div class="form-group">    
              <div class="col-md-1 col-sm-1 col-xs-1">
                <label class="control-label" for="first-name">Qty :<span class="required">*</span></label>
                <input type="hidden" id="hargajual" name="hargajual" class="form-control col-md-3 col-xs-12">
                <input type="hidden" id="profit" name="profit"  class="form-control col-md-3 col-xs-12">
                <input type="hidden" id="stok" name="stok"  class="form-control col-md-3 col-xs-12">
                 
                <input type="text" id="qty" name="qty" required="required" class="form-control col-md-3 col-xs-12">

              </div>
            </div>

            <div class="form-group">    
              <div class="col-md-2 col-sm-2 col-xs-2">
                <label class="control-label" for="first-name">Diskon :<span class="required">*</span></label>
                <input type="text" id="diskon" name="diskon" required="required" class="form-control col-md-3 col-xs-12" data-a-sign ="Rp." data-a-sep="." data-a-dec=",">

              </div>
            </div>
            <?php
            $koderandom = random_string('nozero',9);
            ?>
            <div class="form-group">    
              <div class="col-md-3 col-sm-3 col-xs-2">
                
                <div class="form-inline">
                  <br>
                <a class="btn btn-primary form-control" title="Tambah ke Cart" onclick="addcart()"><i class="fa fa-shopping-cart"></i></a>
                <a href="<?php echo base_url()."penjualan?kodepj=$koderandom" ?>" title="Generate Kode" class="btn btn-danger form-control"><i class="fa fa-refresh"></i></a>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sisa Stok : <input type="button" id="pesanstok" value="0" class="btn btn-success btn-round"></input>
              </div>
              </div>
            </div>
          </form>
          <br><br>
          <div class="x_title"> -->
          

          
          <font style="font-size: 200%;"><i class="fa fa-shopping-cart"> Keranjang Belanjaan Pending</i></font>
          <div class="clearfix"></div>
        </div>
          <table  class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Barcode</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Diskon</th>
                <th>Total</th>
                <th style="width:18%;text-align: center;" >Aksi</th>                   
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
                foreach ($penjualan as $k) {
                $qty = $k->jumlah;
                $harga = $k->harga_jual;
             
                $total_subtotal = $total_subtotal+$k->subtotal;
                $total_diskon = $total_diskon+$k->diskon;
                $total_semua = $total_semua+$k->total;
                
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  
                  <td><?php echo $k->kode_barcode ?></td>
                  <td><?php echo $k->nama_barang ?></td>
                  <td style="text-align:right;"><?php echo "Rp. ".number_format($k->harga_jual,0,",",".") ?></td>
                  <td style="text-align:center;"><?php echo $k->jumlah ?></td>
                  <td style="text-align:right;"><?php echo "Rp. ".number_format($k->subtotal,0,",",".") ?></td>
                  <td style="text-align:right;"><?php echo "Rp. ".number_format($k->diskon,0,",",".") ?></td>
                  <td style="text-align:right;"><?php echo "Rp. ".number_format($k->total,0,",",".") ?></td>

                                                       
                  <td style="text-align: center;">
                  
                    <a class = "btn btn-round btn-danger btn-sm" title="Hapus Data" onclick = "hapus('<?php echo $k->id_penjualan ?>','<?php echo $k->kode_barcode ?>','<?php echo $k->jumlah ?>','<?php echo $k->stok ?>')"><i class="fa fa-trash-o"></i> Delete</a>
                  </td>
                </tr>
              <?php 
              
            } 
            ?>    
            </tbody>
          </table>
          <form class="form-horizontal">
            
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Sub Total (RP) :</label>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <input style="text-align: right" type="text" id="subtotal" name="subtotal" data-a-sign ="Rp." data-a-sep="." data-a-dec=","  required="required" class="form-control col-md-3 col-xs-3" value="<?php echo $total_subtotal ?>" readonly>     
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Total Diskon (RP) :</label>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <input style="text-align: right" type="text" id="totaldiskon" name="totaldiskon" data-a-sign ="Rp." data-a-sep="." data-a-dec="," required="required" class="form-control col-md-3 col-xs-3" value="<?php echo $total_diskon ?>" readonly>     
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Total (RP) :</label>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <input style="text-align: right" type="text" id="totalsemua" name="totalsemua" data-a-sign ="Rp." data-a-sep="." data-a-dec="," required="required" class="form-control col-md-3 col-xs-3" value="<?php echo $total_semua ?>" readonly>     
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Bayar (RP) :</label>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <input style="text-align: right" type="text" id="bayar" data-a-sign ="Rp." data-a-sep="." data-a-dec="," autocomplete="off" name="bayar" required="required" class="bayar form-control col-md-3 col-xs-3" onkeyup="hitungkembalian()">     
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Kembali (RP) :</label>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <input style="text-align: right" type="text" id="kembali" name="kembali" required="required" data-a-sign ="Rp." data-a-sep="." data-a-dec="," class="form-control col-md-3 col-xs-3" readonly>     
              </div>
              <div class="col-md-1 col-sm-1 col-xs-1">
                <a class="btn btn-primary btn-sm" onclick="simpan()">Bayar </a>    
              </div>
              <!--<div class>
                <a href="#tambahkustomer" data-toggle="modal" class="  btn btn-danger btn-sm" onclick="submit('tambah')">Cetak Struk </a>    
              </div>-->
            </div>
        
          </form>			        
        </div>  
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  function hitungkembalian()
  {

    

    var total = $("#totalsemua").autoNumeric('get');
    var bayar = $("#bayar").autoNumeric('get');
    var result = parseInt(bayar)-parseInt(total);

    if (!isNaN(result))
    {
      $("#kembali").val(result);
    }
  }

  <?php echo $jsArray; ?>
  function changeValue(kode_barcode) 
  {
    document.getElementById("hargajual").value = hrg_brg[kode_barcode].hargajual;
    document.getElementById("profit").value = hrg_brg[kode_barcode].profit;
    document.getElementById("stok").value = hrg_brg[kode_barcode].stok;
    document.getElementById("pesanstok").value = hrg_brg[kode_barcode].stok;
  };

  function addcart()
  {
    var kodepenjualan = $("[name = 'kodepenjualan']").val();
    var namakustomer = $("[name = 'namakustomer']").val();
    var namabarang = $("[name = 'namabarang']").val();
    var qty = $("[name = 'qty']").val();
    var hargajual = $("[name = 'hargajual']").val();
    var diskon = $("#diskon").autoNumeric('get');
    var profit = $("[name = 'profit']").val();
    var stok = $("[name = 'stok']").val();

    if (namakustomer == "")
    {
      swal("Belum ada nama kustomer","Nama Kustomer harus di isi !!","warning");
            window.setTimeout(function(){                   
            location.reload(); 
             },2700);  
    }

    else if (namabarang == "")
    {
      swal("Belum ada nama barang","Nama Barang harus di pilih !!","warning");
            window.setTimeout(function(){                   
            location.reload(); 
             },2700);  
    }

    else if (qty == "")
    {
      swal("Belum ada qty","Qty harus di isi !!","warning");
            window.setTimeout(function(){                   
            location.reload(); 
             },2700);  
    }

    else if (stok == 0)
    {
      swal("Stok barang habis","Silahkan melakukan Pre Order !!","warning");
            window.setTimeout(function(){                   
            location.reload(); 
             },2700);  
    }

    else
    {
     
      $.ajax({
        type : 'POST',
        data:'kodepenjualan='+kodepenjualan+'&namakustomer='+namakustomer+'&namabarang='+namabarang+'&qty='+qty+'&hargajual='+hargajual+'&diskon='+diskon+'&profit='+profit,
        url : '<?php echo base_url().'penjualan/tambahdata' ?>',
          dataType : 'json',
          success : function(hasil)
          {     
            location.reload(); 
          }
      });
    }
  }

  function simpan()
  {
    var kodepenjualan = $("[name = 'kodepenjualan']").val();
    var subtotal = $("#subtotal").autoNumeric('get');
    var totaldiskon = $("#totaldiskon").autoNumeric('get');
    var totalsemua = $("#totalsemua").autoNumeric('get');
    var bayar = $("#bayar").autoNumeric('get');
    var kembali = $("#kembali").autoNumeric('get');

    if (subtotal == "")
    {
      swal("Belum ada transaksi","Silahkan melakukan transaksi !!","warning"); 
    }
    else if (bayar == "")
    {
      swal("Belum ada uang bayar","Silahkan Masukkan Uang Bayar !!","warning"); 
    }
    else
    {

    $.ajax({
        type : 'POST',
        data:'kodepenjualan='+kodepenjualan+'&subtotal='+subtotal+'&totaldiskon='+totaldiskon+'&totalsemua='+totalsemua+'&bayar='+bayar+'&kembali='+kembali,
        url : '<?php echo base_url().'penjualan/simpan' ?>',
          dataType : 'json',
          success : function(hasil)
          {
           /*swal("Selesai!","Transaksi Berhasil","success");
            window.setTimeout(function(){
           window.open('penjualan/struk?kodepj=<?php echo $kode ?>','mywindow','width=700px,height=400px,left=300px;')                     
            window.location.href='<?php echo base_url()."penjualan?kodepj=$koderandom" ?>'; 
             },2700);*/
              swal({
                title: "Transaksi Selesai",
                text: "Apakah anda akan cetak Struk ??",
                type: "success",
                showCancelButton: true,
                confirmButtonColor: "#DD6855",
                confirmButtonText: "Ya, Cetak !",
                closeOnConfirm: false
              },function(isConfirm){

                if (!isConfirm)
                {
                  window.location.href='<?php echo base_url()."penjualan?kodepj=$koderandom" ?>';
                }
                else
                {
                  window.setTimeout(function(){
                    window.open('penjualan/struk?kodepj=<?php echo $kode ?>','mywindow','width=700px,height=400px,left=300px;')
                    window.location.href='<?php echo base_url()."penjualan?kodepj=$koderandom" ?>';
                  });
                }
              });
            
          }
    });
  }
    
  }

  function hapus(id,kode_barcode,jumlah,stok) // hapus data
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

      if (!isConfirm) {

      $.ajax({
        type : 'POST',
        data : 'id='+id+'&kode_barcode='+kode_barcode+'&jumlah='+jumlah+'&stok='+stok,
        url : '<?php echo base_url().'penjualan/hapusdata' ?>',
        success : function()
        {
          swal("Selesai!","File sudah terhapus","success");
          window.setTimeout(function(){
            location.reload();
          },2700);
        },
        error:function (xhr,ajaxOptions,thrownError) {
          swal("Error deleting","Please try again","error");
        }
      });
    }
     else {
        window.location.href='barang';
      }
    });
  }
  
</script>



        