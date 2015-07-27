<!-- カートの中身を確認、購入画面に進むためのページ -->
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
		<form method="POST" action="buy_step.php">
			<table id="cart_check" border="1 solid">
				<tr><th>購入</th><th>買い物かごに追加した商品</th><th>単品|税込</th><th>注文個数</th><th>削除</th></tr>
				<!-- ここをループ文にする -->
				<?php
					//商品ごとの個数をカウントする array[商品詳細番号を入れる][個数を入れる]
					$goods_count = array();
					$goods_count[0][0] = "";
					$goods_count[0][1] = "";

					for($i = 0;$i < $_SESSION['cart_count'];$i++){
						$boolean_add = false;

						//同じ商品詳細番号が既に格納されているか調べる
						for($j = 0;$j < count($goods_count);$j++){
							if($goods_count[$j][0] === $result_array[$i]['goods_details_number']){
								$boolean_add = true;
								break;
							}
						}

						//同じ商品詳細番号があればカウントを進める、なければ配列に追加
						if($boolean_add == true){
							$goods_count[$j][1] = $goods_count[$j][1] + 1;
						}else{
							$goods_count[$j][0] = $result_array[$i]['goods_details_number'];
							$goods_count[$j][1] = 1;
						}

					}

					//ポイントの合計を格納する変数
					$point = 0;

					for($i = 0;$i < count($goods_count);$i++){

						$j = 0;
						for($j = 0;$j < $_SESSION['cart_count'];$j++){
							if($goods_count[$i][0] === $result_array[$j]['goods_details_number']){
								print "<tr>";
								print "<td><input type=\"checkbox\" name=\"item_buy\" value=\"".$result_array[$j]['goods_details_number']."\"></td>";
								print "<td>".$result_array[$j]['goods_name']."<br /><img src=\"images/test_images/".$result_array[$j]['photo_name']."\" class=\"img_goods\" /></td>";
								print "<td>".$result_array[$j]['value']."円(税込 ".$result_array[$j]['value']*1.08."円)</td>";
								print "<td>".$goods_count[$i][1]."個</td>";
								print "<td><input type=\"button\" id=\"button_delete\" onclick=\"deleteCart('".$result_array[$j]['goods_details_number']."')\" value=\"削除\" /\">";

								$point = $point + intval($result_array[$j]['value']) * $goods_count[$i][1] * 0.1;

								break;

							}
						}

					}

				?>
			</table>
			<div id="cart_point">カート内全ての商品を購入することで<?php print $point;?>ポイント獲得できます。</div><input type="submit" name="button_buy" value="購入手続き" />
		</form>
	</p>

</div>
</body>
</html>
