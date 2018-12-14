<?php session_start();
// ログイン状態チェック
if (!isset($_SESSION["email"])) {
    header("Location: Logout.php");
    exit;
}
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>INSPECT</title>
  <link rel="stylesheet" type="text/css" href="../css/user_style.css">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
</head>

<body>
  <!-- ナビゲーションバー -->
  <header>
    <nav>
    <ul id="menu">
      <li class="hamburger"><a href="#menu"><i class="fa fa-bars"></i></a></li>
        <li class="logo"><a href="inspect.php">INSPECT</a></li>
        <li><a href="inspect.php">Daily inspection</a></li>
        <li><a href="checker.php">how to</a></li>
        <li><a href="information.php">User</a></li>
        <li><a href="logout.php">log out</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <!-- メールアドレス、通知状況の表示 -->
    <div class="box">
    <div class="box-title">User Account</div>
    <div class = "container">
    <div class="item">
    Email address:
    <?php
      print $_SESSION["email"];
     ?>
  </div>
    <div class="item2">
    通知設定 :
    <?php
      if($_SESSION["notification"]==0){
      print "OFF";
    }else{
      print "ON";
    }
     ?>
    </div>
    <div class="item">
    車種 :
    </div>
    <div class="item">
    初期走行距離 :
    </div>
    <div class="item2">
    登録年月日 :
    </div>
    <div class="button">

    </div>
  </div>
</div>
  </main>
</body>
