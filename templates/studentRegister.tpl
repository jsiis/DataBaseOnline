{* Smarty *}
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<ul>
{foreach $Userlist as $item}
       <li>
	{foreach $item as $key=>$value}
		<th>{$value}</th>
	{/foreach}
       </li>
{/foreach}
</ul>
<form action='studentRegister.php' method=POST>
          <tr>
      	  <li><td>帐号  </td>
      	  <td><input type=text name='UID'></td>
      	  </li> </tr>
          <li></li>
          <tr>
      	  <li><td>姓名  </td>
      	  <td><input type=text name='Uname'></td>
      	  </li></tr>
          <li></li>
      	  <tr>
      	  <li><td>性别  </td>
      	  <td><input type=text name='Usex'></td>
      	  </li></tr>
          <li></li>
          <tr>
      	  <li><td>年龄  </td>
      	  <td><input type=text name='Uage'></td>
      	  </li></tr>
          <li></li>
          <tr>
      	  <li><td>民族  </td>
      	  <td><input type=text name='Unation'></td>
      	  </li></tr>
          <li></li>
          <tr>
      	  <li><td>籍贯  </td>
      	  <td><input type=text name='UBP'></td>
      	  </li></tr>
          <li></li>
      	  <tr>
      	  <li><td>密码  </td>
      	  <td><input type=password name='Upassword1'></td>
      	  </li></tr>
          <li></li>
          <tr>
      	  <li><td>重复密码</td>
      	  <td><input type=password name='Upassword2'></td>
      	  </li></tr>
          <li></li>
          <tr>
      	  <li><td>所在学校</td>
      	  <td><input type=text name='Uschool'></td>
      	  </li></tr>
          <li></li>
      
          
    <input type=submit name='submit' value='提交注册'><br/></form>
</html>      	 
   	 
      	 
      	 
      	 
      	 
      	 
