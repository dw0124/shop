<?
include "common.php";

	$uid=$_POST[uid];
	$pwd=$_POST[pwd];

	$query="select no7, name7 from member where uid7='$uid' and pwd7='$pwd'";
	$result=mysqli_query($db,$query);
	if(!result) exit("에러:$query");
	$count=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);

if ($count>0) {

	//고객의 번호와 이름을 cookie로 저장(cookie_no, cookie_name)
   setcookie("cookie_no",$row[no7]);

   setcookie("cookie_name",$row[name7]);
   //index.html로 이동.

   echo("<script>location.href='index.html'</script>");
   }
else
   echo("<script>location.href='member_login.php'</script>");

?>
