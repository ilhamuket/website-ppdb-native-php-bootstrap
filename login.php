<?php
session_start();
include 'dbconnect.php';
$alert = '';

//cek lagi jika yang login admin maka masuk ke dashboard admin dan sebaliknya
if(isset($_SESSION['role'])){
	$role = $_SESSION['role'];

	if($role=='Admin'){
		header("location:admin");
	} else {
		header("location:user");
	}
	
}


if(isset($_POST['btn-login']))
{
 $email = mysqli_real_escape_string($conn,$_POST['email']);
 $password = mysqli_real_escape_string($conn,$_POST['password']);

 // menyeleksi data user dengan username dan password yang sesuai
$cariadmin = mysqli_query($conn,"select * from admin where adminemail='$email' and adminpassword='$password';");
$cariuser = mysqli_query($conn,"select * from user where useremail='$email' and userpassword='$password';");

// menghitung jumlah data yang ditemukan
$cekadmin = mysqli_num_rows($cariadmin);
$cekuser = mysqli_num_rows($cariuser);
 
// cek apakah username dan password di temukan pada database
	if($cekadmin > 0){
	
	//jika admin
	$data = mysqli_fetch_assoc($cariadmin);
 
		// buat session login dan username
		$_SESSION['email'] = $data['adminemail'];
		$_SESSION['role'] = "Admin";
		header("location:admin");
 	} else if($cekuser > 0){
	//jika user biasa
	$data = mysqli_fetch_assoc($cariuser);
 
		// buat session login dan username
		$_SESSION['email'] = $data['useremail'];
		$_SESSION['userid'] = $data['userid'];
		$_SESSION['role'] = "User";
		header("location:user");
	} else {
	//jika user tidak ditemukan
	echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
	}
 
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SMK IT NUSAINDAH</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/icon.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <style>

* {
  box-sizing: border-box;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  /* padding: 15px; */
  margin: 5px 0 22px 0;
  display: inline-block;
  /* border: none; */
  /* background: #f1f1f1; */
}

input[type=text]:focus, input[type=password]:focus {
  /* background-color: #ddd; */
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.loginbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.loginbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

.register {
  text-align: center;
  padding: 125px;
}


</style>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5"> 
                <a class="navbar-brand" href="index.php"><img src="../assets/icon.png" alt="" width="25" > SMK IT NUSAINDAH</a>
                <!-- <a class="navbar-brand" href="#!" >SMK IT NUSAINDAH</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                        <li class="nav-item"><a class="nav-link" href="kurikulum.php">Kurikulum</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">PPDB 2021</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <!-- <form action="ppdb.php"> -->
  <div class="container">
    <h1>Masuk</h1>
    <p>Silahkan isi formulir ini untuk login akun.</p>
    <hr>

    <form method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-login">Masuk</button>
                </form>
  </div>
  <hr>
  <div class="container register">
    <p>Belum mempunyai akun? <a href="register.php">Daftar</a>.</p>
  </div>
</form>
            </div>
            
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; smkitnusaindah</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

