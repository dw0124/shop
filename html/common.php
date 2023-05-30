<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	ini_set("display_error", 1);

	$admin_id="admin";
    $admin_pw = "1234";

	$page_line=5;
	$page_block=5;

	$db = mysqli_connect("localhost","shop7","1234","shop7");
	if(!$db) exit("DB연결에러");

	$a_idname=array("전체","이름", "ID");     //  2줄은 common.php에 작성.
	$n_idname=count($a_idname);    



	$a_menu=array("분류선택","상의","바지","ACC","모자");
	$n_menu=count($a_menu);              // 분류 개수


	$a_status=array("상품상태","판매중","판매중지","품절");
	$n_status=count($a_status);


	$a_icon=array("아이콘","New","Hit","Sale");
	$n_icon=count($a_icon);


	$a_text1=array("", "제품이름", "제품번호");   // for문의 $i는 1부터 시작
	$n_text1=count($a_text1);

	$a_option=array("신상품순 정렬", "고가격순 정렬", "저가격순 정렬" , "상품명 정렬");
	$n_option=count($a_option);

	$baesongbi = 2500;
	$max_baesongbi =100000;

	$a_state=array("전체","주문신청","주문확인","입금확인", "배송중", "주문완료", "주문취소");
	$n_state=count($a_state);

	$a_text2=array("전체","주문번호","고객명","상품명");
	$n_text2=count($a_text2);
?>
