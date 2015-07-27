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
		  <div id="lead">お客様の情報を入力し、「確認ページヘ」ボタンを押して下さい。</div>
		  <div id="input_table">

		    <form name="form1" id="form1" method="post" action="user_confirmation.php">

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
		            <th>お名前(フリガナ)</th>
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
		          <tr class="birth">
		            <th>生年月日</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
					    <div class="select">
					    <select name="year" style="">
					      <option label="----" value="----">----</option>

<option label="1950" value="1950">1950</option>
<option label="1951" value="1951">1951</option>
<option label="1952" value="1952">1952</option>
<option label="1953" value="1953">1953</option>
<option label="1954" value="1954">1954</option>
<option label="1955" value="1955">1955</option>
<option label="1956" value="1956">1956</option>
<option label="1957" value="1957">1957</option>
<option label="1958" value="1958">1958</option>
<option label="1959" value="1959">1959</option>
<option label="1960" value="1960">1960</option>
<option label="1961" value="1961">1961</option>
<option label="1962" value="1962">1962</option>
<option label="1963" value="1963">1963</option>
<option label="1964" value="1964">1964</option>
<option label="1965" value="1965">1965</option>
<option label="1966" value="1966">1966</option>
<option label="1967" value="1967">1967</option>
<option label="1968" value="1968">1968</option>
<option label="1969" value="1969">1969</option>
<option label="1970" value="1970">1970</option>
<option label="1971" value="1971">1971</option>
<option label="1972" value="1972">1972</option>
<option label="1973" value="1973">1973</option>
<option label="1974" value="1974">1974</option>
<option label="1975" value="1975">1975</option>
<option label="1976" value="1976">1976</option>
<option label="1977" value="1977">1977</option>
<option label="1978" value="1978">1978</option>
<option label="1979" value="1979">1979</option>
<option label="1980" value="1980">1980</option>
<option label="1981" value="1981">1981</option>
<option label="1982" value="1982">1982</option>
<option label="1983" value="1983">1983</option>
<option label="1984" value="1984">1984</option>
<option label="1985" value="1985">1985</option>
<option label="1986" value="1986">1986</option>
<option label="1987" value="1987">1987</option>
<option label="1988" value="1988">1988</option>
<option label="1989" value="1989">1989</option>
<option label="1990" value="1990">1990</option>
<option label="1991" value="1991">1991</option>
<option label="1992" value="1992">1992</option>
<option label="1993" value="1993">1993</option>
<option label="1994" value="1994">1994</option>
<option label="1995" value="1995">1995</option>
<option label="1996" value="1996">1996</option>
<option label="1997" value="1997">1997</option>
<option label="1998" value="1998">1998</option>
<option label="1999" value="1999">1999</option>
<option label="2000" value="2000" selected=""></option>
<option label="2001" value="2001">2001</option>
<option label="2002" value="2002">2002</option>
<option label="2003" value="2003">2003</option>
<option label="2004" value="2004">2004</option>
<option label="2005" value="2005">2005</option>
<option label="2006" value="2006">2006</option>
<option label="2007" value="2007">2007</option>
<option label="2008" value="2008">2008</option>
<option label="2009" value="2009">2009</option>
<option label="2010" value="2010">2010</option>
<option label="2011" value="2011">2011</option>
<option label="2012" value="2012">2012</option>
<option label="2013" value="2013">2013</option>
<option label="2014" value="2014">2014</option>
<option label="2015" value="2015">2015</option>

					    </select>
		                <!-- select -->
		               年　</div>
		              <div class="select">
					    <select name="month" style="">
					      <option label="--" value="" selected="">--</option>
<option label="1" value="1">1</option>
<option label="2" value="2">2</option>
<option label="3" value="3">3</option>
<option label="4" value="4">4</option>
<option label="5" value="5">5</option>
<option label="6" value="6">6</option>
<option label="7" value="7">7</option>
<option label="8" value="8">8</option>
<option label="9" value="9">9</option>
<option label="10" value="10">10</option>
<option label="11" value="11">11</option>
<option label="12" value="12">12</option>

					    </select>
		                <!-- select -->
		              月　</div>
		              <div class="select">
					    <select name="day" style="">
					      <option label="--" value="" selected="">--</option>
<option label="1" value="1">1</option>
<option label="2" value="2">2</option>
<option label="3" value="3">3</option>
<option label="4" value="4">4</option>
<option label="5" value="5">5</option>
<option label="6" value="6">6</option>
<option label="7" value="7">7</option>
<option label="8" value="8">8</option>
<option label="9" value="9">9</option>
<option label="10" value="10">10</option>
<option label="11" value="11">11</option>
<option label="12" value="12">12</option>
<option label="13" value="13">13</option>
<option label="14" value="14">14</option>
<option label="15" value="15">15</option>
<option label="16" value="16">16</option>
<option label="17" value="17">17</option>
<option label="18" value="18">18</option>
<option label="19" value="19">19</option>
<option label="20" value="20">20</option>
<option label="21" value="21">21</option>
<option label="22" value="22">22</option>
<option label="23" value="23">23</option>
<option label="24" value="24">24</option>
<option label="25" value="25">25</option>
<option label="26" value="26">26</option>
<option label="27" value="27">27</option>
<option label="28" value="28">28</option>
<option label="29" value="29">29</option>
<option label="30" value="30">30</option>
<option label="31" value="31">31</option>

					    </select>
		                <!-- select -->
		               日　</div>
		            </td>
		          </tr>
		          <tr class="zip">
		            <th>郵便番号</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
		              <p>
					    〒 &nbsp;<input type="text" name="address_number_head" value="" maxlength="3" style="; ime-mode: disabled;" size="6" class="box60">&nbsp;-&nbsp;
					    <input type="text" name="address_number_bottom" value="" maxlength="4" style="; ime-mode: disabled;" size="6" class="box60">&nbsp;
		    			</p>
		            </td>
		          </tr>
		          <tr class="address">
		            <th>住所</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
		              <p>
		              	<input type="text" name="address" value="" size="60" class="box300" style="; ime-mode: active;"><br>
		     		  </p>
		              <p class="notice">都道府県名から入力してください</p>
		            </td>
		          </tr>
		          <tr class="number">
		            <th>電話番号</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
		              <p>
					   <input type="text" name="phone_number_1" value="" maxlength="6" size="6" style="; ime-mode: disabled;" class="box60">&nbsp;-&nbsp;
					   <input type="text" name="phone_number_2" value="" maxlength="6" size="6" style="; ime-mode: disabled;" class="box60">&nbsp;-&nbsp;
					   <input type="text" name="phone_number_3" value="" maxlength="6" size="6" style="; ime-mode: disabled;" class="box60">
					  </p>
		            </td>
		          </tr>

		          <tr class="email">
		            <th>メールアドレス</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
		              <p>
		    			<input type="text" name="email" value="" style="; ime-mode: disabled;" maxlength="200" size="40" class="box300"><br>
		              </p>
		              <p>
		    			<input type="text" name="email02" value="" style="; ime-mode: disabled;" maxlength="200" size="40" class="box300"><br>
		              </p>
		              <p class="notice">確認のため2度入力してください。</p>
		          </td>
		          </tr>
		          <tr class="job">
		            <th>職業</th>
		            <td class="must">&nbsp;</td>
		            <td class="cont">
					    			                  <div class="select">
					    <select name="job">
					      <option value="" selected="selected">選択してください</option>
					      <option label="社会人(営業・事務系)" value="1">社会人(営業・事務系)</option>
<option label="社会人(技術系)" value="2">社会人(技術系)</option>
<option label="社会人(アパレル・繊維系)" value="3">社会人(アパレル・繊維系)</option>
<option label="社会人(サービス・販売系)" value="4">社会人(サービス・販売系)</option>
<option label="社会人(公務員・教員・農林水産)" value="5">社会人(公務員・教員・農林水産)</option>
<option label="社会人(その他業種)" value="6">社会人(その他業種)</option>
<option label="パート・アルバイト" value="7">パート・アルバイト</option>
<option label="専業主婦" value="8">専業主婦</option>
<option label="大学生" value="9">大学生</option>
<option label="大学院生" value="10">大学院生</option>
<option label="専門学校生" value="11">専門学校生</option>
<option label="高校生" value="12">高校生</option>
<option label="中学生" value="13">中学生</option>
<option label="その他" value="14">その他</option>

					    </select>
		                <div><p>選択してください</p></div>
		                <!-- select -->
		              </div>
		            </td>
		          </tr>
		          <tr class="password">
		            <th>希望するパスワード</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
		              <p>パスワードは購入時に必要です。</p>
		              <p class="notice">半角英数字4～20文字でお願いします。（記号不可）</p>
		              <p>
					   <input type="password" name="password" value="" maxlength="20" style="" size="15" class="box120">
		              </p>
		              <p>
		   				<input type="password" name="password02" value="" maxlength="20" style="" size="15" class="box120">
		              </p>
		              <p class="notice">確認のため2度入力してください。</p>
		            </td>
		          </tr>

        		</tbody></table>

        <div class="tblareabtn button">
          <p><input type="submit" class="box150 confirm" alt="確認ページへ" name="confirm" id="confirm"></p>
        </div>
        </form>

		</div>
		</div>


  	</div>
  	</div>

<div class="footer">copyright</div>
</div>
</body>
</html>