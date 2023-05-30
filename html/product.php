
<?
	include "main_top.php";
	include "common.php";   

	$menu = $_REQUEST[menu];
	$sort=$_REQUEST[sort];
	$no = $_REQUEST[no];
?>


<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

      <!-- 하위 상품목록 -->

			<!-- form2 시작 -->
			<form name="form2" method="post" action="product.php">
			<input type="hidden" name="menu" value="<?=$menu?>">
	
			<table border="0" cellpadding="0" cellspacing="5" width="767" class="cmfont" bgcolor="#efefef">
				<tr>
					<td bgcolor="white" align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="751" class="cmfont">
							<tr>
								<td align="center" valign="middle">
									<table border="0" cellpadding="0" cellspacing="0" width="730" height="40" class="cmfont">
										<tr>
											<td width="500" class="cmfont">
												<font color="#C83762" class="cmfont"><b><?=$a_menu[$menu]?> &nbsp</b></font>&nbsp
											</td>
											<td align="right" width="274">
												<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
													<tr>
													 <?
														if($sort == 0)
															$query = "select * from product where menu7=$menu order by no7 desc";
														elseif($sort == 1)
															$query = "select * from product where menu7=$menu order by price7 desc";
														elseif($sort == 2)
															$query = "select * from product where menu7=$menu order by price7";
														else
															$query = "select * from product where menu7=$menu order by name7";
															
															$result = mysqli_query($db, $query);   
															if (!$result) exit("에러: $query");
															$row=mysqli_fetch_array($result);
															$count=mysqli_num_rows($result);   //전체 레코드개수
													 ?>
														<td align="right"><font color="EF3F25"><b><?=$count?></b></font> 개의 상품.&nbsp;&nbsp;&nbsp</td>
														<td width="100">
																<?
																	echo("<select name='sort' size='1' class='cmfont' onChange='form2.submit()' >");
																	for($i=0;$i<$n_option;$i++)
																	{
																		if ($i==$sort)
																		   echo("<option value='$i' selected>$a_option[$i]</option>");
																		else
																		   echo("<option value='$i'>$a_option[$i]</option>");
																	}
																	echo("</select>");
																	
																?>
														
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<!-- form2 -->

  <?
            $num_col = 5; $num_row = 3;
            $page_line = $num_col * $num_row;
            $icount = 0;

            if (!$page) $page = 1;                                    
            $pages = ceil($count/$page_line);                                 
            $first = 1;
            if ($count > 0) $first = $page_line * ($page - 1);      
            $page_last = $count - $first;
            if ($page_last > $page_line) $page_last = $page_line;      
            if ($count > 0) mysqli_data_seek($result, $first);      

            echo("<table border='0' cellpadding='0' cellspacing='0'>");
            for($ir = 0; $ir < $num_row; $ir++)
            {
               echo('<tr>');
               for($ic = 0;  $ic < $num_col;  $ic++)
               {
                  if($icount < $page_last)
                  {
                     $row = mysqli_fetch_array($result);

						$price = round($row[price7] * (100-$row[discount7])/100, -3);

						$price = number_format($price);
						$price7 = number_format($row[price7]);

						 echo("<td width='150' height='205' align='center' valign='top'>
						 <table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>");

							echo("<tr>
								<td align='center'> 
									<a href='product_detail.php?no=$row[no7]'><img src='product/$row[image1]' width='120' height='140' border='0'></a>
								</td>
							</tr>");	
							echo("<tr><td height='5'></td></tr>");

							echo("<tr> 
								<td height='20' align='center'>
									<a href='product_detail.php?no=$row[no7]'><font color='444444'>$row[name7]</font></a>&nbsp; ");
									
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
<?
   $blocks = ceil($pages / $page_block);            // 전체 블록 수
   $block = ceil($page / $page_block);               // 현재 블록
   $page_s = $page_block * ($block - 1);            // 현재 페이지
   $page_e = $page_block * $block;                     // 마지막 페이지
   if ($blocks <= $block) $page_e = $pages;

   echo("<table border='0' cellpadding='0' cellspacing='0' width='690'>
               <tr>
                  <td height='40' class='cmfont' align='center'>");
   
   if ($block > 1)   {            // 이전 블록으로
      $tmp = $page_s;
      echo("<a href='product.php?menu=$menu&sort=$sort&page=$tmp'>
                  <img src='images/i_prev.gif' align='absmiddle' border='0'>
               </a>&nbsp");
   }

   for($i = $page_s + 1; $i <= $page_e; $i++) {   // 현재 블록의 페이지
      if ($page == $i)
         echo("<font color='red'><b>$i</b></font>&nbsp");
      else
         echo("<a href='product.php?menu=$menu&sort=$sort&page=$i'>[$i]</a>&nbsp");
   }
   
   if ($block < $blocks) {      // 다음 블록으로
      $tmp = $page_e + 1;
      echo("&nbsp<a href='product.php?menu=$menu&sort=$sort&page=$tmp'>
                  <img src='images/i_next.gif' align='absmiddle' border='0'>
               </a>");
   }

   echo("      </td>
               </tr>
            </table>");
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	


<?
	include "main_bottom.php"
?>