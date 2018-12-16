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
        <li><a href="checker.php">inspection</a></li>
        <li><a href="information.php">User</a></li>
        <li><a href="logout.php">log out</a></li>
      </ul>
    </nav>
  </header>
  <main>
  <div class="daily-check">
  <ul>
    <li>バッテリー</li>
    <li>エアクリーナー</li>
    <li>ラジエーター液</li>
    <li>ワイパー</li>
    <li>ワイパーブレード</li>
  </ul>
</div>
  </main>
</body>
