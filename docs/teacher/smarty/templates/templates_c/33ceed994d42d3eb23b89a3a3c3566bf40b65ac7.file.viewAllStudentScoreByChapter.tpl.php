<?php /* Smarty version Smarty-3.1.14, created on 2013-10-03 16:27:41
         compiled from "smarty/templates/templates/viewAllStudentScoreByChapter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78504898851de5f017e7bd9-27781039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33ceed994d42d3eb23b89a3a3c3566bf40b65ac7' => 
    array (
      0 => 'smarty/templates/templates/viewAllStudentScoreByChapter.tpl',
      1 => 1380788857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78504898851de5f017e7bd9-27781039',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_51de5f0184d5e0_52476087',
  'variables' => 
  array (
    'chapterlist' => 0,
    'item' => 0,
    'scorelist' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51de5f0184d5e0_52476087')) {function content_51de5f0184d5e0_52476087($_smarty_tpl) {?>
<html>
<?php echo $_smarty_tpl->getSubTemplate ("teacherHead.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="container">
<center>
<!--form action='viewAllStudentScoreByChapter.php' method=POST-->
          <!--tr>
          <td>请输入需要查询的章节编号</td>
          <td><input type=text name='cno'></td>
          </tr-->
        <!--li><td>要查询的章节编号</td>
        <select name='cno'>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chapterlist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value=<?php echo $_smarty_tpl->tpl_vars['item']->value[0];?>
><?php echo $_smarty_tpl->tpl_vars['item']->value[1];?>
</option>
                <?php } ?>
        </select>
        </tr></li-->
        <!--li><td>请输入需要查询的章节编号</td>
        <br />
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chapterlist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <?php echo $_smarty_tpl->tpl_vars['item']->value[1];?>

                <input type="checkbox" name="cno[]" value=<?php echo $_smarty_tpl->tpl_vars['item']->value[0];?>
 />
                <br />
        <?php } ?>
        </tr></li>


<input type=submit name='submit' value='提交'><br/></form-->
<table class="table table-bordered table-striped" border="1">
	<tr><td><center>学生号</center></td>
	<td><center>学生姓名</center></td>
	<td><center>提交时间</center></td>
	<td><center>考试时间</center></td></tr>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['scorelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
	<tr>
	<td><center><?php echo $_smarty_tpl->tpl_vars['item']->value[0];?>
</center></td>
	<td><center><?php echo $_smarty_tpl->tpl_vars['item']->value[1];?>
</center></td>
	<td><center><?php echo $_smarty_tpl->tpl_vars['item']->value[2];?>
</center></td>
	<td><center><?php echo $_smarty_tpl->tpl_vars['item']->value[3];?>
</center></td>
	</tr>
	<?php } ?>
</table>
<input onClick="location='viewAllChapter.php'" class="btn btn-primary" type=bytton name='btn' value="返回">

<!--ul>
<li>
	<th>学生号</th>
	<th>学生姓名</th>
	<th>提交时间</th>
	<th>考试成绩</th>
</li>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['scorelist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <li>
        <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
                <th><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</th>
        <?php } ?>
        </li>
<?php } ?>
</ul-->
<?php }} ?>