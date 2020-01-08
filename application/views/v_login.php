
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>COZY-VAPE </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url().'assets/vendors/font-awesome/css/font-awesome.min.css '?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url().'assets/vendors/nprogress/nprogress.css' ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url().'assets/vendors/animate.css/animate.min.css' ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url().'assets/build/css/custom.min.css' ?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php
                if (isset($_GET['pesan']))
                {
                  if ($_GET['pesan'] == "gagal")
                  {
                    echo "<div class='alert alert-danger'>Login gagal! Username dan password salah.</div>";
                  }
                  elseif ($_GET['pesan'] == "logout")
                  {
                    echo "<div class='alert alert-danger'>Anda Telah Logout!!</div>";
                  }
                  elseif($_GET['pesan'] == "belumlogin")
                  {
                    echo "<div class='alert alert-success'>Anda Belum Login !!</div>";
                  }
                  elseif($_GET['pesan'] == "daftar")
                  {
                    echo "<div class='alert alert-success'>Berhasil Daftar !!</div>";
                  }
                  elseif($_GET['pesan'] == "daftargagal")
                  {
                    echo "<div class='alert alert-danger'>Gagal Daftar !!</div>";
                  }
                
                } 
              ?>
            <form method="POST" action="<?php echo base_url().'admin/login' ?>">
              
              <h1>Login Form</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" value="Login">
                
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">

            <form method="POST" action="<?php echo base_url().'admin/daftar' ?>">
              <h1>Create Account</h1>
              <div>
                <input type="text" name="dnama" class="form-control" placeholder="Name" required="" />
              </div>
              <div>
                <input type="text" name="dusername" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="dpassword" class="form-control" placeholder="Type Password" required="" />
              </div>
            
              <div>
                <select class="form-control" name="dlevel">
                  <option>--Pilih Level--</option>
                  <option value="admin">Admin</option>
                  <option value="kasir">Kasir</option>
                </select>
              </div>
              <br>
              <div>
                <input type="submit" class="btn btn-default" value="Submit">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
