<?php
session_start();
$userName = $_SESSION['name'] ?? '';
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userEmail = $_SESSION['email'] ?? '';
$polPsic = $_SESSION['psic'] ?? '';
$polJurisdiction = $_SESSION['jurisdiction'] ?? '';
$userPhone = $_SESSION['phone'];
$userPw = $_SESSION['pw'];

if($userId == ''){
  echo "<script>";
  echo "alert('로그인 후 이용해주세요!');";
  echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
  echo "</script>";
}

echo "<script>";
echo "var obj={
  'name' : '$userName',
  'id' : '$userId',
  'polNum' : '$polNum',
  'email' : '$userEmail',
  'psic' : '$polPsic',
  'jur' : '$polJurisdiction',
  'phone' : '$userPhone',
  'pw' : '$userPw'
};";
echo "</script>";

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="./css/join_data_modifiy_main_ver.css" type="text/css" rel="stylesheet" >

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <!-- javascript -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function(){
      var pass_email = false;
    })
    </script>
    <title>스치넷 - 회원정보수정</title>
</head>
<body>
    <div class="header">
        <button class="title_logo" onclick="location.href='main.php'"><img class="title_img" src="./img/titleLogo_WN2.png" alt=""></button>
        <div class="header_logo"></div>
        <div class="header_menu">
          <?php
          if($polNum != ''){
          ?>
          <li class="nav"><a class="menu" id="police_nav" href="insert_pick.php">실종자 & 수배자 등록</a></li>
          <li class="nav"><a class="menu" href="missing_person_info.php">실종자 조회</a></li>
          <li class="nav"><a class="menu" href="criminal_info.php">수배자 조회</a></li>
          <li class="nav"><a class="menu" href="report_pick.php">목격자 게시판</a></li>
          <li class="nav"><a class="menu" href="danger_map_result.php">취약지역 조회</a></li>
          <?php
          }
          else{
          ?>
          <li class="nav"><a class="menu" href="missing_person_info.php">실종자 조회</a></li>
          <li class="nav"><a class="menu" href="criminal_info.php">수배자 조회</a></li>
          <li class="nav"><a class="menu" href="report_pick.php">목격자 게시판</a></li>
          <li class="nav"><a class="menu" href="danger_map.php">취약지역 등록</a></li>
          <?php
          }
          ?>
            <!-- 슬라이드 메뉴 -->
            <input type="checkbox" id="menuicon">
            <label for="menuicon">
                <span id="line"></span>
                <span id="line"></span>
                <span id="line"></span>
            </label>
            <div class="sidebar">
              <?php
                if($userId == ''){
              ?>
                <div id="not_login" class="mypage">
                    <p style="color: black; margin-top: 30px; font-size: 15px;">로그인해주세요.</p>
                    <button id="login" class="slide_button" onclick="location.href='login.php'" style="background-color: white; width: 70px; height: 40px;">로그인</button>
                    <button id="sign_up" class="slide_button" onclick="location.href='join_pick.php'" style="background-color: white; width: 70px; height: 40px;">회원가입</button>
                </div>
              <?php
                }
                else if($polNum == ''){
              ?>
                <div id="basic_user" class="mypage">
                    <p style="color: black; margin-top: 30px; font-size: 15px;"><small style="color: black; font-size: 0.5em;">일반 사용자</small><br><span id="name"><?=$userName?></span>님 <br>환영합니다.</p>
                    <button class="slide_button" style="background-color: white; width: 70px; height: 40px;" onclick="logout_func()">로그아웃</button>
                    <button class="slide_button" style="background-color: white; width: 70px; height: 40px;" onclick="location.href='join_data_modifiy_main_ver.php'">정보수정</button>
                </div>
              <?php
                }
                else{
              ?>
                <div id="admin_user" class="mypage">
                    <p style="color: black; margin-top: 30px; font-size: 15px;"><small style="color: black; font-size: 0.5em;">관리자</small><br><span id="name"><?=$userName?></span>님 <br>환영합니다.</p>
                    <button class="slide_button" style="background-color: white; width: 65px; height: 30px;" onclick="logout_func()">로그아웃</button>
                    <button class="slide_button" style="background-color: white; width: 65px; height: 30px;" onclick="location.href='join_data_modifiy_main_ver.php'">정보수정</button>
                    <button class="slide_button" style="background-color: white; width: 65px; height: 30px;" onclick="location.href='missing_person_map.php'">클러스터</button>
                </div>
              <?php
                }
              ?>
            </div>
            <!-- 여기까지가 슬라이드 메뉴 -->
        </div>
    </div>
    <div class="main_page">
        <div class="sub_frame">
          <?php if($polNum == ''){
          ?>
            <div class="basic">
                <!-- wrapper -->
                <div id="wrapper">
                    <h1 class="modifiy_title">회원정보 수정</h1>
                    <!-- content-->
                    <form id="content">

                        <!-- PW1 -->
                        <div>
                            <h3 class="join_title"><label for="pswd1">현재 비밀번호</label></h3>
                            <span class="box int_pass">
                                <input type="password" id="pswd1" class="int" maxlength="20" placeholder="현재 비밀번호">
                                <!-- <span id="alertTxt">사용불가</span> -->
                                <img src="./img/pwicon.png" id="pswd1_img1" class="pswdImg">
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- PW2 -->
                        <div>
                            <h3 class="join_title"><label for="pswd2">변경할 비밀번호</label></h3>
                            <span class="box int_pass_check">
                                <input type="password" id="pswd2" class="int" maxlength="20" placeholder="변경할 비밀번호">
                                <img src="./img/pwicon.png" id="pswd2_img1" class="pswdImg">
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- PW2 -->
                        <div>
                            <h3 class="join_title"><label for="pswd3">비밀번호 재확인</label></h3>
                            <span class="box int_pass_check">
                                <input type="password" id="pswd3" class="int" maxlength="20" placeholder="비밀번호 재입력">
                                <img src="./img/check_pwicon.png" id="pswd2_img1" class="pswdImg">
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- NAME -->
                        <div>
                            <h3 class="join_title"><label for="name">이름</label></h3>
                            <span class="box int_name" id="aaaa">
                                <input type="text" id="join_name" class="int" value="<?=$userName?>" maxlength="20" readonly>
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <h3 class="join_title"><label for="email">본인확인 이메일 <small> (선택)</small></label></h3>
                            <span class="box int_email">
                                <input type="text" id="email" class="int" value="<?=$userEmail?>" maxlength="100" placeholder="선택입력" onchange="check_email()">
                            </span>
                            <!-- <span class="error_next_box">이메일 주소를 다시 확인해주세요.</span>     -->
                        </div>

                        <!-- MOBILE -->
                        <div>
                            <h3 class="join_title"><label for="phoneNo">휴대전화</label></h3>
                            <span class="box int_mobile">
                                <!-- <input type="tel" id="mobile" class="int" maxlength="16" placeholder="전화번호 입력" required> -->
                                <input type="number" id="mobile" class="int" value="<?=$userPhone?>" placeholder="전화번호 입력" oninput='handleOnInput(this, 11)'>
                            </span>
                            <!-- <span class="error_next_box"></span>     -->
                        </div>


                        <!-- JOIN BTN-->
                        <div class="btn_area">
                            <button type="button" id="btnJoin" onclick="location.href='main.php'">
                                <span>메인으로</span>
                            </button>
                            <button type="button" id="btnJoin" class="modifiy" onclick="user_modify()">
                                <!-- type을 submit에서 button으로 변경함 -->
                                <span>수 정</span>
                            </button>
                            <button type="button" id="btnJoin" class="unregister" onclick="user_del()">
                                <!-- type을 submit에서 button으로 변경함 -->
                                <span>회원탈퇴</span>
                            </button>
                        </div>
                    </form>
                    <!-- content-->
                </div>
                <!-- wrapper -->
            </div>
            <?php
              }
              else{
            ?>


            <!--  -->

            <div class="admin">
                <!-- wrapper -->
                <div id="wrapper">
                    <h1 class="modifiy_title">회원정보 수정</h1>
                    <!-- content-->
                    <form id="content">

                        <!-- PW1 -->
                        <div>
                            <h3 class="join_title"><label for="pswd1">현재 비밀번호</label></h3>
                            <span class="box int_pass">
                                <input type="password" id="pswd1" class="int" maxlength="20" placeholder="현재 비밀번호">
                                <!-- <span id="alertTxt">사용불가</span> -->
                                <img src="./img/pwicon.png" id="pswd1_img1" class="pswdImg">
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- PW2 -->

                        <div style="display: flex;">
                            <div style="width: 45%; margin-right: 5%;">
                                <h3 class="join_title"><label for="pswd2">변경할 비밀번호</label></h3>
                                <span class="box int_pass_check">
                                    <input type="password" id="pswd2" class="int" maxlength="20" placeholder="변경할 비밀번호">
                                    <img src="./img/pwicon.png" id="pswd2_img1" class="pswdImg">
                                </span>
                                <!-- <span class="error_next_box"></span> -->
                            </div>

                            <!-- PW2 -->
                            <div style="width: 45%; margin-left: 5%;">
                                <h3 class="join_title"><label for="pswd3">비밀번호 재확인</label></h3>
                                <span class="box int_pass_check">
                                    <input type="password" id="pswd3" class="int" maxlength="20" placeholder="비밀번호 재입력">
                                    <img src="./img/check_pwicon.png" id="pswd2_img1" class="pswdImg">
                                </span>
                                <!-- <span class="error_next_box"></span> -->
                            </div>
                        </div>

                        <!-- NAME -->
                        <div>
                            <h3 class="join_title"><label for="name">이름</label></h3>
                            <span class="box int_name" id="aaaa">
                                <input type="text" id="join_name2" class="int" value="<?=$userName?>" maxlength="20" readonly>
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- 소속서 -->
                        <div>
                            <h3 class="join_title"><label for="name">소속서</label></h3>
                            <span class="box int_p1" id="aaaa">
                                <input type="text" id="p1" class="int" value="<?=$polPsic?>" maxlength="20">
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- 소속부서 -->
                        <div>
                            <h3 class="join_title"><label for="name">소속부서</label></h3>
                            <span class="box int_p2" id="aaaa">
                                <input type="text" id="p2" class="int" value="<?=$polJurisdiction?>" maxlength="20">
                            </span>
                            <!-- <span class="error_next_box"></span> -->
                        </div>

                        <!-- MOBILE -->
                        <div>
                            <h3 class="join_title"><label for="phoneNo">휴대전화</label></h3>
                            <span class="box int_mobile">
                                <!-- <input type="tel" id="mobile" class="int" maxlength="16" placeholder="전화번호 입력" required> -->
                                <input type="number" id="mobile" class="int" value="<?=$userPhone?>" placeholder="전화번호 입력" oninput='handleOnInput(this, 11)'>
                            </span>
                            <!-- <span class="error_next_box"></span>     -->
                        </div>

                        <!-- JOIN BTN-->
                        <div class="btn_area">
                            <button type="button" id="btnJoin" onclick="location.href='main.php'">
                                <span>메인으로</span>
                            </button>
                            <button type="button" id="btnJoin" class="modifiy" onclick="police_modify()">
                                <!-- type을 submit에서 button으로 변경함 -->
                                <span>수 정</span>
                            </button>
                            <button type="button" id="btnJoin" class="unregister" onclick="police_del()">
                                <!-- type을 submit에서 button으로 변경함 -->
                                <span>회원탈퇴</span>
                            </button>
                        </div>
                    </form>
                    <!-- content-->
                </div>
                <!-- wrapper -->
            </div>
            <?php
              }
            ?>
        </div>
    </div>
    <footer>
        <div class="info">
            <img class="footer_logo" src="./img/titleLogo_WN.png">
            <div class="info_content">
                <div class="info_text">
                    <ul class="info_ui">
                        <li class="info_li"><h5 class="info_li_title" style="font-weight: bold; margin-bottom: 20px;">LOCATION</h5></li>
                        <li class="info_li"><div class="info_li_text">대한민국 경찰청</div><span style="margin-left: 20px;">(03739) 서울특별시 서대문구 통일로 97 경찰청</span></li>
                        <li class="info_li"><div class="info_li_text">초록우산 재단</div><span style="margin-left: 20px;">(04522) 서울시 중구 무교로 20 어린이재단빌딩</span></li>
                        <li class="info_li"><div class="info_li_text">안전Dream 센터</div><span style="margin-left: 20px;">(04522) 서울시 중구 무교로 20 어린이재단빌딩</span></li>
                        <li class="info_li"><div class="info_li_text">중앙치매센터</div><span style="margin-left: 20px;">(04564) 서울시 중구 을지로 245</span></li>
                    </ul>
                </div>
                <div class="etc">
                    <ul class="info_ui">
                        <li class="info_li"><h5 class="info_li_title" style="font-weight: bold; margin-bottom: 20px;">TEL</h5></li>
                        <li class="info_li"><div class="info_li_text">실종자 신고</div><span style="margin-left: 20px;">대표전화 : 182</span></li>
                        <li class="info_li"><div class="info_li_text">범죄, 검찰</div><span style="margin-left: 20px;">대표전화 : 1301</span></li>
                        <li class="info_li"><div class="info_li_text">노인학대</div><span style="margin-left: 20px;">대표전화 : 1577-1389</span></li>
                        <li class="info_li"><div class="info_li_text">청소년상담</div><span style="margin-left: 20px;">대표전화 : 1388</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div>
                <button class="sns_btn" onclick="location.href='http:\/\/www.youtube.com/c/polinlove'"><img style="width: 80px; height: 30px;" src="./img/YouTube_White.png"></button>
                <button class="sns_btn" onclick="location.href='https:\/\/www.safe182.go.kr/home/lcm/lcmMssList.do?rptDscd=2'"><img style="width: 120px; height: 30px;" src="./img/Safety_Dream.png"></button>
                <button class="sns_btn" onclick="location.href='https:\/\/www.childfund.or.kr/main.do'"><img class="sns_img" src="./img/green_umbrella.png"></button>
                <button class="sns_btn" onclick="location.href='https:\/\/www.instagram.com/police_kor_official'"><img class="sns_img" src="./img/Instagram_white.png"></button>
            </div>
            <span> Copyright © SCHNET Corp. All Rights Reserved.</span>
        </div>
    </footer>
    <script>
    function logout_func(){
      location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
    }

    var chk = document.getElementById('email').value;
    if(chk != ''){
      pass_email = true;
    }

    function handleOnInput(el, maxlength) {
      if(el.value.length > maxlength)  {
        el.value
        = el.value.substr(0, maxlength);
      }
    }

    function check_email(){
      var email = document.getElementById('email').value;
      var regExp = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
      if (regExp.test(verify)) {
        pass_email = true;
      }
    }

    function handleOnInput(el, maxlength) {  //휴대전화에서 숫자 제한.
      if(el.value.length > maxlength)  {
        el.value
        = el.value.substr(0, maxlength);
      }
    }
    function user_modify(){
      var inputPw_val = document.getElementById('pswd1').value;
      var newPw_val = document.getElementById('pswd2').value;
      var check_newPw_val = document.getElementById('pswd3').value;
      var newEmail_val = document.getElementById('email').value;
      var newMobile_val = document.getElementById('mobile').value;

      if(inputPw_val == ''){
        alert('비밀번호를 입력해주세요!');
        return;
      }
      if(inputPw_val != obj.pw){
        alert('정확한 현재 비밀번호를 입력해주세요!');
        return;
      }
      if(newPw_val == '' && check_newPw_val != ''){
        alert('변경하실 비밀번호를 입력해주세요!');
        return;
      }
      if(newPw_val != check_newPw_val){
        alert('변경하실 비밀번호와 재입력 비밀번호가 다릅니다.!');
        return;
      }
      if((newEmail_val != '') &&(!pass_email)){
        alert('정확한 이메일을 입력해주세요!');
        return;
      }
      var result = confirm('수정하시겠습니까?');
      if(result){
        location.href = "https://jj7932.cafe24.com/dbp/modify_infomation_process.php?mode=user&newPw="+newPw_val+"&newEmail="+newEmail_val+"&newPhone="+newMobile_val;
      }
    }

    function police_modify(){
      var inputPw_val = document.getElementById('pswd1').value;
      var newPw_val = document.getElementById('pswd2').value;
      var check_newPw_val = document.getElementById('pswd3').value;
      var newMobile_val = document.getElementById('mobile').value;
      var newPsic_val = document.getElementById('p1').value;
      var newJurisdiction_val = document.getElementById('p2').value;

      if(inputPw_val == ''){
        alert('비밀번호를 입력해주세요!');
        return;
      }
      if(inputPw_val != obj.pw){
        alert('정확한 현재 비밀번호를 입력해주세요!');
        return;
      }
      if(newPw_val == '' && check_newPw_val != ''){
        alert('변경하실 비밀번호를 입력해주세요!');
        return;
      }
      if(newPw_val != check_newPw_val){
        alert('변경하실 비밀번호와 재입력 비밀번호가 다릅니다.!');
        return;
      }
      if(newPsic_val == ''){
        alert('소속서를 입력해주세요!');
        return;
      }
      if(newJurisdiction_val == ''){
        alert('소속부서를 입력해주세요!');
        return;
      }
      var result = confirm('수정하시겠습니까?');
      if(result){
        location.href = "https://jj7932.cafe24.com/dbp/modify_infomation_process.php?mode=police&newPw="+newPw_val+"&newPhone="+newMobile_val+"&newPsic="+newPsic_val+"&newJurisdiction="+newJurisdiction_val;
      }
    }

    function user_del(){
      var result = confirm('정말 회원탈퇴를 하시겠습니까?');
      if(result){
        location.href="https://jj7932.cafe24.com/dbp/delete_infomation_process.php?mode=user";
      }
    }
    function police_del(){
      var result = confirm('정말 회원탈퇴를 하시겠습니까?');
      if(result){
        location.href="https://jj7932.cafe24.com/dbp/delete_infomation_process.php?mode=police";
      }
    }
    </script>
</body>
</html>
