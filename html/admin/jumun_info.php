<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";

	$no = $_REQUEST[no];

	$query = "select * from jumun where no7='$no' ;";
	$result = mysqli_query($db, $query);							
	if (!$result) exit("에러: $query");
	$row=mysqli_fetch_array($result);

	$color= "black";
	if($row[state7]==5){
		$color ="blue";
		$color_text = "주문완료";
		}
	if($row[state7]==6) {
		$color ="red";
		$color_text = "주문취소";
	}

	if($row[member_no7] == 0) $client_text = 비회원;
	else $client_text = 회원;

	if($row[pay_method7]==1){
		$pay_method ="무통장";
	}	
	else{
		$pay_method ="카드";
	}

  $o_tel1=trim(substr($row[o_tel7],0,3));    //0번 위치에서 3자리 문자열 추출
  $o_tel2=trim(substr($row[o_tel7],3,4)); 	  //3번 위치에서 4자리
  $o_tel3=trim(substr($row[o_tel7],7,4));	  //7번 위치에서 4자리

  $o_phone1=trim(substr($row[o_phone7],0,3));    //0번 위치에서 3자리 문자열 추출
  $o_phone2=trim(substr($row[o_phone7],3,4)); 	  //3번 위치에서 4자리
  $o_phone3=trim(substr($row[o_phone7],7,4));	  //7번 위치에서 4자리

  $r_tel1=trim(substr($row[r_tel7],0,3));    //0번 위치에서 3자리 문자열 추출
  $r_tel2=trim(substr($row[r_tel7],3,4)); 	  //3번 위치에서 4자리
  $r_tel3=trim(substr($row[r_tel7],7,4));	  //7번 위치에서 4자리

  $r_phone1=trim(substr($row[r_phone7],0,3));    //0번 위치에서 3자리 문자열 추출
  $r_phone2=trim(substr($row[r_phone7],3,4)); 	  //3번 위치에서 4자리
  $r_phone3=trim(substr($row[r_phone7],7,4));	  //7번 위치에서 4자리

   $o_tel=$o_tel1 . "-" . $o_tel2 . "-" . $o_tel3;
   $o_phone=$o_phone1 . "-" . $o_phone2 . "-" . $o_phone3;
   $r_tel=$r_tel1 . "-" . $r_tel2 . "-" . $r_tel3;
   $r_phone=$r_phone1 . "-" . $r_phone2 . "-" . $r_phone3;

	if( $row[card_halbu7] == 0){
	  $card_halbu ="일시불";
	}
	else if ($row[card_halbu7] == 3){
		$card_halbu ="3개월";
	}
	else if ($row[card_halbu7] == 6){
		$card_halbu ="6개월";
	}
	else if ($row[card_halbu7] == 9){
		$card_halbu ="9개월";
	}
	else if ($row[card_halbu7] == 12){
		$card_halbu ="12개월";
	}
	  
	if($row[card_kind7] == 0){
	  $card_kind = "";
	}
	else if ($row[card_kind7] == 1){
		$card_kind ="국민카드";
	}
	else if ($row[card_kind7] == 2){
		$card_kind ="신한카드";
	}
	else if ($row[card_kind7] == 3){
		$card_kind ="우리카드";
	}
	else if ($row[card_kind7] == 4){
		$card_kind ="하나카드";
	}
	if($row[bank_kind7] == 1){
		$bank_kind = "국민은행:123-12-12345";
	}
	else if ($row[bank_kind7] == 2){
		$bank_kind ="신한은행:123-12-12345";
	}

?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문번호</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE">&nbsp;<font size="3"><b><?=$row[no7]?> (<font color=<?=$color?>><?=$color_text?></font>)</b></font></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문일</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[jumunday7]?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[o_name7]?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$o_tel?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[o_email7]?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$o_phone?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?=$row[o_zip7]?>) <?=$row[o_juso7]?></td>
	</tr>
	</tr>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[r_name7]?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$r_tel?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[r_email7]?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$r_phone?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?=$row[r_zip7]?>) <?=$row[r_juso7]?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">메모</font></td>
        <td width="300" height="50" bgcolor="#EEEEEE" colspan="3"><?=$row[memo7]?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">지불종류</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$pay_method?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드승인번호 </font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[card_okno7]?>&nbsp</td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드 할부</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$card_halbu?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드종류</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$card_kind?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">무통장</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$bank_kind?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">입금자이름</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[bank_sender7]?></td>
	</tr>
</table>
<br>


<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC"> 
    <td width="340" height="20" align="center"><font color="#142712">상품명</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">수량</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">단가</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">금액</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">할인</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션1</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션2</font></td>
	</tr>
	<? 
	$query=" select jumuns.product_no7 as js_no , product.name7 as name, jumuns.num7 as num, jumuns.price7 as price, jumuns.cash7 as cash, jumuns.discount7 as discount , opts1.name7 as opts1, opts2.name7 as opts2
    from ((jumuns left join product on jumuns.product_no7=product.no7)
           left join opts as opts1 on jumuns.opts_no1=opts1.no7)
           left join opts as opts2 on jumuns.opts_no2=opts2.no7
    where jumuns.jumun_no7='$no';";
	$result = mysqli_query($db, $query);							
	if (!$result) exit("에러: $query");

	$count = mysqli_num_rows($result);

	for($i=0;$i<$count;$i++)
   {   
	$row1=mysqli_fetch_array($result); //1 레코드 읽기

	if($row1[discount] == 0) $discount = "";
	else $discount = $row1[discount].'%';

	if($row1[js_no] == 0)
		$product_name = "배송비";
	else
		$product_name = $row1[name];

	$price_text = number_format($row1[price]);
	$cash_text = number_format($row1[cash]);

	$total_cash = $total_cash + $row1[cash];
	$total_cash_text = number_format($total_cash);
	
	echo("<tr bgcolor='#EEEEEE' height='20'>	
		<td width='340' height='20' align='left'>$product_name</td>	
		<td width='50'  height='20' align='center'>$row1[num]</td>	
		<td width='70'  height='20' align='right'>$price_text</td>	
		<td width='70'  height='20' align='right'>$cash_text</td>	
		<td width='50'  height='20' align='center'>$discount</td>	
		<td width='60'  height='20' align='center'>$row1[opts1]</td>	
		<td width='60'  height='20' align='center'>$row1[opts2]</td>	
	</tr>");
}
?>
</table>

<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
	  <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">총금액</font></td>
		<td width="700" height="20" bgcolor="#EEEEEE" align="right"><font color="#142712" size="3"><b><?=$total_cash_text?></b></font> 원&nbsp;&nbsp</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="button" value="이 전 화 면" onClick="javascript:history.back();">&nbsp
			<input type="button" value="프린트" onClick="javascript:print();">
		</td>
	</tr>
</table>

</center>

<br>
</body>
</html>
