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

$sql = "SELECT polNum FROM Police";

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
                        <label for="id">경찰번호 <small> (필수)</small> </label>
                    </h3>
                    <span class="box int_id">
                        <input type="text" id="id" name="id" class="int" maxlength="20" placeholder="아이디" onchange="check_id()">
                    </span>
                    <span id = "check_id_1" style="color:red">&nbsp;필수 입력 정보입니다!</span>
                    <span id = "check_id_2" style="color:green">&nbsp;멋진 아이디네요!</span>
                    <span id = "check_id_3" style="color:red">&nbsp;이미 사용중인 아이디입니다!</span>
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
                <!-- police_station_in_charge -->
                <div>
                    <h3 class="join_title"><label for="p1">소속 서<small> (필수)</small></label></h3>
                    <span class="box int_name">
                        <input type="text" id="p1" name="p2" class="int" maxlength="20" onchange="check_pol()">
                    </span>
                    <!-- <span class="error_next_box"></span> -->
                </div>
                <!-- jurisdition -->
                <div>
                    <h3 class="join_title"><label for="p2">소속 부서<small> (필수)</small></label></h3>
                    <span class="box int_name">
                        <input type="text" id="p2" name="p2" class="int" maxlength="20" onchange="check_dep()">
                    </span>
                    <!-- <span class="error_next_box"></span> -->
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
                        <span>가 입</span>
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
        <script>
          var pass_id = false;
          var pass_pw = false;
          var pass_cpw = false;
          var pass_name = false;
          var pass_pol = false;
          var pass_dep = false;
          var pass_phone = false;

          function check_id(){
            var id = document.getElementById('id').value;
            if(id.length != 0){
                if (id_arr.length == 0) {
                  document.getElementById("check_id_1").style.display = 'none'
                  document.getElementById("check_id_2").style.display = 'block'
                  document.getElementById("check_id_3").style.display = 'none'
                  pass_id = true;
                  return;
                }
                for(var i = 0; i < id_arr.length; i++){
                  if(id_arr[i] == id){
                    document.getElementById("check_id_1").style.display = 'none'
                    document.getElementById("check_id_2").style.display = 'none'
                    document.getElementById("check_id_3").style.display = 'block'
                    pass_id = false;
                    return;
                  }
                  else {
                    document.getElementById("check_id_1").style.display = 'none'
                    document.getElementById("check_id_2").style.display = 'block'
                    document.getElementById("check_id_3").style.display = 'none'
                    pass_id = true;
                  }
                }
            }
            else {
              document.getElementById("check_id_1").style.display = 'block'
              document.getElementById("check_id_2").style.display = 'none'
              document.getElementById("check_id_3").style.display = 'none'
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

          function check_pol(){
            var pol = document.getElementById('p1').value;
            if (pol.length == 0) {
              pass_pol = false;
            }
            else {
              pass_pol = true;
            }
          }

          function check_dep(){
            var dep = document.getElementById('p2').value;
            if (dep.length == 0) {
              pass_dep = false;
            }
            else {
              pass_dep = true;
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
            var phone = document.getElementById('phone').value;
            var pol = document.getElementById('p1').value;
            var dep = document.getElementById('p2').value;
            if(id != '' && pw != '' && cpw != '' && name != '' && phone != '' && pol != '' && dep != ''){
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
              if (pass_name == false) {
                alert('이름을 입력해주세요!');
                return;
              }
              if (pass_pol == false) {
                alert('소속 서를 입력해주세요!');
                return;
              }
              if (pass_dep == false) {
                alert('소속 부서를 입력해주세요!');
                return;
              }
              if (pass_phone == false) {
                alert('휴대폰 번호 설정이 잘못되었습니다!');
                return;
              }
              location.href="./pol_sign_up_Process.php?id="+id+"&pw="+pw+"&name="+name+"&pol="+pol+"&dep="+dep+"&phone="+phone;
            }
            else{
              alert('모두 입력 해주세요.');
            }
          }
        </script>
    </body>
</html>
