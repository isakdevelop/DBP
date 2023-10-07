<?php
session_start();

$userName = $_SESSION['name'] ?? '';
$userId = $_SESSION['id'] ?? '';
$polNum = $_SESSION['police'] ?? '';
$userEmail = $_SESSION['email'] ?? '';

if($userId != ''){
  echo "<script>";
  echo "alert('로그인 후 이용해 주세요!');";
  echo "location.href='main.php'";
  echo "</script>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="./css/join_pick.css" type="text/css" rel="stylesheet" >

    <!-- favicon -->
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">

    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
        crossorigin="anonymous">
    </script>
    <script>
    </script>
    <title>스치넷 - 회원가입</title>
</head>
<body class="container mx-auto">
	<div class="main-container">
		<div class="main-wrap">
		<header>
			<div class="main-logo">
				<button class="main-button col-12" onclick="location.href='main.php'">
					<picture>
						<source media="(max-width: 400px)" srcset="./img/titleLogoS.png">
						<img src="./img/titleLogo.png">
					</picture>
				</button>
			</div>
		</header>
        <section>
            <div class="bottom-line col-6 mx-auto"></div>
            <div class="pick_frame">
                <div class="basic" onclick="location.href='terms.html'"></div>
                <div class="admin" onclick="location.href='admin_terms.html'"></div>
            </div>
            <div class="pick_frame">
                <h3 class="pick_frame_text" onclick="location.href='terms.html'">일반계정 가입</h3>
                <h3 class="pick_frame_text" onclick="location.href='admin_terms.html'">경찰계정 가입</h3>
            </div>
            <div class="bottom-line col-6 mx-auto"></div>
            <div class="join-button">
                <button type="button" class="j-button" id="prew" onclick="history.back()">이 전</button>
            </div>
        </section>
		<footer class="col-2 col-4 col-6 col-12 mx-auto">
			<div class="copyright-wrap">
			<span> Copyright © SCHNET Corp. All Rights Reserved.</span>
			</div>
		</footer>
		</div>
	</div>
</body>
</html>
