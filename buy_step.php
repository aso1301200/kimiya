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

	//▼データベースへの接続処理や準備処理のみ先に行う
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
	//▲データベース接続、準備処理

	if(!empty($_SESSION['id'])){
		//結果代入用配列
		$result_array = array();

		//会員情報を取得
		$sql = "SELECT name,kana,address,phone_number,email,address_number,point FROM user WHERE user_id='".quote_smart($_SESSION['id'])."'";
		$result = mysql_query($sql,$link);

		$assoc_user = mysql_fetch_assoc($result);
		mysql_data_seek($result, 0);

	}

?>
<!-- ここまでデータベース -->

<div id="page">

	<!-- ヘッダー部分 -->
	<?php include '/common/header.html';?>
	<!-- ここまでヘッダー部分 -->

	<div class="clear"></div>

	<!-- タグ部メニュー -->
	<p><?php include '/common/cssmenu.html';?></p>
	<!-- ここまでタグ部メニュー -->

	<!-- 商品一覧部分 -->
	<div class="contents_item">
		<div id="item_center">

			<!-- カテゴリ検索欄 -->
			<?php include '/common/item_category.html';?>
			<!-- ここままでカテゴリ検索欄 -->

			<!-- カートの中身 -->
			<div id="cart_title"><font size="5">購入手続き</font></div>

			<div id="cart_contents">
				<div id="lead">お客様の情報を入力し、「購入」ボタンを押して下さい。</div>
				<form method="POST" action="buy_submited.php">
					<?php
						if(!empty($_GET['empty_post'])){
							print "<p><font color=\"FF0000\">未入力の項目があります</font></p>";
						}
					?>

							<!-- ▼商品一覧 -->
							<?php
								if(count($_POST['item_buy']) != 0){
									//購入する商品にチェックがある場合の処理

									//合計獲得ポイント格納用の変数
									$point = 0;

									//チェックした商品を格納するための配列
									$array_item = $_POST['item_buy'];

									//一度配列に格納|情報表示
									print "<div>";
									print "<div style=\"overflow:hidden;\">";
									for($i = 0;$i < count($array_item);$i++){
										//データベースから商品詳細番号を元にデータを取得
										$sql_item = "SELECT g.goods_name,p.photo_name,g.value "
												."FROM goods g,goods_details gd,goods_photo gp,photo p "
												."WHERE g.goods_number = gd.goods_number "
												."AND gd.goods_details_number = gp.goods_details_number "
												."AND gp.photo_number = p.photo_number "
												."AND gd.goods_details_number='".quote_smart($array_item[$i])."' "
												."AND gp.direction_code = '2'";
										$result_item = mysql_query($sql_item,$link);

										$assoc_item = mysql_fetch_assoc($result_item);
										mysql_data_seek($result_item, 0);

										//セッション内から対応する商品詳細番号の購入個数を求めるループ文(ポイント算出に使用)
										//商品の購入個数を一時的に格納する変数
										$count = 0;
										for($j = 0;$j < $_SESSION['cart_count'];$j++){
											if($_SESSION['cart_array'][$j*2] === $array_item[$i]){
												$count = $count + 1;
											}
										}

										print "<div style=\" float: left;\">";
										print "<img src=\"images/test_images/".$assoc_item['photo_name']."\" style=\"width: 160px;height: 100px;float: none;\" /></br>";
										print $assoc_item['goods_name']."</br>";
										print (intval($assoc_item['value'])*$count*1.08)."円</br>";
										print (intval($assoc_item['value'])*$count*0.1)."ポイント</br>";
										print "</div>";

										$point = $point + intval($assoc_item['value'])*$count*0.1;
									}
									print "</div></br></br></br>";
									print "<div style=\" clear: both;\">今回の購入で合計".$point."ポイント獲得できます。</div></br>";

									$_SESSION['goods_buy'] = $array_item;
									$_SESSION['point_get'] = $point;


								}else if(!empty($_SESSION['goods_buy'])){
									//入力ミスなどでリダイレクトでアクセスされたときの処理

									//一度配列に格納|情報表示
									print "<div>";
									print "<div style=\"overflow:hidden;\">";
									for($i = 0;$i < count($array_item);$i++){
										//データベースから商品詳細番号を元にデータを取得
										$sql_item = "SELECT g.goods_name,p.photo_name,g.value "
												."FROM goods g,goods_details gd,goods_photo gp,photo p "
												."WHERE g.goods_number = gd.goods_number "
												."AND gd.goods_details_number = gp.goods_details_number "
												."AND gp.photo_number = p.photo_number "
												."AND gd.goods_details_number='".quote_smart($_SESSION['goods_buy'])."' "
												."AND gp.direction_code = '2'";
										$result_item = mysql_query($sql_item,$link);

										$assoc_item = mysql_fetch_assoc($result_item);
										mysql_data_seek($result_item, 0);

										//セッション内から対応する商品詳細番号の購入個数を求めるループ文(ポイント算出に使用)

										print "<div style=\" float: left;\">";
										print "<img src=\"images/test_images/".$assoc_item['photo_name']."\" style=\"width: 160px;height: 100px;float: none;\" /></br>";
										print $assoc_item['goods_name']."</br>";
										print (intval($assoc_item['value'])*$count*1.08)."</br>";
										print (intval($assoc_item['value'])*$count*0.1)."ポイント</br>";
										print "</tr>";

									}
									print "</div></br></br></br>";
									print "<div style=\" clear: both;\">今回の購入で合計".$_SESSION['point_get']."ポイント獲得できます。</div></br>";


								}else{
									//購入する商品にチェックがない場合の処理
									print "購入する商品がありません<br />";
								}
							?>
							<!-- ▲商品一覧 -->

							<!-- ▼個人情報入力フォーム -->
							<?php
								print "<hr style=\"border-top: 2px dotted #000000; width: 100%;\">";
								print "<div class=\"buy_userinfo\">";
								if(empty($_SESSION['id']) && count($_POST['item_buy']) != 0){
									//ログインしていない人の情報入力フォーム

									print "<table class=\"buy_table\">";
									print "<tr class=\"buy_info\">";
									print "<th>氏名</th><td><input type=\"text\" name=\"buy_name\"/></td>";
									print "<th>電話番号</th><td><input type=\"text\" name=\"buy_phonenumber_first\" size=\"4\" />-<input type=\"text\" name=\"buy_phonenumber_middle\" size=\"4\" />-<input type=\"text\" name=\"buy_phonenumber_last\" size=\"4\" /></td><br />";
									print "</tr>";
									print "<tr class=\"buy_info\">";
									print "<th>フリガナ</th><td><input type=\"text\" name=\"buy_kana\" /></td>";
									print "<th>Email</th><td><input type=\"text\" name=\"buy_email\" /></td>";
									print "</tr>";
									print "<tr class=\"buy_info\">";
									print "<th>お届け先郵便番号</th><td><input type=\"text\" name=\"buy_addressnumber_first\" size=\"3\" />-<input type=\"text\" name=\"buy_adressnumber_last\" size=\"4\" /></td>";
									print "<th>お届け日付</th><td><input type=\"text\" size=\"2\" name=\"buy_month\" />月<input type=\"text\" size=\"2\" name=\"buy_day\" />日</td>";
									print "</tr>";
									print "<tr class=\"buy_info\">";
										print "<th>お届け先住所</th><td><input type=\"text\" name=\"buy_address\" /></td>";
									print "<th>お届け時間</th><td><input type=\"text\" size=\"2\" name=\"buy_hour\" />時<input type=\"text\" size=\"2\" name=\"buy_minute\" />分</td>";
									print "</tr>";
									print "</table>";

								}else if(count($_POST['item_buy']) != 0){

									//ログインしている人の情報入力フォーム
									print "<table class=\"buy_table\">";
									print "<tr class=\"buy_info\">";
									print "<th>氏名</th><td><input type=\"text\" name=\"buy_name\" value=\"".$assoc_user['name']."\"/></td>";

									//▼ここから電話番号の処理
									//電話番号を取り出す処理
									for($i = 0;$i < mb_strlen($assoc_user['phone_number']);$i++){
										//この配列に1文字ずつ格納
										$array_phone[$i] = mb_substr($assoc_user['phone_number'], $i,1);
									}

									$i = 0;
									//1つ目のinputに格納
									print "<th>電話番号</th><td><input type=\"text\" name=\"buy_phonenumber_first\" size=\"4\" value=\"";
									while($array_phone[$i] != "-"){
										print $array_phone[$i];
										$i++;
									}
									print "\" />-";

									$i++;

									//2つ目のinputに格納
									print "<input type=\"text\" name=\"buy_phonenumber_middle\" size=\"4\" value=\"";
									while($array_phone[$i] != "-"){
										print $array_phone[$i];
										$i++;
									}
									print "\" />-";

									$i++;

									//3つ目のinputに格納
									print "<input type=\"text\" name=\"buy_phonenumber_last\" size=\"4\" value=\"";
									while($i < mb_strlen($assoc_user['phone_number'])){
										print $array_phone[$i];
										$i++;
									}
									print "\" /></td>";
									//▲ここまで電話番号の処理
									print "</tr>";

									print "<tr class=\"buy_info\">";
									print "<th>フリガナ</th><td><input type=\"text\" name=\"buy_kana\" value=\"".$assoc_user['kana']."\" /></td>";
									print "<th>Email</th><td><input type=\"text\" name=\"buy_email\" value=\"".$assoc_user['email']."\" /></td>";
									print "</tr>";

									print "<tr class=\"buy_info\">";
									//▼ここから郵便番号を取り出す処理
									//郵便番号を取り出す処理
									for($i = 0;$i < mb_strlen($assoc_user['address_number']);$i++){
										//この配列に1文字ずつ格納
										$array_address[$i] = mb_substr($assoc_user['address_number'], $i,1);
									}

									$i = 0;
									print "<th>お届け先郵便番号</th><td><input type=\"text\" name=\"buy_addressnumber_first\" size=\"3\" value=\"";
									//郵便番号を"-"で区切ってinputに格納
									while($array_address[$i] != "-"){
										print $array_address[$i];
										$i++;
									}
									print "\" />-";

									$i++;

									print "<input type=\"text\" name=\"buy_addressnumber_last\" size=\"4\" value=\"";
									while($i < mb_strlen($assoc_user['address_number'])){
										print $array_address[$i];
										$i++;
									}
									print "\" /></td>";
									//▲郵便番号の処理はここまで
									print "<th>お届け日付</th><td><input type=\"text\" size=\"2\" name=\"buy_month\" />月<input type=\"text\" size=\"2\" name=\"buy_day\" />日</td>";
									print "<tr>";

									print "<tr class=\"buy_info\">";
									print "<th>お届け先住所</th><td><input type=\"text\" name=\"buy_address\" value=\"".$assoc_user['address']."\" /></td>";
									print "<th>お届け時間</th><td><input type=\"text\" size=\"2\" name=\"buy_hour\" />時<input type=\"text\" size=\"2\" name=\"buy_minute\" />分</td>";
									print "<tr>";
									print "</table>";

									print "</br></br>";
									print "購入に使用するポイント(1ポイントにつき1円となります)|現在の所持ポイント".$assoc_user['point']."<br /><br />";
									print "<input type=\"text\" name=\"buy_point\" value=\"0\" />ポイント使用する";

								}
								print "</div>";
								print "<input type=\"submit\" name=\"submit_buy\" value=\"購入内容を確定\" class=\"botton_buy\">";

							?>
							<!-- ▲個人情報入力フォーム -->

				</form>
				<p><a href="cart_check.php" class="botton_cart">カート画面に戻る</a></p>
			</div>
		</div>
	</div>
</div>
<div class="footer">copyright</div>
</body>
</html>
