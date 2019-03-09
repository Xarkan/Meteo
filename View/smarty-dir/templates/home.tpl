<!DOCTYPE html>
<html>
<head>
  <title>MeteoTopper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="View/style/home/css/home.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">MeteoTopper</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#section1">Home</a></li>
          <li><a href="#section2">Our Service</a></li>
          <li><a href="#section3">Us</a></li>
          {if $enabled == true}
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">MyStations<span class="caret"></span></a>
            <ul class="dropdown-menu">
              {section name=nr loop=$stations}
              <li><a href="station/{$stations[nr].id}">{$stations[nr].name}</a></li>
              {/section}
            </ul>
          </li>
          {/if}
        </ul>
        <ul class="nav navbar-nav navbar-right">
        {if $enabled == false}
        <li><a href="signin"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        {/if}
        <li><a href="{$href}"><span class="glyphicon glyphicon-log-{$icon}"></span>{$action}</a></li>
    </ul>
      </div>
    </div>
  </div>
</nav>    

<div id="section1" class="container-fluid">
  <h1>Home</h1>
  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
</div>
<div id="section2" class="container-fluid">
  <h1>Our Service</h1>
  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
</div>
<div id="section3" class="container-fluid">
  <h1>Us</h1>
  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
  <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
</div>

</body>
</html>
