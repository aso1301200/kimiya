<!-- sessionの開始(全てのページに入力してください) -->
<?php
	session_start();
?>
<!DOCTYPE html>
<html lang=''>
<head>
<?php include '/common/metadata.html';?>
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
	$result = mysql_query("SELECT gd.goods_details_number,g.goods_name,p.photo_name,color_code,g.goods_explain FROM goods g, goods_details gd, goods_photo gp, photo p, direction d WHERE g.goods_number = gd.goods_number AND gd.goods_details_number = gp.goods_details_number AND gp.photo_number = p.photo_number AND gp.direction_code = d.direction_code AND d.direction_code = '2'", $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	//結果セットの行数を取得する
	$rows = mysql_num_rows($result);
?>
<!-- ここまでデータベース -->



<div id="page">

	<!-- ヘッダー部分 -->
	<?php
	$destroyed = false;
	if (!empty($_SESSION['id'])){
		unset($_SESSION['id']);
		session_destroy();
		$destroyed = true;
	}
	include '/common/header.html';
	?>
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

		<!-- 問い合わせ -->
		<div id="company_title"><font size="5">ログアウト</font></div>
			<div id="content_input3">
			  <?php
				/*
				 * ファイル名:loguot.php
				 * 作成者：吉川
				 * 概要：ログアウト処理を行うプログラム
				 * 		ほぼ全ページに配置するログアウトボタンから一元化してここにアクセスする
				 * 		アクセス後は元のページに戻る
				 */
				if ($destroyed == true){
					print "<div id=\"lead\">ログアウトが完了しました。</div>";
					print "<a href=\"".$_SERVER['HTTP_REFERER']."\" id=\"botton_index\">前の画面に戻る</a>";
				}else{
					print "<div id=\"lead\">このページはログインしていないとアクセスできません。</div>";
					print "<a href=\"index.php\" id=\"botton_index\">ホームへ</a>";
				}
			  ?>
		  	</div>
	  	</div>

</div>
<div class="footer">copyright</div>
</body>
</html>