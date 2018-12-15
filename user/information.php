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
  <link rel="stylesheet" type="text/css" href="../css/userstyle.css">
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
    <div class = "b_container">
    <a href="./user_edit.php" class="btn-border">ユーザー情報の編集</a>
  </div>
</div>
    <div class="item">
    車種 :
    <?php
    $config = True;
    try{
      $db = new SQLite3("../DB/customer.sqlite3");
      $sql = 'SELECT * FROM car';
      $res = $db->query($sql);
      while( $row = $res->fetchArray()){
        if($row['user_id']==$_SESSION['user_id']){
          echo $row['car_name'];
          $f_distance = $row['first_distance'];
          $n_distance = $row['now_distance'];
          $reg_date = $row['reg_date'];
          $config = False;
        }
      }
      if($config){
        echo '車種を設定して下さい';
      }
    }catch(Exception $e){
      echo 'データベースエラー';
    }
     ?>
    </div>
    <div class="item">
    初期走行距離 :
    <?php
    if($config){
      echo '初期の走行距離を設定して下さい';
    }else{
      echo $f_distance.' km';
    }
     ?>
    </div>
    <div class="item">
    現在走行距離 :
    <?php
    if($config){
      echo '現在の走行距離を設定して下さい';
    }else{
      echo $n_distance.' km';
    }
     ?>
    </div>
    <div class="item2">
    登録年月日 :
    <?php
    if($config){
      echo '登録年月日を設定して下さい';
    }else{
      echo substr($reg_date,0,4).' 年 '.substr($reg_date,4).' 月';
    }
     ?>
     <div class = "b_container">
     <a href="./car_edit.php" class="btn-border">車体情報の編集</a>
   </div>
</div>
  </main>
</body>
