<?
	include "common.php";
	
	$cookie_no=$_COOKIE[cookie_no];

	$no=$_REQUEST[no];
    $uid=$_REQUEST[uid];
	$pwd=$_REQUEST[pwd];
	$name=$_REQUEST[name];
    $tel1=$_REQUEST[tel1];
    $tel2=$_REQUEST[tel2];
    $tel3=$_REQUEST[tel3];
    $tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
    $sm=$_REQUEST[sm];
    $birthday1=$_REQUEST[birthday1];
    $birthday2=$_REQUEST[birthday2];
    $birthday3=$_REQUEST[birthday3];
    $birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
    $phone1=$_REQUEST[phone1];
    $phone2=$_REQUEST[phone2];
    $phone3=$_REQUEST[phone3];
    $phone = sprintf("%-3s%-4s%-4s", $phone1, $phone2, $phone3);
	$email=$_REQUEST[email];
	$zip=$_REQUEST[zip];
	$juso=$_REQUEST[juso];

	$pwd1=$_REQUEST[pwd1];
	$pwd2=$_REQUEST[pwd2];



	 if (!$pwd1){
		 $query="update member set name7='$name' , birthday7='$birthday' , sm7=$sm , tel7='$tel' ,
					phone7='$phone' , email7='$email' , zip7='$zip' , juso7='$juso' , gubun7='0'
					where no7=$cookie_no";
					$result=mysqli_query($db,$query);
					if(!$result) exit("에러: $query");
	 }
	  else{
		 $query="update member set pwd7='$pwd1' , name7='$name' , birthday7='$birthday' , sm7=$sm , tel7='$tel' ,
					phone7='$phone' , email7='$email' , zip7='$zip' , juso7='$juso' , gubun7='0'
					where no7=$cookie_no";
		$result=mysqli_query($db,$query);
		if(!$result) exit("에러: $query");
	  }
	   echo("<script>location.href='index.html'</script>");
?>