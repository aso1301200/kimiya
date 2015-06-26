<?php
	/*
	 * ファイル名:loguot.php
	 * 作成者：吉川
	 * 概要：ログアウト処理を行うプログラム
	 * 		ほぼ全ページに配置するログアウトボタンから一元化してここにアクセスする
	 * 		アクセス後は元のページに戻る
	 */
	session_start();
	if (!empty($_SESSION['id'])){
		session_destroy();
		print "<html><head>";
		print "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">";
		print "<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">";
		print "<meta charset='utf-8'>";
		print "<title>ログアウト</title>";
		print "</head>";
		print "<body>ログアウトが完了しました。<br />";
		print "<a href=\"".$_SERVER['HTTP_REFERER']."\">前の画面に戻る</a></body></html>";
	}else{
		print "<html><head>";
		print "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">";
		print "<meta http-equiv=\"Content-Style-Type\" content=\"text/css\">";
		print "<meta charset='utf-8'>";
		print "<title>ログインしていません</title>";
		print "</head>";
		print "<body>このページはログインしていないとアクセスできません。<br />";
		print "<a href=\"index.php\">トップページに移動する</a></body></html>";
	}
?>