<?php
session_start();
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userName = $_SESSION['name'] ?? '';

$input_name = $_GET['input_name'] ?? '';

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['page'])){
                  $page = $_GET['page'];
              } else{
                  $page = 1;
              }


echo "<script>";
echo "var page='$page';";
echo "var mp_arr = new Array();";
echo "var obj = '';";
echo "</script>";

if ($input_name == '') {
  $sql = "SELECT idx, photo, name, gender, age, date_of_occurrence, address FROM Missing_Person";
}
else {
  $sql = "SELECT idx, photo, name, gender, age, date_of_occurrence, address FROM Missing_Person WHERE name = '$input_name'";
}

$result = mysqli_query($conn, $sql);
$total = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result)){
  $photoFromDB = $row['photo'];
  $nameFromDB = $row['name'];
  $genderFromDB = $row['gender'];
  $ageFromDB = $row['age'];
  $dateFromDB = $row['date_of_occurrence'];
  $addressFromDB = $row['address'];
  $idxFromDB = $row['idx'];

  echo "<script>";
  echo "obj = {
    'idx' : '$idxFromDB',
    'photo' : '$photoFromDB',
    'name' : '$nameFromDB',
    'gender' : '$genderFromDB',
    'age' : '$ageFromDB',
    'date' : '$dateFromDB',
    'address' : '$addressFromDB'
  };";
  echo "mp_arr.push(obj);";
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
    <link href="./css/missing_person_info.css" type="text/css" rel="stylesheet" >

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <!-- javascript -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <title>스치넷 - 실종자 게시판</title>
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
            <ul id='items' class="missing_info">

            </ul>
            <ul style=" list-style: none;">
              <div id= "page_num">
                <?php
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                } else{
                    $page = 1;
                }
                $list_num = 8;
                $page_num = 5;

                $block_num = ceil($page / $page_num);
                $block_start = (($block_num - 1) * $page_num) + 1;
                $block_end = $block_start + $page_num - 1;

                $total_page = ceil($total / $list_num);
                if($block_end > $total_page) $block_end = $total_page;
                $total_block = ceil($total_page / $page_num);
                $start_num = ($page - 1) * $list_num;

                if($page <= 1)
                { //만약 page가 1보다 크거나 같다면
                  echo "<li class='fo_re'>[처음]</li>"; //처음이라는 글자에 빨간색 표시
                  }else{
                  echo "<li class='fo_re'><a href='?page=1'>[처음]</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
                }
                   if($page <= 5)
                   { //만약 page가 1보다 크거나 같다면 빈값

                   }else{
                       $pre = $page-5; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
                       echo "<li class='fo_re'><a href='?page=$pre'> ◀ </a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
                   }
                   for($i=$block_start; $i<=$block_end; $i++){
                       //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
                       if($page == $i){ //만약 page가 $i와 같다면
                           echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
                       }else{
                           echo "<li class='fo_re'><a href='?page=$i'>[$i]</a></li>"; //아니라면 $i
                       }
                   }
                   if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
                   }else{
                       $next = $page + 5; //next변수에 page + 1을 해준다.
                       echo "<li class='fo_re'><a href='?page=$next'> ▶ </a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
                   }
                   if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
                       echo "<li class='fo_re'>[마지막]</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
                   }else{
                       echo "<li class='fo_re'><a href='?page=$total_page'>[마지막]</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
                   }
                ?>
                <input id="find_person" placeholder="실종자 성명"></input> <button onClick="find_person()">검색</button>
              </div>
            </ul>
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
      var nowAge_arr = new Array();

      var viewNum = 8;
      var start = (page-1) * viewNum;
      if(page+1 == parseInt(mp_arr.length/viewNum)){
        viewNum = mp_arr.length%viewNum;
      }
      for(var i = start; i<start+viewNum; i++){
        var nowAge = ageCalculator(mp_arr[i].date, mp_arr[i].age);
        var idx_tmp = mp_arr[i].idx;
        var nowAge_obj = {
          'idx' : idx_tmp,
          'nowAge' : nowAge
        };
        nowAge_arr.push(nowAge_obj);
        $('#items').append(
          "<li id='item_"+mp_arr[i].idx+"' onclick='move_page(this)'>"+
            "<dl>"+
              "<dd><span class='gal-desc' style='text-align: center;'>"+mp_arr[i].name+"("+mp_arr[i].age+") "+mp_arr[i].gender+"</span></dd>"+
              "<dd class='gal-thum'>"+
                "<div>"+
                  "<img class=img-responsive src='"+mp_arr[i].photo+"'/>"+
                "</div></dd>"+
                "<dd><span class='gal-title'>당시나이:</span>"+
                "<span class='gal-desc'>"+mp_arr[i].age+"세 (현재나이 "+nowAge+"세)</span></dd>"+
                "<dd><span class='gal-title'>발생일시:</span>"+
                "<span class='gal-desc'>"+mp_arr[i].date+"</span></dd>"+
                "<dd><span class='gal-title'>발생장소:</span>"+
                "<span class='gal-desc'>"+mp_arr[i].address+"</span></dd>"+
              "</dl>"+
          "</li>");
      }

      function ageCalculator(dateFromDB, ageFromDB){
        var splitDate = dateFromDB.split(' ');
        var x_year = splitDate[0].replace('년', '');
        var y_year = x_year - ageFromDB;

        const today = new Date();
        var z_year = today.getFullYear();

        let nowAge = z_year - y_year;

        return nowAge;
      }

      function find_person(){
        var input_name = document.getElementById('find_person').value;
        location.href = "https://jj7932.cafe24.com/dbp/missing_person_info.php?input_name="+input_name;
      }
      function move_page(obj){
        var splitID = (obj.id).split('_');
        var index = splitID[1];
        var age = 0;

        for(var i = 0; i<nowAge_arr.length; i++){
          if(nowAge_arr[i].idx == index){
            age = nowAge_arr[i].nowAge;
          }
        }

        location.href = "https://jj7932.cafe24.com/dbp/missing_person_data.php?idx="+index+"&nowAge="+age;
      }

      function logout_func(){
        location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
      }
    </script>
</body>
</html>
