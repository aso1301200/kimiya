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
	$result = mysql_query("SELECT gd.goods_details_number,g.goods_name,p.photo_name,color_code,g.goods_explain FROM goods g, goods_details gd, goods_photo gp, photo p, direction d WHERE g.goods_number = gd.goods_number AND gd.goods_details_number = gp.goods_details_number AND gp.photo_number = p.photo_number AND gp.direction_code = d.direction_code AND d.direction_code = '2'", $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	//結果セットの行数を取得する
	$rows = mysql_num_rows($result);
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



		<!-- 問い合わせ -->
		<div id="company_title"><font size="5">お問い合わせ</font></div>
		<div id="content_input2">
		  <div id="lead">メールでのお問い合わせは土日・祝日・弊社指定休日にご連絡いただいた場合、
		  営業開始日より順次対応させていただきます。ご連絡を差し上げるまでに数日間頂戴する場合がございますので、
		  ご不便をおかけ致しますが、予めご了承ください。</div>

			<div id="input_table">
			    <form name="form1" id="form1" method="post" action="campany_check.php">
	        	  <table summary="会員登録フォーム">
	                  <tbody><tr class="name">
			            <th>お名前</th>
			            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
			            <td class="cont">
			              <p>
							姓&nbsp;&nbsp;<input type="text" name="last_name" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">&nbsp;

						    名&nbsp;&nbsp;<input type="text" name="first_name" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">
			              </p>
			            </td>
			          </tr>
			          <tr class="name">
			            <th>フリガナ</th>
			            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
			            <td class="cont">
			              <p>
						    セイ&nbsp;<input type="text" name="last_kana" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">&nbsp;
						    メイ&nbsp;<input type="text" name="first_kana" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">
			              </p>
			            </td>
			          </tr>
			          <tr class="gender">
			            <th>性別</th>
			            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
			            <td class="cont">
			              <div class="radio">
			                <p>
							    <input type="radio" id="man" name="sex" value="1" style=""><label for="man">男性</label>
							    <input type="radio" id="woman" name="sex" value="2" style=""><label for="woman">女性</label>
			                </p>
			                <!-- radio -->
			              </div>
			            </td>
			          </tr>
			          <tr class="email2">
			            <th>メールアドレス</th>
			            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
			            <td class="cont">
			              <p>
			    			<input type="text" name="email" value="" style="; ime-mode: disabled;" maxlength="200" size="40" class="box300"><br>
			              </p>
			          </td>
			          </tr>
			          <tr class="message">
			            <th>メッセージ</th>
			            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
			            <td class="cont">
			              <p>
			    			<input type="text" name="email" value="" style="; ime-mode: disabled;" maxlength="200" size="40" class="box400"><br>
			              </p>
			          </td>
			          </tr>
	        		</tbody>
	        	  </table>
	        	 </form></br></br>

	        	 <div>
			      <a href="campany_check.php"id="botton_index">送信</a>
				</div>

				</div>
			</div>


	  	</div>
	  	</div>

</div>
<div class="footer">copyright</div>

</body>
</html>