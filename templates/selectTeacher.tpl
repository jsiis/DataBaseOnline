{* Smarty *}
<html>
{include file="studenthead.tpl"}  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<form action='selectTeacher.php' method=POST>
  {foreach $problemlist as $item}
	<li><tr><td>教师号：</td><td>{$item[0]}</td><br>
        </tr></li>
  {/foreach}
   
        <td>请选择教师号：</td>
	<td><input type=text name="selectTno"></td>
	</tr></li>

        <input type=submit name='submit' value='提交'><br/></form>
</html>

