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
					  <font size="8" color="red">\<?php print $assoc['value'];?></font></p><br><br>
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
					  <p>買い物かご合計個数：
					  <?php
					  	if(empty($_SESSION['cart_array'])){
					  		print "0";
					  	}else{
					  		print $_SESSION['cart_count'];
					  	}
					  ?></p><p></p><br>
					<!-- 価格 -->
					  <p>価格：<?php print $assoc['value'];?></p><p></p></br>
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