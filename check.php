<?php
$db = null;
$sql = null;
$res = null;
// DB接続
$db = new SQLite3("./DB/customer.sqlite3");
// クエリ作成
$sql = 'SELECT * FROM user';
// リクエスト
$res = $db->query($sql);
echo 'DBの中身は<br/>';
// 結果の行を取得
while( $row = $res->fetchArray()){
echo '<p>'.$row[0].' '.$row[1].' '.$row[2].'</p>';
}
