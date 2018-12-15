<?php session_start();
// ログイン状態チェック
if (!isset($_SESSION["email"])) {
    header("Location: Logout.php");
    exit;
}
// DBから走行距離等の情報を抽出
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
    <div class="check">
    <ul>
      <li>HTML</li>
      <li>CSS</li>
      <li>Photoshop</li>
      <li>Illustrator</li>
    </ul>
  </div>
  </main>
</body>
