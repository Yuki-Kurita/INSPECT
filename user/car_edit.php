<?php session_start();
// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";
$db = null;
$sql = null;
$res = null;
$sql2 = null;
$res2 = null;
$sql3 = null;
$res3 = null;
$sql4 = null;
$res4 = null;
$sql5 = null;
$res5 = null;
$insertCon = True;
if(isset($_POST['edit'])){
  // 距離が数値で入力されているか確認
  if(is_numeric($_POST['f_distance']) && is_numeric($_POST['n_distance'])){
    $f_distance = intval($_POST['f_distance']);
    $n_distance = intval($_POST['n_distance']);
    $distance = $n_distance - $f_distance;
  }else{
    $errorMessage = "距離は数値を入力してください";
  }
  // 年月が入力されているか確認
  if(empty($_POST['month']) || empty($_POST['year'])){
    $errorMessage = '年月を登録してください';
  }

  if(!empty($_POST['car_name']) && is_numeric($_POST['f_distance']) && is_numeric($_POST['n_distance']) && !empty($_POST['month']) && !empty($_POST['year'])){
    try{
      $id = $_SESSION['user_id'];
      $car_name = htmlentities($_POST['car_name']);
      $reg_date = intval($_POST['year'].$_POST['month']);
      $d_year = intval(date("Y")) - intval($_POST['year']);
      $d_month = intval(date("m")) - intval($_POST['month']);
      $time = $d_year*12 + $d_month;
      $year = floor($time/12);
      $month = $time%12;
      // engine周りの変数
      $e_oil = 5000 - $distance;
      $oilfilter = 0;
      $batterie = strval(floor((4*12-$time)/12))." 年 ".strval((4*12-$time)%12)." 月 ";
      $llc = strval(floor((2*12-$time)/12))." 年 ".strval((2*12-$time)%12)." 月 ";
      $b_fluid = $p_oil = 25000 - $distance;
      $aircleaner = 45000 - $distance;
      $spark = 40000 - $distance;
      $plug = $timing_b = 100000 - $distance;
      $v_belt = 75000 - $distance;
      $fuel_i = 175000 - $distance;
      $fuel_f = 125000 - $distance;
      // foot周りの変数
      $tire = strval(floor((5*12-$time)/12))." 年 ".strval((5*12-$time)%12)." 月 ";
      $tire_r = 5000 - $distance;
      $Tyrot_end = 100000 - $distance;
      $brake_h = 30000 - $distance;
      $brake_c = $damper = 100000 - $distance;
      // 駆動系
      $d_oil = 50000 - $distance;
      $smoke_candle =strval(floor((3*12-$time)/12))." 年 ".strval((3*12-$time)%12)." 月 ";
      $c_filter = 30000 - $distance;
      $wiper_b_r = strval(floor((2*12-$time)/12))." 年 ".strval((2*12-$time)%12)." 月 ";
      // データの入れ替え
      $db = new SQLite3("../DB/customer.sqlite3");
      $sql = "SELECT * FROM car";
      $res = $db->query($sql);
      while($row = $res->fetchArray()){
        if($row['user_id'] == $_SESSION['user_id']){
          $sql2 = "UPDATE car SET car_name='$car_name', first_distance=$f_distance, now_distance=$n_distance, reg_date=$reg_date WHERE user_id = $id";
          $res2 = $db->query($sql2);
          $insertCon = False;
          $signUpMessage = "設定の変更を完了しました";
          break;
        }
      }
      // データの追加
      if($insertCon){
        $sql2 = "INSERT INTO car values($id,'$car_name',$f_distance,$n_distance,$reg_date)";
        $res2 = $db->query($sql2);
        // エンジン周りのDB追加
        $sql3 = "INSERT INTO engine values($id,$e_oil,$oilfilter,'$batterie','$llc',$b_fluid,$p_oil,$aircleaner,$spark,$plug,$timing_b,$v_belt,$fuel_i,$fuel_f)";
        $res3 = $db->query($sql3);
        // foot周り
        $sql4 = "INSERT INTO foot values($id,'$tire',$tire_r,$Tyrot_end,$brake_h,$brake_c,$damper)";
        $res4 = $db->query($sql4);
        // 駆動系
        $sql5 = "INSERT INTO drive_exterior values($id,$d_oil,'$smoke_candle',$c_filter,'$wiper_b_r')";
        $res5 = $db->query($sql5);
        $signUpMessage = "車の設定を追加しました";
      }

    }catch(Exception $e){
      $errorMessage = 'DBエラー';
    }
  }
}
 ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>INSPECT</title>
  <link rel="stylesheet" type="text/css" href="../css/userstyle.css">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/car_form.scss">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>

<body>
  <!-- ナビゲーションバー -->
  <header>
    <nav>
    <ul id="menu">
      <li class="hamburger"><a href="#menu"><i class="fa fa-bars"></i></a></li>
        <li class="logo"><a href="inspect.php">INSPECT</a></li>
        <li><a href="inspect.php">Replace</a></li>
        <li><a href="checker.php">Daily inspection</a></li>
        <li><a href="information.php">User</a></li>
        <li><a href="logout.php">log out</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="message">
    <?php
      if($errorMessage){
      echo $errorMessage;
    }
      else if($signUpMessage){
      echo $signUpMessage;
      }
     ?>
   </div>
    <form aciton="car_edit.php" method="post">
      <h1><i class="fas fa-car"></i> UPDATE CAR INFORMATION <i class="fas fa-car"></i></h1>
      <?php
      print<<<_HTML_
      <div class='form-name'>車種(例 : プリウス)</div>
      <input value="$car_name" type="text" required="" name="car_name">
      <div class="form-name">初期走行距離(最後に点検を行なった時の走行距離を入力してください　単位:km)</div>
      <input value="$f_distance" type="text" required="" name="f_distance">
      <div class="form-name">現在走行距離(例 : 4000)</div>
      <input value="$n_distance" type="text" required="" name="n_distance">
      <div class="form-name">最後に点検を行なった年月<br/></div>
      <div class="date">
      <select name="year">
      <option value="">-</option>
_HTML_;
      for($i=1990; $i<2019; $i++){
      print "<option value='$i'>$i</option>";
    }
      print<<<__HTML__
      </select>　年
      <select name="month">
      <option value="">-</option>
__HTML__;
      for($i=1; $i<13; $i++){
      print "<option value='$i'>$i</option>";
    }
      print<<<___HTML___
</select> 月</div>
___HTML___
       ?>
      <input type="submit" name="edit" value="Update car information" class="button">
    </form>
  </main>
</body>
