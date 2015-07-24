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

<?php
//▼新規会員登録用変数
session_start();

$last_name = " ";

// if(!empty($_POST)){
//   //エラー項目の確認
//   if($_POST['first_name'] == ''){
//     $error['first_name'] = 'blank';
//   }
//   if($_POST['last_name'] == ''){
//   	$error['last_name'] = 'blank';
//   }
//   if($_POST['first_kana'] == ''){
//   	$error['first_kana'] = 'blank';
//   }
//   if($_POST['last_kana'] == ''){
//   	$error['last_kana'] = 'blank';
//   }
//   if($_POST['sex'] == ''){
//     $error['sex'] = 'blank';
//   }
//   if($_POST['year'] == ''){
//   	$error['year'] = 'blank';
//   }
//   if($_POST['month'] == ''){
//   	$error['month'] = 'blank';
//   }
//   if($_POST['day'] == ''){
//   	$error['day'] = 'blank';
//   }
//   if($_POST['address_number_head'] == ''){
//   	$error['address_number_head'] = 'blank';
//   }
//   if($_POST['address_number_bottom'] == ''){
//   	$error['address_number_bottom'] = 'blank';
//   }
//   if($_POST['phone_number_1'] == ''){
//   	$error['phone_number_1'] = 'blank';
//   }
//   if($_POST['phone_number_2'] == ''){
//   	$error['phone_number_2'] = 'blank';
//   }
//   if($_POST['phone_number_3'] == ''){
//   	$error['phone_number_3'] = 'blank';
//   }
//   if($_POST['email'] == ''){
//   	$error['email'] = 'blank';
//   }
//   if($_POST['jpb'] == ''){
//   	$error['jpb'] = 'blank';
//   }
//   if(strlen($_POST['pass']) < 8){
//     $error['pass'] = 'length';
//   }
//   if($_POST['pass'] == ''){
//     $error['pass'] = 'blank';
//   }

//   if(empty($error)){
//     $_SESSION['join'] = $_POST;
//     header('Location: user_confirmation.php');
//     exit();
//   }
// }

?>

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