<!doctype html>
<html lang="en">
 <head>
  <title>MeteoTopper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <link rel="stylesheet" href="/Meteo/View/style/station/css/station.css">


</head>

  <body onload="addLoadEvent(loadPage({$id},{$chartlimit}));">

  <div class="cards-container">
  <!--<div class="card info-card" id="card-main" style="width: 18rem;">
  <img src="/Meteo/View/style/station/images/monte_calvo.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Monte Calvo</h5>
  </div>
</div>-->

<div class="card info-card">
  <div class="card-header">
    Last Measure: {$lastMeasure.time}
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Temperature: {$lastMeasure.temp} °C</li>
    <li class="list-group-item">Humidity: 80%</li>
    <li class="list-group-item">Wind: 20 m/s (97°)</li>
    <li class="list-group-item">Rain: 12 mm</li>
    <li class="list-group-item">Pressure: {$lastMeasure.pressure} hPa</li>
  </ul>
</div>

<div class="card info-card" style="width: 18rem;">
  <div class="card-header">
    Station: {$name}
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Operating since: {$firstMeasure}</li>
    <li class="list-group-item">Altitude: {$altitude} m</li>
    <li class="list-group-item">Latitude: {$latitude}°</li>
    <li class="list-group-item">Longitude: {$longitude}°</li> 
    <li class="list-group-item">See on <a href="https://www.google.com/maps/place/{$latitude}N+{$longitude}E/@{$latitude},{$longitude},16z/data=!3m1!1e3" target="_blank">Google Maps</li> 

  </ul>
</div>

</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<a class="navbar-brand" href="../home">MeteoTopper</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MyStations
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          {section name=nr loop=$stations}
              <a class="dropdown-item" href="{$stations[nr].id}">{$stations[nr].name}</a>
              {/section}
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{$id}/download"><span class="glyphicon glyphicon-download"></span>Download</a>
      </li>
    </ul>
  </div>
    <a href="../logout"><button class="btn btn-dark my-2 my-sm-0">Logout</button></a>
</nav>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="nav-item-charts" onclick="selectCard({$id},'charts'); loadCharts({$id},{$chartlimit});">Charts</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" id="nav-item-photos" onclick="selectCard({$id},'photos'); loadPhotos({$id});">Photos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="nav-item-table" onclick="selectCard({$id},'table'); loadTable({$id});">Table</a>
      </li>
    </ul>
  </div>


  <div class="card-body">
    <div class="container chart-container border-bottom border-secondary">   
      <!----------------------chart-bar----------------------->  
        <div class="container chart-bar">

          <div class="container mydropdown-input chart-btn">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="variable1">variable</label>
              </div>
            <select class="custom-select" id="variable1">
              <!--qui ci vuole il ciclo smarty-->
              {section name=nr loop=$sensors} 
                <option value="{$sensors[nr].COLUMN_NAME}">{$sensors[nr].COLUMN_NAME}</option>
              {/section}
            </select>
            </div>
          </div>

          <div class="container mydropdown-input chart-btn">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text">from</label>
              </div>
              <input type="date" class="form-control" id="from-date">
            </div>
          </div>

          <div class="container mydropdown-input chart-btn">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text">to</label>
              </div>
              <input type="date" class="form-control" id="to-date">
            </div>
          </div>

          <div class="container mydropdown-input mysubmit">
                <button id="load-btn" class="btn btn-primary">Load</button>
              </div>
        </div>   
      </div>

    <div id="card-charts">

      <!------------------------chart----------------------->
       <div class="container chart-container border-bottom border-secondary">
       <div class="container chartContainer" id="chartContainer1"></div>  
        </div>  
        {for $k=2 to $chartlimit}        
        <div class="container chart-bar">

          <div class="container mydropdown-input chart-btn">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="variable{$k}">variable</label>
              </div>
            <select class="custom-select" id="variable{$k}">
              <!--qui ci vuole il ciclo smarty-->
              {section name=nr loop=$sensors} 
                <option value="{$sensors[nr].COLUMN_NAME}">{$sensors[nr].COLUMN_NAME}</option>
              {/section}
            </select>
            </div>
          </div>   
      </div>
      <div class="container chart-container border-bottom border-secondary">
       <div class="container chartContainer" id="chartContainer{$k}"></div>  
        </div>  

    {/for}
      <!---------------------------------------------------->

      <div class="container chart-btn1">
        <button onclick="loadChart(1);" class="btn btn-primary" id="addChart-btn1">New Chart</button>
      </div>
    </div>

    <div id="card-photos" style="display: none;">    

        <div class="container page-top">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
              <a href="/Meteo/View/style/station/images/monte_calvo.jpg" class="fancybox" rel="ligthbox">
                <img src="/Meteo/View/style/station/images/monte_calvo.jpg" class="zoom img-fluid " alt="">
              </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
              <a href="/Meteo/View/style/station/images/monte_calvo.jpg"  class="fancybox" rel="ligthbox">
                <img  src="/Meteo/View/style/station/images/monte_calvo.jpg" class="zoom img-fluid" alt="">
              </a>
            </div>                 
       </div>
    </div>

    </div>

    <div id="card-table" style="display: none;">
      <div class="container">

      <div id="table-container"></div> 
    </div>
    <div class="container">
      <button onclick="loadMore();" class="btn btn-primary">Load More</button>
    </div>

    </div>

  </div>
</div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script type="text/javascript" src="/Meteo/View/style/station/js/station.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  </body>


</html>