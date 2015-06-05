<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">

<title>きみ屋</title>

<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
	<div id="">
		<h1>きみ屋　商品情報</h1>

		<div class="post">
			<h4><a href="#">商品追加</a></h4>
				<img src="images/sample_logo_01.png" alt="" />
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
					    <td></td>
					    <td>
					      <input type="submit" value="送信">
					      <input type="reset" value="リセット">
					    </td>
					  </tr>
					</table>
					</form>
				</p>
				<p><a class="more" href="#">設定 »</a></p>
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
