<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>COZYVAPE</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url().'assets/vendors/font-awesome/css/font-awesome.min.css' ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url().'assets/vendors/nprogress/nprogress.css ' ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url().'assets/build/css/custom.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/sweetalert/sweetalert.css' ?>" rel="stylesheet">

     <!-- Datatables -->
    <link href="<?php echo base_url().'assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css '?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css '?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css '?>" rel="stylesheet">

    <link href="<?php echo base_url().'assets/vendors/bootstrap-daterangepicker/daterangepicker.css'?>" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url().'assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css' ?>" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url().'assets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'?>" rel="stylesheet">
    <!--Jquery--> 

    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/chartjs/Chart.js' ?>"></script>
    

   


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<?php if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='kasir') { ?>
              	<a href="<?php echo base_url().'page' ?>" class="site_title"><i class="fa fa-paw"></i> <span>Point Of Sales</span></a>
							<?php } ?>
							<?php if ($this->session->userdata('level')=='owner') { ?>
              	<a href="<?php echo base_url().'owner' ?>" class="site_title"><i class="fa fa-paw"></i> <span>Point Of Sales</span></a>
							<?php } ?>
            </div>
                  <script type="text/javascript">    
                      //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
                      function tampilkanwaktu(){
                          //buat object date berdasarkan waktu saat ini
                          var waktu = new Date();
                          //ambil nilai jam, 
                          //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
                          var sh = waktu.getHours() + ""; 
                          //ambil nilai menit
                          var sm = waktu.getMinutes() + "";
                          //ambil nilai detik
                          var ss = waktu.getSeconds() + "";
                          //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
                          document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
                      }
                  </script>
                    <body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">               
                      &nbsp&nbsp&nbsp&nbsp<span id="clock"></span> 
                      <?php
                        $hari = date('l');
                        /*$new = date('l, F d, Y', strtotime($Today));*/
                        if ($hari=="Sunday") {
                          echo "Minggu";
                        }elseif ($hari=="Monday") {
                          echo "Senin";
                        }elseif ($hari=="Tuesday") {
                          echo "Selasa";
                        }elseif ($hari=="Wednesday") {
                          echo "Rabu";
                        }elseif ($hari=="Thursday") {
                          echo("Kamis");
                        }elseif ($hari=="Friday") {
                          echo "Jum'at";
                        }elseif ($hari=="Saturday") {
                          echo "Sabtu";
                        }
                      ?>,

                      <?php
                        $tgl =date('d');
                        echo $tgl;
                        $bulan =date('F');
                        if ($bulan=="January") {
                          echo " Januari ";
                        }elseif ($bulan=="February") {
                          echo " Februari ";
                        }elseif ($bulan=="March") {
                          echo " Maret ";
                        }elseif ($bulan=="April") {
                          echo " April ";
                        }elseif ($bulan=="May") {
                          echo " Mei ";
                        }elseif ($bulan=="June") {
                          echo " Juni ";
                        }elseif ($bulan=="July") {
                          echo " Juli ";
                        }elseif ($bulan=="August") {
                          echo " Agustus ";
                        }elseif ($bulan=="September") {
                          echo " September ";
                        }elseif ($bulan=="October") {
                          echo " Oktober ";
                        }elseif ($bulan=="November") {
                          echo " November ";
                        }elseif ($bulan=="December") {
                          echo " Desember ";
                        }
                        $tahun=date('Y');
                        echo $tahun;
                      ?>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_pic">
                <img src="./assets/images/<?php echo $this->session->userdata('foto') ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('nama'); ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <?php
            $koderandom = random_string('numeric',9);
            ?>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
									
									<?php if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='kasir') { ?>
									<li><a href="<?php echo base_url().'page' ?>"><i class="fa fa-home"></i> Home </a></li>
									<?php } ?>

									<?php if ($this->session->userdata('level')=='owner') { ?>
									<li><a><i class="fa fa-cog"></i> Manage Toko <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
											<li><a href="<?php echo base_url().'cabang' ?>">Cabang</a></li>
											<li><a href="<?php echo base_url().'owner' ?>">Owner</a></li>
											<li><a href="<?php echo base_url().'admincabang' ?>">Admin</a></li>
                    </ul>
									</li>
									<li><a><i class="fa fa-book"></i> Laporan Toko<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url().'laporantoko' ?>">Transaksi Sukses</a></li>
                      <li><a href="<?php echo base_url().'pendingtoko' ?>">Transaksi Pending</a></li>
                    </ul>
                  </li>
									<?php } ?>

									<?php if ($this->session->userdata('level')=='admin') { ?>
									<li><a href="<?php echo base_url().'user' ?>"><i class="fa fa-user"></i> User </a></li>
                  <li><a href="<?php echo base_url().'barang' ?>"><i class="fa fa-archive"></i> Barang </a></li>
                  
                  <!--<li><a href="<?php echo base_url().'supplier' ?>"><i class="fa fa-users"></i> Supplier </a></li>-->
                  <li><a href="<?php echo base_url().'kustomer' ?>"><i class="fa fa-user-md"></i> Kustomer </a></li>
									<?php } ?>
									
									<?php if ($this->session->userdata('level')=='admin') { ?>
									<li><a href="<?php echo base_url()."penjualanv2?kodepj=$koderandom" ?>"><i class="fa fa-shopping-cart"></i> Point Of Sale </a></li>
									
                  <li><a><i class="fa fa-book"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url().'laporan' ?>">Transaksi Sukses</a></li>
                      <li><a href="<?php echo base_url().'pending' ?>">Transaksi Pending</a></li>
                    </ul>
                  </li>
									<?php } ?>
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->

            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="" alt=""><?php echo $this->session->userdata('nama') ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="<?php echo base_url().'page/logout' ?>" class="delete-link"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <?php foreach ($jumlah as $j) { 

                          ?>
                    <span id="badge" class="badge bg-green">
                      <?php 
                      if ($j->jumlah == "0")
                      { ?>
                        <script>
                        $("#badge").hide();
                        </script>
                      <?php } 
                      else
                      {
                        echo $j->jumlah;
                      }
                      ?>                       
                    </span>
                  <?php } ?>

                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <?php foreach ($barang as $b) { 

                          ?>
                      <a href = "#tambahstok" title ="Edit Data" data-toggle = "modal" onclick="submitstok('<?php echo $b->id ?>')">
                        
                        <span class="image"><img src="./assets/images/<?php echo $this->session->userdata('foto') ?>" alt="Profile Image" /></span>
                        <span>
                          
                          <span style="text-decoration: underline;"><b><?php echo $b->nama_barang ?></b></span>

                          <span style="color: red;" class="time">Stok sisa <?php echo $b->stok ?></span>
                        </span>
                        <span class="message">
                          Barang sudah mau habis, silahkan melakukan Pre Order lagi !!
                        </span>
                      
                      </a>
                      <?php } ?>
                    </li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>

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
                      <button type="button" class="btn btn-primary" onclick="tambahstok()">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>  
          </div> 
          <!-- End Modal Tambah Stok -->      
        <!-- /top navigation -->
       
            <script>
                jQuery(document).ready(function($){
                    $('.delete-link').on('click',function(){
                        var getLink = $(this).attr('href');
                        swal({
                                title: "Apakah Anda Yakin Log Out ? ?",
                               
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes",
                                closeOnConfirm: false
                                },function(){

                                window.location.href = getLink
                            });
                        return false;
                    });
                });

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
            </script>
