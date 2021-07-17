<?php
session_start();

include "../koneksi.php";

$stmt = "";
if(isset($_POST['login'])){
	if(isset($_POST['username']) && isset($_POST['password'])){
		
		// if($_POST['username'] == "admin" || $_POST['username'] == "evaluator"){
			$tabel = "user";
		// }
		$qry = "SELECT * FROM $tabel WHERE username = '".$_POST['username']."' and password = '".$_POST['password']."'";
		$result = mysqli_query($conn,$qry); 
		$auth = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result) > 0){
			// var_dump($auth); die;
			// $_SESSION['username'] = $_POST['username'];
			$_SESSION['username'] = $auth;
			header("location:index.php?content=Home");
		}
		else 
			$stmt = "<div class='alert alert-danger'><center>Maaf, User atau Pass Anda Salah.</center></div>";
		
	}
}
if(isset($_SESSION['register']) && $_SESSION['register'] == "register"){
	$stmt = "<div class='alert alert-success'>Register Berhasil, Silahkan login!</div>";
	$_SESSION['register'] = "";
}

?>


<html>
<head>
	<meta charset="UTF-8">
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  	<title>Login &mdash; Sistem Peramalan</title>

    <!-- <title>Forecast Perkembangan Belajar Siswa Daring</title>
    <link href="../dist/css/reset.css" rel="stylesheet" type="text/css">
    <link href="../dist/css/baisnew.css" rel="stylesheet" type="text/css">
	<link href="../dist/css/style.css" rel="stylesheet" type="text/css"> -->

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet" href="../dist/assets/css/style.css" type="text/css">
  	<link rel="stylesheet" href="../dist/assets/css/components.css" type="text/css">
	<link rel="stylesheet" href="../dist/node_modules/bootstrap-social/bootstrap-social.css" type="text/css">
	
</head>
<body>
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="../dist/img/daring.png" alt="logo" width="100" class="shadow-light rounded-circle">
			        <br>
              <div style="padding-top: 25px; font-style:oblique; color:royalblue; text-shadow: 2px 2px;"><h4>Sistem Peramalan Perkembangan Siswa</h4></div>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="login.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Masukkan Username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Masukkan password
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; M. Imaduddin Ihsan 2021
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
	<!-- General JS Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="../dist/assets/js/stisla.js"></script>

	<!-- JS Libraies -->

	<!-- Template JS File -->
	<script src="../dist/assets/js/scripts.js"></script>
	<script src="../dist/assets/js/custom.js"></script>

	<!-- Page Specific JS File -->
</body>
</html>