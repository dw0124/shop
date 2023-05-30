<?
    include "common.php";
	   
    $cookie_no=$_COOKIE[cookie_no];
    if($cookie_no) $member_no = $cookie_no;
    else $member_no = 0;
	
	$o_jumunday = date("Y-m-d");

	$cart = $_COOKIE[cart];
	$n_cart = $_COOKIE[n_cart];
    $o_name = $_REQUEST[o_name];
    $o_tel = $_REQUEST[o_tel];
    $o_phone = $_REQUEST[o_phone];
    $o_email = $_REQUEST[o_email];
    $o_zip = $_REQUEST[o_zip];
    $o_addr = $_REQUEST[o_addr];
    $o_etc = $_REQUEST[o_etc];

    $r_name = $_REQUEST[r_name];
    $r_tel = $_REQUEST[r_tel];
    $r_phone = $_REQUEST[r_phone];
    $r_email = $_REQUEST[r_email];
    $r_zip = $_REQUEST[r_zip];
    $r_addr = $_REQUEST[r_addr];

    $pay_method = $_REQUEST[pay_method];
    $card_kind = $_REQUEST[card_kind];
    $card_okno = $_REQUEST[card_okno];
    $card_halbu = $_REQUEST[card_halbu];
    $bank_kind = $_REQUEST[bank_kind];
    $bank_sender = $_REQUEST[bank_sender];

	$query= "select no7 from jumun where jumunday7=curdate() order by no7 desc limit1;";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);

	if ($count>0)      // 주문번호가 있으면 
		//새주문번호 = 가장 큰 주문번호 + 1;
		$o_no = $o_no + 1;
	else
	   $o_no = date("ymd") . "0001";

	$total_price=0;
	$product_nums = 0;
	$product_names = "";
	For ($i=1;  $i<=$n_cart;  $i++)
	{
	   if ($cart[$i]) // 제품정보가 있는 경우만
	   {
		   //• 장바구니 cookie에서 제품번호, 수량, 소옵션번호1,2 알아내기
		   list($no, $num, $opts1, $opts2) = explode("^", $cart[$i]);

		   //• 제품정보(제품번호, 단가, 할인여부, 할인율) 알아내기
			$query= "select * from product where no7 = $no;";
			$result = mysqli_query($db, $query);
			if (!$result) exit("에러: $query");
			$row = mysqli_fetch_array($result);

		   // 소옵션 이름 opt1, opt2 이름 알아내기
			$query = "select * from opts where no7=$opts1";
			$result = mysqli_query($db, $query);   
			if (!$result) exit("에러: $query");
			$row1=mysqli_fetch_array($result);
	   
			$query="select * from opts where no7=$opts2";
			$result = mysqli_query($db, $query);   
			if (!$result) exit("에러: $query");
			$row2=mysqli_fetch_array($result);

			if($row[icon_sale7]) 
				$discount_price = round($row[price7] * (100 - $row[discount7]) / 100, -3);
			else 
				$discount_price = $row[price21];
			
			$cash_price = $discount_price * $num;

		   //• insert SQL문을 이용하여 jumuns 테이블에 저장.
		   // (주문번호, 제품번호, 수량, 단가, 금액, 할인율, 소옵션번호1,2)
			$query = "insert into jumuns (jumun_no7, product_no7, num7, price7, cash7, discount7, opts_no1, opts_no2)
			values ('$o_no' , '$row[no7]', '$num', '$row[price]', '$cash_price', '$row[discount7]', '$opts1', '$opts2');";



		   //• 장바구니 cookie에서 제품 정보 삭제.
		   setcookie("cart[$i]");



		    $total_price += $cash_price;

		   $product_nums = $product_nums + 1;
		   if ($product_nums==1) $product_names = $row[name7];
		}
	}

	if ($product_nums>1)      // 제품수가 2개 이상인 경우만, "외 ?" 추가
	{
		$tmp = $product_nums;
		$product_names = $product_names . " 외 " . $tmp;
	}

	if($total_price < $max_baesongbi) {
      $query = "insert into jumuns (jumun_no7, product_no7, num7, price7, cash7, discount7, opts_no1, opts_no2)
            values ('$o_no', 0, 1, '$baesongbi', '$baesongbi', 0, 0, 0);";
      $result = mysqli_query($db, $query);
      if (!$result) exit("에러: $query");

      $total_price += $baesongbi;
	}

   $cookie_no=$_COOKIE[cookie_no];
   if($cookie_no) $member_no = $cookie_no;
   else $member_no = 0;


   $query = "insert into jumun (no7, member_no7, jumunday7, product_names7, product_nums7, o_name7, o_tel7, o_phone7, o_email7, o_zip7, o_juso7, r_name7, r_tel7, r_phone7, r_email7, r_zip7, r_juso7, memo7, pay_method7, card_okno7, card_halbu7, card_kind7, bank_kind7, bank_sender7, total_cash7, state7)
      values ('$o_no', '$member_no', '$o_jumunday', '$product_names', '$product_nums', '$o_name', '$o_tel', '$o_phone', '$o_email', '$o_zip', '$o_addr', '$r_name', '$r_tel', '$r_phone', '$r_email', '$r_zip', '$r_addr', '$o_etc', '$pay_method', '$card_okno', '$card_halbu', '$card_kind', '$bank_kind', '$bank_sender', '$total_price', 1);";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   echo("<script>location.href='order_ok.html'</script>");
?>