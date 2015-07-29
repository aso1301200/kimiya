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

	<!-- カート部分 -->
		<div class="contents_item">
			<div id="item_center">

				<!-- カテゴリ検索欄 -->
				<?php include '/common/item_category.html';?>
				<!-- ここままでカテゴリ検索欄 -->

				<!-- カートの中身 -->
				<div id="cart_title"><font size="5">買い物かご</font></div>

				 <div id="cart_contents" style=" height: <?php print count($_SESSION['cart_array'])/2*130 + 150; ?>px;">
				  <p>
					<form method="POST" action="buy_step.php">
						<table id="cart_check">
							<!-- ここをループ文にする -->
							<?php
								//ポイントの合計を格納する変数
								$point = 0;
								$sum = 0;

								if(!empty($_SESSION['cart_count'])){
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

									print "<div id=\"lead\">商品を確認し、購入する商品にチェックをつけて購入ボタンを押してください。</div>";

									for($i = 0;$i < count($goods_count);$i++){

										$j = 0;
										for($j = 0;$j < $_SESSION['cart_count'];$j++){
											if($goods_count[$i][0] === $result_array[$j]['goods_details_number']){
												print "<tr>";
												print "<td><input type=\"checkbox\" name=\"item_buy[]\" value=\"".$result_array[$j]['goods_details_number']."\"></td>";
												print "<td><img src=\"images/test_images/".$result_array[$j]['photo_name']."\" class=\"img_goods\" /></td>";
												print "<td id=\"cart_td\">".$result_array[$j]['goods_name']."<br />".$result_array[$j]['value']."円(税込 ".$result_array[$j]['value']*1.08."円)";
												print "</br>".$goods_count[$i][1]."個";
												print "<br><input type=\"button\" id=\"button_delete\" onclick=\"deleteCart('".$result_array[$j]['goods_details_number']."')\" value=\"削除\" /\"></td>";
												print "</tr>";
												$point = $point + intval($result_array[$j]['value']) * $goods_count[$i][1] * 0.1;
												$sum = $sum + intval($result_array[$j]['value'] * $goods_count[$i][1] * 1.08);

												break;

											}
										}

									}
									print "</table>";
									print "<div style=\"float: right\"><font size=\"6\" style=\"float: right\">合計金額：".$sum."</font>";
									print "</br></br>";
									print "<label style=\"float: right;  \">カート内全ての商品を購入することで".$point."ポイント獲得できます。</label>";
									print "</br></br>";
									print "<input type=\"submit\" id=\"cart_buy\" name=\"button_buy\" value=\"購入手続き\" /></div>";

								}else{
									print "</table>";
									print "<p>カート内に商品が存在しません</p>";
								}
							?>
						</table>
					</form>
				  </p>
				</div>
			</div>
		</div>
<div class="footer">copyright</div>
</div>
</body>
</html>
