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
	
	//詳細、画像などを含めた商品情報のすべて
	$sql = "SELECT * "
		+ "FROM goods g, goods_details gd, goods_photo gp, photo p, direction d "
		+ "WHERE g.goods_number = gd.goods_number "
		+ "AND gd.goods_details_number = gp.goods_details_number "
		+ "AND gp.photo_number = p.photo_number "
		+ "AND gp.direction_code = d.direction_code "
		+ "AND d.direction_code = '2';";
	$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

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

			</div><!-- #header-widget-area -->

			<div class="clear"></div>

		</div><!-- .header-inner -->

	</div><!-- #masthead -->
	<p>
		<div id="header-top-image">
			<img src="">トップ		<!-- トップの上部のおしゃれな絵 -->
		</div>
	</p>

	<!-- タグ部メニュー -->
	<p>
		<div id="cssmenu">
		<ul>
				<li class='active'><a href='#'><span>ホーム</span></a></li>
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
		<div id="goods-space">
			<table border="1">
				<?php 
					for ($count = 0;$count < 8;$count++){
						if($count < $rows){
							
						}
					}
					
					//結果保持用メモリを開放する
					mysql_free_result($result);
					
					// MySQLへの接続を閉じる
					mysql_close($link) or die("MySQL切断に失敗しました。");
					
				?>
				<tr><td><a href=""><img src="">a</a></td><td><a href=""><img src="">b</a></td><td><a href=""><img src="">c</a></td><td><a href=""><img src="">d</a></td></tr>
				<tr><td><a href=""><img src="">e</a></td><td><a href=""><img src="">f</a></td><td><a href=""><img src="">g</a></td><td><a href=""><img src="">h</a></td></tr>
			</table>
		</div>
	</p>
</div>
</body>
</html>