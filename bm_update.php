<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$id = $_POST['id'];
$title = $_POST['title'];
$url = $_POST['url'];
$comment = $_POST['comment'];
$rating = $_POST['rating'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
// $pdoの中のprepareを使う
$stmt = $pdo->prepare(
    "UPDATE `gs_bm_table` SET 
    title=:title , url=:url , comment=:comment , rating=:rating , indate=sysdate() 
    WHERE id=:id"
  );
  
  // 4. バインド変数を用意
  $stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//４．データ登録処理後
// 実行
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    sql_error($stmt);
  }else{
    //５．リダイレクト
    redirect('bm_list_view.php');
  }