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
			</div><!-- #header-widget-area -->
			<div class="clear"></div>
		</div><!-- .header-inner -->
	</div><!-- #masthead -->

	<p>
		<div id="header-top-image">
			<img src="">トップ		<!-- トップの上部のおしゃれな絵 -->
		</div>
	</p>

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
		<div id="wrapper">
		  <input type="radio" name="slideshow" id="switch1" checked>
		  <input type="radio" name="slideshow" id="switch2">
		  <input type="radio" name="slideshow" id="switch3">
		  <input type="radio" name="slideshow" id="switch4">
			  <div id="slideshow">
			    <div class="slideContents">
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
				<font size="6">SQLから取得した商品名</font>
			</div>
			<div id="item_explanation">
			  <!-- 価格 -->
			  <p style="border-bottom: dotted 1px #000;">
			  <font size="8" color="red">Prise</font></p><br><br>
			  <!-- サイズ -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Size</font></div>
			  <div style="text-align: right;">価格</div>
			  </div><br>
			  <!-- タイプ -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Type</font></div>
			  <div style="text-align: right;">タイプ</div>
			  </div><br>
			  <!-- カラー -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Color</font></div>
			  <div style="text-align: right;">カラー</div>
			  </div><br>
			  <!-- 性別 -->
			  <div style="border-bottom: dotted 1px #000; padding-bottom: 1px;">
			  <div style="text-align: left; float: left;"><font size="4">Sex</font></div>
			  <div style="text-align: right;">性別</div>
			  </div><br>
			  <!-- 商品説明文 -->
			  <p id="explanation_tail">ここに商品説明文が入る</p>
			</div>
		  </div>
		 <!-- カート欄 -->
		  <div id="item_cart">
			<div id="cart_info">
			<!--番号 -->
			  <p>番号：</p><p></p><br>
			<!-- サイズ -->
			  <p>サイズ：</p><p></p><br>
			<!-- 個数 -->
			  <p>個数：</p><p></p><br>
			<!-- 価格 -->
			  <p>価格：</p><p></p>
			</div>
			<!-- カートボタン -->
			  <div id="cart_botton">
			  <p class="btn"><a>カートに入れる</a></p>
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