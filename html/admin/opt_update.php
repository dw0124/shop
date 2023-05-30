<?
   include "../common.php";

   $no=$_REQUEST[no1];
   $name=$_REQUEST[name];

   $query="update opt set name7='$name' where no7=$no;";
   $result=mysqli_query($db,$query);
   if(!$result) exit("에러: $query");


   echo("<script>location.href='opt.php'</script>");
?>