<?php
/* Smarty version 3.1.33, created on 2019-03-11 15:04:06
  from '/opt/lampp/htdocs/Meteo/View/smarty-dir/templates/table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c866ad6e1d0e7_26143110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fbedfa9b14b20906c67b9ff9c982fd97dd55d0b' => 
    array (
      0 => '/opt/lampp/htdocs/Meteo/View/smarty-dir/templates/table.tpl',
      1 => 1552313044,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c866ad6e1d0e7_26143110 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['table']->value[0], 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
      <th scope="col"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</th>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tr>
  </thead>
  <tbody>
    <?php
$__section_nr_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['table']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nr_0_total = $__section_nr_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nr'] = new Smarty_Variable(array());
if ($__section_nr_0_total !== 0) {
for ($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] = 0; $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] <= $__section_nr_0_total; $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']++){
?>
    <tr>
      <th scope="row"><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['iteration'] : null);?>
</th>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['table']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_nr']->value['index'] : null)], 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>
      <td><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</td>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tr>
    <?php
}
}
?>
  </tbody>
</table><?php }
}
