<?php session_start();
require 'password.php';
// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";
$db = null;
$sql = null;
$res = null;
$sql2 = null;
$res2 = null;
$count = 1;
// create accountが押された場合
if(isset($_POST['signup'])){
  // email addresの入力チェック
  if(empty($_POST['email'])){
    $errorMessage = 'メールアドレスが未入力です';
  }
  // passwordのチェック
  else if(strlen($_POST['password'])<8){
    $errorMessage = 'パスワードは8桁以上で入力してください';
  }
// メールアドレスとパスワードが入力されている場合
if(!empty($_POST["email"]) && strlen($_POST["password"])>=8){
  $email = $_POST["email"];
  $password = $_POST["password"];
  $hash_pass = password_hash($password, PASSWORD_DEFAULT);
  $notification = 1;
  // DBへの追加
  try{
    $db = new SQLite3("DB/customer.sqlite3");
    $sql = 'SELECT * FROM users';
    $res = $db->query($sql);
    while( $row = $res->fetchArray()){
      $count += 1;
      // emailが被ってないかチェック
    }
    $sql2 = "INSERT INTO users(user_id,email,password,notification) values($count,'$email','$hash_pass',$notification)";
    $res2 = $db->query($sql2);
    $signUpMessage = '登録が完了しました。あなたのmail addresは'.$email.'です。<br/>パスワードは'.$password.'です。';
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
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/form.scss">
</head>

<body>
  <!-- ナビゲーションバー -->
  <header>
    <nav>
    <ul id="menu">
      <li class="hamburger"><a href="#menu"><i class="fa fa-bars"></i></a></li>
        <li class="logo"><a href="">INSPECT</a></li>
        <li><a href="create.php">Create Account</a></li>
        <li><a href="login.php">log in</a></li>
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
    <form aciton="information.php" method="post">
      <h1>CREATE ACCOUNT</h1>
      <input placeholder="E-mail address" type="text" required="" name="email">
      <input placeholder="Password" type="password" required="" name="password">
      <input type="submit" name="signup" value="CREATE ACCOUNT" class="button">
    </form>
  </main>
</body>
