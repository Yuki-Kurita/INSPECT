<?php session_start();
// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";
$db = null;
$sql = null;
$res = null;
if(isset($_POST['change_pass'])){
  // email addresの入力チェック
  if(strlen($_POST['before_pass'])<8){
    $errorMessage = '前のパスワードを8文字以上で入力してください';
  }
  // passwordのチェック
  else if(strlen($_POST['new_pass'])<8){
    $errorMessage = '新しいパスワードを8文字以上で入力してください';
  }
  else if(!password_verify($_POST["before_pass"],$_SESSION["password"])){
    $errorMessage = 'パスワードが間違っています';
  }
if(strlen($_POST["before_pass"])>=8 && strlen($_POST["new_pass"])>=8 && password_verify($_POST["before_pass"],$_SESSION["password"])){
  try{
    $notification = $_POST['notification'];
    $password = $_POST['new_pass'];
    $id = $_SESSION['user_id'];
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION["password"] = $hash_pass;
    // データの入れ替え
    $db = new SQLite3("../DB/customer.sqlite3");
    $sql = "UPDATE users SET password = '$hash_pass',notification=$notification WHERE user_id = $id";
    $res = $db->query($sql);
    $signUpMessage = "設定の変更が完了しました";
  }catch(Exception $e){
    $errorMessage = 'DBエラー';
  }
}  else{
    $errorMessage = "パスワードが違います";
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
  <link rel="stylesheet" type="text/css" href="../css/user_form.scss">
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
    <form aciton="user_edits.php" method="post">
      <h1>CHANGE USER INFORMATION</i></h1>
      <div class='form-name'>前のパスワード</div>
      <input placeholder="前のパスワードを入力して下さい" type="password" required="" name="before_pass">
      <div class='form-name'>新しいパスワード</div>
      <input placeholder="新しいパスワードを入力して下さい" type="password" required="" name="new_pass">
      <div class='form-name'>通知設定</div>
      <div class="radio02">
        <input type="radio" name="notification" value=1 class="radio02-input" id="radio02-01" checked>
        <label for="radio02-01">ON</label>
        <input type="radio" name="notification" value=0 class="radio02-input" id="radio02-02">
        <label for="radio02-02">OFF</label>
      </div>
      <input type="submit" name="change_pass" value="Change user information" class="button">
    </form>
  </main>
</body>
