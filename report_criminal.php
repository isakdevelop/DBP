<?php
session_start();
$userId = $_SESSION['id'] ?? '';
$userName = $_SESSION['name'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userEmail = $_SESSION['email'] ?? '';

if($userId == ''){
  echo "<script>";
  echo "alert('로그인 후 이용해 주세요!');";
  echo "location.href='https://jj7932.cafe24.com/dbp/login.php'";
  echo "</script>";
}

$page = $_GET['page'] ?? 1;
$search_value = $_POST['search_value'] ?? '';
$search_terms = $_POST['search_terms'] ?? '';

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>";
echo "var obj = '';";
echo "var ispol = false;";
echo "var page = '$page';";
echo "var report_arr = new Array();";
echo "</script>";

$total;
//경찰 로그인

if(isset($_SESSION['police'])){
  echo "<script>";
  echo "ispol = true;";
  echo "</script>";
  switch($search_terms){
    case 'title':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE title LIKE '%$search_value%'";
      break;
    case 'wdName':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE name LIKE '%$search_value%'";
      break;
    case 'writer':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE wanted_report.id = (SELECT id
       FROM user_infomation
       WHERE user_infomation.name = '".$search_value."')";
      break;
    case 'ID':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE id LIKE '%$search_value%'";
      break;
    default:
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report";
      break;
  }

  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result)){
    $idx = $row['idx'];
    $id = $row['id'];
    $idx_ref_mp = $row['irp'];
    $name = $row['name'];
    $content = $row['content'];
    $title = $row['title'];
    $pw = $row['pw'];

    echo "<script>";
    echo "var obj = {
      'idx' : '$idx',
      'id' : '$id',
      'irp' : '$idx_ref_mp',
      'name' : '$name',
      'content' : '$content',
      'title' : '$title',
      'pw' : '$pw'
    };";
    echo "report_arr.push(obj);";
    echo "</script>";
  }
}
//사용자 로그인
else{
  switch($search_terms){
    case 'title':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE id = '$userId' AND title LIKE '%$search_value%'";
      break;
    case 'npName':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE id = '$userId' AND name LIKE '%$search_value%'";
      break;
    case 'writer':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE wanted_report.id
      = (SELECT id
         FROM user_infomation
         WHERE user_infomation.name = $name)";
      break;
    case 'ID':
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE id = '$userId' AND id LIKE '%$search_value%'";
      break;
    default:
      $sql = "SELECT idx, id, idx_ref_mp AS irp, name, content, title, pw FROM wanted_report WHERE id = '$userId'";
      break;
  }

  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);

  while($row = mysqli_fetch_array($result)){
    $idx = $row['idx'];
    $id = $row['id'];
    $idx_ref_mp = $row['irp'];
    $name = $row['name'];
    $content = $row['content'];
    $title = $row['title'];
    $pw = $row['pw'];

    echo "<script>";
    echo "var obj = {
      'idx' : '$idx',
      'id' : '$id',
      'irp' : '$idx_ref_mp',
      'name' : '$name',
      'content' : '$content',
      'title' : '$title',
      'pw' : '$pw'
    };";
    echo "report_arr.push(obj);";
    echo "</script>";
  }
}

$pageSet_arr = array();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="./css/report_criminal.css" type="text/css" rel="stylesheet" >

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
            $("#del").click(function() {
                $(".notice").css('display', 'block');
                $(".notice_read_del").css('display', 'none');
            })
            $("#back_r").click(function() {
                $(".notice").css('display', 'block');
                $(".notice_read_del").css('display', 'none');
            })
            $(".page_title").click(function() {
                $(".notice").css('display', 'none');
                $(".notice_read_del").css('display', 'block');
            })
        });

    </script>
    <title>스치넷</title>
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
            <!-- 게시판 -->
            <section class="notice col-12 mx-auto">
                <table>
                    <caption class="tablename mb-3" align="top" style="text-align: center;">
                        <h2>수배자 제보 게시판</h2>
                        <div class="bottom-line col-6 mx-auto"></div></caption>
                    <thead><tr><th>글번호</th><th>제목</th><th>ID</th></tr></thead>
                    <tbody id="items">
                    </tbody>
                    <tfoot>
                        <tr><td class="page_number" colspan="3">
                          <ul style="list-style:none;">
                          <?php
                          $list_num = 10;
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
                          </ul>
                        </td></tr>
                    </tfoot>
                </table>
                <form action="./report_criminal.php" method="post">
                <select id="search_terms" name="search_terms" class="sel" style="width: 80px; text-align: center;">
                    <option value="title">제목</option>
                    <option value="wdName" name="wdName">수배자</option>
                    <option value="writer" name="writer">작성자</option>
                    <option value="ID">ID</option>
                </select>
                <input type="text" name="search_value" style="width: 500px;">
                <button id="search" class="write">검 색</button>
                <!-- <button id="write" type="button" class="write" style="position: absolute; right: 0px;" onclick="location.href='notice_write_renewal.html'">글쓰기</button> -->
              </form>
            </section>

            <!-- 글읽기 -->
            <section class="notice_read_del col-12 mx-auto">
                <form>
                    <h2 style="text-align: center; font-family: '마초체';">제보내용</h2>
                    <div class="bottom-line mx-auto mt-5"></div></caption>

                    <div class="text_input">
                        <label for="title">제목</label><br>
                        <input type="text" maxlength="100" id="title" style="width: 100%;">
                    </div>
                    <div class="text_input">
                        <label for="content">내용</label><br>
                        <textarea id="content" style="width: 100%; height: 250px;"></textarea>
                    </div>
                    <div class="text_input">
                        <div class="bottom-line mx-auto mt-5"></div></caption>
                        <?php
                        if($polNum == ''){
                        ?>
                        <label for="password">비밀번호</label><br>
                        <input type="password" maxlength="100" id="password" style="width: 25%;">
                        <?php
                        }
                        ?>
                        <input id="modify" type="button" class="write2" style="margin-left: 10px;" onclick="modify_func();" value="수정"/>
                        <input id="del" type="button" class="write2" style="margin-left: 10px;" onclick="delete_func();" value="삭제"/>
                        <input id="back_r" type="button" class="write2" value="이전"/>
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
            </div>
            <span> Copyright © SCHNET Corp. All Rights Reserved.</span>
        </div>
    </footer>
    <script>

      var viewNum = 10;
      var start = (page-1) * viewNum;
      if(page+1 == parseInt(report_arr.length/viewNum)){
        viewNum = report_arr.length%viewNum;
      }

      for(var i = start; i<start+viewNum; i++){
        $('#items').append("<tr class='table_page'>"+
          "<td>"+(i+1)+"</td><td id='title_"+report_arr[i].idx+"' class='page_title' onclick='click_title(this)'><span>["+report_arr[i].name+"]</span>"+report_arr[i].title+"</td><td>"+report_arr[i].id+"</td>"+
        "</tr>");
      }

      function click_title(obj){
        $(".notice").css('display', 'none');
        $(".notice_read_del").css('display', 'block');
        var splitObj = (obj.id).split('_');
        select_title_idx = splitObj[1];

        var idx_i = '';
        for(var i=0; i<report_arr.length; i++){
          if(report_arr[i].idx == select_title_idx){
            idx_i = i;
            break;
          }
        }

        var title = document.getElementById('title');
        var content = document.getElementById('content');
        title.value = report_arr[idx_i].title;
        content.value = report_arr[idx_i].content;
        console.log(select_title_idx);
      }


      function modify_func(){
        var title_value = document.getElementById('title').value;
        var content_value = document.getElementById('content').value;

        if(ispol == true){
          var result = confirm('수정하시겠습니까?');
          if(result){
            location.href = "https://jj7932.cafe24.com/dbp/cm_modify_process.php?title="+title_value+"&content="+content_value+"&idx="+select_title_idx;
          }
        }
        else {
          var pw_value = document.getElementById('password').value;
          var pw = '';
          for(var i=0; i<report_arr.length; i++){
            if(report_arr[i].idx == select_title_idx){
              pw = report_arr[i].pw;
              break;
            }
          }
          if(pw_value == pw){
            console.log(select_title_idx);
            var result = confirm('수정하시겠습니까?');
            if(result){
              location.href = "https://jj7932.cafe24.com/dbp/cm_modify_process.php?title="+title_value+"&content="+content_value+"&idx="+select_title_idx;
            }
          }
          else{
            alert('올바른 비밀번호를 입력해 주세요.');
            return;
          }
        }
      }


      function delete_func(){
        if(ispol == true){
          console.log(select_title_idx);
          var result = confirm('삭제하시겠습니까?');
          if(result){
            location.href = "https://jj7932.cafe24.com/dbp/cm_delete_process.php?idx="+select_title_idx;
          }
        }
        else {
          var pw_value = document.getElementById('password').value;
          var pw = '';

          for(var i=0; i<report_arr.length; i++){
            if(report_arr[i].idx == select_title_idx){
              pw = report_arr[i].pw;
              break;
            }
          }
          if(pw_value == pw){
            var result = confirm('삭제하시겠습니까?');
            if(result){
              location.href = "https://jj7932.cafe24.com/dbp/cm_delete_process.php?idx="+select_title_idx;
            }
          }
          else{
            alert('올바른 비밀번호를 입력해 주세요.');
            return;
          }
        }
      }

      function logout_func(){
        location.href = "https://jj7932.cafe24.com/dbp/logout_process.php";
      }
    </script>
</body>
</html>
