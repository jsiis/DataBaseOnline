{* Smarty *}
<html>
{include file="studenthead.tpl"}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="container">
<body><center>
<form class="well" action='updateSelfInformation.php' method=POST>
<table class="table table-bordered" border="1">
		  <tr>
          <td>姓名*  </td>
      	  <td><input class="form-control"type=text name='Uname'></td>
      	  </li></tr>
  
      	  <tr>
      	  <td>性别  </td>
      	  <td><input type="radio" name="Usex" value="男" checked>Boy
			<input type="radio" name="Usex" value="女">Girl</td>
      	  </tr>

          <tr>
      	  <td>年龄  </td>
      	  <td><input class="form-control" type=text name='Uage'></td>
      	  </tr>

          <tr>
      	  <td>民族  </td>
      	  <td><input class="form-control" type=text name='Unation' ></td>
      	  </tr>

          <tr>
      	  <td>籍贯  </td>
      	  <td><input class="form-control" type=text name='UBP'></td>
      	  </tr>
 
      	  <tr>
      	  <td>密码*  </td>
      	  <td><input class="form-control" type=password name='Upassword1'></td>
      	  </tr>

          <tr>
      	  <td>重复密码*</td>
      	  <td><input class="form-control" type=password name='Upassword2'></td>
      	  </tr>
 
          <tr>
      	  <td>所在学校</td>
      	  <td><input class="form-control" type=text name='Uschool' value="中山大学"></td>
      	  </tr>

          <tr>
      	  <td>电子邮件*</td>
      	  <td><input class="form-control" type=text name='Uemail'></td>
      	  </tr>
     
          <tr>
      	  <td>电话*</td>
      	  <td><input class="form-control" type=text name='Uphone'></td>
      	  </tr>
</table>
<input  class="btn btn-primary" type=submit name='submit' value='提交修改'><br/></form>
</center>
<hr>
<p style="color:red">每次提交会更新上表的所有信息。</p>
<p style="color:red">星号选项必填。</p>
</body>
</div>
</html>
