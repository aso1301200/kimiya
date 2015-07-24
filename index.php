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

<!-- sessionの開始(全てのページに入力してください) -->
<?php
	session_start();
?>

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
	$result = mysql_query("SELECT gd.goods_details_number,g.goods_name,p.photo_name,color_code,g.goods_explain FROM goods g, goods_details gd, goods_photo gp, photo p, direction d WHERE g.goods_number = gd.goods_number AND gd.goods_details_number = gp.goods_details_number AND gp.photo_number = p.photo_number AND gp.direction_code = d.direction_code AND d.direction_code = '2'", $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	//結果セットの行数を取得する
	$rows = mysql_num_rows($result);
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

					<!-- ▼ログインのフォーム、及び顧客のページへのリンク(コメントで挟んでいる内容を全てのページに入力してください)▼ -->
					<div id="header-login-form">
					<br clear="all" />
						<?php
						if (!empty($_SESSION['id']) && $_SESSION['data'] === "user"){
							//ログインしている場合の処理
							print "<form method=\"post\" action=\"logout.php\">";
							print "ようこそ！".$_SESSION['name']."さん！";
							print "<a href=\"mypage.php?tag=home\">マイページへ</a>";
							print "<input type=\"submit\" value=\"ログアウト\">";
							print "</form>";

						}else{
							//ログインしてない場合の処理
							print "<form method=\"post\" action=\"login.php\">";
							print "ログイン";
							print "ID:<input type=\"text\" value=\"\" name=\"id\" id=\"form-id\">";
							print "パスワード:<input type=\"password\" value=\"\" name=\"password\" id=\"form-password\">";
							print "<input type=\"submit\" value=\"ログイン\">";
							print "<a href=\"\">新規会員登録はこちらから</a>";
							print "</form>";
						}
						?>
						<a href="cart_check.php">カート</a>
					</div>
					<!-- ▲ここまでがログインに関するフォームです(コメントで挟んでいる内容を全てのページに入力してください)▲ -->


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

	<!-- 商品一覧部分 -->
		<div class="contents_item">

			<div id="item_center">
		<!-- カテゴリ検索欄 -->
		<div id="item_category">
		<ul>
		<li><b>category</b></li>
		<li class="category"><p>type</p></li>
			<li><a href="">スクウェア</a></li>
			<li><a href="">ホックス</a></li>
			<li><a href="">ボストン</a></li>
			<li><a href="">セオミート</a></li>
			<li><a href="">その他</a></li>
		<li class="category"><p>sex</p></li>
			<li><a>Man</a></li>
			<li><a>Leadies</a></li>
			<li><a>Kids</a></li>
		<li class="category"><p>color</p></li>
			<li><a>Black</a></li>
			<li><a>Red</a></li>
			<li><a>Blue</a></li>

		</ul>
		</div>


				<?php


					for ($count = 0;$count < 10;$count++){
						if($count < $rows){
							//SELECT文から1行取得し配列"$array"に代入
							$array = mysql_fetch_array($result,MYSQL_BOTH);
							if($count == 0 || $count == 3 || $count == 6 || $count == 9){
								print "<div id=\"item_list\">";
								print "<ul>";
							}
// 							printf( "<td><a href=\"item_tail.php?item=%s&color=%s\"><img src=\"images/test_images/%s\" class=\"img_goods\"/><div class=\"text_goods\">%s</div></a><td>",$array["goods_details_number"],$array["color_code"],$array["photo_name"],$array["goods_name"]);

							print "<li class=\"type1\">";
							print "<img src=\"images/test_images/".$array["photo_name"]."\" id=\"item_top_image\" style=\"width: 260px;height: 169px;float: none;\" />";
							print "<dl>";
							print "<dt>".$array["goods_name"]."</dt>";
							print "<dd>".$array["goods_explain"]."</dd>";
							printf("<dd><a href=\"item_tail.php?item=%s&color=%s\" target=\"_blank\">この商品を見る</a></dd>",$array["goods_details_number"],$array["color_code"]);
							print "</dl>";
							print "</li>";

							//3.3.3.1という並び順で10個の商品を表示する
							if($count == 2 || $count == 5 || $count == 8 || $count == 9){
								print "</ul>";
								print "</div>";
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
		</div>

</div>
</body>
</html>
