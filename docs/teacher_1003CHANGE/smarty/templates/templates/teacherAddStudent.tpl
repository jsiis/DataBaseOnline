{* Smarty *}
{include file="teacherHead.tpl"}
Add Student

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

{foreach $Studentlist as $item}
        <li>
        {foreach $item as $key=>$value}
                <th>{$value}</th>
        {/foreach}
        </li>
{/foreach}
</ul>
<form action='teacherAddStudent.php' method=POST>
	<li>
          <tr>
          <td>教师帐号</td>
          <td><input type=text name='tno'></td>
          </tr>
	</li>
        <li>
          <tr>
          <td>学生帐号</td>
          <td><input type=text name='sno'></td>
          </tr>
        </li>
        <li>
          <tr>
          <td>所在学校</td>
          <td><input type=text name='uschool'></td>
          </tr>
        </li>



 <input type=submit name='submit' value='提交'><br/></form>

