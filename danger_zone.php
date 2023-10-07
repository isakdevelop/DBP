<?php
session_start();

$sessionID = $_SESSION['id'] ?? '';

echo "<script>";
echo "var userID = '$sessionID'";
echo "</script>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="stylesheet" type="text/css" href="./css/danger_zone_temp.css">
    <title>스치넷 - 취약지역</title>

</head>
<body>
<div class="ViewWeb">
<!-- 헤더영역 -->
<div class="header">
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

</script>
</html>
