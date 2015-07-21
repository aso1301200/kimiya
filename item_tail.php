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
	$sql = "SELECT * "
			."FROM color c ,direction d ,goods g ,goods_details gd , goods_photo gp , photo p , sex se , size si , type t "
			."WHERE g.goods_number = gd.goods_number "
			."AND gd.color_code = c.color_code "
			."AND gd.type_code = t.type_code "
			."AND gd.size_code = si.size_code "
			."AND gd.sex_code = se.sex_code "
			."AND gd.goods_details_number = gp.goods_details_number "
			."AND gp.photo_number = p.photo_number "
			."AND gp.direction_code = d.direction_code "
			."AND gd.goods_details_number = '".quote_smart($_GET['item'])."' "
			."AND gd.color_code = '".quote_smart($_GET['color'])."' "
			."ORDER BY gp.direction_code ASC";

	$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	//結果セットの行数を取得する
	$rows = mysql_num_rows($result);

	//結果セットを取得する
	$assoc = mysql_fetch_assoc($result);
	//mysql_fetch_assocで動いたポインタを元に戻す
	mysql_data_seek($result, 0);
?>
<!-- ここまでデータベース -->
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
					</div>
					<!-- ▲ここまでがログインに関するフォームです(コメントで挟んでいる内容を全てのページに入力してください)▲ -->

			</div><!-- #header-widget-area -->

					<div id="header-top-image">
						<!--  <img src="">		<!-- トップの上部のおしゃれな絵 -- -->
					</div>


		</div><!-- .header-inner -->
	</div><!-- #masthead -->

	<div class="clear"></div>

	<!-- タグ部メニュー -->
	<p>
		<div id="cssmenu">
			<ul>
				<li><a href='#'><span>ホーム</span></a></li>
				<li><a href='#'><span>ご利用案内</span></a></li>
				<li><a href='#'><span>新規会員登録</span></a></li>
				<li><a href='#'><span>注文商品紹介</span></a></li>
				<li><a href='#'><span>買い物かご</span></a></li>
				<li><a href='#'><span>サイトマップ</span></a></li>
				<li class='last'><a href='#'><span>問い合わせ</span></a></li>
			</ul>
		</div>
	</p>

	<div class="contents_item">

	<div id="item_center">
		<!-- カテゴリ検索欄 -->
		<div id="item_category">
		<ul>
		<li><b>category</b></li>
		<li class="category"><p>type</p></li>
			<li><a href="">スクウェア</a></li>
			<li><a href="">ホックス</a></li>
			<li><a href="">ボストン</a></li>
			<li><a href="">セオミート</a></li>
			<li><a href="">その他</a></li>
		<li class="category"><p>sex</p></li>
			<li><a>Man</a></li>
			<li><a>Leadies</a></li>
			<li><a>Kids</a></li>
		<li class="category"><p>color</p></li>
			<li><a>Black</a></li>
			<li><a>Red</a></li>
			<li><a>Blue</a></li>

		</ul>
		</div>

		<!-- 商品詳細画面 -->
		<div id="item_tail">
		<?php
			//商品をカートに追加後テキストを表示
			if(!empty($_GET['added']) && $_GET['added'] == true){
				print "<div id=\"added\" style=\"background-color: #fff0f0; font-size: 20px; \"><font color=\"#ffa0a0\">カートに商品を追加しました</font></div>";
			}
		?>
		<div id="wrapper">
		  <input type="radio" name="slideshow" id="switch1" checked>
		  <input type="radio" name="slideshow" id="switch2">
		  <input type="radio" name="slideshow" id="switch3">
		  <input type="radio" name="slideshow" id="switch4">
			  <div id="slideshow">
			    <div class="slideContents">

			    <!--  この内容を元にループ文でsqlの動作に合わせた内容に
			      <section id="slide1">
			        <img src="images/test_images/test_grassB_front.png">
			      </section>
			      <section id="slide2">
			        <img src="images/test_images/test_grassB_front.png">
			      </section>
			      <section id="slide3">
			        <img src="images/test_images/test_grassB_front.png">
			      </section>
			      <section id="slide4">
			        <img src="images/test_images/test_grassB_front.png">
			      </section>
			     -->

			     <?php
			     //phpで上記の内容を作成、sqlの動作に合わせたものに
			     for($count = 0;$count < 4;$count++){
			     	if($count < 3){
				     	$array = mysql_fetch_array($result);
				     	print "<section id=\"slide".($count+1)."\">";
				     	print "<img src=\"images/test_images/".$array['photo_name']."\">";
				     	print "</section>";
			     	}else{
			     		print "<section id=\"slide".($count+1)."\">";
			     		print "<img src=\"images/test_images/".$assoc['photo_name']."\">";
			     		print "</section>";
			     	}

			     }

			     ?>

			    </div>
			    <p class="arrow prev">
			      <i class="ico"></i>
			      <label for="switch1"></label>
			      <label for="switch2"></label>
			      <label for="switch3"></label>
			      <label for="switch4"></label>
			    </p>
			    <p class="arrow next">
			      <i class="ico"></i>
			      <label for="switch1"></label>
			      <label for="switch2"></label>
			      <label for="switch3"></label>
			      <label for="switch4"></label>
			    </p>
			  </div>
		</div>
		<!-- 商品情報説明欄 -->
		<div id="item">
		  <div id="item_info">
			<div id="item_name">
				<font size="6"><?php print $array['goods_name'];?></font>
			</div>
			<div id="item_explanation">
			  <!-- 価格 -->
			  <p style="border-bottom: dotted 1px #000;">
			  <font size="8" color="red"><?php print $assoc['value'];?></font></p><br><br>
			  <!-- サイズ -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Size</font></div>
			  <div style="text-align: right;"><?php print $assoc['size_name'];?></div>
			  </div><br>
			  <!-- タイプ -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Type</font></div>
			  <div style="text-align: right;"><?php print $assoc['type_name'];?></div>
			  </div><br>
			  <!-- カラー -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Color</font></div>
			  <div style="text-align: right;"><?php print $assoc['color_name'];?></div>
			  </div><br>
			  <!-- 性別 -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Sex</font></div>
			  <div style="text-align: right;"><?php print $assoc['sex_name'];?></div>
			  </div><br>
			  <!-- 商品説明文 -->
			  <p id="explanation_tail"><?php print $assoc['goods_explain'];?></p>
			</div>
		  </div>
		 <!-- カート欄 -->
		  <div id="item_cart">
			<div id="cart_info">
			<!--番号 -->
			  <p>番号：<?php print $assoc['goods_details_number'];?></p><p></p><br>
			<!-- サイズ -->
			  <p>サイズ：<?php print $assoc['size_name'];?></p><p></p><br>
			<!-- 個数 -->
			  <p>個数：
			  <?php
			  	if(empty($_SESSION['cart_array'])){
			  		print "0";
			  	}else{
			  		print $_SESSION['cart_count'];
			  	}
			  ?></p><p></p><br>
			<!-- 価格 -->
			  <p>価格：<?php print $assoc['value'];?></p><p></p>
			<!-- カラー -->
			  <p>カラー：<?php print $assoc['color_name'];?></p><p></p>
			</div>
			<!-- カートボタン -->
			  <div id="cart_botton">
			  <p class="btn"><a href="cart_add.php?item=<?php print $_GET['item']?>&color=<?php print $_GET['color']?>">カートに入れる</a></p>
			</div>
		  </div>
		</div>
		</div>
  	</div>
  	</div>

<div class="footer">copyright</div>
</div>
</body>
</html>