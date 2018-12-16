<?php
function select($table){
  try{
  $errorMessage = '';
  $config = True;
  $db = new SQLite3("../DB/customer.sqlite3");
  //DBから抽出
  $sql = "SELECT * FROM $table";
  $res = $db->query($sql);
  while( $row = $res->fetchArray()){
    if($row['user_id']==$_SESSION['user_id']){
      $data = $row;
      $config = False;
      break;
      }
    }
      if($config){
        $errorMessage = '車種を設定して下さい';
      }
    }catch(Exception $e){
      $errorMessage = 'データベースエラー';
    }

    if($errorMessage){
      echo $errorMessage;
    }
    return $data;
  }

function d_checker($table,$column){
  $output = $table["$column"];
  if($output<=0){
    return "交換してください";
  }
  else{
    return "後 ".$output." km";
  }
}

function r_checker($table,$column){
  $output = $table["$column"];
  if(strpos($output,'-') !== false){
    return "交換してください";
  }
  else{
    return "残り ".$output;
  }
}
?>
