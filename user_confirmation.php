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
		    <form name="form1" id="form1" method="post" action="?">
<!--         <input type="hidden" name="transactionid" value="8817517b795b38e142d73a543572064526d533cc"> -->
<!--         <input type="hidden" name="mode" value="confirm"> -->

<!--         <script type="text/javascript" charset="utf-8" src="https://api.socialplus.jp/zoff/test/form_assist/assist.js"></script> -->

        		<table summary="会員登録フォーム">
                  <tbody><tr class="name">
		            <th>お名前</th>
		            <td class="cont">
		              <p>
						姓&nbsp;&nbsp;<input type="text" name="name01" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">&nbsp;
					    名&nbsp;&nbsp;<input type="text" name="name02" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">
		              </p>
		            </td>
		          </tr>
		          <tr class="name">
		            <th>お名前(フリガナ)</th>
		            <td class="cont">
		              <p>
					    セイ&nbsp;<input type="text" name="kana01" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">&nbsp;
					    メイ&nbsp;<input type="text" name="kana02" value="" maxlength="50" style="; ime-mode: active;" size="15" class="box120">
		              </p>
		            </td>
		          </tr>
		          <tr class="gender">
		            <th>性別</th>
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
<option label="1901" value="1901">1901</option>
<option label="1902" value="1902">1902</option>
<option label="1903" value="1903">1903</option>
<option label="1904" value="1904">1904</option>
<option label="1905" value="1905">1905</option>
<option label="1906" value="1906">1906</option>
<option label="1907" value="1907">1907</option>
<option label="1908" value="1908">1908</option>
<option label="1909" value="1909">1909</option>
<option label="1910" value="1910">1910</option>
<option label="1911" value="1911">1911</option>
<option label="1912" value="1912">1912</option>
<option label="1913" value="1913">1913</option>
<option label="1914" value="1914">1914</option>
<option label="1915" value="1915">1915</option>
<option label="1916" value="1916">1916</option>
<option label="1917" value="1917">1917</option>
<option label="1918" value="1918">1918</option>
<option label="1919" value="1919">1919</option>
<option label="1920" value="1920">1920</option>
<option label="1921" value="1921">1921</option>
<option label="1922" value="1922">1922</option>
<option label="1923" value="1923">1923</option>
<option label="1924" value="1924">1924</option>
<option label="1925" value="1925">1925</option>
<option label="1926" value="1926">1926</option>
<option label="1927" value="1927">1927</option>
<option label="1928" value="1928">1928</option>
<option label="1929" value="1929">1929</option>
<option label="1930" value="1930">1930</option>
<option label="1931" value="1931">1931</option>
<option label="1932" value="1932">1932</option>
<option label="1933" value="1933">1933</option>
<option label="1934" value="1934">1934</option>
<option label="1935" value="1935">1935</option>
<option label="1936" value="1936">1936</option>
<option label="1937" value="1937">1937</option>
<option label="1938" value="1938">1938</option>
<option label="1939" value="1939">1939</option>
<option label="1940" value="1940">1940</option>
<option label="1941" value="1941">1941</option>
<option label="1942" value="1942">1942</option>
<option label="1943" value="1943">1943</option>
<option label="1944" value="1944">1944</option>
<option label="1945" value="1945">1945</option>
<option label="1946" value="1946">1946</option>
<option label="1947" value="1947">1947</option>
<option label="1948" value="1948">1948</option>
<option label="1949" value="1949">1949</option>
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
					    〒 &nbsp;<input type="text" name="zip01" value="" maxlength="3" style="; ime-mode: disabled;" size="6" class="box60">&nbsp;-&nbsp;<input type="text" name="zip02" value="" maxlength="4" style="; ime-mode: disabled;" size="6" class="box60">&nbsp;
		    			</p>
		            </td>
		          </tr>
		          <tr class="address">
		            <th>住所</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
				      			    <select name="pref" style="">
					      <option value="" selected="selected">都道府県を選択</option>
					      <option label="北海道" value="1">北海道</option>
<option label="青森県" value="2">青森県</option>
<option label="岩手県" value="3">岩手県</option>
<option label="宮城県" value="4">宮城県</option>
<option label="秋田県" value="5">秋田県</option>
<option label="山形県" value="6">山形県</option>
<option label="福島県" value="7">福島県</option>
<option label="茨城県" value="8">茨城県</option>
<option label="栃木県" value="9">栃木県</option>
<option label="群馬県" value="10">群馬県</option>
<option label="埼玉県" value="11">埼玉県</option>
<option label="千葉県" value="12">千葉県</option>
<option label="東京都" value="13">東京都</option>
<option label="神奈川県" value="14">神奈川県</option>
<option label="新潟県" value="15">新潟県</option>
<option label="富山県" value="16">富山県</option>
<option label="石川県" value="17">石川県</option>
<option label="福井県" value="18">福井県</option>
<option label="山梨県" value="19">山梨県</option>
<option label="長野県" value="20">長野県</option>
<option label="岐阜県" value="21">岐阜県</option>
<option label="静岡県" value="22">静岡県</option>
<option label="愛知県" value="23">愛知県</option>
<option label="三重県" value="24">三重県</option>
<option label="滋賀県" value="25">滋賀県</option>
<option label="京都府" value="26">京都府</option>
<option label="大阪府" value="27">大阪府</option>
<option label="兵庫県" value="28">兵庫県</option>
<option label="奈良県" value="29">奈良県</option>
<option label="和歌山県" value="30">和歌山県</option>
<option label="鳥取県" value="31">鳥取県</option>
<option label="島根県" value="32">島根県</option>
<option label="岡山県" value="33">岡山県</option>
<option label="広島県" value="34">広島県</option>
<option label="山口県" value="35">山口県</option>
<option label="徳島県" value="36">徳島県</option>
<option label="香川県" value="37">香川県</option>
<option label="愛媛県" value="38">愛媛県</option>
<option label="高知県" value="39">高知県</option>
<option label="福岡県" value="40">福岡県</option>
<option label="佐賀県" value="41">佐賀県</option>
<option label="長崎県" value="42">長崎県</option>
<option label="熊本県" value="43">熊本県</option>
<option label="大分県" value="44">大分県</option>
<option label="宮崎県" value="45">宮崎県</option>
<option label="鹿児島県" value="46">鹿児島県</option>
<option label="沖縄県" value="47">沖縄県</option>

					    </select>
		                <!-- select -->
		              <p>
		              	<input type="text" name="addr01" value="" size="60" class="box300" style="; ime-mode: active;"><br>
		     			市区町村名番地（例：千代田区神田神保町1-3-5）<br>
		     		  </p>
		              <p>
		              	<input type="text" name="addr02" value="" size="60" class="box300" style="; ime-mode: active;"><br>
		      			ビル名（例：Zoffビル6階）
		      		  </p>
		              <p class="notice">住所は2つに分けてご記入いただけます。ビル・マンション名は必ず記入してください。</p>
		            </td>
		          </tr>
		          <tr class="number">
		            <th>電話番号</th>
		            <td class="must"><img src="images/form_icon_must.png" alt="必須"></td>
		            <td class="cont">
		              <p>
					   <input type="text" name="tel01" value="" maxlength="6" size="6" style="; ime-mode: disabled;" class="box60">&nbsp;-&nbsp;<input type="text" name="tel02" value="" maxlength="6" size="6" style="; ime-mode: disabled;" class="box60">&nbsp;-&nbsp;<input type="text" name="tel03" value="" maxlength="6" size="6" style="; ime-mode: disabled;" class="box60">
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