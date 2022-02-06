<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/register_style.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ユーザー登録</title>
</head>
<body>

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index.php"><< トップページに戻る</a></div>
    </div>
  </nav>
</header>
<div class="title-container">
    <p class="title-text">新規登録</p>
</div>
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="register_act.php" method="post">
<table class="form-table">
    <tr>
      <th class="form-header">ユーザーID</th>
      <td class="form-data">
        <input type="text" class="form-text" name="newid">
      </td>
    </tr>
    <tr>
      <th class="form-header">パスワード</th>
      <td class="form-data">
        <input type="password" class="form-text" name="newpw">
      </td>
    </tr>
</table>
<p id="sendbutton"><input type="submit" id="send" value="新規登録"></input></p> 
</form>


</body>
</html>