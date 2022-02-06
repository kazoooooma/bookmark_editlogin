<?php
//1.  DB接続します
require_once('funcs.php'); //一度呼び出す
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");

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
    '<td class="list_results">'.$result['lid'].'</td>'.
    '<td class="list_results">'.$result['lpw'].'</td>'.
    '<td class="list_results">'.$result['kanri_flg'].'</td>'.
    // '<td class="list_results"><a href="user_delete.php?id='.$result['id'].'">[ユーザーを削除]</a></td>'.
    '<td class="list_results"><a href="" onclick="delClick('.$result['id'].')">[ユーザー削除]</a></td>'.
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
<link rel="stylesheet" href="css/userview.css">
<script src="js/jquery-3.5.1.min.js"></script>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><< トップページに戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="title-container">
    <p class="title-text">ユーザー管理</p>
  </div>
<div>
<table class="list_table">
    <tr>
      <th class="list_header" id="userid">ユーザーid</th>
      <th class="list_header" id="password">ユーザーパスワード</th>
      <th class="list_header" id="kanriflg">管理者権限</th>
      <th class="list_header" id="del">管理</th>
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
        window.location.href = "https://kazoooooma.sakura.ne.jp/bookmark_editlogin/user_delete.php?id="+id;
    }
    else {
        // キャンセルならアラートボックスを表示
        alert("キャンセルしました");
    }
  }
</script>
