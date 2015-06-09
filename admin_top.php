<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">

<title>きみ屋</title>

<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
	<div id="admin">
		<h1>きみ屋　商品情報</h1>

		<div class="post">
			<h3>商品追加</h3>
				<img src="images/sample_logo_01.png" alt=""  id="admin_image"/>
				<p>
					<form action="" method="post">
					<table border="0">
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
					  	<td><input type="file" name="photo"></td>
					  </tr>
					</table>
					</form>
				</p>
				<p>
					<input class="more" type="reset" value="リセット">
					<input class="more" type="submit" value="追加">
				</p>
		</div>

		<div class="post">
			<h4><a href="#">商品更新</a></h4>
				<img src="images/sample_logo_01.png" alt="" />
				<p>今回はフロートを使って ...</p>
				<p><a class="more" href="#">設定 »</a></p>
		</div>

		<div class="post">
			<h4><a href="#">商品削除</a></h4>
				<img src="images/sample_logo_01.png" alt="" />
				<p>今回はフロートを使って ...</p>
				<p><a class="more" href="#">設定 »</a></p>
		</div>
	</div>
</body>
</html>
