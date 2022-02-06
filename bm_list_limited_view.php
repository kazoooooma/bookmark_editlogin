<?php

//SESSIONスタート
session_start();

//関数を呼び出す
require_once('funcs.php');

//ログインチェック、sessionid更新
loginCheck();

//以下ログインユーザーのみ
$user_name = $_SESSION['name'];

//1.  DB接続します
require_once('funcs.php'); //一度呼び出す
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .=
    '<tr class="list_row">'.
    '<td class="list_results">'.$result['indate'].'</td>'.
    '<td class="list_results">'.'<a href="'.$result['url'].'">'.$result['title'].'</a></td>'.
    '<td class="list_results">'.$result['comment'].'</td>'.
    '<td class="list_results">'.'<img src="img/star'.$result['rating'].'.png" class="starrate">'.'</td>'.
    '</tr>';
  };
};
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧</title>
<link rel="stylesheet" href="css/listview.css">
<script src="js/jquery-3.5.1.min.js"></script>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><< ブックマーク登録に戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="title-container">
    <p class="title-text">ブックマーク一覧（閲覧のみ）</p>
  </div>
<div>
<table class="list_table">
    <tr>
      <th class="list_header" id="indate">追加日時</th>
      <th class="list_header" id="title">タイトル</th>
      <th class="list_header" id="comment">コメント</th>
      <th class="list_header" id="rating">レーティング</th>
    </tr>
    <?= $view ?>
</div>
<!-- Main[End] -->

</body>
</html>

<script>
  function delClick(id){
    let res = confirm("本当に削除しますか？");
    if( res == true ) {
        // OKなら移動
        window.location.href = "http://localhost/bookmark_editable/bm_delete.php?id="+id;
    }
    else {
        // キャンセルならアラートボックスを表示
        alert("キャンセルしました");
    }
  }
</script>
