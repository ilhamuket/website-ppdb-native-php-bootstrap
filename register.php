<?php
session_start();
include 'dbconnect.php';
$alert = '';

if(isset($_SESSION['role'])){
	header("location:index.php");
}

if(isset($_POST['btn-daftar']))
{
 $email = mysqli_real_escape_string($conn,$_POST['email']);
 $password = mysqli_real_escape_string($conn,$_POST['password']);

 //cek apakah email sudah pernah digunakan
$lihat1 = mysqli_query($conn,"select * from user where useremail='$email'");
$lihat2 = mysqli_num_rows($lihat1);
 
if($lihat2 < 1){
    //email belum pernah digunakan
    $insert = mysqli_query($conn,"insert into user (useremail,userpassword) values ('$email','$password')");
        
        //eksekusi query
        if($insert){
            echo "<div class='alert alert-success'>Berhasil mendaftar, silakan login.</div>
            <meta http-equiv='refresh' content='2; url= login.php'/>  ";
        } else {
            //daftar gagal
            echo "<div class='alert alert-warning'>Gagal mendaftar, silakan coba lagi.</div>
            <meta http-equiv='refresh' content='2'>";
        }

    }
 else
    {
    //jika email sudah pernah digunakan
    $alert = '<strong><font color="red">Email sudah pernah digunakan</font></strong>';
    echo '<meta http-equiv="refresh" content="2">';
    }
 
};




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
  margin: 5px 0 22px 0;
  display: inline-block;
}

input[type=text]:focus, input[type=password]:focus {
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.btn btn-primary {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn btn-primary:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}


.signin {
  /* background-color: #f1f1f1; */
  text-align: center;
  padding: 120px;
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
            <!-- <form action="login.php"> -->
  <div class="container">
    <h1>Daftar</h1>
    <p>Silahkan isi formulir ini untuk mendaftar akun.</p>
    <hr><label><?php echo $alert ?></label>


    <form method="post">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-daftar">Daftar</button>
                </form>
  </div>
  <hr>
  <div class="container signin">
    <p>Sudah mempunyai akun? <a href="login.php">Login</a>.</p>
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
