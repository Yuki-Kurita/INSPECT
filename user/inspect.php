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
        <li><a href="inspect.php">Replace</a></li>
        <li><a href="checker.php">Daily inspection</a></li>
        <li><a href="information.php">User</a></li>
        <li><a href="logout.php">log out</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <!-- DBから値抽出 -->
    <?php
      require("db_select.php");
      $engine = select("engine");
      $foot = select("foot");
      $drive = select("drive_exterior");
     ?>
    <h2 class="topic">車の点検</h2>
    <table>
      <tr>
      <?php
      // テーブルに挿入する変数
      $e_oil = d_checker($engine,'e_oil');
      $oil_filter = $engine['oilfilter'];
      $batterie = r_checker($engine,'batterie');
      $llc = r_checker($engine,'llc');
      $b_fluid = d_checker($engine,'b_fluid');
      $p_oil = d_checker($engine,'p_oil');
      $aircleaner = d_checker($engine,'aircleaner');
      $spark = d_checker($engine,'spark');
      $plug = d_checker($engine,'plug');
      $timing_b = d_checker($engine,'timing_b');
      $v_belt = d_checker($engine,'v_belt');
      $fuel_i = d_checker($engine,'fuel_i');
      $fuel_f  = d_checker($engine,'fuel_f');
      $tire = r_checker($foot,'tire');
      $tire_r = d_checker($foot,'tire_r');
      $Tyrot_end = d_checker($foot,'Tyrot_end');
      $brake_h = d_checker($foot,'brake_h');
      $brake_c = d_checker($foot,'brake_c');
      $damper = d_checker($foot,'damper');
      $d_oil = d_checker($drive,'d_oil');
      $smoke_candle = d_checker($drive,'smoke_candle');
      $c_filter = d_checker($drive,'c_filter');
      $wiper_b_r = r_checker($drive,'wiper_b_r');

      print<<<_HTML_
        <th>メンテナンスパーツ</th> <th>交換時期の目安</th> <th>費用の目安</th>
      </tr>
      <tr>
        <td colspan="3" class="sub_th">エンジンルーム</td>
      </tr>
      <tr>
        <td>エンジンオイル</td><td>$e_oil</td> <td>¥4000</td>
      </tr>
      <tr>
        <td>オイルフィルター</td> <td>後エンジンオイル $oil_filter 回</td> <td>¥2000</td>
      </tr>
      <tr>
        <td>バッテリー</td> <td>$batterie</td> <td>¥10000</td>
      </tr>
      <tr>
        <td>冷却</td> <td>$llc</td> <td>¥5000</td>
      </tr>
      <tr>
        <td>ブレーキフルード</td> <td>$b_fluid</td> <td>¥4000</td>
      </tr>
      <tr>
        <td>パワステオイル</td> <td>$p_oil</td> <td>¥2000</td>
      </tr>
      <tr>
        <td>エアークリーナーエレメント</td> <td>$aircleaner</td> <td>¥3000</td>
      </tr>
      <tr>
        <td>スパークプラグ</td> <td>$spark</td> <td>¥5000</td>
      </tr>
      <tr>
        <td>プラグコード</td> <td>$plug</td> <td>¥10000</td>
      </tr>
      <tr>
        <td>タイミングベルト</td> <td>$timing_b</td> <td>¥50000</td>
      </tr>
      <tr>
        <td>Vベルト</td> <td>$v_belt</td> <td>¥6000</td>
      </tr>
      <tr>
        <td>フューエルインジェクター</td> <td>$fuel_i</td> <td>¥50000</td>
      </tr>
      <tr>
        <td>フューエルフィルター</td> <td>$fuel_f</td> <td>¥6000</td>
      </tr>
      <tr>
        <td colspan="3" class="sub_th">足まわり</td>
      </tr>
      <tr>
        <td>タイヤ</td><td>$tire</td> <td>¥40000</td>
      </tr>
      <tr>
        <td>タイヤローテーション</td><td>$tire_r</td> <td>¥3000</td>
      </tr>
      <tr>
        <td>タイロットエンド</td><td>$Tyrot_end</td> <td>¥20000</td>
      </tr>
      <tr>
        <td>ブレーキパッド</td><td>$brake_h</td> <td>¥9000</td>
      </tr>
      <tr>
        <td>ブレーキキャリバー、ホース</td><td>$brake_c</td> <td>¥20000</td>
      </tr>
      <tr>
        <td>ダンパー</td><td>$damper</td><td>¥40000</td>
      </tr>
      <tr>
        <td colspan="3" class="sub_th">駆動系、エクステリア</td>
      </tr>
      <tr>
        <td>デフオイル</td><td>$d_oil</td> <td>¥4000</td>
      </tr>
      <tr>
        <td>発煙筒</td><td>$smoke_candle</td> <td>¥500</td>
      </tr>
      <tr>
        <td>クリーンフィルター</td><td>$c_filter</td> <td>¥2000</td>
      </tr>
      <tr>
        <td>ワイパーブレード</td><td>$wiper_b_r</td> <td>¥2000</td>
      </tr>
    </table>
_HTML_;
  ?>
<!--
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
</div> -->
  </main>
</body>
