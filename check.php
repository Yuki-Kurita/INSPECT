<?php
$db = null;
$sql = null;
$res = null;
$sql2 = null;
$res2 = null;
// DB接続
$db = new SQLite3("./DB/customer.sqlite3");
// クエリ作成
$sql = 'SELECT * FROM users';
// リクエスト
$res = $db->query($sql);
echo 'user_DBの中身は<br/>';
// 結果の行を取得
while( $row = $res->fetchArray()){
echo '<p>'.$row[0].' '.$row[1].' '.$row[2].' '.$row[3].'</p>';
}

// クエリ作成
$sql2 = 'SELECT * FROM car';
// リクエスト
$res2 = $db->query($sql2);
echo 'car_DBの中身は<br/>';
// 結果の行を取得
while( $row = $res2->fetchArray()){
echo '<p>'.$row[0].' '.$row[1].' '.$row[2].' '.$row[3].' '.$row[4].'</p>';
}

$sql3 = 'SELECT * FROM engine';
// リクエスト
$res3 = $db->query($sql3);
echo 'engine_DBの中身は<br/>';
// 結果の行を取得
while( $row = $res3->fetchArray()){
  for($i=0;$i<count($row);$i++){
    echo $row[$i];
  }
}
