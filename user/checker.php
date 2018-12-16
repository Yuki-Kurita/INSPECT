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
  <div class="daily-check">
  <ul>
    <li>ブレーキ液の量</li>
    <li>冷却水の量</li>
    <li>エンジン・オイルの量</li>
    <li>バッテリー液の量</li>
    <li>ワイパーブレード</li>
    <li>ウインド・ウォッシャ液の量</li>
  </ul>
</div>
  </main>
</body>
