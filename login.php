<!--
ファイル名:login.php
作成日:2015/6/19
作成者:吉川
概要:ログイン処理を行うためのページ、ログイン処理後、成功時はトップ及び管理者画面へリダイレクト
	失敗時は失敗のメッセージを表示し、前の画面に遷移する。
-->

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
<?php
	//▼SQL文のエスケープ処理
	function quote_smart($parameter)
	{
		// 数値以外をクオートする
		if (!is_numeric($parameter)) {
			$value = "'" . mysql_real_escape_string($parameter) . "'";
		}
		return $value;
	}
	//▲SQL文のエスケープ処理

	//▼会員、管理者のID、パスワードを調べるために接続
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

	// SELECT文
	$sql = sprintf("SELECT user_id,password from user where user_id = %s AND password = %s",quote_smart($_POST['id']),quote_smart($_POST['password']));

	//詳細、画像などを含めた商品情報のすべて
	$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	//結果セットの行数を取得する
	$rows = mysql_num_rows($result);

	//結果を取得したかどうかを調べ、処理内容を決定するif
	if($rows != 0){

	}else{
		print "ID及びパスワードが異なります<br />";
		print "下記のリンクより前の画面にお戻りください<br />";
		print "<a href=\"" + $_SERVER['HTTP_REFERER'] + "\">";
	}
?>