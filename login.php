<?php session_start();
// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$db = null;
$sql = null;
$res = null;
$loginCon = True;
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
  try{
    // DB接続
    $db = new SQLite3("./DB/customer.sqlite3");
    // クエリ作成
    $sql = 'SELECT * FROM user';
    // リクエスト
    $res = $db->query($sql);
    while( $row = $res->fetchArray()){
      $count += 1;
      // mailアドレスが一致するか
      if($email == $row['email']){
        // パスワードが一致するか
        if(password_verify($password,$row['password'])){
        // 認証成功
          session_regenerate_id(true);
          $_SESSION['email'] = $row['email'];
          $_SESSION['notification'] = $row['notification'];
          $loginCon = False;
          // ユーザ画面に移動
          header("Location: user/information.php");
          exit();
      }
    }
    }
    if($loginCon){
      // 認証失敗
      $errorMessage = 'emailまたはパスワードに誤りがあります';
    }
  }
  catch(Exception $e){
    $errorMessage = 'データベースエラー';
  }
  }
}
 ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>INSPECT</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/form.scss">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
</head>

<body>
  <!-- ナビゲーションバー -->
  <header>
    <nav>
    <ul id="menu">
      <li class="hamburger"><a href="#menu"><i class="fa fa-bars"></i></a></li>
        <li class="logo"><a href="/INSPECT">INSPECT</a></li>
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
     ?>
   </div>
    <form aciton="" method="post">
      <h1>Log in</h1>
      <input placeholder="E-mail address" type="text" required="" name="email">
      <input placeholder="Password" type="password" required="" name="password">
      <input type="submit" name="signup" value="login" class="button">
    </form>
  </main>
</body>
