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

		<!-- 新規会員登録 -->
		<div id="register_title"><font size="5">新規会員登録</font></div>
		<div id="content_input">
		  <div id="lead">お客様の情報を確認し、「登録」ボタンを押して下さい。</div>
		  <div id="input_table">
		    <form name="form1" id="form1" method="post" action="user_insert.php">
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
		            <?php
		            //職業を格納する変数
					$job = "";

					switch(intval($_POST["job"])){
						case 1:
							$job = "社会人(営業・事務系)";
							break;
						case 2:
							$job = "社会人(技術系)";
							break;
						case 3:
							$job = "社会人(アパレル・繊維系)";
							break;
						case 4:
							$job = "社会人(サービス・販売系)";
							break;
						case 5:
							$job = "社会人(公務員・教員・農林水産)";
							break;
						case 6:
							$job = "社会人(その他業種)";
							break;
						case 7:
							$job = "パート・アルバイト";
							break;
						case 8:
							$job = "専業主婦";
							break;
						case 9:
							$job = "大学生";
							break;
						case 10:
							$job = "大学院生";
							break;
						case 11:
							$job = "専門学校生";
							break;
						case 12:
							$job = "高校生";
							break;
						case 13:
							$job = "中学生";
							break;
						case 14:
							$job = "その他";
							break;
						default:
							break;
					}
		            echo $job;
		            ?>
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
		          <p><input type="submit" class="box150 confirm" value="登録" name="confirm" id="confirm"></p>
		        </div></form>
		  </div>
		</div>

		<!-- セッションに格納 -->
		<?php
			$_SESSION['insert_name'] = $_POST["last_name"].$_POST["first_name"];
			$_SESSION['insert_kana'] = $_POST["last_kana"].$_POST["first_kana"];
			$_SESSION['insert_sex_code'] = $_POST["sex"];
			$_SESSION['insert_birthday'] = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
			$_SESSION['insert_address_number'] = $_POST["address_number_head"]."-".$_POST["address_number_bottom"];
			$_SESSION['insert_address'] = $_POST["address"];
			$_SESSION['insert_phone_number'] = $_POST["phone_number_1"]."-".$_POST["phone_number_2"]."-".$_POST["phone_number_3"];
			$_SESSION['insert_email'] = $_POST["email"];
			$_SESSION['insert_job'] = $job;
			$_SESSION['insert_password'] = $_POST["password"];
		?>
		<!-- セッションに格納 -->

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
