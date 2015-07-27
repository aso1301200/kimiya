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
						<div id="cssmenu">
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
						if($_GET['tag'] === "home" || empty($_GET['tag'])){
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
							print "購入履歴";

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
										print "<tr><td colspan=\"3\"><input type=\"submit\" value=\"変更\"></td></tr>";
									print "</form>";
								print "</table>";
						}else if($_GET['tag'] === "delete"){
							//退会
								print "<table class=\"table_mypage_userinfo\">";
									print "<tr><td colspan=\"3\"><div id=\"show_mypage_username\">退会ページです。<br />退会しますとアカウント情報の復帰はできません。<br />退会しますか？<br /><form method=\"POST\" action=\"user_delete.php\"><input type=\"submit\" name=\"user_delete\" value=\"退会します\"></form></div></td></tr>";
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

</div>
</body>
</html>
