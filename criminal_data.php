<?php
session_start();
$polNum = $_SESSION['police'] ?? '';
$userId = $_SESSION['id'] ?? '';
$userName = $_SESSION['name'] ?? '';

$idx = $_GET['idx'];
echo "<script>var idx = $idx;</script>";

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT photo, name, crime, Place_of_Registration as por, address FROM wanted WHERE idx = '$idx'";

$result = mysqli_query($conn, $sql);

$name = '';
$photo = '';
$crime = '';
$place = '';
$address = '';
echo "<script>";
echo "var cm_obj = '';";
echo "</script>";
while($row = mysqli_fetch_array($result)){
  $name = $row['name'];
  $photo = $row['photo'];
  $crime = $row['crime'];
  $place = $row['por'];
  $address = $row['address'];

  echo "<script>";
  echo "cm_obj = {
    'name' : '$name',
    'photo' : '$photo',
    'crime' : '$crime',
    'place' : '$place',
    'address' : '$address'
  };";
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
    <link href="./css/criminal_data.css" type="text/css" rel="stylesheet" >

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <!-- javascript -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <title>스치넷 - <?=$name?></title>
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
            <div class="missing_title">수배자 상세정보</div>
            <div class="data_frame">
                <div class="img_div">
                    <div id = 'add_img' class="main_photo">
                      <img src='<?=$photo?>'/>
                    </div>
                </div>
                <div id='items'>
                  <table>
                    <tbody>
                      <tr>
                        <th>이름</th>
                        <td><?=$name?></td>
                      </tr>
                      <tr>
                        <th>범죄명</th>
                        <td><?=$crime?></td>
                      </tr>
                      <tr>
                        <th>등록지</th>
                        <td><?=$place?></td>
                      </tr>
                      <tr>
                        <th>주소</th>
                        <td><?=$address?></td>
                      </tr>
                      <tr>
                        <th>신고처</th><!-- 이거는 안바꿔도됨 고정임-->
                        <td>112</td>
                      </tr>
                      <tr>
                        <th>유효기간</th> <!-- 이거는 안바꿔도됨 고정임-->
                        <td>2022-11-01 ~ 2022-12-31</td>
                      </tr>
                      </tbody>
                    </table>
                  <div> <!-- 이거는 안바꿔도됨 고정임-->
                    <img src="./img/criminal_logo.jpeg" style="margin-top: 30px; cursor: pointer;" onclick="window.open('http:\/\/onetouch.police.go.kr/')">
                  </div>
                </div>
            </div>
            <button id="list" class="m_btn" onclick="go_info()">목 록</button>
            <?php
              if($userId != ''){
            ?>
            <button id="report" class="m_btn" onclick="go_write()">목격담 제보</button>
            <?php
              }
              if($polNum !=''){
            ?>
            <button id="report_list" class="m_btn" onclick="go_list()">목격담 목록</button>
            <button id="del" class="m_btn" onclick="go_del()">삭 제</button>
            <button id="modify" class="m_btn" onclick="go_modify()">수 정</button>
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
      function go_info() {
        location.href='https://jj7932.cafe24.com/dbp/criminal_info.php';
      }

      function go_write() {
        location.href="https://jj7932.cafe24.com/dbp/write_criminal.php?idx="+idx;
      }

      function go_list() {
        location.href="list_criminal.php?name="+cm_obj.name;
      }

      function go_del(){
        var result = confirm('정말로 삭제하시겠습니까?');
        if(result) {
        location.href="https://jj7932.cafe24.com/dbp/data_delete_process.php?mode=cm&idx="+idx+"&photo="+cm_obj.photo;
        }
      }
      function go_modify(){
        location.href="https://jj7932.cafe24.com/dbp/modify_Wanted.php?idx="+idx+"&name="+cm_obj.name+"&photo="+cm_obj.photo+"&crime="+cm_obj.crime+"&place="+cm_obj.place+"&address="+cm_obj.address;
      }
      function logout_func(){
        location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
      }
    </script>
</body>
</html>
