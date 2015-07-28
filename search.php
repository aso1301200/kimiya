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
			</div>
		</div>

</div>
</body>
</html>
