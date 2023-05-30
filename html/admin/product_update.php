<?
   include "../common.php";

   $no=$_REQUEST[no];
   $sel1=$_REQUEST[sel1];
   $sel2=$_REQUEST[sel2];
   $sel3=$_REQUEST[sel3];
   $sel4=$_REQUEST[sel4];
   $text1=$_REQUEST[text1];
   $page=$_REQUEST[page];
   

   $menu=$_REQUEST[menu];
   $code=$_REQUEST[code];
   $name=addslashes($_REQUEST[name]);
   $coname=$_REQUEST[coname];
   $price=filter_var($_REQUEST[price], 519);
   $opt1=$_REQUEST[opt1];
   $opt2=$_REQUEST[opt2];
   $contents=addslashes($_REQUEST[contents]);
   $status=$_REQUEST[status];
   $icon_new=$_REQUEST[icon_new];
   $icon_hit=$_REQUEST[icon_hit];
   $icon_sale=$_REQUEST[icon_sale];
   $discount=$_REQUEST[discount];
   $regday1=$_REQUEST[regday1];
   $regday2=$_REQUEST[regday2];
   $regday3=$_REQUEST[regday3];
   $imagename1=$_REQUEST[imagename1];
   $imagename2=$_REQUEST[imagename2];
   $imagename3=$_REQUEST[imagename3];
   $checkno1=$_REQUEST[checkno1];
   $checkno2=$_REQUEST[checkno2];
   $checkno3=$_REQUEST[checkno3];
   $image1=$_REQUEST[image1];
   $image2=$_REQUEST[image2];
   $image3=$_REQUEST[image3];
   $big=$_REQUEST[big];
   
	if($icon_new) $icon_new = 1; else $icon_new = 0;
	if($icon_hit) $icon_hit = 1; else $icon_hit = 0;
	if($icon_sale) $icon_sale = 1; else $icon_sale = 0;

	$regday=sprintf("%04d-%02d-%02d",$regday1,$regday2,$regday3);

	$fname1=$imagename1;
	if ($checkno1=="1") $fname1="";    // 삭제 체크가 된 경우
	if ($_FILES["image1"]["error"]==0) 
	{
		$fname1=$_FILES["image1"]["name"];    
		if (!move_uploaded_file($_FILES["image1"]["tmp_name"],"../product/.$fname1")) exit("업로드 실패1");
	}

	$fname2=$imagename2;
	if ($checkno2=="1") $fname2="";    // 삭제 체크가 된 경우
	if ($_FILES["image2"]["error"]==0) 
	{
		$fname2=$_FILES["image2"]["name"];    
		if (!move_uploaded_file($_FILES["image2"]["tmp_name"],"../product/.$fname2")) exit("업로드 실패2");
	}

	$fname3=$imagename3;
	if ($checkno3=="1") $fname3="";    // 삭제 체크가 된 경우
	if ($_FILES["image3"]["error"]==0) 
	{
		$fname3=$_FILES["image3"]["name"];    
		if (!move_uploaded_file($_FILES["image3"]["tmp_name"],"../product/.$fname3")) exit("업로드 실패3");
	}

   $query="update product set menu7='$menu', code7='$code', name7='$name', coname7='$coname', price7='$price', opt1='$opt1', opt2='$opt2', contents7='$contents', status7='$status', regday7='$regday', icon_new7='$icon_new', icon_hit7='$icon_hit', icon_sale7='$icon_sale', discount7='$discount', image1='$fname1', image2='$fname2', image3='$fname3' where no7=$no;";
   $result=mysqli_query($db,$query);
   if (!$result) exit("에러:$query");

   echo("<script>location.href='product_edit.php?no=$no&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page'</script>");
?>