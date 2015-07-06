<html>
<head>
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
		session_start();
	?>
	<title>更新</title>
</head>
<body>

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
						print "<a href=\"mypage.php\">マイページへ</a>";
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

	<div class="clear"></div>
		<div id='mypage-body'>

		<?php
		if (!empty($_SESSION['id']) && !empty($_POST['user_delete'])){
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

			//データベースから会員情報を削除
			$sql = "delete from user where user_id='".quote_smart($_SESSION['id'])."'";
			mysql_query($sql,$link);

			//セッションを破棄
			session_destroy();
			print "退会処理が完了しました。<br />";
			print "ご利用ありがとうございます。<br />";
			print "<a href=\"index.php\">トップページに移動する</a>";
		}else{
			print "このページへはURLを直接入力してのアクセスはできません。<br />";
			print "<a href=\"index.php\">トップページに移動する</a>";
		}
		?>

		</div>
	</div>

</div>
</body>
</html>
