<!-- 購入ページの１つめ、住所などの情報を入力するページ -->
<!DOCTYPE html>
<html lang=''>
<head>
<?php include '/common/metadata.html';?>
</head>
<body>

<!-- sessionの開始(全てのページに入力してください) -->
<?php
	session_start();
?>

<!-- データベース準備 -->
<?php
	//▼SQL文のエスケープ処理
	function quote_smart($parameter)
	{
		// 数値以外をクオートする
		if (!is_numeric($parameter)) {
			$value = mysql_real_escape_string($parameter);
		}else{
			$value = (string)$parameter;
		}
		return $value;
	}
	//▲SQL文のエスケープ処理

	if(!empty($_SESSION['cart_array'])){
		//結果代入用配列
		$result_array = array();

		$url = "localhost";
		$user = "root";
		$pass = "root";
		$db = "kimiya";

		// MySQLへ接続する
		$link = mysql_connect($url,$user,$pass) or die("MySQLへの接続に失敗しました。");

		// データベースを選択する
		$sdb = mysql_select_db($db,$link) or die("データベースの選択に失敗しました。");

		// クエリを送信する
		//文字化け対策
		mysql_query("SET NAMES 'utf8'");

		//詳細、画像などを含めた商品情報のすべて
		for($i = 0;$i < $_SESSION['cart_count'];$i++){
			$sql = "SELECT g.goods_name,gd.goods_details_number,p.photo_name,g.value "
				."FROM goods g,goods_details gd,goods_photo gp,photo p "
				."WHERE g.goods_number = gd.goods_number "
				."AND gd.goods_details_number = gp.goods_details_number "
				."AND gp.photo_number = p.photo_number "
				."AND gd.goods_details_number='".quote_smart($_SESSION['cart_array'][$i*2])."' "
				."AND gd.color_code='".quote_smart($_SESSION['cart_array'][$i*2+1])."' "
				."AND gp.direction_code = '2'";
			$result = mysql_query($sql,$link);

			//退避用の配列$array
			$array = mysql_fetch_assoc($result);

			$result_array[$i]['goods_name'] = $array['goods_name'];
			$result_array[$i]['goods_details_number'] = $array['goods_details_number'];
			$result_array[$i]['photo_name'] = $array['photo_name'];
			$result_array[$i]['value'] = $array['value'];
		}
	}

?>
<!-- ここまでデータベース -->

<!-- ここから削除ボタンのJavaScript -->
<script type="text/javascript">
	function deleteCart(item){
		location.href = "cart_delete.php?item="+item;
	}
</script>
<!-- ここまで削除ボタンのJavaScript -->

<div id="page">

	<!-- ヘッダー部分 -->
	<?php include '/common/header.html';?>
	<!-- ここまでヘッダー部分 -->

	<div class="clear"></div>

	<!-- タグ部メニュー -->
	<p><?php include '/common/cssmenu.html';?></p>
	<!-- ここまでタグ部メニュー -->

	<!-- カートの中身 -->
	<p>
		<form method="POST" action="">
			<table>
			<td>会員情報
				<?php
					if(empty($_SESSION['id'])){
						//ログインしていない人の情報入力フォーム

					}else{
						//ログインしている人の情報入力フォーム
					}
				?>
			</td>
			<td>商品情報
				<?php
				?>
			</td>
			</table>
		</form>
	</p>

</div>
</body>
</html>
