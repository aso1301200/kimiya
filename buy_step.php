<!-- 購入ページの１つめ、住所などの情報を入力するページ -->
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

	if(!empty($_SESSION['cart_array'])){
		//結果代入用配列
		$result_array = array();

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
		for($i = 0;$i < $_SESSION['cart_count'];$i++){
			$sql = "SELECT g.goods_name,gd.goods_details_number,p.photo_name,g.value "
				."FROM goods g,goods_details gd,goods_photo gp,photo p "
				."WHERE g.goods_number = gd.goods_number "
				."AND gd.goods_details_number = gp.goods_details_number "
				."AND gp.photo_number = p.photo_number "
				."AND gd.goods_details_number='".quote_smart($_SESSION['cart_array'][$i*2])."' "
				."AND gd.color_code='".quote_smart($_SESSION['cart_array'][$i*2+1])."' "
				."AND gp.direction_code = '2'";
			$result = mysql_query($sql,$link);

			//退避用の配列$array
			$array = mysql_fetch_assoc($result);

			$result_array[$i]['goods_name'] = $array['goods_name'];
			$result_array[$i]['goods_details_number'] = $array['goods_details_number'];
			$result_array[$i]['photo_name'] = $array['photo_name'];
			$result_array[$i]['value'] = $array['value'];
		}
	}

?>
<!-- ここまでデータベース -->

<!-- ここから削除ボタンのJavaScript -->
<script type="text/javascript">
	function deleteCart(item){
		location.href = "cart_delete.php?item="+item;
	}
</script>
<!-- ここまで削除ボタンのJavaScript -->

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
					<!-- ▲ここまでがログインに関するフォームです(コメントで挟んでいる内容を全てのページに入力してください)▲ -->
				</div>

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
	<!-- カートの中身 -->
	<p>
		<form method="POST" action="">
			<table>
			<td>会員情報
				<?php
					if(empty($_SESSION['id'])){
						//ログインしていない人の情報入力フォーム

					}else{
						//ログインしている人の情報入力フォーム
					}
				?>
			</td>
			<td>商品情報
				<?php
				?>
			</td>
			</table>
		</form>
	</p>

</div>
</body>
</html>
