<!--
ファイル名:mypage.php
作成日:2015/06/26
作成者:吉川
概要:会員情報ページ
-->
<!DOCTYPE html>
<html lang=''>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">

<!-- sessionの開始(全てのページに入力してください) -->
<?php
	session_start();
?>

<!-- タグ関係（MenuMaker） 2015/06/07 -->
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="script.js"></script>
<!-- ここまで、タグ関係 -->
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

	<div id="masthead" role="banner">

		<div id="header-inner">

			<div id="header-title-area">

				<h1 class="site-title-img"><a href="index.php" title="ギャラリー（教育・スクール：ブルー）" rel="home"><img src="images/sample_logo_01.png" alt="ギャラリー（教育・スクール：ブルー）"></a></h1>

			</div><!-- #header-title-area -->

			<div id="header-widget-area">
				<form role="search" method="get" id="searchform" class="searchform" action="*******">
					<div>
						<input type="text" value="" name="s" id="s">
						<input type="submit" id="searchsubmit" value="検索">
					</div>					</form>

					<!-- ▼ログインのフォーム、及び顧客のページへのリンク▼ -->
								<div id="header-login-form">
					<br clear="all" />
					<?php
					if (!empty($_SESSION['id']) && $_SESSION['data'] === "user"){
						//ログインしている場合の処理
						print "<form method=\"post\" action=\"logout.php\">";
						print "ようこそ！".$_SESSION['name']."さん！";
						print "<a href=\"マイページへ\">マイページへ</a>";
						print "<input type=\"submit\" value=\"ログアウト\">";
						print "</form>";

					}
					?>
					<!-- ▲ここまでがログインに関するフォームです▲ -->
				</div>

			</div><!-- #header-widget-area -->


					<div id="header-top-image">
						<!-- <img src="images/test_images/test_top.png" style="width:100%;height:100%;">トップの上部のおしゃれな絵-->
					</div>


		</div><!-- .header-inner -->

	</div><!-- #masthead -->

	<div class="clear"></div>

	<!-- タグ部メニュー -->
	<p>
		<div id="cssmenu">
		<ul>
				<li><a href='index.php'><span>ホーム</span></a></li>
				<li><a href='#'><span>ご利用案内</span></a></li>
				<li><a href='#'><span>新規会員登録</span></a></li>
				<li><a href='#'><span>注文商品紹介</span></a></li>
				<li><a href='#'><span>買い物かご</span></a></li>
				<li><a href='#'><span>サイトマップ</span></a></li>
				<li class='last'><a href='#'><span>問い合わせ</span></a></li>
		</ul>
		</div>
	</p>

	<!-- 会員情報、履歴、更新、退会 -->
	<?php
	if (!empty($_SESSION['id'])){
		//ログイン中の処理
		print "<div id=\"show_mypage_username\">".$rows['name']."さんの会員情報です。</div>";
			print "<table class=\"table_mypage_userinfo\">";
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
	}else{
		//ログインしていない時にアクセスした場合に表示する内容
		print "ログインしている状態でなければこのページはご利用になれません。<br />";
		print "<a href=\"index.php\">トップページに戻る</a>";
	}
	?>

</div>
</body>
</html>
