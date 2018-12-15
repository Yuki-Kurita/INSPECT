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
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

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
    <!-- DBから値抽出 -->
    <?php
    try{
      $errorMessage = '';
      $config = True;
      $db = new SQLite3("../DB/customer.sqlite3");
      $sql = 'SELECT * FROM car';
      $res = $db->query($sql);
      while( $row = $res->fetchArray()){
        if($row['user_id']==$_SESSION['user_id']){
          $f_distance = $row['first_distance'];
          $n_distance = $row['now_distance'];
          $reg_date = $row['reg_date'];
          $config = False;
          $distance = $n_distance - $f_distance;
          $d_year = intval(date("Y")) - intval(substr($reg_date,0,4));
          $d_month = date("m") - intval(substr($reg_date,4));
          $time = $d_year*12 + $d_month;
          $year = floor($time/12);
          $month = $time%12;
          break;
          }
        }
          if($config){
            $errorMessage = '車種を設定して下さい';
          }
        }catch(Exception $e){
          $errorMessage = 'データベースエラー';
        }
     ?>
    <h1 class="topic">車の点検</h1>
    <table>
      <tr>
      <?php
      // 各パーツの残り距離、期間
      $eo_d = 5000-$distance;
      print<<<_HTML_
        <th>メンテナンスパーツ</th> <th>交換時期の目安</th> <th>費用の目安</th>
      </tr>
      <tr>
        <td colspan="3" class="sub_th">エンジンルーム</td>
      </tr>
      <tr>

        <td>エンジンオイル</td><td>後 $eo_d km</td> <td>¥4000</td>
      </tr>
      <tr>
        <td>オイルフィルター</td> <td>24</td> <td>¥2000</td>
      </tr>
      <tr>
        <td>バッテリー</td> <td>20</td> <td>¥10000</td>
      </tr>
    </table>
_HTML_;
  ?>
      <!-- <li>エンジンオイル</li>
      <li>オイルフィルター</li>
      <li>バッテリー</li>
      <li>冷却水</li>
      <li>ブレーキフルード</li>
      <li>パワステオイル</li>
      <li>エアクリーナーエレメント</li>
      <li>スパークプラグ</li>
      <li>プラグコード</li>
      <li>タイミングベルト</li>
      <li>Vベルト</li>
      <li>ラジエターホース</li>
      <li>フューエルフィルター</li> -->


  <div class="daily-check">
  <ul>
    <li>バッテリー</li>
    <li>エアクリーナー</li>
    <li>ラジエーター液</li>
    <li>ワイパー</li>
    <li>ワイパーブレード</li>
    <li>Photoshop</li>
    <li>Illustrator</li>
  </ul>
</div>
  </main>
</body>
