<?php
session_start();

$userName = $_SESSION['name'] ?? '';
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userEmail = $_SESSION['email'] ?? '';

echo "<script>console.log('$userId');</script>";
echo "<script>console.log('$polNum');</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="./css/main.css" type="text/css" rel="stylesheet" >

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
        $(document).ready(function() {
            // $("#sign_up").click(function() {
            //     let ymd = y+m+d; //생년월일 한 문자열로 연결

            //     if(pw != pw_ck) { //비밀번호 불일치
            //         alert("비밀번호가 일치하지 않습니다.")
            //         return
            //     }
            //     // if(y/1==y || d/1==d){
            //     //     alert("생년월일은 숫자로 입력해주세요.")
            //     //     return
            //     // }

            //     if(id != "" && pw != "" && pw_ck != "" && name != "" && y != "" && m != "" && d != "" && sex != "" && phone != ""){ // 모든 필수란 입력했을 경우
            //         location.replace('main.html');
            //         alert(id+" "+pw+" "+pw_ck+" "+name+" "+ymd+" "+sex+" "+mail+" "+phone+" ");
            //     } else { /* 필수란 1개라도 미 입력시 경고창 띄우기*/
            //         alert("필수 입력란을 입력해주세요.");
            //     }
            // });
        });
    </script>
    <title>스치넷</title>
</head>
<body>
    <section class="">
        <header class="">
            <button class="title_logo" onclick="location.href='#'"><img class="title_img" src="./img/titleLogo_WN2.png" alt=""></button>
            <div class="header_logo"></div>
            <div class="header_menu">
                <li class="nav"><a class="menu" href="#">실종자 등록</a></li>
                <li class="nav"><a class="menu" href="#">실종자 정보</a></li>
                <li class="nav"><a class="menu" href="#">취약지역 조회</a></li>
                <li class="nav"><a class="menu" href="#">시발</a></li>

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
                        <button id="login" class="slide_button" onclick="location.href='login.html'" style="background-color: white; width: 70px; height: 40px;">로그인</button>
                        <button id="sign_up" class="slide_button" onclick="location.href='join_pick.html'" style="background-color: white; width: 70px; height: 40px;">회원가입</button>
                    </div>
                  <?php
                    }
                    else if($polNum == ''){
                  ?>
                    <div id="basic_user" class="mypage">
                        <p style="color: black; margin-top: 30px; font-size: 15px;"><small style="color: black; font-size: 0.5em;"><?=$userName?></small><br><span id="name"></span>님 <br>환영합니다.</p>
                        <button class="slide_button" style="background-color: white; width: 70px; height: 40px;" onclick="logout_func()">로그아웃</button>
                        <button class="slide_button" style="background-color: white; width: 70px; height: 40px;">정보수정</button>
                    </div>
                  <?php
                    }
                    else{
                  ?>
                    <div id="admin_user" class="mypage">
                        <p style="color: black; margin-top: 30px; font-size: 15px;"><small style="color: black; font-size: 0.5em;"><?=$userName?>(<?=$polNum?>)</small><br><span id="name"></span>님 <br>환영합니다.</p>
                        <button class="slide_button" style="background-color: white; width: 65px; height: 30px;" onclick="logout_func()">로그아웃</button>
                        <button class="slide_button" style="background-color: white; width: 65px; height: 30px;">정보수정</button>
                        <button class="slide_button" style="background-color: white; width: 65px; height: 30px;">내 업무</button>
                    </div>
                  <?php
                    }
                  ?>
                </div>
                <!-- 여기까지가 슬라이드 메뉴 -->
            </div>
        </header>
        <article>
            <div class="video_view">
                <div class="imgtext" style="color: white;">
                    <h1>"이 얼굴 꼭 좀 봐주세요.."</h1>
                    <h4 style="margin-left: 20px;">누군가의 부모를, 자녀를 찾는 사람들의 목소리 <span class="highlight">曰</span></h4>
                    <p style="margin: 20px 0 0 20px;">저희는 잊지 않겠습니다. 도와드리겠습니다. <br><span class="highlight">스</span>마트 <span class="highlight" style="margin-left: 5px;">치</span>안 <span class="highlight" style="margin-left: 5px;">NET</span> : 민간 - 경찰 정보 공유서비스 플랫폼</p>
                    <p></p>
                </div>
                <div class="sns">
                    <button class="sns_btn" onclick="location.href='http:\/\/www.youtube.com/c/polinlove'"><img style="width: 80px; height: 30px;" src="./img/YouTube_White.png"></button>
                    <button class="sns_btn" onclick="location.href='https:\/\/www.safe182.go.kr/home/lcm/lcmMssList.do?rptDscd=2'"><img style="width: 120px; height: 30px;" src="./img/Safety_Dream.png"></button>
                    <button class="sns_btn" onclick="location.href='https:\/\/www.childfund.or.kr/main.do'"><img class="sns_img" src="./img/green_umbrella.png"></button>
                    <button class="sns_btn" onclick="location.href='https:\/\/www.instagram.com/police_kor_official'"><img class="sns_img" src="./img/Instagram_white.png"></button>
                </div>
                <video src="./video/main.mp4" muted autoplay loop></video>
            </div>
            <!-- <div>추가?</div> -->
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
        </article>


    </section>
    <footer>
        <div class="copyright">
        <span> Copyright © SCHNET Corp. All Rights Reserved.</span>
        </div>
    </footer>
    <script>
      function logout_func(){
        location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
      }
    </script>
</body>
</html>
