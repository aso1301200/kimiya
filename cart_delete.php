<?php
	session_start();

	if(!empty($_SESSION['cart_count'])){
		//カートに商品を追加
		$array = array();

		//現在の個数を格納
		$count = intval($_SESSION['cart_count']);

		for($i = 0;$i < intval($_SESSION['cart_count']); $i++){

			//削除に指定した商品詳細番号以外のものを再格納(実質指定した商品詳細番号は省かれる)
			if($_SESSION['cart_array'][$i*2] === $_GET['item']){
				$count = $count - 1;
			}else{
				array_push($array, $_SESSION['cart_array'][$i*2],$_SESSION['cart_array'][$i*2+1]);
			}
		}

		unset($_SESSION['cart_array']);
		$_SESSION['cart_array'] = $array;
		$_SESSION['cart_count'] = (String)$count;


		//商品詳細画面にリダイレクトする
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: cart_check.php");
		exit();
	}

?>
