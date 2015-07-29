<!--
ファイル名:mypage.php
作成日:2015/06/26
作成者:吉川
概要:会員情報ページ
-->
<!DOCTYPE html>
<html lang=''>
<head>
<?php include '/common/metadata.html';?>

<!-- sessionの開始(全てのページに入力してください) -->
<?php
	session_start();
?>

<?php
	if(!empty($_SESSION['id'])){
		//ログイン中の場合は会員の名前をtitleに含める
		print "<title>".$_SESSION['name']."さんの会員ページ</title>";
	}else{
		//ログインしていない場合のtitle
		print "<title>会員ページ</title>";
	}
?>
</head>
<body>

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

	//データベースへの接続はログイン中のみに行う
	if(!empty($_SESSION['id'])){
		//▼会員のIDから会員情報を取得するために接続
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

		// SELECT文(会員)
		$sql = "SELECT * from user u,sex s where u.user_id = '".quote_smart($_SESSION['id'])."' AND u.sex_code = s.sex_code";

		// SELECT文実行、配列に格納
		$result = mysql_query($sql, $link);
		$rows = mysql_fetch_assoc($result);
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

	<div class="contents_item">
	<div id="item_center">

				<!-- カテゴリ検索欄 -->
				<?php include '/common/item_category.html';?>
				<!-- ここままでカテゴリ検索欄 -->

				<!-- 会員情報、履歴、更新、退会 -->
				<div id='mypage-body'>
					<p>
						<div id="mypage_tab">
							<ul>
									<li><a href='?tag=home'><span>会員情報閲覧</span></a></li>
									<li><a href='?tag=history'><span>購入履歴</span></a></li>
									<li><a href='?tag=alter'><span>会員情報更新</span></a></li>
									<li class='last'><a href='?tag=delete'><span>退会</span></a></li>
							</ul>
						</div>
					</p>

					<div id='mypage-body-inner'>
					<?php
					if (!empty($_SESSION['id'])){
						//ログイン中の処理
						if(empty($_GET['tag']) || $_GET['tag'] === "home"){
							//会員情報閲覧
								print "<table class=\"table_mypage_userinfo\">";
									print "<tr><td colspan=\"3\"><div id=\"show_mypage_username\">".$rows['name']."さんの会員情報です。</div></td></tr>";
									print "<tr><td>ID</td><td>".$rows['user_id']."</td><tr>";
									print "<tr><td>氏名</td><td>".$rows['name']."</td><tr>";
									print "<tr><td>フリガナ</td><td>".$rows['kana']."</td><tr>";
									print "<tr><td>郵便番号</td><td>".$rows['address_number']."</td><tr>";
									print "<tr><td>住所</td><td>".$rows['address']."</td><tr>";
									print "<tr><td>電話番号</td><td>".$rows['phone_number']."</td><tr>";
									print "<tr><td>Eメールアドレス</td><td>".$rows['email']."</td><tr>";
									print "<tr><td>性別</td><td>".$rows['sex_name']."</td><tr>";
									print "<tr><td>生年月日</td><td>".substr($rows['birthday'], 0, 4)."年".substr($rows['birthday'], 5, 2)."月".substr($rows['birthday'], 8, 2)."日</td><tr>";
									print "<tr><td>職業</td><td>".$rows['job']."</td><tr>";
									print "<tr><td>パスワード</td><td>&lt;この項目は表示されません&gt</td><tr>";
									print "<tr><td>現在のポイント</td><td>".$rows['point']."</td><tr>";
								print "</table>";
						}else if($_GET['tag'] === "history"){
							//購入履歴

							//▼購入履歴情報を取得
							// SELECT文(購入履歴)
							$sql_history = "SELECT b.buy_date,b.send_address,b.send_date,b.send_time,gd.goods_details_number,g.goods_name,p.photo_name,color_code,g.goods_explain,c.value,c.used_point "
									."FROM goods g, goods_details gd, goods_photo gp, photo p, direction d, buy b,cart c "
									."WHERE g.goods_number = gd.goods_number "
									."AND gd.goods_details_number = gp.goods_details_number "
									."AND gp.photo_number = p.photo_number "
									."AND gp.direction_code = d.direction_code "
									."AND gd.goods_details_number = c.goods_details_number "
									."AND b.buy_number = c.buy_number "
									."AND d.direction_code = '2'"
									."AND b.user_id = '".quote_smart($_SESSION['id'])."'";

							// SELECT文実行、行数取得
							$result_history = mysql_query($sql_history, $link);
							$row_count = mysql_num_rows($result_history);
							//▲購入履歴情報を取得

							print "<div id=\"show_mypage_username\">".$rows['name']."さんの購入履歴です。</div>";
								print "<table class=\"table_mypage_userinfo\">";
									print "<tr><th>購入商品</th><th>購入価格</th><th>購入時に使用したポイント</th><th>購入日</th><th>届け先</th><th>届け日</th><th>届け時間</th></tr>";

									if($row_count != 0){

										//何ページ目かを示す変数
										$page;

										//▼最初のアクセス||仮にページ数が表示最大数を超えたものだった場合の対処の処理(応急処置として1ページ目を表示することにする)
										if(empty($_GET['page']) || $row_count/2 < intval($_GET['page'])-1){
											$page = 1;
										}else{
											$page = intval($_GET['page']);
										}
										//▲最初のアクセス||仮にページ数が表示最大数を超えたものだった場合の対処の処理(応急処置として1ページ目を表示することにする)

										//▼表示処理
										for($count = 0;$count < 2 && $count+($page-1)*2 < $row_count;$count++){
											//SELECT文から1行取得し配列"$array"に代入
											mysql_data_seek($result_history, $count+($page-1)*2);
											$array = mysql_fetch_array($result_history,MYSQL_BOTH);

											print "<tr>";
											//購入商品
											print "<td>";
												print "<div align=\"left\">".$array['goods_name']."</div>";
												print "<div align=\"right\"><img src=\"images/test_images/".$array['photo_name']."\" style=\"width: 260px;height: 169px;float: none;\" /></div>";
												print "<br clear=\"all\">";
											print "</td>";

											//購入価格
											print "<td>".$array['value']."円</td>";

											//購入時に使用したポイント
											print "<td>".$array['used_point']."</td>";

											//購入日
											$array_buy_date = array();
											for($j = 0;$j < mb_strlen($array['buy_date']);$j++){
												$array_buy_date[$j] = mb_substr($array['buy_date'], $j, 1);
											}

											print "<td>";
												$j = 0;
												//年
												while($array_buy_date[$j] != "-"){
													print $array_buy_date[$j];
													$j++;
												}
												print "年";
												$j++;
												//月
												while($array_buy_date[$j] != "-"){
													print $array_buy_date[$j];
													$j++;
												}
												print "月";
												$j++;
												//日
												while($j < count($array_buy_date)){
													print $array_buy_date[$j];
													$j++;
												}
												print "日";
											print"</td>";

											//届け先
											print "<td>".$array['send_address']."</td>";

											//届け日
											$array_send_date = array();
											for($j = 0;$j < mb_strlen($array['send_date']);$j++){
												$array_send_date[$j] = mb_substr($array['send_date'], $j, 1);
											}

											print "<td>";
												$j = 0;
												//月
												while($array_send_date[$j] != "-"){
													print $array_send_date[$j];
													$j++;
												}
												print "月";
												$j++;
												//日
												while($j < count($array_send_date)){
													print $array_send_date[$j];
													$j++;
												}
												print "日";
											print"</td>";

											//届け時間
											$array_send_time = array();
											for($j = 0;$j < mb_strlen($array['send_time']);$j++){
												$array_send_time[$j] = mb_substr($array['send_time'], $j, 1);
											}

											print "<td>";
												$j = 0;
												//時
												while($array_send_time[$j] != ":"){
													print $array_send_time[$j];
													$j++;
												}
												print "時";
												$j++;
												//分
												while($j < count($array_send_time)){
													print $array_send_time[$j];
													$j++;
												}
												print "分";
											print "</td>";
											print "</tr>";
										}
										//▲表示処理

										print "</table>";

										//▼ページ切り替え
										print "<p><div align=\"center\">";
										if($row_count%2 == 0){
											//$rowsが2で割り切れる場合のループ
											for($i = 1;$i <= $row_count/2;$i++){
												print "<a href=\"mypage.php?tag=history&page=".$i."\" style=\"border:solid; margin:5px;\">".$i."</a>";
											}
										}else{
											//$rowsが2で割り切れない場合のループ
											for($i = 1;$i <= $row_count/2+1;$i++){
												print "<a href=\"mypage.php?tag=history&page=".$i."\" style=\"border:solid; margin:5px;\">".$i."</a>";
											}
										}
										//▲ページ切り替え
										print "</div></p>";
									}else{
										//会員が未購入の場合の処理
										print "</table>";
										print "<p>購入した商品がありません。</p>";
									}

						}else if($_GET['tag'] === "alter"){
							//会員情報更新(3列目に入力フォーム)
							print "<div id=\"show_mypage_username\">".$rows['name']."さんの会員情報です。</div>";
								print "<table class=\"table_mypage_userinfo\">";
									print "<form method=\"POST\" action=\"user_update.php\">";
										print "<tr><td colspan=\"3\"><div id=\"show_mypage_username\">".$rows['name']."さんの更新する情報を入力してください。</div></td></tr>";
										print "<tr><td></td><td>更新前情報</td><td>更新後情報</td>";
										print "<tr><td>ID</td><td>".$rows['user_id']."</td><td>IDは更新できません</td><tr>";
										print "<tr><td>氏名</td><td>".$rows['name']."</td><td><input type=\"text\" name=\"name\"></td><tr>";
										print "<tr><td>フリガナ(全角カナ)</td><td>".$rows['kana']."</td><td><input type=\"text\" name=\"kana\"></td><tr>";
										print "<tr><td>郵便番号(半角英数)</td><td>".$rows['address_number']."</td><td><input type=\"text\" name=\"address_number_head\" size=\"3\">-<input type=\"text\" name=\"address_number_bottom\" size=\"4\"></td><tr>";
										print "<tr><td>住所</td><td>".$rows['address']."</td><td><input type=\"text\" name=\"address\"></td><tr>";
										print "<tr><td>電話番号(半角英数)</td><td>".$rows['phone_number']."</td><td><input type=\"text\" name=\"phone_number_1\" size=\"4\">-<input type=\"text\" name=\"phone_number_2\" size=\"4\">-<input type=\"text\" name=\"phone_number_3\" size=\"4\"></td><tr>";
										print "<tr><td>Eメールアドレス(半角英数)</td><td>".$rows['email']."</td><td><input type=\"text\" name=\"email\"></td><tr>";
										print "<tr><td>性別</td><td>".$rows['sex_name']."</td><td><select name=\"sex_code\"><option value=\"1\">男性</option><option value=\"2\">女性</option></select></td></tr>";
										print "<tr><td>生年月日(西暦)(半角英数)</td><td>".substr($rows['birthday'], 0, 4)."年".substr($rows['birthday'], 5, 2)."月".substr($rows['birthday'], 8, 2)."日</td><td><input type=\"text\" name=\"year\" size=\"4\">年<input type=\"text\" name=\"month\" size=\"2\">月<input type=\"text\" name=\"date\" size=\"2\">日</td><tr>";
										print "<tr><td>職業</td><td>".$rows['job']."</td><td><input type=\"text\" name=\"job\"></td><tr>";
										print "<tr><td>パスワード(半角英数)</td><td>&lt;この項目は表示されません&gt</td><td><input type=\"password\" name=\"password\"></td><tr>";
										print "<tr><td>現在のポイント</td><td>".$rows['point']."</td><td></td><tr>";
										print "<tr><td colspan=\"3\"><input type=\"submit\" value=\"変更\" class=\"mypage_botton\"></td></tr>";
									print "</form>";
								print "</table>";
						}else if($_GET['tag'] === "delete"){
							//退会
								print "<table class=\"table_mypage_userinfo\">";
									print "<tr><td colspan=\"3\"><div id=\"show_mypage_username\">退会ページです。<br />退会しますとアカウント情報の復帰はできません。<br />退会しますか？<br /><form method=\"POST\" action=\"user_delete.php\"><input type=\"submit\" name=\"user_delete\" value=\"退会します\" class=\"mypage_botton\"></form></div></td></tr>";
									print "<tr><td colspan=\"3\"><div id=\"show_mypage_username\">".$rows['name']."さんの会員情報です。</div></td></tr>";
									print "<tr><td>ID</td><td>".$rows['user_id']."</td><tr>";
									print "<tr><td>氏名</td><td>".$rows['name']."</td><tr>";
									print "<tr><td>フリガナ</td><td>".$rows['kana']."</td><tr>";
									print "<tr><td>郵便番号</td><td>".$rows['address_number']."</td><tr>";
									print "<tr><td>住所</td><td>".$rows['address']."</td><tr>";
									print "<tr><td>電話番号</td><td>".$rows['phone_number']."</td><tr>";
									print "<tr><td>Eメールアドレス</td><td>".$rows['email']."</td><tr>";
									print "<tr><td>性別</td><td>".$rows['sex_name']."</td><tr>";
									print "<tr><td>生年月日</td><td>".substr($rows['birthday'], 0, 4)."年".substr($rows['birthday'], 5, 2)."月".substr($rows['birthday'], 8, 2)."日</td><tr>";
									print "<tr><td>職業</td><td>".$rows['job']."</td><tr>";
									print "<tr><td>パスワード</td><td>&lt;この項目は表示されません&gt</td><tr>";
									print "<tr><td>現在のポイント</td><td>".$rows['point']."</td><tr>";
								print "</table>";
						}
					}else{
						//ログインしていない時にアクセスした場合に表示する内容
						print "ログインしている状態でなければこのページはご利用になれません。<br />";
						print "<a href=\"index.php\">トップページに戻る</a>";
					}
					?>
					</div>
				</div>
		</div>
	</div>
<div class="footer">copyright</div>
</div>
</body>
</html>
