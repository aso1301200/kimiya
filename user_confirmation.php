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
			<img src="images/top.png" 	width="100%" height="300px;"><!-- トップの上部のおしゃれな絵 -->
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

		<?php session_start();?>

		<!-- 新規会員登録 -->
		<div id="register_title"><font size="5">新規会員登録</font></div>
		<div id="content_input">
		  <div id="lead">お客様の情報を確認し、「登録」ボタンを押して下さい。</div>
		  <div id="input_table">
		    <form name="form1" id="form1" method="post" action="?">
		    <table summary="会員登録フォーム">
                  <tbody><tr class="table_user">
		            <th>お名前</th>
		            <td>
		            <?php echo $_POST["last_name"].$_POST["first_name"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>お名前(フリガナ)</th>
		            <td class="cont">
		              <?php echo $_POST["last_kana"].$_POST["first_kana"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>性別</th>
		            <td class="cont">
		            <?php echo $_POST["sex"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>生年月日</th>
		            <td class="cont">
		              <p><?php echo $_POST["year"]?>年　
		              <?php echo $_POST["month"]?>月　
		              <?php echo $_POST["day"]?>日　</p>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>郵便番号</th>
		            <td class="cont">
		            <?php echo $_POST["address_number_head"]."-".$_POST["address_number_bottom"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>住所</th>
		            <td class="cont">
		            <?php echo $_POST["address"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>電話番号</th>
		            <td class="cont">
		            <?php echo $_POST["phone_number_1"]."-".$_POST["phone_number_2"]."-".$_POST["phone_number_3"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>メールアドレス</th>
		            <td class="cont">
		            <?php echo $_POST["email"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>職業</th>
		            <td class="cont">
		            <?php echo $_POST["job"]?>
		            </td>
		          </tr>
		          <tr class="table_user">
		            <th>希望するパスワード</th>
		            <td class="cont">
		            <p>表示されません</p>
		            </td>
		          </tr>
		          </tbody></table>

		        <div class="tblareabtn button">
		          <p><input type="submit" class="box150 confirm" alt="確認ページへ" name="confirm" id="confirm"></p>
		        </div></form>
		  </div>
		</div>
		<?php
		$_SESSION['join'] = $_POST;
		exit();
		?>


  	</div>
  	</div>

<div class="footer">copyright</div>
</div>
</body>
</html>