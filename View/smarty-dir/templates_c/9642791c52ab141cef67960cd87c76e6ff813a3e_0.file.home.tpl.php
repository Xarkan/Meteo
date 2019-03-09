<?php
/* Smarty version 3.1.33, created on 2019-02-16 15:00:15
  from '/opt/lampp/htdocs/Meteo/View/smarty-dir/templates/home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c68176f440dc5_69550162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9642791c52ab141cef67960cd87c76e6ff813a3e' => 
    array (
      0 => '/opt/lampp/htdocs/Meteo/View/smarty-dir/templates/home.tpl',
      1 => 1550325612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c68176f440dc5_69550162 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
  <title>MeteoTopper</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>

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
          <?php if ($_smarty_tpl->tpl_vars['enabled']->value == true) {?>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">MyStations<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['stations']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($__section_nr_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $__section_nr_0_iteration <= $__section_nr_0_total; $__section_nr_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>
              <li><a href="station/<?php echo $_smarty_tpl->tpl_vars['stations']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['stations']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)]['name'];?>
</a></li>
              <?php
}
}
?>
            </ul>
          </li>
          <?php }?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        <?php if ($_smarty_tpl->tpl_vars['enabled']->value == false) {?>
        <li><a href="signin"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <?php }?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
"><span class="glyphicon glyphicon-log-<?php echo $_smarty_tpl->tpl_vars['icon']->value;?>
"></span><?php echo $_smarty_tpl->tpl_vars['action']->value;?>
</a></li>
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
<?php }
}
