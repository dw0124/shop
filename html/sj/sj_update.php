<?
	include "common.php";

	$no=$_REQUEST[no];
	$name=$_REQUEST[name];
	$kor=$_REQUEST[kor];
	$eng=$_REQUEST[eng];
	$mat=$_REQUEST[mat];
	$hap=$_REQUEST[hap];
	$avg=$_REQUEST[avg];

	$query="update sj set name7='$name', kor7=$kor,
					eng7=$eng, mat7=$mat, hap7=$hap,
					avg7=$avg where no7=$no;";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러: $query");


	echo("<script>location.href='sj_list.php'</script>");
?>