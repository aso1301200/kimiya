
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

	//会員番号を割り振る処理
	$sql_id = "SELECT * FROM user";
	$result = mysql_query($sql_id,$link);

	$rows = mysql_num_rows($result) + 1;

	//割り振るID値
	$id = "";
	$id += (String)$rows;

	//挿入するSQL文
	$sql = "INSERT INTO user VALUES('".quote_smart($_SESSION['insert_name'])."','".quote_smart($_SESSION['insert_kana'])."','".quote_smart($_SESSION['insert_address'])."','".quote_smart($_SESSION['insert_phone_number'])."','".quote_smart($_SESSION['insert_email'])."','".quote_smart($_SESSION['insert_sex_code'])."','".$_SESSION['insert_birthday']."','".quote_smart($_SESSION['insert_job'])."','".$id."','".quote_smart($_SESSION['insert_password'])."','".quote_smart($_SESSION['insert_address_number'])."',0)";
	mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);
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

		<!-- 新規会員登録完了 -->
		<div id="company_title"><font size="5">新規会員登録</font></div>
			<div id="content_input3">
			  <div id="lead">会員登録が完了いたしました。</div>
			  <div><a href="index.php"id="botton_index">ホームへ</a></div>
		  	</div>
	  	</div>

</div>
<div class="footer">copyright</div>
</body>
</html>