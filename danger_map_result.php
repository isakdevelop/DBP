<?php
session_start();

$userName = $_SESSION['name'] ?? '';
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userEmail = $_SESSION['email'] ?? '';
$input_name = $_GET['input_name'] ?? '';
$input_name = $_GET['input_name'] ?? '';
$searchID = $_GET['searchID'] ?? '';
//db연결부
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//SELECT * FROM MARKER 마커 전체 조회
$sql = '';

if($searchID == ''){
  if($input_name == ''){
    $sql = "SELECT id, lat, lng, report_content, address, idx FROM danger_zone";
  }
  else{
    $sql = "SELECT  id, lat, lng, report_content, address, idx FROM danger_zone WHERE danger_zone.id = (SELECT id
     FROM user_infomation
     WHERE user_infomation.name = '".$input_name."')";
  }
}
else{
  $sql = "SELECT id, lat, lng, report_content, address, idx FROM danger_zone WHERE id = '$searchID'";
}

//쿼리 실행 및 결과 저장
$result = mysqli_query($conn, $sql);


//php에서 js 사용
//marker : 마커의 내용이 key:value형태의 객체로서 저장
//marker_arr : 마커 객체가 담길 array
echo "<script>";
echo "var marker = '';";
echo "var user = '';";
echo "var marker_arr = new Array();";
echo "var user_arr = new Array();";
echo "</script>";

//결과 row를 가져옴 (행 별로 가져오기때문에 while문을 씀, 만약 결과 row가 1개라면 if문을 써도 무방)
while($row = mysqli_fetch_array($result)){
  //각 행의 열들의 값을 보기 편하게 해줌
  $id = $row['id'];
  $lat = $row['lat'];
  $lng = $row['lng'];
  $report_content = $row['report_content'];
  $address = $row['address'];
  $idx = $row['idx'];

  //마커 객체를 만들어줌
  echo "<script>";
  echo "marker = {
    'id' : '$id',
    'lat' : '$lat',
    'lng': '$lng',
    'report_content' : '$report_content',
    'address' : '$address',
    'idx' : '$idx'
  };";
  //만든 객체를 array에 push
  echo "marker_arr.push(marker);";
  echo "</script>";
}

$sql = "SELECT id, COUNT(report_content) AS cnt FROM danger_zone GROUP BY id";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
  $id = $row['id'];
  $cnt = $row['cnt'];

  echo "<script>";
  echo "user = {
    'id' : '$id',
    'cnt' : '$cnt'
  };";
  echo "user_arr.push(user);";
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
    <link href="./css/danger_map_result_temp.css" type="text/css" rel="stylesheet" >

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <!-- javascript -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <title>스치넷 - 취약지역 조회</title>
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
            <!-- <iframe src="https://jj7932.cafe24.com/dbp/danger_map_result.php" frameborder="0"></iframe>         -->
            <!-- 배너 -->
    <center class="textBanner">
        위험지역 분포를 보여주는 결과화면입니다.<br>
        마커를 터치하여 내용을 확인해주세요.
      </center>

      <!-- 지도 -->
      <div style="display: flex; width: 750px; margin: 0 auto;">
        <div style=" margin: 0 auto; ">
            <div id="resultMap"></div>
            <button onClick="viewAll()">전체보기</button>
            <input id="searchID_input" placeholder="민원인 성함"></input> <button onClick="search()">검색</button>&nbsp;<button onclick ="statistics()">통계</button>
            <div id="deleteBtn_div"></div>
          </div>
        <div id="userList_div" style="display: none; margin: 0 auto;">
        </div>
      </div>


      <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=3fa891f223b08bd5be79955ae8d9c082&libraries=services"></script>
      <script>
        //각 마커의 인포윈도우가 열려있는지를 나타내는 배열 생성
        var isOpenMarker_arr = new Array();
        //db에서 가져온 마커들을 객체화 시킨 리스트를 출력

        var mapContainer = document.getElementById('resultMap'), // 지도를 표시할 div
            mapOption = {
              center : new kakao.maps.LatLng(35.70253223016285, 127.8698587285432), // 지도의 중심좌표
              level : 13 // 지도의 확대 레벨
            };

            // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
            var map = new kakao.maps.Map(mapContainer, mapOption);
            //마커 이미지 주소
            var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";

            //마커 리스트를 for문을 돌며 지도상에 표현함.
            for(var i = 0; i<marker_arr.length; i++){
              //i번째의 마커의 open 여부(default는 false로 해줌)
              isOpenMarker_arr.push(false);
              var title = i;
              //위도 경도를 카카오에서 제공하는 함수를 통해 format
              var latlng = new kakao.maps.LatLng(marker_arr[i].lat, marker_arr[i].lng);
              //마커 이미지 사이즈
              var imageSize = new kakao.maps.Size(35, 50);
              //이미지 객체 생성
              var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
              //실제 마커 객체 생성
              var markerObject = new kakao.maps.Marker({
                map: map,
                position: latlng,
                title: title,
                image: markerImage,
                clickable: true
              });


              //마커를 눌렀을 때 나오는 창
              var iwContent = '<div style="font-size:20px;width:350px;padding:5px;">사용자 ID : '+marker_arr[i].id+'<hr>'+
                              '내용 : '+marker_arr[i].report_content+'</div>',
              iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시됩니다
                // 인포윈도우를 생성합니다
              var infowindow = new kakao.maps.InfoWindow({
                  content : iwContent,
                  removable : iwRemoveable
              });
              // 마커에 클릭이벤트를 등록합니다
              kakao.maps.event.addListener(markerObject, 'click', addInfowindowEvent(map, markerObject, infowindow, i));
            }

            function addInfowindowEvent(map, marker, infowindow, marker_i){
              return function(){
                if(isOpenMarker_arr[marker_i]){
                  infowindow.close(map, marker);
                  $('#userList_div').empty();
                  $('#deleteBtn_div').empty();
                  isOpenMarker_arr[marker_i] = false;
                }
                else{
                  infowindow.open(map, marker);
                  $('#userList_div').empty();
                  $('#deleteBtn_div').empty();
                  $("#deleteBtn_div").append("<div id='item'>"+
                    "<div class='pWrapDiv'>"+
                    "<div id='buttonWrapDiv'><button class='deleteBtn' onClick='deleteFunc("+marker_arr[marker_i].idx+")'>삭제</button></div>"+
                  "</div>");
                  isOpenMarker_arr[marker_i] = true;
                }
              }
            }

            function viewAll(){
              location.href="https://jj7932.cafe24.com/dbp/danger_map_result.php";
            }

            function search(){
              console.log('검색 클릭 됨');
              var input_name = document.getElementById('searchID_input').value;
              location.href = "https://jj7932.cafe24.com/dbp/danger_map_result.php?input_name="+input_name;
            }

            function deleteFunc(markerNum){
              var result = confirm('삭제하시겠습니까?');
              if(result){
                location.href = "https://jj7932.cafe24.com/dbp/deleteProcess.php?idx="+markerNum;
              }
            }

            function statistics() {
                var dis = document.getElementById("userList_div");
                if (dis.style.display == "none") {
                    dis.style.display = "block";
                } else {
                    dis.style.display = "none";
                }

                console.log(user_arr);
                $('#deleteBtn_div').empty();
                $('#userList_div').empty();
                $('#userList_div').append("<table id='statistics_table'>");
                $('#userList_div').append("<th>ID</th><th>민원수</th>");
                for(var i=0; i<user_arr.length; i++){
                    $('#userList_div').append("<tr class='statistics_tr' onclick='select_id("+i+")' id='tr_"+i+"'><td>"+user_arr[i].id+"</td><td>"+user_arr[i].cnt+"</td></tr>");
                    if(i == user_arr.length-1){
                    $('#userList_div').append("</table>");
                    }
                }

            }

            function select_id(get_i){
              var userId = user_arr[get_i].id;
              location.href = "https://jj7932.cafe24.com/dbp/danger_map_result.php?searchID="+userId;
            }

            function logout_func(){
              location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
            }

      </script>

      <!-- 결과 개수 -->
      <div class="resultText"></div>
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
</html>
