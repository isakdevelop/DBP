<?php
session_start();
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userName = $_SESSION['name'] ?? '';
$idx = $_GET['idx'];

if($userId == ''){
  echo "<script>";
  echo "alert('로그인 후 이용해 주세요!');";
  echo "location.href='https://jj7932.cafe24.com/dbp/login.php'";
  echo "</script>";
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="./css/write_criminal.css" type="text/css" rel="stylesheet" >

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <!-- javascript -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <title>스치넷 - 수배자 제보 작성</title>
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
                            <button class="slide_button" style="background-color: white; width: 65px; height: 30px;" onclick="location.href='missing_person_map.php'">내 업무</button>
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
            <!-- 글쓰기 -->
            <section class="notice_write col-12 mx-auto">
                <form id="write_form" action="write_criminal_process.php?idx=<?=$idx?>" method="post">
                    <h2 style="text-align: center; font-family: '마초체';">수배자 제보하기</h2>
                    <div class="bottom-line mx-auto mt-5"></div></caption>
                    <div class="text_input">
                        <label for="title">제목</label><br>
                        <input type="text" name="title"maxlength="100" id="title" style="width: 100%;">
                    </div>
                    <div class="text_input">
                        <label for="content">내용</label><br>
                        <textarea id="content" name="content" style="width: 100%; height: 250px;"></textarea>
                    </div>
                    <div class="text_input">
                        <div class="bottom-line mx-auto mt-5"></div></caption>
                        <label for="password">비밀번호</label><br>
                        <input type="password" name="password" maxlength="4" id="password" style="width: 25%;">
                        <input id="add" type="button" class="write1" style="margin-left: 10px;" value="등록" onclick="check_pw()"/>
                        <button id="back_w" type="button" class="write1" onclick="history.back()">이전</button>
                    </div>
                </form>
            </section>
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
            <span> Copyright © SCHNET Corp. All Rights Reserved.</span>
        </div>
    </footer>
    <script>
      function check_pw(){
        var form = document.getElementById('write_form');
        var pw_value = document.getElementById('password').value;

        if(pw_value == ''){
          alert('비밀번호를 입력해 주세요.');
          return;
        }
        if(pw_value.length < 4){
          alert('4글자의 비밀번호로 설정해주세요.');
          return;
        }
        form.submit();
      }
      function logout_func(){
        location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
      }
    </script>
</body>
</html>
