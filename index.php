<?php
//include 'config/database.php';
session_start();

if(isset($_SESSION['login'])){
    header('location: admin?menu=');
}
else{

?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'views/partials/head.php'; ?>
      <style>
        
@media (min-width: 560px) and (max-width: 740px) {
    html,
    body,
    header,
    .view {
        height: 650px;
    }
}
@media (min-width: 800px) and (max-width: 850px) {
    html,
    body,
    header,
    .view  {
        height: 650px;
    }
}
      </style>
</head>
<body class="login-page">
	<!-- Intro Section -->
    <section class="view intro-2">
        <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-10 col-sm-12 mx-auto mt-5">

                        <!-- Form with header -->
                        <div class="card wow fadeIn" data-wow-delay="0.3s">
                            <div class="card-body">

                                <!-- Header -->
                                <div class="form-header purple-gradient">
                                    <h3 class="font-weight-500 my-2 py-1"><i class="fas fa-user"></i> Log in:</h3>
                                </div>

                                <!-- Body -->
                                <form method="post" class="form-login">
                                    <div class="md-form">
                                        <i class="fas fa-user prefix white-text"></i>
                                        <input type="text" id="username" name="username" class="form-control ">
                                        <label for="username" class="" >USERNAME</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fas fa-lock prefix white-text"></i>
                                        <input type="password" id="password" name="password" class="form-control ">
                                        <label for="password" class="" >PASSWORD</label>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn purple-gradient btn-lg" id="submitlogin">Sign up</button>
                                        <hr class="mt-4">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Form with header -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Intro Section -->
	<?php include 'views/partials/footer.php'; ?>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#submitlogin").click(function(e){
                e.preventDefault();
                var url_admin    = 'admin/?menu=';
                var url_kasir    = 'admin/?menu=transaksi';
                
                var data = $('.form-login').serialize();
                $.ajax({
                    url     : 'controllers/login.ctrl.php',
                    data    : data, 
                    type    : 'POST',
                    success : function(pesan){
                        console.log(pesan)
                        window.location.href = 'admin/?menu='+pesan;
                        
                    },
                });
            });
        });
    </script>
</body>
</html>

<?php
}
?>