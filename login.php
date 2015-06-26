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
			$value = mysql_real_escape_string($parameter);
		}else{
			$value = (string)$parameter;
		}
		return $value;
	}
	//▲SQL文のエスケープ処理

	//▼会員、管理者のID、パスワードを調べるために接続
	$url = "localhost";
	$user = "root";
	$pass = "root";
	$db = "kimiya";

	//会員("user")と管理者("manager")、もしくはデータの取得ができない場合("failed")を判別するための変数。
	$data = "failed";

	// MySQLへ接続する
	$link = mysql_connect($url,$user,$pass) or die("MySQLへの接続に失敗しました。");

	// データベースを選択する
	$sdb = mysql_select_db($db,$link) or die("データベースの選択に失敗しました。");

	// クエリを送信する
	//文字化け対策
	mysql_query("SET NAMES 'utf8'");

	// SELECT文(会員)
	$sql = "SELECT * from user where user_id = '".quote_smart($_POST['id'])."' AND password = '".quote_smart($_POST['password'])."'";

	// SELECT文実行
	$result = mysql_query($sql, $link);

	//結果セットの行数を取得する
	//結果を取得したかどうかを調べ、判別用変数の格納内容を決定するif
	if(mysql_num_rows($result)){
		// 会員の情報取得に成功したことを判別用変数に"user"を格納
		$data = "user";

	}else{
		// 会員の情報を取得できなければ管理者のデータを取得
		// SELECT文(管理者)
		$sql = "SELECT * from manager where manager_id = '".quote_smart($_POST['id'])."' AND password = '".quote_smart($_POST['password'])."'";

		// SELECT文実行
		$result = mysql_query($sql, $link);

		// 管理者のデータを取得できたか調べるif
		if(mysql_num_rows($result)){
			//取得できた場合は判別用変数に"manager"を格納
			$data = "manager";
		}
	}

	if($data === "user"){
		// 取得した会員情報を配列として格納
		$rows = mysql_fetch_assoc($result);

		// セッションの開始
		session_start();

		// セッションの中に会員情報を格納(idで判別)
		$_SESSION['id'] = $rows['user_id'];
		$_SESSION['name'] = $rows['name'];

		//dataの格納内容で会員と管理者を判別する
		$_SESSION['data'] = "user";

		databaseReset($result,$link);

		//前のページにリダイレクトする
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();

// 		print "ログインしました<br />";
// 		print "ID:".$_SESSION['id']." 名前:".$_SESSION['name'];
// 		print "<a href=\"".$_SERVER['HTTP_REFERER']."\">前の画面に戻る</a>";

	}else if($data === "manager"){
		// 取得した管理者情報を配列として格納
		$rows = mysql_fetch_assoc($result);

		// セッションの開始
		session_start();

		// セッションの中にユーザ情報を格納(idで判別)
		$_SESSION['id'] = $rows['manager_id'];
		$_SESSION['name'] = $rows['name'];

		//dataの格納内容で会員と管理者を判別する
		$_SESSION['data'] = "manager";

		databaseReset($result,$link);

		//前のページにリダイレクトする
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: admin_top.php");
		exit();

	}else{
		print "ID及びパスワードが異なります<br />";
		print "下記のリンクより前の画面にお戻りください<br />";
		print "<a href=\"".$_SERVER['HTTP_REFERER']."\">前の画面に戻る</a>";

		databaseReset($result,$link);
	}

	//データベース解放用の変数
	function databaseReset($result,$link) {
		//結果保持用メモリを開放する
		mysql_free_result($result);

		// MySQLへの接続を閉じる
		mysql_close($link) or die("MySQL切断に失敗しました。");
	}
?>