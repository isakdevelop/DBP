<?php
session_start();
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userName = $_SESSION['name'] ?? '';
$idx = $_GET['idx'];
$nowAge = $_GET['nowAge'];
echo "<script>var idx = $idx;</script>";

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT photo, name, gender, age, nationality, date_of_occurrence, address, height, weight, bulid, face_shape, hair_color, hair_shape, cloth FROM Missing_Person WHERE idx = '$idx'";

$result = mysqli_query($conn, $sql);

$name = '';
$photo = '';
$gender = '';
$age = '';
$nationality = '';
$date = '';
$address = '';
$height = '';
$weight = '';
$bulid = '';
$face_shape = '';
$hair_color = '';
$hair_shape = '';
$cloth = '';

echo "<script>";
echo "var mp_obj = '';";
echo "</script>";
while($row = mysqli_fetch_array($result)){
  $name = $row['name'];
  $photo = $row['photo'];
  $gender = $row['gender'];
  $age = $row['age'];
  $nationality = $row['nationality'];
  $date = $row['date_of_occurrence'];
  $address = $row['address'];
  $height = $row['height'];
  $weight = $row['weight'];
  $bulid = $row['bulid'];
  $face_shape = $row['face_shape'];
  $hair_color = $row['hair_color'];
  $hair_shape = $row['hair_shape'];
  $cloth = $row['cloth'];

  echo "<script>";
  echo "mp_obj = {
    'name' : '$name',
    'photo' : '$photo',
    'gender' : '$gender',
    'age' : '$age',
    'nationality' : '$nationality',
    'date' : '$date',
    'address' : '$address',
    'height' : '$height',
    'weight' : '$weight',
    'build' : '$bulid',
    'face_shape' : '$face_shape',
    'hair_color' : '$hair_color',
    'hair_shape' : '$hair_shape',
    'cloth' : '$cloth'
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
    <link href="./css/missing_person_data.css" type="text/css" rel="stylesheet" >

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
            <div class="missing_title">실종자 정보 게시판</div>
            <div class="data_frame">
                <div class="img_div">
                    <div class="main_photo">
                        <img src='<?=$photo?>'>
                    </div>
                    <span class="name"><?=$name?> (<?=$age?>세) <?=$gender?></span>
                </div>
                <div>
                    <table>
                        <tbody>
                            <tr>
                                <th>당시나이</th>
                                <td><?=$age?>세 (현재나이 : <?=$nowAge?>세)</td>
                            </tr>
                            <tr>
                                <th>국적</th>
                                <td><?=$nationality?></td>
                            </tr>
                            <tr>
                                <th>발생일시</th>
                                <td><?=$date?></td>
                            </tr>
                            <tr>
                                <th>발생장소</th>
                                <td><?=$address?></td>
                            </tr>
                            <tr>
                                <th>키</th>
                                <td><?=$height?></td>
                            </tr>
                            <tr>
                                <th>몸무게</th>
                                <td><?=$weight?></td>
                            </tr>
                            <tr>
                                <th>체격</th>
                                <td><?=$bulid?></td>
                            </tr>
                            <tr>
                                <th>얼굴형</th>
                                <td><?=$face_shape?></td>
                            </tr>
                            <tr>
                                <th>두발색상</th>
                                <td><?=$hair_color?></td>
                            </tr>
                            <tr>
                                <th>두발형태</th>
                                <td><?=$hair_shape?></td>
                            </tr>
                            <tr>
                                <th>착의의상</th>
                                <td><?=$cloth?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button id="list" class="m_btn" onclick="go_info()">목 록</button>
            <?php
              if($userId !=''){
            ?>
            <button id="report" class="m_btn" onclick="go_write()">목격담 제보</button>
            <?php
              }
              if($polNum != ''){
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
        location.href='https://jj7932.cafe24.com/dbp/missing_person_info.php';
      }

      function go_write() {
        location.href="https://jj7932.cafe24.com/dbp/write_missing_person.php?idx="+idx;
      }

      function go_list() {
        location.href="list_missing_person.php?name="+mp_obj.name;
      }

      function go_modify(){
        location.href="https://jj7932.cafe24.com/dbp/modify_missing_person.php?idx="+idx+"&name="+mp_obj.name+"&photo="+
        mp_obj.photo+"&gender="+mp_obj.gender+"&age="+mp_obj.age+"&nationality="+mp_obj.nationality+"&date="+mp_obj.date+
        "&address="+mp_obj.address+"&height="+mp_obj.height+"&weight="+mp_obj.weight+"&build="+mp_obj.build+"&face_shape="+mp_obj.face_shape+
        "&hair_color="+mp_obj.hair_color+"&hair_shape="+mp_obj.hair_shape+"&cloth="+mp_obj.cloth;
      }

      function logout_func(){
        location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
      }
      function go_del(){
        var result = confirm('정말로 삭제하시겠습니까?');
        if(result) {
        location.href="https://jj7932.cafe24.com/dbp/data_delete_process.php?mode=mp&idx="+idx+"&photo="+mp_obj.photo;
        }
      }

    </script>
</body>
</html>
