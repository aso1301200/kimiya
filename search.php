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

<!--PHP関数 -->
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
?>

<!-- データベース準備 -->
<?php

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
				<div id="search_title"><font size="5">検索結果</font></div>
				<div id="content_search">
						<?php
							if(!empty($_GET['search_item'])){
								//▼データベース処理
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
								$sql = "SELECT gd.goods_details_number,g.goods_name,p.photo_name,color_code,g.goods_explain "
										."FROM goods g, goods_details gd, goods_photo gp, photo p, direction d "
										."WHERE g.goods_number = gd.goods_number "
										."AND gd.goods_details_number = gp.goods_details_number "
										."AND gp.photo_number = p.photo_number "
										."AND gp.direction_code = d.direction_code "
										."AND d.direction_code = '2' "
										."AND g.goods_name LIKE '%".$_GET['search_item']."%'";

								$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

								//結果セットの行数を取得する
								$rows = mysql_num_rows($result);
								//▲データベース処理

								//何ページ目かを示す変数
								$page;

								//▼最初のアクセス||仮にページ数が表示最大数を超えたものだった場合の対処の処理(応急処置として1ページ目を表示することにする)
								if(empty($_GET['page']) || $rows/10 < intval($_GET['page'])-1){
									$page = 1;
								}else{
									$page = intval($_GET['page']);
								}
								//▲最初のアクセス||仮にページ数が表示最大数を超えたものだった場合の対処の処理(応急処置として1ページ目を表示することにする)

								if($rows != 0){
									for ($count = 0;$count < 10 && $count+($page-1)*10 < $rows;$count++){
										//SELECT文から1行取得し配列"$array"に代入
										mysql_data_seek($result, $count+($page-1)*10);
										$array = mysql_fetch_array($result,MYSQL_BOTH);

										if($count%3 == 0){
											print "<div id=\"item_list\">";
											print "<ul>";
										}
				// 						printf( "<td><a href=\"item_tail.php?item=%s&color=%s\"><img src=\"images/test_images/%s\" class=\"img_goods\"/><div class=\"text_goods\">%s</div></a><td>",$array["goods_details_number"],$array["color_code"],$array["photo_name"],$array["goods_name"]);

										print "<li class=\"type1\">";
										print "<img src=\"images/test_images/".$array["photo_name"]."\" id=\"item_top_image\" style=\"width: 260px;height: 169px;float: none;\" />";
										print "<dl>";
										print "<dt>".$array["goods_name"]."</dt>";
										print "<dd>".$array["goods_explain"]."</dd>";
										printf("<dd><a href=\"item_tail.php?item=%s&color=%s\" target=\"_blank\">この商品を見る</a></dd>",$array["goods_details_number"],$array["color_code"]);
										print "</dl>";
										print "</li>";

										//3.3.3.1という並び順で10個の商品を表示する
										if($count%3 == 2 || $count == 9){
											print "</ul>";
											print "</div>";
										}

									}

									//▼ページ切り替え
									if($rows%10 == 0){
										//$rowsが10で割り切れる場合のループ
										for($i = 1;$i <= $rows/10;$i++){
											print "<div id=\"search_page\"><a href=\"search.php?search_item=".$_GET['search_item']."&page=".$i."\" style=\"border:solid; margin:5px;\">".$i."</a></div";
										}
									}else{
										print "<div id=\"search_page\">";
										//$rowsが10で割り切れない場合のループ
										for($i = 1;$i <= $rows/10+1;$i++){
											print "<a href=\"search.php?search_item=".$_GET['search_item']."&page=".$i."\" style=\"border:solid; margin:5px;\">".$i."</a>";
										}
										print "</div>";
									}
									//▲ページ切り替え
									print "";
								}else{
									print "<p>お探しの商品は見つかりませんでした。</p>";
								}

								//結果保持用メモリを開放する
								mysql_free_result($result);

								// MySQLへの接続を閉じる
								mysql_close($link) or die("MySQL切断に失敗しました。");

							}else{
								//URLを直接入力されるなどした場合の対処の処理
								print "<p>このページにはURLを直接入力してのアクセスはできません。</p>";
								print "<p><a href=\"index.php\">トップページに移動する</a></p>";
							}

						?>
				</div>
			</div>
		</div>

</div>
<div class="footer">copyright</div>
</body>
</html>
