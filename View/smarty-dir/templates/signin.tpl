<!DOCTYPE html>
<html lang="en">
<head>
  <title>Signin</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="icon" type="image/png" href="View/style/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="View/style/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="View/style/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="View/style/login/vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="View/style/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="View/style/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="View/style/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="View/style/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="home">MeteoTopper</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#section1">Home</a></li>
          <li><a href="#section2">Our Service</a></li>
          <li><a href="#section3">Us</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Section 4 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#section41">Section 4-1</a></li>
              <li><a href="#section42">Section 4-2</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
      <li><a href="signin"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
      </div>
    </div>
  </div>
</nav>    

  <div class="bg-contact2" style="background-image: url('View/style/login/images/bg-01.jpg');">
    <div class="container-contact2">
      <div class="wrap-contact2">
        <form class="contact2-form validate-form" method="post">
          <span class="contact2-form-title">
            Signin
          </span>

          <span class="contact2-form-title">
           <a class='login' href='{$glink}'><img src='View/style/signin/images/signin_button.png'><img/></a>
          </span>

          <div class="wrap-input2 validate-input" data-validate="Name is required">
            <input class="input2" type="text" name="name">
            <span class="focus-input2" data-placeholder="NAME"></span>
          </div>

          <div class="wrap-input2 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input2" type="text" name="email">
            <span class="focus-input2" data-placeholder="EMAIL"></span>
          </div>

          <div class="wrap-input2 validate-input" data-validate="Password is required">
            <input class="input2" type="password" name="password">
            <span class="focus-input2" data-placeholder="PASSWORD"></span>
          </div>

          <div class="wrap-input2 validate-input" data-validate="Password is required">
            <input class="input2" type="password" name="password">
            <span class="focus-input2" data-placeholder=" CONFIRM PASSWORD"></span>
          </div>

          <div class="container-contact2-form-btn">
            <div class="wrap-contact2-form-btn">
              <div class="contact2-form-bgbtn"></div>
              <button class="contact2-form-btn">
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>




<!--===============================================================================================-->
  <script src="View/style/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="View/style/login/vendor/bootstrap/js/popper.js"></script>
  <script src="View/style/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="View/style/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="View/style/login/js/main.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  {literal}
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
  </script>
  {/literal}
</body>
</html>