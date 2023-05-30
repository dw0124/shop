<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	

<?
	include "main_top.php";
	include "common.php";   

?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!---- 화면 우측(신상품) 시작 -------------------------------------------------->	
			<table width="767" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60">
						<img src="images/main_newproduct.jpg" width="767" height="40">
					</td>
				</tr>
			</table>
<?
		$query = 'select * from product where icon_new7=1 and status7=1 order by rand() limit 15';
		$row=mysqli_fetch_array($result);
		$result = mysqli_query($db, $query);                     
		

		
		
		if (!$result) exit("에러: $query");
			$num_col=5;   $num_row=3;                   // column수, row수
			$count=mysqli_num_rows($result);           // 출력할 제품 개수
			$icount=0;       // 출력한 제품개수 카운터
			echo("<table>");
			for ($ir=0; $ir<$num_row; $ir++)
			{

				 echo("<tr>");
				 for ($ic=0;  $ic<$num_col;  $ic++)
				{


					 if ($icount < $count)
					{
						 $row=mysqli_fetch_array($result);	

						$price = round($row[price7] * (100-$row[discount7])/100, -3);

						$price = number_format($price);
						$price7 = number_format($row[price7]);

						 echo("<td width='150' height='205' align='center' valign='top'>
						 <table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>");

							echo("<tr>
								<td align='center'> 
									<a href='product_detail.php? no=$row[no7]'><img src='product/$row[image1]' width='120' height='140' border='0'></a>
								</td>
							</tr>");	
							echo("<tr><td height='5'></td></tr>");

							echo("<tr> 
								<td height='20' align='center'>
									<a href='product_detail.php? no=$row[no7]'><font color='444444'>$row[name7]</font></a>&nbsp; ");
									
									if($row[icon_hit7] == 1)
									echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
									if($row[icon_new7] == 1)
									echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'> ");
									if($row[icon_sale7] == 1)
									echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'>");
								
								echo("</td>");
							echo("</tr>");

							if($row[discount7] > 0)
							echo("<tr><td height='20' align='center'><strike>$price7 원</strike><br><b> $price 원</b></td></tr>");
							else
							echo("<tr><td height='20' align='center'><b>$price7 원</b></td></tr>");

						echo("</table>");
							echo("</td>");
					 }
					 else
						 echo("<td></td>");      // 제품 없는 경우
					 $icount++;

				}
				echo("</tr>");
			}
			echo("</table>");
?>


			<!---- 화면 우측(신상품) 끝 -------------------------------------------------->	

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	


<?
	include "main_bottom.php"
?>