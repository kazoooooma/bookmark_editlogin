<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$id = $_POST['id'];
$title = $_POST['title'];
$url = $_POST['url'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];

// 2. DB接続します
require_once('funcs.php'); //一度呼び出す
$pdo = db_conn();


// ３．SQL文を用意(データ登録：INSERT)
// SQL injectionからの防御でコロンを入力変数の前に入れる（バインド変数）
$stmt = $pdo->prepare(
  "INSERT INTO gs_bm_table(id, title, url, comment, rating, indate)
  VALUES( NULL, :title, :url, :comment, :rating, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rating', $rating, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('index.php');
}
?>
