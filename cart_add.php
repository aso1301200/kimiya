<!-- カートに商品を挿入するためのPHP -->
<?php
	session_start();

	if(empty($_SESSION['cart_array'])){
		//カートに商品を追加
		$_SESSION['cart_array'] = array();
		array_push($_SESSION['cart_array'], $_GET['item'], $_GET['color']);
		$_SESSION['cart_count'] = "1";
	}else{
		//カートに商品を追加
		$array = array();
		for($i = 0;$i < intval($_SESSION['cart_count']); $i++){
			array_push($array, $_SESSION['cart_array'][$i*2],$_SESSION['cart_array'][$i*2+1]);
		}
		array_push($array, $_GET['item'], $_GET['color']);
		$_SESSION['cart_array'] = $array;

		//商品の個数+1
		$count = $_SESSION['cart_count'];
		$count = (string)(intval($count) + 1);
		$_SESSION['cart_count'] = $count;
	}

	//商品詳細画面にリダイレクトする
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: item_tail.php?item=".$_GET['item']."&color=".$_GET['color']."&added=true");
	exit();
?>