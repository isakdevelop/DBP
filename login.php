<?php
  session_start();
  $userId = $_SESSION['id'] ?? '';

  if($userId != ''){
    echo "<script>location.href='https://jj7932.cafe24.com/dbp/main.php';</script>";
  }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/login.css" type="text/css" rel="stylesheet" >
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>로그인</title>
</head>
<body>
	<div class="container mx-auto">
		<div class="main-wrap col-12">
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
		<section class="login-input-section-wrap col-12 mx-auto">
			<form action="./login_process.php" method="post" class="col-8 mx-auto" style="width: 40%;">
				<div class="login-input-wrap col-12" id="id">
					<input id="id-input" name="id-input" placeholder="아이디" type="text" required></input>
				</div>
				<div class="login-input-wrap col-12" id="pw">
					<input id="pw-input" name="pw-input" placeholder="비밀번호" type="password" required></input>
				</div>
				<div class="login-button">
					<center><button id="login" class="buttom-menu-button" type="submit" style="cursor: pointer;">로그인</button></center>
				</div>
				<div class="join-me col-12">
					<a href="join_pick.php">회원가입</a>
				</div>
			</form>
		</section>
    <center>
		<section class="web-link-block" style="width: 70%;">
			<h3 style="font-family: '마초체'; font-size: 15px;">외부 사이트 바로가기</h3>
			<div class="web-link-list">
				<button onclick="location.href='https:\/\/www.police.go.kr/index.do'"><div class="web-button"><img class="web-button-logo" src="./img/Pollogo.png"><span class="button-text">경찰청 홈페이지</span></div></button>
				<button onclick="location.href='http:\/\/www.youtube.com/c/polinlove'"><div class="web-button"><img class="web-button-logo" src="./img/Youtubelogo.png"><span class="button-text">경찰청 유튜브</span></div></button>
				<button onclick="location.href='https:\/\/www.instagram.com/police_kor_official'"><div class="web-button"><img class="web-button-logo" src="./img/Instagramlogo.png"><span class="button-text">경찰청 인스타그램</span></div></button>
			</div>
		</section>
  </center>
		<footer class="col-2 col-4 col-6 col-12 mx-auto">
			<div class="copyright">
			<span> Copyright © SCHNET Corp. All Rights Reserved.</span>
			</div>
		</footer>
		</div>
	</div>
</body>
</html>
