<?php
session_start();

$userName = $_SESSION['name'] ?? '';
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userEmail = $_SESSION['email'] ?? '';

if($userId == ''){
  echo "<script>";
  echo "alert('로그인 후 이용해 주세요!');";
  echo "location.href='https://jj7932.cafe24.com/dbp/login.php'";
  echo "</script>";
}

echo "<script>";
echo "var userID = '$userId'";
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
    <link href="./css/danger_map.css" type="text/css" rel="stylesheet" >
    <!-- <link rel="stylesheet" type="text/css" href="/css/map_clusterer.css"> -->

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <!-- javascript -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <title>스치넷 - 취약 지역 등록</title>
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
            <div class="ViewWeb">
                <!-- 헤더영역 -->
                <div class="map_header">
                  <div class="explainText">
                    불안장소를 검색하거나 지도를 터치하여 표시하세요.
                  </div>
                  <div class="input">
                    <input id="inputText" type="text" name="address" placeholder="주소입력 (예:천안시 서북구 천안대로 1223-24)">
                    <button id="searchButton">검색</button>
                  </div>

                </div>
                <!-- 지도를 표시할 div 입니다 -->
                <div id="map"></div>

                <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=3fa891f223b08bd5be79955ae8d9c082&libraries=services"></script>
                <div class="footer">
                  <textarea id="content" type="text" name="content" value="" placeholder="자세한 위치와 범죄불안 요인ㆍ개선요구사항을 입력해주세요."></textarea>
                  <button id="submitButton">완료</button>
                </div>
                </div>
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
</body>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        document.getElementById("searchButton").addEventListener("click", searchAddress);
    });

    window.addEventListener('DOMContentLoaded', function() {
        document.getElementById("submitButton").addEventListener("click", submitToServer);
    });



    var mapContainer = document.getElementById('map'), // 지도를 표시할 div
        mapOption = {
            center: new kakao.maps.LatLng(36.85229272598323, 127.1503037298312), // 지도의 중심좌표
            level: 2 // 지도의 확대 레벨
        };
    var markerCount;
    var at = 0;
    var lo= 0;
    var dbSubmitAddress;

    // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
    var map = new kakao.maps.Map(mapContainer, mapOption);

    // 지도를 클릭한 위치에 표출할 마커입니다
    var marker = new kakao.maps.Marker({
        // 지도 중심좌표에 마커를 생성합니다
        position: map.getCenter()
    });
    // 지도에 마커를 표시합니다
    marker.setMap(map);

    var geocoder=new daum.maps.services.Geocoder();
    // 지도에 클릭 이벤트를 등록합니다
    // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
    kakao.maps.event.addListener(map, 'click', function(mouseEvent) {

        // 클릭한 위도, 경도 정보를 가져옵니다
        var latlng = mouseEvent.latLng;

        // 마커 위치를 클릭한 위치로 옮깁니다
        marker.setPosition(latlng);


        at = latlng.getLat();
        lo = latlng.getLng();
        getDBSubmitAddress(lo, at, function(result, status){
          if(status == kakao.maps.services.Status.OK){
            dbSubmitAddress = !!result[0].road_address ? (result[0].road_address.address_name) : result[0].address.address_name;

            console.log(at);
            console.log(lo);
            console.log(dbSubmitAddress);
          }
        });

    });


    function searchAddress(){
      // 주소-좌표 변환 객체를 생성합니다
      var geocoder = new kakao.maps.services.Geocoder();

      var address = document.getElementById("inputText").value;

      if(address===""){
        alert('주소를 입력해주세요.');
        return;
      }

      // 주소로 좌표를 검색합니다
      geocoder.addressSearch(address, function(result, status) {

          // 정상적으로 검색이 완료됐으면
           if (status === kakao.maps.services.Status.OK) {

              var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

              //마커 표시
              marker.setPosition(coords);
              //마커가 있는 곳으로 확대 레벨1로 이동(중앙으로)
              map.setCenter(coords);
              map.setLevel(1);
              at = coords.getLat();
              lo = coords.getLng();
              getDBSubmitAddress(lo, at, function(result, status){
                if(status == kakao.maps.services.Status.OK){
                  dbSubmitAddress = !!result[0].road_address ? (result[0].road_address.address_name) : result[0].address.address_name;
                  console.log(at);
                  console.log(lo);
                  console.log(dbSubmitAddress);
                }
              });
          }
      });
    }

    function getDBSubmitAddress(lng, lat, callback){
      geocoder.coord2Address(lng, lat, callback);
    }

    function getSubmitTime(){
      var today = new Date();

      var date = today.toLocaleString();
      console.log(date);
      return date;
    }

    function submitToServer(){
      console.log(at);
      console.log(lo);
      var markerText = document.getElementById("content").value;
      if(at===0&&lo===0){
        alert('좌표를 찍어주세요');
        return;
      }
      if(markerText===""){
        alert('자세한 내용을 입력해주세요');
        return;
      }
      var answer = window.confirm("저장하시겠습니까?");
      if(answer){
        // //현재 로그인 되어있는 사용자 정보는 세션으로 적용시켜야 함.
        // var userID = "xezc159";
        // var userEmail = "xezc159@naver.com";
        if(userID == ''){
          alert('로그인 후 이용해주세요!');
          location.href = "./login.php";
        }
        else{
          var date = getSubmitTime();
          //insertProcess php로 마커에 대한 정보를 보냄
          location.href="https://jj7932.cafe24.com/dbp/danger_zone_process.php?id="+userID+"&at="+at+"&lo="+lo+"&txt="+markerText+"&address="+dbSubmitAddress+"&date="+date;
        }
      }
    }
    function logout_func(){
      location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
    }

  </script>
</html>
