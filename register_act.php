<?php
// 1. POSTデータ取得
$newid = $_POST['newid'];
$newpw = $_POST['newpw'];

// 2. DB接続します
require_once('funcs.php'); //一度呼び出す
$pdo = db_conn();

$newhashpw = password_hash($newpw,PASSWORD_DEFAULT);

// ３．SQL文を用意(データ登録：INSERT)
// SQL injectionからの防御でコロンを入力変数の前に入れる（バインド変数）
$stmt = $pdo->prepare(
  "INSERT INTO gs_user_table(id, name, lid, lpw, kanri_flg, life_flg)
  VALUES( NULL, :newid, :newid, :newhashpw, 0, 0)"
);

// 4. バインド変数を用意
$stmt->bindValue(':newid', $newid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':newhashpw', $newhashpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('index.php');
}
?>