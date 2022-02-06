<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php'); //一度呼び出す
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view ='';
if($status == false){
    sql_error($stmt);
}else{
    $result = $stmt->fetch();
}

?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブックマーク編集</title>
    <link rel="stylesheet" href="css/indexstyle.css">
</head>

<body>
<div class="title-container">
    <p class="title-text">ブックマーク編集</p>
  </div>

    <!-- method, action, 各inputのnameを確認してください。  -->
<div id="inputcontainer">
<form method="post" action="bm_update.php">
  <table class="form-table">
    <tr>
      <th class="form-header">書籍タイトル</th>
      <td class="form-data">
        <input type="text" class="form-text" name="title" value="<?= $result['title']?>">
      </td>
    </tr>
    <tr>
      <th class="form-header">URL
      </th>
      <td class="form-data">
        <input type="text" class="form-text" name="url" value="<?= $result['url']?>">
      </td>
    </tr>
    <tr>
      <th class="form-header">評価<br></th>
      <td class="form-data">
        <div class="stars">
          <input id="star5" type="radio" name="rating" value="5" />
          <label for="star5">★</label>
          <input id="star4" type="radio" name="rating" value="4" />
          <label for="star4">★</label>
          <input id="star3" type="radio" name="rating" value="3" />
          <label for="star3">★</label>
          <input id="star2" type="radio" name="rating" value="2" />
          <label for="star2">★</label>
          <input id="star1" type="radio" name="rating" value="1" />
          <label for="star1">★</label>
        </div>
    </tr>
    <tr>
      <th class="form-header">コメント<br></th>
      <td class="form-data">
        <textarea id="text" class="form-longtext" name="comment"><?= $result['comment']?></textarea>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?= $result['id']?>">
  <p id="sendbutton"><input type="submit" id="send" value="更新"></input></p> 
</form>
</div>

<div class="listlink_container">
    <div class="listlink"><a class="linktext" href="bm_list_view.php">一覧に戻る</a></div>
  </div>
</body>

</html>
