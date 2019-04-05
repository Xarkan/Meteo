<?php
/* Smarty version 3.1.33, created on 2019-03-20 17:00:36
  from '/opt/lampp/htdocs/Meteo/View/smarty-dir/templates/station.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c9263a4679f19_07138671',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b667dc4e2037da6485174337b9507dc852e01519' => 
    array (
      0 => '/opt/lampp/htdocs/Meteo/View/smarty-dir/templates/station.tpl',
      1 => 1553097629,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c9263a4679f19_07138671 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="en">
 <head>
  <title>MeteoTopper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   <link rel="stylesheet" href="/Meteo/View/style/station/css/station.css">


</head>

  <body onload="addLoadEvent(loadPage(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['chartlimit']->value;?>
));">

  <div class="cards-container">
  <!--<div class="card info-card" id="card-main" style="width: 18rem;">
  <img src="/Meteo/View/style/station/images/monte_calvo.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Monte Calvo</h5>
  </div>
</div>-->

<div class="card info-card">
  <div class="card-header">
    Last Measure: <?php echo $_smarty_tpl->tpl_vars['lastMeasure']->value['time'];?>

  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Temperature: <?php echo $_smarty_tpl->tpl_vars['lastMeasure']->value['temp'];?>
 °C</li>
    <li class="list-group-item">Humidity: 80%</li>
    <li class="list-group-item">Wind: 20 m/s (97°)</li>
    <li class="list-group-item">Rain: 12 mm</li>
    <li class="list-group-item">Pressure: <?php echo $_smarty_tpl->tpl_vars['lastMeasure']->value['pressure'];?>
 hPa</li>
  </ul>
</div>

<div class="card info-card" style="width: 18rem;">
  <div class="card-header">
    Station: <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Operating since: <?php echo $_smarty_tpl->tpl_vars['firstMeasure']->value;?>
</li>
    <li class="list-group-item">Altitude: <?php echo $_smarty_tpl->tpl_vars['altitude']->value;?>
 m</li>
    <li class="list-group-item">Latitude: <?php echo $_smarty_tpl->tpl_vars['latitude']->value;?>
°</li>
    <li class="list-group-item">Longitude: <?php echo $_smarty_tpl->tpl_vars['longitude']->value;?>
°</li> 
    <li class="list-group-item">See on <a href="https://www.google.com/maps/place/<?php echo $_smarty_tpl->tpl_vars['latitude']->value;?>
N+<?php echo $_smarty_tpl->tpl_vars['longitude']->value;?>
E/@<?php echo $_smarty_tpl->tpl_vars['latitude']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['longitude']->value;?>
,16z/data=!3m1!1e3" target="_blank">Google Maps</li> 

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
          <?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['stations']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($__section_nr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_0_iteration <= $__section_nr_0_total; $__section_nr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>
              <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['stations']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['stations']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['name'];?>
</a>
              <?php
}
}
?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/download"><span class="glyphicon glyphicon-download"></span>Download</a>
      </li>
    </ul>
  </div>
    <a href="../logout"><button class="btn btn-dark my-2 my-sm-0">Logout</button></a>
</nav>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="nav-item-charts" onclick="selectCard(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
,'charts'); loadCharts(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['chartlimit']->value;?>
);">Charts</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" id="nav-item-photos" onclick="selectCard(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
,'photos'); loadPhotos(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);">Photos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="nav-item-table" onclick="selectCard(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
,'table'); loadTable(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
);">Table</a>
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
              <?php
$__section_nr_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sensors']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_1_total = $__section_nr_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_1_total !== 0) {
for ($__section_nr_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_1_iteration <= $__section_nr_1_total; $__section_nr_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?> 
                <option value="<?php echo $_smarty_tpl->tpl_vars['sensors']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['COLUMN_NAME'];?>
"><?php echo $_smarty_tpl->tpl_vars['sensors']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['COLUMN_NAME'];?>
</option>
              <?php
}
}
?>
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
        <?php
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['k']->step = 1;$_smarty_tpl->tpl_vars['k']->total = (int) ceil(($_smarty_tpl->tpl_vars['k']->step > 0 ? $_smarty_tpl->tpl_vars['chartlimit']->value+1 - (2) : 2-($_smarty_tpl->tpl_vars['chartlimit']->value)+1)/abs($_smarty_tpl->tpl_vars['k']->step));
if ($_smarty_tpl->tpl_vars['k']->total > 0) {
for ($_smarty_tpl->tpl_vars['k']->value = 2, $_smarty_tpl->tpl_vars['k']->iteration = 1;$_smarty_tpl->tpl_vars['k']->iteration <= $_smarty_tpl->tpl_vars['k']->total;$_smarty_tpl->tpl_vars['k']->value += $_smarty_tpl->tpl_vars['k']->step, $_smarty_tpl->tpl_vars['k']->iteration++) {
$_smarty_tpl->tpl_vars['k']->first = $_smarty_tpl->tpl_vars['k']->iteration === 1;$_smarty_tpl->tpl_vars['k']->last = $_smarty_tpl->tpl_vars['k']->iteration === $_smarty_tpl->tpl_vars['k']->total;?>        
        <div class="container chart-bar">

          <div class="container mydropdown-input chart-btn">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="variable<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
">variable</label>
              </div>
            <select class="custom-select" id="variable<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
">
              <!--qui ci vuole il ciclo smarty-->
              <?php
$__section_nr_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sensors']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_2_total = $__section_nr_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_2_total !== 0) {
for ($__section_nr_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_2_iteration <= $__section_nr_2_total; $__section_nr_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?> 
                <option value="<?php echo $_smarty_tpl->tpl_vars['sensors']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['COLUMN_NAME'];?>
"><?php echo $_smarty_tpl->tpl_vars['sensors']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['COLUMN_NAME'];?>
</option>
              <?php
}
}
?>
            </select>
            </div>
          </div>   
      </div>
      <div class="container chart-container border-bottom border-secondary">
       <div class="container chartContainer" id="chartContainer<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"></div>  
        </div>  

    <?php }
}
?>
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


  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
 type="text/javascript" src="/Meteo/View/style/station/js/station.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://canvasjs.com/assets/script/canvasjs.min.js"><?php echo '</script'; ?>
>

  </body>


</html><?php }
}
