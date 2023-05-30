<?
   include "common.php";
   
   $uid=$_REQUEST[uid];
   $pwd=$_REQUEST[pwd];
   $name=$_REQUEST[name];
   $birthday1=$_REQUEST[birthday1];
   $birthday2=$_REQUEST[birthday2];
   $birthday3=$_REQUEST[birthday3];
   $sm=$_REQUEST[sm];
   $tel1=$_REQUEST[tel1];
   $tel2=$_REQUEST[tel2];
   $tel3=$_REQUEST[tel3];
   $phone1=$_REQUEST[phone1];
   $phone2=$_REQUEST[phone2];
   $phone3=$_REQUEST[phone3];
   $email=$_REQUEST[email];
   $zip=$_REQUEST[zip];
   
   $juso=$_REQUEST[juso];
   $gubun=$_REQUEST[gubun];

   //$zip=sprintf("%-3s%-3s%",$zip1,$zip2);
   $tel=sprintf("%-3s%-4s%-4s",$tel1,$tel2,$tel3);
   $phone=sprintf("%-3s%-4s%-4s",$phone1,$phone2,$phone3);
   $birthday=sprintf("%04d-%02d-%02d",$birthday1,$birthday2,$birthday3);

   $query="insert into member (uid7, pwd7, name7, birthday7, sm7, tel7, phone7, email7, zip7, juso7, gubun7)
            values ('$uid', '$pwd', '$name', '$birthday', $sm, '$tel', '$phone', '$email', '$zip', '$juso', 0);";
   $result=mysqli_query($db,$query);
   if (!$result) exit("에러:$query");

   echo("<script>location.href='member_joinend.php'</script>");
?>