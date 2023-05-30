<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "../common.php";

	$day1_y = $_REQUEST[day1_y];
	$day1_m = $_REQUEST[day1_m];
	$day1_d = $_REQUEST[day1_d];
	$day2_y = $_REQUEST[day2_y];
	$day2_m = $_REQUEST[day2_m];
	$day2_d = $_REQUEST[day2_d];
	$sel1 =$_REQUEST[sel1];
	$sel2 =$_REQUEST[sel2];
	$text1=$_REQUEST[text1];

	$page=$_REQUEST[page];


?>
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_update(no,pos)
	{
		state=form1.state[pos].value;
		location.href="jumun_update.php?no="+no+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1_y="+form1.day1_y.value+"&day1_m="+form1.day1_m.value+"&day1_d="+form1.day1_d.value+
			"&day2_y="+form1.day2_y.value+"&day2_m="+form1.day2_m.value+"&day2_d="+form1.day2_d.value;
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<form name="form1" method="post" action="jumun.php">
<input type="hidden" name="page" value="<?=$page?>">

<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr height="40">

<?

			if(!$day1_y) $day1_y = date("Y");
			if(!$day1_m) $day1_m = date("m");
			if(!$day1_d) $day1_d = date("d");
			if(!$day2_y) $day2_y = date("Y");
			if(!$day2_m) $day2_m = date("m");
			if(!$day2_d) $day2_d = date("d");

			if(!$sel1) $sel1 = 0;
			if(!$sel2) $sel2 = 0;
			if(!$text1) $text1 = "";

			$k = 0;
			if($day1_y !=0 && $day2_y !=0){
				$date1 = sprintf("%04d-%02d-%02d", $day1_y, $day1_m, $day1_d);
				$date2 = sprintf("%04d-%02d-%02d", $day2_y, $day2_m, $day2_d);
				$s[$k] = "jumunday7 between date('$date1') and date('$date2')";
				$k++;
			}
			
			if($sel1 != 0){
				$s[$k] = "state7 =" . $sel1;
				$k++;
			}
			if($text1) {
				if($sel2==1) { $s[$k] = "no7 like '%" . $text1 . "%'"; $k++; }
				elseif($sel2==2) { $s[$k] = "o_name7 like '%" . $text1 . "%'"; $k++; }
				elseif($sel2==3) { $s[$k] = "product_names7 like '%" . $text1 . "%'"; $k++; }
			}
			if($k > 0){
				$tmp = implode(" and ", $s);
				$tmp = " where " . $tmp;
			}
	
			$query = "select * from jumun " . $tmp . " order by no7 desc;";
			$result = mysqli_query($db, $query);							
			if (!$result) exit("에러: $query");								

			$count = mysqli_num_rows($result);

?>

		<td align="left"  width="70" valign="bottom">&nbsp 주문수 : <font color="#FF0000"><?=$count?></font></td>
		<td align="right" width="730" valign="bottom">
			기간 : 
			<input type="text" name="day1_y" size="4" value="<?=$day1_y?>">
			<?//검색 표시 구현
				echo("<select name='day1_m'>");
				for($i = 1; $i < 13; $i++) {
					if($day1_m == $i)
						echo("<option value='$i' selected>$day1_m</option>");
					else
						echo("<option value='$i'>$i</option>");
				}
				echo("</select>  ");

				echo("<select name='day1_d'>");
				for($i = 1; $i < 32; $i++) {
					if($day1_d == $i)
						echo("<option value='$i' selected>$day1_d</option>");
					else
						echo("<option value='$i'>$i</option>");
				}
				echo("</select>");

				echo(" - ");
				echo("<input type='text' name='day2_y' size='4' value='$day2_y'> ");
			
				echo("<select name='day2_m'>");
				for($i = 1; $i < 13; $i++) {
					if($day2_m == $i)
						echo("<option value='$i' selected>$day2_m</option>");
					else
						echo("<option value='$i'>$i</option>");
				}
				echo("</select> ");

				echo("<select name='day2_d'>");
				for($i = 1; $i < 32; $i++) {
					if($day2_d == $i)
						echo("<option value='$i' selected>$day2_d</option>");
					else
						echo("<option value='$i'>$i</option>");
				}
				echo("</select> ");

				echo("<select name='sel1'>");
				for($i = 0; $i < $n_state; $i++) {
					if($sel1 == $i)
						echo("<option value='$i' selected>$a_state[$i]</option>");
					else
						echo("<option value='$i'>$a_state[$i]</option>");
				}
				echo("</select> &nbsp");
				
				echo("<select name='sel2'>");
				for($i = 0; $i < $n_text2; $i++) {
					if($sel2 == $i)
						echo("<option value='$i' selected>$a_text2[$i]</option>");
					else
						echo("<option value='$i'>$a_text2[$i]</option>");
				}
				echo("</select> &nbsp");
			?>
			
			<input type="text" name="text1" size="10" value="<?=$text1?>">&nbsp
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;
		</td>
	</tr>
	</tr><td height="5" colspan="2"></td></tr>
</table>


<table width="800" border="1" cellpadding="0" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="70"  align="center">주문번호</td>
		<td width="70"  align="center">주문일</td>
		<td width="250" align="center">상품명</td>
		<td width="50"  align="center">제품수</td>	
		<td width="70"  align="center">총금액</td>
	    <td width="65"  align="center">주문자</td>
		<td width="50"  align="center">결재</td>
		<td width="135" align="center" colspan="2">주문상태</td>
	    <td width="50"  align="center">삭제</td>
	</tr>

<?

	$page=$_REQUEST[page]; 

   if(!$page) $page=1;                                  
   $pages=ceil($count/$page_line);
   $first=1;
   if($count>0) $first=$page_line*($page-1);
   $page_last=$count - $first;
   if($page_last>$page_line) $page_last=$page_line;
   if($count>0) mysqli_data_seek($result,$first);       

   //회원정보 (ID, 이름, 휴대폰, 전화번호, eamli 회원구분)

   for($i=0;$i<$page_last;$i++)
   {   
    $row=mysqli_fetch_array($result); //1 레코드 읽기
	
	$price=number_format($row[total_cash7]);

	if($row[pay_method21]==1){
		$pay_method ="무통장";
	}	
	else{
		$pay_method ="카드";
	}
	echo("<tr bgcolor='#F2F2F2' height='23'> 
		<td width='70'  align='center'><a href='jumun_info.php?no=$row[no7]'>$row[no7]</a></td>
		<td width='70'  align='center'>$row[jumunday7]</td>
		<td width='250' align='left'>&nbsp;$row[product_names7]</td>	
		<td width='40' align='center'>$row[product_nums7]</td>	
		<td width='70'  align='right'>$price&nbsp</td>	
		<td width='65'  align='center'>$row[o_name7]</td>	
		<td width='50'  align='center'>$pay_method</td>	
		<td width='85' align='center' valign='bottom'>");
		$color= "black";
		if($row[state7]==5) $color ="blue";
		if($row[state7]==6) $color ="red";
	echo("<select name='state' style='font-size:9pt; color:$color'>");
		for($a = 1; $a < $n_state; $a++){
			if($row[state7] == $a)
				echo("<option value='$a' selected>$a_state[$a]</option>");
			else
				echo("<option value='$a'>$a_state[$a]</option>");
		}
	echo("</select>&nbsp;
		</td>
		<td width='50' align='center'>
			<a href='javascript:go_update($row[no7],$i);'><img src='images/b_edit1.gif' border='0'></a>
		</td>	
		<td width='50' align='center'>
			<a href='jumun_delete.php?no=$row[no7]' onclick='javascript:return confirm(\"삭제할까요 ?\");'><img src='images/b_delete1.gif' border='0'></a>
			</td>
	</tr>");
		}
	?>
</table>

<input type="hidden" name="state">

<?
	$blocks = ceil($pages / $page_block);
	$block = ceil($page / $page_block);	
	$page_s = $page_block * ($block - 1);
	$page_e = $page_block * $block;
	if ($blocks <= $block) $page_e = $pages;

	echo("<table width='800' border='0'>
					<tr>
						<td height='30' align='center'>");
	
	if ($block > 1)	{
		$tmp = $page_s;
		echo("<a href='jumun.php?page=$tmp&sel1=$sel1&sel2=$sel2&text1=$text1&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d'>
						<img src='images/i_prev.gif' align='absmiddle' border='0'>
					</a>&nbsp");
	}

	for($i = $page_s + 1; $i <= $page_e; $i++) {
		if ($page == $i)
			echo("<font color='red'><b>$i</b></font>&nbsp");
		else
			echo("<a href='jumun.php?page=$i&sel1=$sel1&sel2=$sel2&text1=$text1&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d'>[$i]</a>&nbsp");
	}
	
	if ($block < $blocks) {
		$tmp = $page_e + 1;
		echo("&nbsp<a href='jumun.php?page=$tmp&sel1=$sel1&sel2=$sel2&text1=$text1&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d'>
						<img src='images/i_next.gif' align='absmiddle' border='0'>
					</a>");
	}

	echo("		</td>
					</tr>
				</table>");
?>

</form>

</center>

</body>
</html>