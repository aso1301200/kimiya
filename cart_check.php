<!-- カートの中身を確認、購入画面に進むためのページ -->
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
			<table id="cart_check" border="1 solid">
				<tr><th>購入</th><th>買い物かごに追加した商品</th><th>単品|税込</th><th>注文個数</th><th>削除</th></tr>
				<!-- ここをループ文にする -->
				<?php
					//商品ごとの個数をカウントする array[商品詳細番号を入れる][個数を入れる]
					$goods_count = array();
					$goods_count[0][0] = "";
					$goods_count[0][1] = "";

					for($i = 0;$i < $_SESSION['cart_count'];$i++){
						$boolean_add = false;

						//同じ商品詳細番号が既に格納されているか調べる
						for($j = 0;$j < count($goods_count);$j++){
							if($goods_count[$j][0] === $result_array[$i]['goods_details_number']){
								$boolean_add = true;
								break;
							}
						}

						//同じ商品詳細番号があればカウントを進める、なければ配列に追加
						if($boolean_add == true){
							$goods_count[$j][1] = $goods_count[$j][1] + 1;
						}else{
							$goods_count[$j][0] = $result_array[$i]['goods_details_number'];
							$goods_count[$j][1] = 1;
						}

					}

					//ポイントの合計を格納する変数
					$point = 0;

					for($i = 0;$i < count($goods_count);$i++){

						$j = 0;
						for($j = 0;$j < $_SESSION['cart_count'];$j++){
							if($goods_count[$i][0] === $result_array[$j]['goods_details_number']){
								print "<tr>";
								print "<td><input type=\"checkbox\" name=\"item_buy\" value=\"".$result_array[$j]['goods_details_number']."\"></td>";
								print "<td>".$result_array[$j]['goods_name']."<br /><img src=\"images/test_images/".$result_array[$j]['photo_name']."\" class=\"img_goods\" /></td>";
								print "<td>".$result_array[$j]['value']."円(税込 ".$result_array[$j]['value']*1.08."円)</td>";
								print "<td>".$goods_count[$i][1]."個</td>";
								print "<td><input type=\"button\" id=\"button_delete\" onclick=\"deleteCart('".$result_array[$j]['goods_details_number']."')\" value=\"削除\" /\">";

								$point = $point + intval($result_array[$j]['value']) * $goods_count[$i][1] * 0.1;

								break;

							}
						}

					}

				?>
			</table>
			<div id="cart_point">カート内全ての商品を購入することで<?php print $point;?>ポイント獲得できます。</div><input type="submit" name="button_buy" value="購入手続き" />
		</form>
	</p>

</div>
</body>
</html>
