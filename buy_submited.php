<!-- 購入情報確定後のページ -->
<!-- このページで使用する関数 -->
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

	//▼入力内容が空白でないか確認する処理
	function empty_post($parameter)
	{
		if($parameter == ""){
			//購入情報入力画面にリダイレクトする
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: buy_step.php?empty_post=true");
			exit();
		}
		return;
	}
	//▲入力内容が空白でないか確認する処理

	//▼今日の日付を戻り値として返す関数
	function today()
	{
		$time = time();
		$year = date("Y",$time);
		$month = date("m",$time);
		$day = date("d",$time);

		$today = (String)$year.(String)$month.(String)$day;
		return $today;
	}
	//▲今日の日付を戻り値として返す関数
?>
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



<!-- データベースへの接続処理 -->
<?php
	//▼データベースへの接続処理や準備処理のみ先に行う
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
	//▲データベース接続、準備処理
?>
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
		<br clear="all" />
<?php
	if(empty($_POST['submit_buy'])){
		//URLを直接打ち込むなどしてアクセスされた場合の対処
		print "<p>このページへはURLを直接入力してのアクセスはできません。";
		print "<a href=\"index.php\">トップページに移動する</a></p>";

	}else{
		//submitで正しくアクセスされた場合の処理
		//一時格納用配列(カート内から商品を削除するときに使用)
		$array = array();
		//商品数カウント(カートの商品数を減らすときに使用)
		$cart_count = 0;

		//年月日を一時格納用
		$year;
		$month;
		$day;

		if(!empty($_SESSION['id'])){

			//会員がログインしている場合での購入処理
			//会員情報を呼び出す
			$sql = "SELECT * FROM user WHERE user_id='".quote_smart($_SESSION['id'])."'";
			$result = mysql_query($sql,$link);

			$assoc_user = mysql_fetch_assoc($result);
			mysql_data_seek($result, 0);

			//▼個人情報が入力されているかの確認処理
			empty_post($_POST['buy_name']);
			empty_post($_POST['buy_kana']);
			empty_post($_POST['buy_addressnumber_first']);
			empty_post($_POST['buy_addressnumber_last']);
			empty_post($_POST['buy_address']);
			empty_post($_POST['buy_phonenumber_first']);
			empty_post($_POST['buy_phonenumber_middle']);
			empty_post($_POST['buy_phonenumber_last']);
			empty_post($_POST['buy_email']);
			empty_post($_POST['buy_month']);
			empty_post($_POST['buy_day']);
			empty_post($_POST['buy_hour']);
			empty_post($_POST['buy_minute']);
			empty_post($_POST['buy_point']);

			//pointが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_point']) && intval($_POST['buy_point']) > intval($assoc_user['point'])){

				//購入情報入力画面にリダイレクトする
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: buy_step.php?empty_post=true");
				exit();
			}

			//monthが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_month']) && mb_strlen($_POST['buy_month']) != 2){
				if(mb_strlen($_POST['buy_month']) == 1){
					$month = (String)$_POST['buy_month'];
					$month = "0".(String)$month;
				}else{
				//購入情報入力画面にリダイレクトする
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: buy_step.php?empty_post=true");
				exit();
				}
			}else{
				$month = (String)$_POST['buy_month'];
			}

			//dayが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_day']) && mb_strlen($_POST['buy_day']) != 2){
				if(mb_strlen($_POST['buy_day']) == 1){
					$day = (String)$_POST['buy_day'];
					$day = "0".(String)$day;
				}else{
				//購入情報入力画面にリダイレクトする
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: buy_step.php?empty_post=true");
				exit();
				}
			}else{
				$day = (String)$_POST['buy_day'];
			}

			//hourが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_hour']) && mb_strlen($_POST['buy_hour']) != 2){
				if(mb_strlen($_POST['buy_hour']) == 1){
					$_POST['buy_hour'] = "0".(String)$_POST['buy_hour'];
				}else{
				//購入情報入力画面にリダイレクトする
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: buy_step.php?empty_post=true");
				exit();
				}
			}

			//minuteが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_minute']) && mb_strlen($_POST['buy_minute']) != 2){
				if(mb_strlen($_POST['buy_minute']) == 1){
					$_POST['buy_minute'] = "0".(String)$_POST['buy_minute'];
				}else{
					//購入情報入力画面にリダイレクトする
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: buy_step.php?empty_post=true");
					exit();
				}
			}
			//▲個人情報が入力されているかの確認処理



			//▼購入する処理
			//先に購入情報から行数を取得
			$sql_count = "SELECT * FROM buy ";
			$result_count = mysql_query($sql_count,$link);

			$rows = intval(mysql_fetch_row($result_count)) + 1;

			//時間を正しい形式にする
			$time = (String)$_POST['buy_hour'].":".(String)$_POST['buy_minute'];

			//▼▼購入情報にinsert
			$sql_buy = "INSERT INTO buy VALUES('".quote_smart((String)$rows)."','".quote_smart($_SESSION['id'])."','".quote_smart(today())."','".quote_smart($_POST['buy_address'])."','".quote_smart((String)$month."-".(String)$day)."','".quote_smart($time)."','')";
			mysql_query($sql_buy,$link);
			//▲▲購入情報にinsert

			//▼▼カートテーブルにinsert
			//カート番号を格納する変数
			$cart_number = 1;
			for($i = 0;$i < count($_SESSION['goods_buy']);$i++){
				for($j = 0;$j < intval($_SESSION['cart_count']);$j++){
					//商品詳細番号が一致した時にinsert
					if($_SESSION['goods_buy'][$i] === $_SESSION['cart_array'][$j*2]){
						//先に商品の値段を呼び出す
						$sql_value = "SELECT value FROM goods g,goods_details gd "
									."WHERE g.goods_number = gd.goods_number "
									."AND gd.goods_details_number = '".quote_smart($_SESSION['goods_buy'][$i])."'";
						$result_value = mysql_query($sql_value,$link);
						$assoc_value = mysql_fetch_assoc($result_value);
						$value = intval($assoc_value['value']) * 1.08;
						mysql_data_seek($result_value, 0);

						//カートテーブルにinsertするSQL文
						$sql_cart = "INSERT INTO cart VALUES('".quote_smart((String)$rows)."','".quote_smart($cart_number)."','".quote_smart($_SESSION['goods_buy'][$i])."',".quote_smart($value).",".quote_smart($_POST['buy_point']).",'".quote_smart(today())."')";
						mysql_query($sql_cart,$link);

						$cart_number = $cart_number + 1;
					}
				}
			}
			//▲▲カートテーブルにinsert

			//▼▼セッションの内容を適切なものに置き換える

			//購入済みの商品をカートから削除
			for($i = 0;$i < count($_SESSION['goods_buy']);$i++){
				$delete_flg = false;
				for($j = 0;$j < intval($_SESSION['cart_count']);$j++){
					if($_SESSION['goods_buy'][$i] === $_SESSION['cart_array'][$j*2]){
						$delete_flg = true;
					}
				}
				if($delete_flg == true){
					$count = intval($_SESSION['cart_count']);
					for($j = 0;$j < intval($_SESSION['cart_count']); $j++){
						//削除に指定した商品詳細番号以外のものを再格納(実質指定した商品詳細番号は省かれる)
						if($_SESSION['goods_buy'][$i] === $_SESSION['cart_array'][$j*2]){
							$count = $count - 1;
						}else{
							array_push($array, $_SESSION['cart_array'][$j*2],$_SESSION['cart_array'][$j*2+1]);
						}
					}

					unset($_SESSION['cart_array']);
					$_SESSION['cart_array'] = $array;
					$_SESSION['cart_count'] = (String)$count;

					$array = array();
				}
			}
			//▲▲セッションの内容を適切なものに置き換える

			//▼▼ポイント処理
			//合計ポイント格納変数
			$point_sum = intval($assoc_user['point']);
			$point_sum = $point_sum + intval($_SESSION['point_get']) - intval($_POST['buy_point']);

			$sql_point = "UPDATE user SET point = ".quote_smart($point_sum)." WHERE user_id = '".quote_smart($_SESSION['id'])."'";
			mysql_query($sql_point,$link);
			//▲▲ポイント処理

			//結果保持用メモリを開放する
			mysql_free_result($result);

			// MySQLへの接続を閉じる
			mysql_close($link) or die("MySQL切断に失敗しました。");

			//▲購入する処理
		}else{
			//会員以外の人がログインなしで購入した場合の処理

			//▼個人情報が入力されているかの確認処理
			empty_post($_POST['buy_name']);
			empty_post($_POST['buy_kana']);
			empty_post($_POST['buy_addressnumber_first']);
			empty_post($_POST['buy_addressnumber_last']);
			empty_post($_POST['buy_address']);
			empty_post($_POST['buy_phonenumber_first']);
			empty_post($_POST['buy_phonenumber_middle']);
			empty_post($_POST['buy_phonenumber_last']);
			empty_post($_POST['buy_month']);
			empty_post($_POST['buy_day']);
			empty_post($_POST['buy_hour']);
			empty_post($_POST['buy_minute']);
			empty_post($_POST['buy_email']);

			//monthが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_month']) && mb_strlen($_POST['buy_month']) != 2){
				if(mb_strlen($_POST['buy_month']) == 1){
					$month = (String)$_POST['buy_month'];
					$month = "0".$month;
				}else{
				//購入情報入力画面にリダイレクトする
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: buy_step.php?empty_post=true");
				exit();
				}
			}else{
				$month = (String)$_POST['buy_month'];
			}

			//dayが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_day']) && mb_strlen($_POST['buy_day']) != 2){
				if(mb_strlen($_POST['buy_day']) == 1){
					$day = (String)$_POST['buy_day'];
					$day = "0".$day;
				}else{
				//購入情報入力画面にリダイレクトする
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: buy_step.php?empty_post=true");
				exit();
				}
			}else{
				$day = (String)$_POST['buy_day'];
			}

			//hourが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_hour']) && mb_strlen($_POST['buy_hour']) != 2){
				if(mb_strlen($_POST['buy_hour']) == 1){
					$_POST['buy_hour'] = "0".(String)$_POST['buy_hour'];
				}else{
					//購入情報入力画面にリダイレクトする
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: buy_step.php?empty_post=true");
					exit();
				}
			}

			//minuteが正しく入力されているかの確認処理
			if(!is_numeric($_POST['buy_minute']) && mb_strlen($_POST['buy_minute']) != 2){
				if(mb_strlen($_POST['buy_minute']) == 1){
					$_POST['buy_minute'] = "0".(String)$_POST['buy_minute'];
				}else{
					//購入情報入力画面にリダイレクトする
					header("HTTP/1.1 301 Moved Permanently");
					header("Location: buy_step.php?empty_post=true");
					exit();
				}
			}
			//▲個人情報が入力されているかの確認処理



			//▼購入する処理
			//先に購入情報から行数を取得
			$sql_count = "SELECT * FROM buy ";
			$result_count = mysql_query($sql_count,$link);

			$rows = intval(mysql_fetch_row($result_count)) + 1;

			//時間を正しい形式にする
			$time = (String)$_POST['buy_hour'].":".(String)$_POST['buy_minute'];

			//▼▼購入情報にinsert
			$sql_buy = "INSERT INTO buy VALUES('".quote_smart((String)$rows)."',null,'".quote_smart(today())."','".quote_smart($_POST['buy_address'])."','".quote_smart((String)$month."-".(String)$day)."','".quote_smart($time)."','')";
			mysql_query($sql_buy,$link);
			//▲▲購入情報にinsert

			//▼▼カートテーブルにinsert
			//カート番号を格納する変数
			$cart_number = 1;
			for($i = 0;$i < count($_SESSION['goods_buy']);$i++){
				for($j = 0;$j < intval($_SESSION['cart_count']);$j++){
					//商品詳細番号が一致した時にinsert
					if($_SESSION['goods_buy'][$i] === $_SESSION['cart_array'][$j*2]){
						//先に商品の値段を呼び出す
						$sql_value = "SELECT value FROM goods g,goods_details gd "
								."WHERE g.goods_number = gd.goods_details_number "
										."AND gd.goods_details_number = '".quote_smart($_SESSION['goods_buy'][$i])."'";
						$result_value = mysql_query($sql_value,$link);
						$assoc_value = mysql_fetch_assoc($result_value);
						mysql_data_seek($result_value, 0);
						$value = intval($assoc_value['value']) * 1.08;

						//カートテーブルにinsertするSQL文
						$sql_cart = "INSERT INTO cart VALUES('".quote_smart((String)$rows)."','".quote_smart($cart_number)."','".quote_smart($_SESSION['goods_buy'][$i])."',".quote_smart($value).",0,'".quote_smart(today())."')";
						mysql_query($sql_cart,$link);

						$cart_number = $cart_number + 1;
					}
				}
			}
			//▲▲カートテーブルにinsert

			//▼▼セッションの内容を適切なものに置き換える

			//購入済みの商品をカートから削除
			for($i = 0;$i < count($_SESSION['goods_buy']);$i++){
				$delete_flg = false;
				for($j = 0;$j < intval($_SESSION['cart_count']);$j++){
					if($_SESSION['goods_buy'][$i] === $_SESSION['cart_array'][$j*2]){
						$delete_flg = true;
					}
				}
				if($delete_flg == true){
					$count = intval($_SESSION['cart_count']);
					for($j = 0;$j < intval($_SESSION['cart_count']); $j++){
						//削除に指定した商品詳細番号以外のものを再格納(実質指定した商品詳細番号は省かれる)
						if($_SESSION['goods_buy'][$i] === $_SESSION['cart_array'][$j*2]){
							$count = $count - 1;
						}else{
							array_push($array, $_SESSION['cart_array'][$j*2],$_SESSION['cart_array'][$j*2+1]);
						}
					}

					unset($_SESSION['cart_array']);
					$_SESSION['cart_array'] = $array;
					$_SESSION['cart_count'] = (String)$count;

					$array = array();
				}
			}
			//▲▲セッションの内容を適切なものに置き換える

			//結果保持用メモリを開放する
			mysql_free_result($result);

			// MySQLへの接続を閉じる
			mysql_close($link) or die("MySQL切断に失敗しました。");

			//▲購入する処理
		}
		print "<p>ご注文内容が確定しました。<br />";
		print "ご利用ありがとうございました。<br />";
		print "<a href=\"index.php\">トップページに移動する</a></p>";

	}
?>
