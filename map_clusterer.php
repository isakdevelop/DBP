<?php
//region이라는 name을 get해오며 디폴트값으로 ''를 설정.
$region = $_GET['region'] ?? '';
$input_name = $_GET['input_name'] ?? '';
//db연결부
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

//SELECT * FROM Missing_Person 마커 전체 조회
$sql = '';

if ($input_name == '') {
  if($region == ''){
    $sql = "SELECT photo, name, date_of_occurrence, lat, lng, address	FROM Missing_Person";
  }
  else{
    $sql = "SELECT photo, name, date_of_occurrence, lat, lng, address	FROM Missing_Person WHERE address LIKE '$region%'";
  }
}
else {
  $sql = "SELECT photo, name, date_of_occurrence, lat, lng, address FROM Missing_Person WHERE name='$input_name'";
}

//쿼리 실행 및 결과 저장
$result = mysqli_query($conn, $sql);


//php에서 js 사용
//marker : 마커의 내용이 key:value형태의 객체로서 저장
//marker_arr : 마커 객체가 담길 array
echo "<script>";
echo "var marker = '';";
echo "var marker_arr = new Array();";
echo "</script>";

//결과 row를 가져옴 (행 별로 가져오기때문에 while문을 씀, 만약 결과 row가 1개라면 if문을 써도 무방)
while($row = mysqli_fetch_array($result)){
  //각 행의 열들의 값을 보기 편하게 해줌
  $photo = $row['photo'];
  $name = $row['name'];
  $date_of_occurrence = $row['date_of_occurrence'];
  $lat = $row['lat'];
  $lng = $row['lng'];
  $address = $row['address'];

  //마커 객체를 만들어줌
  echo "<script>";
  echo "marker = {
    'photo' : '$photo',
    'name' : '$name',
    'date_of_occurrence' : '$date_of_occurrence',
    'lat' : '$lat',
    'lng' : '$lng',
    'address' : '$address',
  };";

  //만든 객체를 array에 push
  echo "marker_arr.push(marker);";
  echo "</script>";
}
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shoutcut icon" type="image/x-icon" href="./img/titleLogo.png">
    <link rel="stylesheet" type="text/css" href="./css/map_clusterer.css">
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <title>스치넷 - 전국 실종자 정보</title>
  </head>
  <body>

    <!-- 배너 -->
    <center class="textBanner">
      실종자 분포를 보여주는 결과화면입니다.<br>
      마커를 터치하여 내용을 확인해주세요.
    </center>

    <!-- 지도 -->
    <div id="resultMap"></div>
    <span class="box">
      <select id="region" name="region" style="width:200px;height:20px;" class="sel" onchange="find_region()">
        <option value="지역">지역</option>
        <option value="전체">전체</option>
        <option value="서울특별시">서울특별시</option>
        <option value="인천광역시">인천광역시</option>
        <option value="대전광역시">대전광역시</option>
        <option value="대구광역시">대구광역시</option>
        <option value="울산광역시">울산광역시</option>
        <option value="부산광역시">부산광역시</option>
        <option value="광주광역시">광주광역시</option>
        <option value="제주특별자치도">제주특별자치도</option>
        <option value="세종특별자치시">세종특별자치시</option>
        <option value="강원도">강원도</option>
        <option value="경기도">경기도</option>
        <option value="충청북도">충청북도</option>
        <option value="충청남도">충청남도</option>
        <option value="경상북도">경상북도</option>
        <option value="경상남도">경상남도</option>
        <option value="전라북도">전라북도</option>
        <option value="전라남도">전라남도</option>
      </select>
      <br><br>
      <input id="find_person" placeholder="실종자 성명"></input> <button onClick="find_person()">검색</button>
    </span>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=3fa891f223b08bd5be79955ae8d9c082&libraries=clusterer"></script>
    <script>
        var select_region = false;
        var map = new kakao.maps.Map(document.getElementById('resultMap'), { // 지도를 표시할 div
        center : new kakao.maps.LatLng(35.70253223016285, 127.8698587285432), // 지도의 중심좌표
        level : 13 // 지도의 확대 레벨
        });

        var clusterer = new kakao.maps.MarkerClusterer({
              map: map, // 마커들을 클러스터로 관리하고 표시할 지도 객체
              averageCenter: true, // 클러스터에 포함된 마커들의 평균 위치를 클러스터 마커 위치로 설정
              minLevel: 9, // 클러스터 할 최소 지도 레벨
              calculator: [20, 30, 40], // 클러스터의 크기 구분 값, 각 사이값마다 설정된 text나 style이 적용된다
              texts: getTexts, // texts는 ['삐약', '꼬꼬', '꼬끼오', '치멘'] 이렇게 배열로도 설정할 수 있다
              styles: [{ // calculator 각 사이 값 마다 적용될 스타일을 지정한다
                      width : '30px', height : '30px',
                      background: 'rgba(51, 204, 255, .8)',
                      borderRadius: '15px',
                      color: '#000',
                      textAlign: 'center',
                      fontWeight: 'bold',
                      lineHeight: '31px'
                      },
                      {
                      width : '40px', height : '40px',
                      background: 'rgba(255, 153, 0, .8)',
                      borderRadius: '20px',
                      color: '#000',
                      textAlign: 'center',
                      fontWeight: 'bold',
                      lineHeight: '41px'
                      },
                      {
                      width : '50px', height : '50px',
                      background: 'rgba(255, 51, 204, .8)',
                      borderRadius: '25px',
                      color: '#000',
                      textAlign: 'center',
                      fontWeight: 'bold',
                      lineHeight: '51px'
                      },
                      {
                      width : '60px', height : '60px',
                      background: 'rgba(255, 80, 80, .8)',
                      borderRadius: '30px',
                      color: '#000',
                      textAlign: 'center',
                      fontWeight: 'bold',
                      lineHeight: '61px'
                      }
                      ]
              });

      // 클러스터 내부에 삽입할 문자열 생성 함수입니다
      function getTexts( count ) {

      // 한 클러스터 객체가 포함하는 마커의 개수에 따라 다른 텍스트 값을 표시합니다
      if(count < 20) {
          return '주의';
        } else if(count < 30) {
          return '집중';
        } else if(count < 40) {
          return '과다';
        } else {
          return '폭주';
        }
      }

      // 마커들을 저장 할 변수 생성(마커 클러스터러 관련)
      var markers = [];

      //마커 리스트를 for문을 돌며 지도상에 표현함.
      for(var i = 0; i<marker_arr.length; i++){
        //지도에 마커를 생성하고 표시한다.
        var marker = new kakao.maps.Marker({
        position: new kakao.maps.LatLng(marker_arr[i].lat, marker_arr[i].lng), // 마커의 좌표
        map: map, // 마커를 표시할 지도 객체
        clickable: true
        });

        markers.push(marker);

        // 마커를 클릭했을 때 마커 위에 표시할 인포윈도우를 생성
        //사진이 없으면 나오지 않고 사진이 있으면 사진을 표시.
        if (marker_arr[i].photo.length == 0) {
          var iwContent = '<div style="font-size:20px;width:350px;padding:5px;">'+marker_arr[i].name+'<hr>'
                          +marker_arr[i].date_of_occurrence+'<hr>'
                          +marker_arr[i].address+'<hr></div>',
              iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시
        }
        else {
          var iwContent = '<div style="font-size:20px;width:350px;padding:5px;">'+marker_arr[i].name+'<hr>'
                          +marker_arr[i].date_of_occurrence+'<hr>'
                          +marker_arr[i].address+'<hr>'
                          +'<center><img src = '+marker_arr[i].photo+' width="250px" height="350px"></center></div>',
              iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시
        }

        var infowindow = new kakao.maps.InfoWindow({
            content : iwContent,
            removable : iwRemoveable
        });
        kakao.maps.event.addListener(marker, 'click', addInfowindowEvent(map, marker, infowindow));
      }
      function addInfowindowEvent(map, marker, infowindow){
        return function() {
          infowindow.open(map, marker);
        };
      }
      clusterer.addMarkers(markers);
    //지역 별로 실종자의 마커를 검색
    function find_region(){
      var region = document.getElementById('region').value;
      if (region == "전체") {
        location.href = "https://jj7932.cafe24.com/dbp/map_clusterer.php";
      }
      else {
        location.href = "https://jj7932.cafe24.com/dbp/map_clusterer.php?region="+region;
      }
    }
    function find_person(){
      var input_name = document.getElementById('find_person').value;
      location.href = "https://jj7932.cafe24.com/dbp/map_clusterer.php?input_name="+input_name;
    }
    </script>
    <!-- 결과 개수 -->
    <div class="resultText"></div>
  </body>
</html>
