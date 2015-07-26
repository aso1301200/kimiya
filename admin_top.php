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

	<!-- 管理者 -->
	<div id="admin">
		<div id="contents_admin">
			<div><h2>商品追加</h2></div>
			<div class="post">
					<img src="images/sample_logo_01.png" alt=""  id="admin_image"/>
					<p>
					<form action="" method="post">
						<table border="0">
						  <tr>
						    <td align="right"><b> 商品ID：</b></td>
						    <td><input type="text" name="name" size="30" maxlength="20"></td>
						  </tr>
						  <tr>
						    <td align="right"><b> 商品名：</b></td>
						    <td><input type="text" name="name" size="30" maxlength="20"></td>
						  </tr>
						  <tr>
						    <td align="right"><b>価格：</b></td>
						    <td><input type="text" name="prise" size="30" maxlength="20"></td>
						  </tr>
						  <tr>
						    <td align="right"><b>性別：</b></td>
						    <td>
						      <input type="checkbox" name="sex" value="1">メンズ
						      <input type="checkbox" name="sex" value="2">レディース
						      <input type="checkbox" name="sex" value="3">ユニセックス
						      <input type="checkbox" name="sex" value="4">キッズ
						    </td>
						  </tr>
						  <tr>
						    <td align="right"><b>サイズ：</b></td>
						    <td>
						      <input type="checkbox" name="size" value="1">S
						      <input type="checkbox" name="size" value="2">M
						      <input type="checkbox" name="size" value="3">L
						    </td>
						  </tr>
						  <tr>
						    <td align="right"><b>カラー：</b></td>
						    <td>
						      <input type="checkbox" name="color" value="1">ブラック
						      <input type="checkbox" name="color" value="2">ホワイト
						      <input type="checkbox" name="color" value="3">レッド
						      <input type="checkbox" name="color" value="4">ブルー
						    </td>
						  </tr>
						  <tr>
						  	<td></td>
						  	<td>
						      <input type="checkbox" name="color" value="5">グリーン
						      <input type="checkbox" name="color" value="6">その他
						  	</td>
						  </tr>
						  <tr>
						  	<td align="right"><b>タイプ：</b></td>
						  	<td>
						  		<select>
									<option value="1">おひつじ座</option>
									<option value="2">おうし座</option>
									<option value="3">ふたご座</option>
									<option value="4">かに座</option>
									<option value="5">しし座</option>
									<option value="6">おとめ座</option>
									<option value="7">てんびん座</option>
									<option value="8">さそり座</option>
						  		</select>
						  	</td>
						  </tr>
						  <tr>
						  	<td align="right"><b>写真：</b></td>
						  	<td><input type="file" name="photo" multiple="multiple"></td>
						  </tr>
						</table>
						<input class="more" type="reset" value="リセット">
						<input class="more" type="submit" value="追加">
					</form>
					</p>
			</div>
		</div>

		<div id="contents_admin">
			<div><h2>商品更新</h2></div>
			<div class="post">

					<img src="images/sample_logo_01.png" alt="" id="admin_image" />
					<p>
					<form action="" method="post">
						<table border="0">
						  <tr>
						    <td align="right"><b> 商品ID：</b></td>
						    <td><input type="text" name="name" size="30" maxlength="20"></td>
						  </tr>
						  <tr>
						    <td align="right"><b> 商品名：</b></td>
						    <td><input type="text" name="name" size="30" maxlength="20"></td>
						  </tr>
						  <tr>
						    <td align="right"><b>価格：</b></td>
						    <td><input type="text" name="prise" size="30" maxlength="20"></td>
						  </tr>
						  <tr>
						    <td align="right"><b>性別：</b></td>
						    <td>
						      <input type="checkbox" name="sex" value="1">メンズ
						      <input type="checkbox" name="sex" value="2">レディース
						      <input type="checkbox" name="sex" value="3">ユニセックス
						      <input type="checkbox" name="sex" value="4">キッズ
						    </td>
						  </tr>
						  <tr>
						    <td align="right"><b>サイズ：</b></td>
						    <td>
						      <input type="checkbox" name="size" value="1">S
						      <input type="checkbox" name="size" value="2">M
						      <input type="checkbox" name="size" value="3">L
						    </td>
						  </tr>
						  <tr>
						    <td align="right"><b>カラー：</b></td>
						    <td>
						      <input type="checkbox" name="color" value="1">ブラック
						      <input type="checkbox" name="color" value="2">ホワイト
						      <input type="checkbox" name="color" value="3">レッド
						      <input type="checkbox" name="color" value="4">ブルー
						    </td>
						  </tr>
						  <tr>
						  	<td></td>
						  	<td>
						      <input type="checkbox" name="color" value="5">グリーン
						      <input type="checkbox" name="color" value="6">その他
						  	</td>
						  </tr>
						  <tr>
						  	<td align="right"><b>タイプ：</b></td>
						  	<td>
						  		<select>
									<option value="1">おひつじ座</option>
									<option value="2">おうし座</option>
									<option value="3">ふたご座</option>
									<option value="4">かに座</option>
									<option value="5">しし座</option>
									<option value="6">おとめ座</option>
									<option value="7">てんびん座</option>
									<option value="8">さそり座</option>
						  		</select>
						  	</td>
						  </tr>
						  <tr>
						  	<td align="right"><b>写真：</b></td>
						  	<td><input type="file" name="photo" multiple="multiple"></td>
						  </tr>
						</table>
						</form>
						<input class="more" type="reset" value="リセット">
						<input class="more" type="submit" value="更新">
					</form>
					</p>
			</div>
		</div>

		<div id="contents_admin">
			<div><h2>商品削除</h2></div>
			<div class="post">
					<img src="images/sample_logo_01.png" alt=""  id="admin_image"/>
					<p>
					<form action="" method="post">
						<table border="0">
						  <tr>
						    <td align="right"><b> 商品ID：</b></td>
						    <td><input type="text" name="name" size="30" maxlength="20"></td>
						  </tr>
						</table>
						<input class="more" type="reset" value="リセット">
						<input class="more" type="submit" value="削除">
					</form>
					</p>
			</div>
		</div>
	</div>
</div>
</body>
</html>