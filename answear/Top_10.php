<html>
<head>
  <title>
  Top10
  </title>
</head>
<body>
  <?php
    include "connect_MySQL.php"; 
    session_start();
    $UID=20082001;
//    $chapterNo=00120081001;
//	$tempUID = $_POST['UID'];
//	$_SESSION['studentID']=$tempUID;

    echo "<table>
          <form method='post' action='Top_10'>
          <input type=radio name = 'mode' value = '0'>����������
          <input type=radio name = 'mode' value = '1 '>���½�����";
    
    $sql="select distinct Cname 
          from chapter,student 
          where Student.Sno='$UID' and student.Tno=chapter.Tno;";
    $result=mysqli_query($link,$sql);
    while(1){
      	$row = mysqli_fetch_array($result, MYSQLI_NUM);
      	if($row != NULL){
      		echo"<tr>
      		     <td>$row[0]</td>
      		     <td name=chapterNo type=hidden value=$row[0]></td>
      		     <td>
      		       <input type=radio name='Chapter' value='��������½�'>
      		     </td>
      		     
      		     ";
      	}
      }
      
      
      echo "<tr><td>
            <input type=submit name='submit' value='��������½�'>
            </td></tr>
            </form><table>";
  ?>
<!--  <form action="Top_10.php" method=POST>-->
<!--  -->
<!--  <input type=radio name = 'Chapter' value = "00120081001" >��һ��-->
<!--  <input type=radio name = 'Chapter' value = '00220081001' >�ڶ���-->
<!--  <input type=radio name = 'Chapter' value = '00320081001' >������-->
<!--  <input type=radio name = 'Chapter' value = '00420081001' >������-->
<!--  <br/>-->
<!--    -->
<!--  -->
<!--  <input type=radio name = 'mode' value = '0'>����������-->
<!--  <input type=radio name = 'mode' value = '1 '>���½�����-->
<!--  <br/> -->
<!---->
<!--  <input type=submit name="submit" value='ȷ��'>-->
<!--  <br/>-->
<!--  </form>-->
 
  <?php
    echo "Top10��";
/*    function process_form(){
     	$chapterNo=$_POST["Chapter"];
    	$mode=$_POST["mode"];
    }
    
    if($_POST[submit]){
    	process_form();
    }
    
 */   
    
	echo "<table>
	<COL WIDTH=200><COL WIDTH=200><COL WIDTH=200>
       	<tr>
			<th>����</th>
			<th>����</th>
			<th>�ύ����</th>
		</tr>"; 
	
	include ("connect_MySQL.php");
	if(isset($_POST["submit"])){
	  $chapterNo=$_POST["Chapter"];
      $mode=$_POST["mode"];
	
      $Tno="SELECT distinct Tno from user,student where user.UID=student.Sno";
      
      
//      $sql= mysqli_query($link, "call showChapterImT($chapterNo.$tempUID);");
//	    $row = mysqli_fetch_array($sql, MYSQLI_NUM);
//        echo "<tr>";
//	    foreach($row as $key=>$value){
//	    	echo "<td>$row</td>";
//	    }
//	    echo "</tr>";
//	    echo "</table>";
	
      $sql= mysqli_query($link, "call showTop10('$chapterNo',' $mode');");
//    while(1){
	  $row = mysqli_fetch_array($sql, MYSQLI_NUM);
      echo "<tr>";
	  foreach($row as $key=>$value){
	  	echo "<td>$value</td>";
      }
      echo "</tr>";
//    }
    echo "</table>";
	}
	?>
</body>
</html>