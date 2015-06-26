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