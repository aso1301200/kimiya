<!DOCTYPE html>
<html lang=''>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">

<!-- タグ関係（MenuMaker） 2015/06/07 -->
<meta charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="script.js"></script>
<!-- ここまで、タグ関係 -->
<title>きみ屋</title>

</head>
<body>
<!-- データベース準備 -->
<?php
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
	$result = mysql_query("SELECT g.goods_number,g.goods_name,p.photo_name FROM goods g, goods_details gd, goods_photo gp, photo p, direction d WHERE g.goods_number = gd.goods_number AND gd.goods_details_number = gp.goods_details_number AND gp.photo_number = p.photo_number AND gp.direction_code = d.direction_code AND d.direction_code = '2'", $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	//結果セットの行数を取得する
	$rows = mysql_num_rows($result);
?>
<!-- ここまでデータベース -->
<div id="page">

	<div id="masthead" role="banner">

		<div id="header-inner">

			<div id="header-title-area">

				<h1 class="site-title-img"><a href="index.php" title="ギャラリー（教育・スクール：ブルー）" rel="home"><img src="images/sample_logo_01.png" alt="ギャラリー（教育・スクール：ブルー）"></a></h1>

				<div id="header-login-form">
					<?php
					if (!empty($_SESSION['id']) && $_SESSION['data'] === "user"){
						//ログインしている場合の処理
						print "ようこそ！".$_SESSION['name']."さん！";
						print "<form method=\"post\" action=\"logout.php\">";
						print "<input type=\"submit\" value=\"ログアウト\">";
						print "</form>";

					}else{
						//ログインしてない場合の処理
						print "<form method=\"post\" action=\"login.php\">";
						print "ログイン";
						print "ID:<input type=\"text\" value=\"\" name=\"id\" id=\"form-id\">";
						print "パスワード:<input type=\"password\" value=\"\" name=\"password\" id=\"form-password\">";
						print "<input type=\"submit\" value=\"ログイン\">";
						print "</form>";
					}
					?>
				</div>

			</div><!-- #header-title-area -->

			<div id="header-widget-area">

<!-- 検索フォームの位置替えのためコメントアウト
				<form role="search" method="get" id="searchform" class="searchform" action="*******">
					<div>
						<input type="text" value="" name="s" id="s">
						<input type="submit" id="searchsubmit" value="検索">
					</div>
				</form>

-->

			</div><!-- #header-widget-area -->


					<div id="header-top-image">
						<img src="images/test_images/test_top.png" style="width:100%;height:100%;"><!-- トップの上部のおしゃれな絵 -->
					</div>


		</div><!-- .header-inner -->

	</div><!-- #masthead -->

	<div class="clear"></div>

	<!-- タグ部メニュー -->
	<p>
		<div id="cssmenu">
		<ul>
				<li><a href='#'><span>ホーム</span></a></li>
				<li><a href='#'><span>ご利用案内</span></a></li>
				<li><a href='#'><span>新規会員登録</span></a></li>
				<li><a href='#'><span>注文商品紹介</span></a></li>
				<li><a href='#'><span>買い物かご</span></a></li>
				<li><a href='#'><span>サイトマップ</span></a></li>
				<li class='last'><a href='#'><span>問い合わせ</span></a></li>
		</ul>
		</div>
	</p>

	<!-- 商品一覧部分 -->
	<p>
			<table border="1" class="goods-table">
				<?php
					for ($count = 0;$count < 8;$count++){
						if($count < $rows){
							//SELECT文から1行取得し配列"$array"に代入
							$array = mysql_fetch_array($result,MYSQL_BOTH);
							if($count == 0 || $count == 4){
								print "<tr>";
							}
							printf( "<td><a href=\"%s\"><img src=\"images/test_images/%s\" class=\"img_goods\"/><div class=\"text_goods\">%s</div></a><td>",$array["goods_number"],$array["photo_name"],$array["goods_name"]);
							if($count == 3 || $count == 7){
								print "</tr>";
							}
						}else{
							break;
						}
					}

					//結果保持用メモリを開放する
					mysql_free_result($result);

					// MySQLへの接続を閉じる
					mysql_close($link) or die("MySQL切断に失敗しました。");

				?>
			</table>
	</p>
</div>
</body>
</html>
