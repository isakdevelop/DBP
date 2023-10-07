<?php
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<script>";
echo "var id_arr = new Array();"; //아이디를 저장할 배열 선언.
echo "</script>";

$sql = "SELECT id FROM user_infomation";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
  $idFromDB = $row['id'];

  echo "<script>";
  echo "var id = '$idFromDB';"; // 데이터베이스에 있는 id값을 자바스크립트 id 변수에 저장.
  echo "id_arr.push(id);"; //id 배열에 저장.
  echo "</script>";
}
?>

<!DOCTYPE html>
<html lnag="ko">
    <head>
        <meta charset="UTF-8">
        <title>회원가입</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/sign_up.css">
        <link rel="shortcut icon" href="./img/titleLogo.png">
        <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    </head>
    <body class="container col-12 mx-auto">
        <!-- header -->
        <div id="header">
            <div class="main-logo">
            <button class="main-button col-12" onclick="location.href='./main.php'">
               <picture>
                  <source media="(max-width: 400px)" srcset="./img/titleLogoS.png">
                  <img src="./img/titleLogo.png">
               </picture>
            </button>
         </div>
        </div>


        <!-- wrapper -->
        <div id="wrapper">
            <!-- content-->
            <form id="content">
                <!-- ID -->
                <div>
                    <h3 class="join_title">
                        <label for="id">아이디 <small> (필수)</small> </label>
                    </h3>
                    <span class="box int_id">
                        <input type="text" id="id" name="id" class="int" maxlength="20" placeholder="아이디" onchange="check_id()">
                    </span>
                    <span id = "check_id_1" style="color:red">&nbsp;필수 입력 정보입니다!</span>
                    <span id = "check_id_2" style="color:green">&nbsp;멋진 아이디네요!</span>
                    <span id = "check_id_3" style="color:red">&nbsp;5~15자의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다.</span>
                    <span id = "check_id_4" style="color:red">&nbsp;이미 사용중인 아이디입니다!</span>
                    <!-- <span class="error_next_box"></span> -->
                </div>

                <!-- PW1 -->
                <div>
                    <h3 class="join_title"><label for="pswd1">비밀번호<small> (필수)</small></label></h3>
                    <span class="box int_pass">
                        <input type="password" id="pswd1" name="pswd1" class="int" maxlength="20" placeholder="비밀번호" onchange="check_pw()">
                        <!-- <span id="alertTxt">사용불가</span> -->
                        <img src="./img/pwicon.png" id="pswd1_img1" class="pswdImg">
                    </span>
                    <span id = "check_pw_1" style="color:red">&nbsp;필수 입력 정보입니다!</span>
                    <span id = "check_pw_2" style="color:green">&nbsp;안전한 비밀번호입니다!</span>
                    <span id = "check_pw_3">&nbsp;8~16자 영문 대소문자, 숫자, 특수문자를 사용하세요. 사용 가능한 특수문자는 !, @, #, $, %, & 입니다.</span>
                    <!-- <span class="error_next_box"></span> -->
                </div>

                <!-- PW2 -->
                <div>
                    <h3 class="join_title"><label for="pswd2">비밀번호 재확인</label></h3>
                    <span class="box int_pass_check">
                        <input type="password" id="pswd2" name="pswd2" class="int" maxlength="20" placeholder="비밀번호 재입력" onchange="compare_pw()">
                        <img src="./img/check_pwicon.png" id="pswd2_img1" class="pswdImg">
                    </span>
                    <span id = "compare_pw_1">&nbsp;필수 입력 정보입니다!</span>
                    <span id = "compare_pw_2" style="color:blue">&nbsp;비밀번호가 일치합니다!</span>
                    <span id = "compare_pw_3" style="color:red">&nbsp;비밀번호가 일치하지않습니다!</span>
                    <!-- <span class="error_next_box"></span> -->
                </div>

                <!-- NAME -->
                <div>
                    <h3 class="join_title"><label for="name">이름<small> (필수)</small></label></h3>
                    <span class="box int_name">
                        <input type="text" id="name" name="name" class="int" maxlength="20" onchange="check_name()">
                    </span>
                    <!-- <span class="error_next_box"></span> -->
                </div>

                <!-- BIRTH -->
                <div>
                    <h3 class="join_title"><label for="yy">생년월일<small> (필수)</small></label></h3>
                    <div id="bir_wrap">
                        <!-- BIRTH_YY -->
                        <div id="bir_yy">
                            <span class="box">
                                <input type="text" id="yy" name="yy" class="int" maxlength="4" placeholder="년" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="check_year()" onblur="check_year()">
                            </span>
                        </div>
                        <!-- BIRTH_MM -->
                        <div id="bir_mm">
                            <span class="box">
                                <select id="mm" name="mm" class="sel" onchange="check_day()" onblur="check_day()">
                                    <option>월</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </span>
                        </div>
                        <!-- BIRTH_DD -->
                        <div id="bir_dd">
                            <span class="box">
                                <input type="text" id="dd" name="dd" class="int" maxlength="2" placeholder="일" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onchange="check_day()" onblur="check_day()">
                            </span>
                        </div>
                    </div>
                    <span id = "check_year" style="color:red">태어난 년도 4자리를 정확하게 입력하세요.</span>
                    <span id = "check_day" style="color:red">태어난 일(날짜)를 정확하게 입력하세요.</span>
                    <span id = "check_yy_dd" style="color:red">생년월일을 다시 확인해주세요.</span>
                    <span id = "this_is_real" style="color:red">정말이세요?</span>
                    <!-- <span class="error_next_box"></span>     -->
                </div>

                <!-- GENDER -->
                <div>
                    <h3 class="join_title"><label for="gender">성별<small> (필수)</small></label></h3>
                    <span class="box gender_code">
                        <select id="gender" name="gender" class="sel" onchange="check_gender()">
                            <option>성별</option>
                            <option value="남">남자</option>
                            <option value="여">여자</option>
                        </select>
                    </span>
                    <!-- <span class="error_next_box">필수 정보입니다.</span> -->
                </div>

                <!-- EMAIL -->
                <div>
                    <h3 class="join_title"><label for="email">본인확인 이메일<small> (선택)</small></label></h3>
                    <span class="box int_email">
                        <input type="text" id="email" name="email" class="int" maxlength="100" placeholder="선택입력" onchange="check_email()">
                    </span>
                    <span id = "check_email_1" style="color:blue">&nbsp;사용 가능한 이메일입니다!</span>
                    <span id = "check_email_2" style="color:red">&nbsp;이메일 형식이 올바르지않습니다!</span>
                    <!-- <span class="error_next_box">이메일 주소를 다시 확인해주세요.</span>     -->
                </div>

                <!-- MOBILE -->
                <div>
                    <h3 class="join_title"><label for="phoneNo">휴대전화<small> (필수)</small></label></h3>
                    <span class="box int_mobile">
                        <!-- <input type="tel" id="mobile" class="int" maxlength="16" placeholder="전화번호 입력" required> -->
                        <input type="number" id="phone" name="phone" class="int" placeholder="전화번호 입력" oninput='handleOnInput(this, 11)' onchange="check_phone()">
                    </span>
                    <!-- <span class="error_next_box"></span>     -->
                </div>


                <!-- JOIN BTN-->
                <div class="btn_area">
                    <button type="button" id="btnJoin" onclick="history.back()">
                        <span>이 전</span>
                    </button>
                    <button type="button" id="btnJoin" class="join_up" onclick="signup()">
                        <!-- type을 submit에서 button으로 변경함 -->
                        <span>등 록</span>
                    </button>
                </div>
                <footer>
                    <div class="copyright-wrap">
                    <span> Copyright © SCHNET Corp. All Rights Reserved.</span>
                    </div>
                </footer>
            </form>
            <!-- content-->
        </div>
        <!-- wrapper -->
        <script
            src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
            integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
            crossorigin="anonymous">
        </script>
        <script>
          var pass_id = false;
          var pass_pw = false;
          var pass_cpw = false;
          var pass_name = false;
          var pass_yy = false;
          var pass_dd = false;
          var pass_gender = false;
          var pass_email = true;
          var pass_phone = false;

          function check_id(){
            var id = document.getElementById('id').value;
            var id_reg = /^[a-z0-9_-]{5,15}/;
            if(id.length != 0){
              if(id_reg.test(id)){
                if (id_arr.length == 0) {
                  document.getElementById("check_id_1").style.display = 'none'
                  document.getElementById("check_id_2").style.display = 'block'
                  document.getElementById("check_id_3").style.display = 'none'
                  document.getElementById("check_id_4").style.display = 'none'
                  pass_id = true;
                  return;
                }
                for(var i = 0; i < id_arr.length; i++){
                  if(id_arr[i] == id){
                    document.getElementById("check_id_1").style.display = 'none'
                    document.getElementById("check_id_2").style.display = 'none'
                    document.getElementById("check_id_3").style.display = 'none'
                    document.getElementById("check_id_4").style.display = 'block'
                    pass_id = false;
                    return;
                  }
                  else {
                    document.getElementById("check_id_1").style.display = 'none'
                    document.getElementById("check_id_2").style.display = 'block'
                    document.getElementById("check_id_3").style.display = 'none'
                    document.getElementById("check_id_4").style.display = 'none'
                    pass_id = true;
                  }
                }
              }
              else {
                document.getElementById("check_id_1").style.display = 'none'
                document.getElementById("check_id_2").style.display = 'none'
                document.getElementById("check_id_3").style.display = 'block'
                document.getElementById("check_id_4").style.display = 'none'
                pass_id = false;
              }
            }
            else {
              document.getElementById("check_id_1").style.display = 'block'
              document.getElementById("check_id_2").style.display = 'none'
              document.getElementById("check_id_3").style.display = 'none'
              document.getElementById("check_id_4").style.display = 'none'
              pass_id = false;
            }
          }
          function check_pw(){
            var pw = document.getElementById('pswd1').value;
            var chk_pw = document.getElementById('pswd2').value;
            var reg = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,16}$/;

            if (pw.length != 0) {
              if(reg.test(pw)){
                document.getElementById("check_pw_1").style.display = 'none';
                document.getElementById("check_pw_2").style.display = 'block';
                document.getElementById("check_pw_3").style.display = 'none';
                pass_pw = true;
              }
              else {
                document.getElementById("check_pw_1").style.display = 'none';
                document.getElementById("check_pw_2").style.display = 'none';
                document.getElementById("check_pw_3").style.display = 'block';
                pass_pw = false;
              }
            }
            else {
              document.getElementById("check_pw_1").style.display = 'block';
              document.getElementById("check_pw_2").style.display = 'none';
              document.getElementById("check_pw_3").style.display = 'none';
              pass_pw = false;
            }
            if((pw.length != 0 && chk_pw.length != 0) && pw == chk_pw){
              document.getElementById("compare_pw_1").style.display = 'none';
              document.getElementById("compare_pw_2").style.display = 'block';
              document.getElementById("compare_pw_3").style.display = 'none';
            }
            else if((pw.length != 0 && chk_pw.length != 0) && pw != chk_pw){
              document.getElementById("compare_pw_1").style.display = 'none';
              document.getElementById("compare_pw_2").style.display = 'none';
              document.getElementById("compare_pw_3").style.display = 'block';
            }
          }
          function compare_pw() {
            var input_pw = document.getElementById('pswd1').value;
            var chk_pw = document.getElementById('pswd2').value;

            if((input_pw.length != 0 && chk_pw.length != 0) && input_pw == chk_pw){
              document.getElementById("compare_pw_1").style.display = 'none';
              document.getElementById("compare_pw_2").style.display = 'block';
              document.getElementById("compare_pw_3").style.display = 'none';
              pass_cpw = true;
            }
            else if (chk_pw.length == 0) {
              document.getElementById("compare_pw_1").style.display = 'block';
              document.getElementById("compare_pw_2").style.display = 'none';
              document.getElementById("compare_pw_3").style.display = 'none';
              pass_cpw = false;
            }
            else {
              document.getElementById("compare_pw_1").style.display = 'none';
              document.getElementById("compare_pw_2").style.display = 'none';
              document.getElementById("compare_pw_3").style.display = 'block';
              pass_cpw = false;
            }
          }
          function check_name(){
            var name = document.getElementById('name').value;
            if (name.length == 0) {
              pass_name = false;
            }
            else {
              pass_name = true;
            }
          }
          function check_year(){
            var year = document.getElementById('yy').value;
            var time = new Date();
            if (year.length != 4) {
              document.getElementById("check_year").style.display = 'block';
              document.getElementById("check_day").style.display = 'none';
              document.getElementById("check_yy_dd").style.display = 'none';
              document.getElementById("this_is_real").style.display = "none";
              pass_yy = false;
            }
            else {
              if (Number(year) <= time.getFullYear() - 100 || Number(year) >= time.getFullYear() + 100) {
                document.getElementById("check_year").style.display = 'none';
                document.getElementById("check_day").style.display = 'none';
                document.getElementById("check_yy_dd").style.display = 'none';
                document.getElementById("this_is_real").style.display = "block";
                pass_yy = false;
              }
              else {
                document.getElementById("check_year").style.display = 'none';
                document.getElementById("check_day").style.display = 'none';
                document.getElementById("check_yy_dd").style.display = 'none';
                document.getElementById("this_is_real").style.display = "none";
                pass_yy = true;
              }
            }
          }
          function check_day(){
            var year = document.getElementById('yy').value;
            var month = document.getElementById('mm').value;
            var day = document.getElementById('dd').value;
            var time = new Date();
            if (day == "0" || day == "00") {
              document.getElementById("check_day").style.display = 'none';
              document.getElementById("check_year").style.display = 'none';
              document.getElementById("check_yy_dd").style.display = 'block';
              document.getElementById("this_is_real").style.display = "none";
              pass_dd = false;
            }
            if (day != "0" && day.length == 1) {
              document.getElementById("check_day").style.display = 'none';
              document.getElementById("check_year").style.display = 'none';
              document.getElementById("check_yy_dd").style.display = 'none';
              document.getElementById("this_is_real").style.display = "none";
              pass_dd = true;
            }
            else if (day != "00" && day.length == 2) {
              if (month == "01" || month == "03" || month == "05" || month == "07" || month == "08" || month == "10" || month == "12") {
                if (Number(day) >= 1 && Number(day) <= 31) {
                  document.getElementById("check_day").style.display = 'none';
                  document.getElementById("check_year").style.display = 'none';
                  document.getElementById("check_yy_dd").style.display = 'none';
                  document.getElementById("this_is_real").style.display = "none";
                  pass_dd = true;
                }
                else {
                  document.getElementById("check_day").style.display = 'none';
                  document.getElementById("check_year").style.display = 'none';
                  document.getElementById("check_yy_dd").style.display = 'block';
                  document.getElementById("this_is_real").style.display = "none";
                  pass_dd = false;
                }
              }
              else if (month == "02"){
                if ((Number(year) % 4 == 0 && Number(year) % 100 != 0) || Number(year) % 400 == 0) {
                  if (Number(day) >= 1 && Number(day) <= 29){
                    document.getElementById("check_day").style.display = 'none';
                    document.getElementById("check_year").style.display = 'none';
                    document.getElementById("check_yy_dd").style.display = 'none';
                    document.getElementById("this_is_real").style.display = "none";
                    pass_dd = true;
                  }
                  else {
                    document.getElementById("check_day").style.display = 'none';
                    document.getElementById("check_year").style.display = 'none';
                    document.getElementById("check_yy_dd").style.display = 'block';
                    document.getElementById("this_is_real").style.display = "none";
                    pass_dd = false;
                  }
                }
              else {
                  if (Number(day) >= 1 && Number(day) <= 28){
                    document.getElementById("check_day").style.display = 'none';
                    document.getElementById("check_year").style.display = 'none';
                    document.getElementById("check_yy_dd").style.display = 'none';
                    document.getElementById("this_is_real").style.display = "none";
                    pass_dd = true;
                  }
                  else {
                    document.getElementById("check_day").style.display = 'none';
                    document.getElementById("check_year").style.display = 'none';
                    document.getElementById("check_yy_dd").style.display = 'block';
                    document.getElementById("this_is_real").style.display = "none";
                    pass_dd = false;
                  }
                }
              }
              else if (month == "04" || month == "06" || month == "09" || month == "11") {
                if (Number(day) >= 1 && Number(day) <= 30) {
                  document.getElementById("check_day").style.display = 'none';
                  document.getElementById("check_year").style.display = 'none';
                  document.getElementById("check_yy_dd").style.display = 'none';
                  document.getElementById("this_is_real").style.display = "none";
                  pass_dd = true;
                }
                else {
                  document.getElementById("check_day").style.display = 'block';
                  document.getElementById("check_year").style.display = 'none';
                  document.getElementById("check_yy_dd").style.display = 'none';
                  document.getElementById("this_is_real").style.display = "none";
                  pass_dd = false;
                }
              }
            }
          }
          function check_gender(){
            var gender = document.getElementById('gender').value;
            if (gender == "") {
              pass_gender = false;
            }
            else {
              pass_gender = true;
            }
          }
          function check_email(){
            var email = document.getElementById('email').value;
            var regExp = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
            if (email.length != 0) {
              if (regExp.test(verify)) {
                document.getElementById("check_email_1").style.display = 'block';
                document.getElementById("check_email_2").style.display = 'none';
                pass_email = true;
              }
              else {
                document.getElementById("check_email_1").style.display = 'none';
                document.getElementById("check_email_2").style.display = 'block';
                pass_email = false;
              }
            }
            else {
              document.getElementById("check_email_1").style.display = 'none';
              document.getElementById("check_email_2").style.display = 'none';
              pass_email = true;
            }
          }
          function handleOnInput(el, maxlength) {  //휴대전화에서 숫자 제한.
            if(el.value.length > maxlength)  {
              el.value
              = el.value.substr(0, maxlength);
            }
          }
          function check_phone(){
            var phone = document.getElementById('phone').value;
            if (phone.length == 0) {
              pass_phone = false;
            }
            else {
              pass_phone = true;
            }
          }
          function signup(){
            var id = document.getElementById('id').value;
            var pw = document.getElementById('pswd1').value;
            var cpw = document.getElementById('pswd2').value;
            var name = document.getElementById('name').value;
            var year = document.getElementById('yy').value;
            var month = document.getElementById('mm').value;
            var day = document.getElementById('dd');
            var day_value = day.value;
            if (day_value.length == 1) {
              day.value = "0" + day_value;
            }
            var gender = document.getElementById('gender').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            if(id != '' && pw != '' && cpw != '' && name != '' && year != '' && month != ''&& day != '' && gender != '' && phone != ''){
              if(pass_id == false){
                alert('아이디 설정이 잘못되었습니다!');
                return;
              }
              if (pass_pw == false) {
                alert('비밀번호 설정이 잘못되었습니다!');
                return;
              }
              if (pass_cpw == false) {
                alert('비밀번호 확인이 잘못되었습니다!');
                return;
              }
              if (pass_yy == false) {
                alert('년도의 설정이 잘못되었습니다!');
                return;
              }
              if (pass_dd == false) {
                alert('날짜(일)의 설정이 잘못되었습니다!');
                return;
              }
              if (pass_name == false) {
                alert('이름을 입력해주세요!');
                return;
              }
              if (pass_gender == false) {
                alert('성별을 입력해주세요!');
                return;
              }
              if (pass_email == false) {
                alert('이메일 설정이 잘못되었습니다!');
                return;
              }
              if (pass_phone == false) {
                alert('휴대폰 번호 설정이 잘못되었습니다!');
                return;
              }
              var day = document.getElementById('dd').value;  //사용자 입력 날이 한 자릿 수 인 경우 앞에 0을 붙여줌. 따라서 위에서 value에 0을 붙이고 다시 선언해서 불러옴.
              location.href="./sign_up_Process.php?id="+id+"&pw="+pw+"&cpw="+cpw+"&name="+name+"&year="+year+"&month="+month+"&day="+day+"&gender="+gender+"&email="+email+"&phone="+phone;
            }
            else{
              alert('모두 입력 해주세요.');
            }
          }
        </script>
    </body>
</html>
