<?php
include("functions.php");
// id受け取り
//var_dump($_GET);
//exit();
$id = $_GET['id'];
// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM busstation_teble WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="todo_update.php" method="POST">
    <fieldset>
      <legend>バス停登録画面</legend>
      <a href="todo_read.php">バス停一覧画面</a>
      <div>
        バス停名: <input type="text" name="bus_station_name" value="<?= $record['bus_station_name'] ?>">
      </div>
      <div>
        緯度: <input type="text" name="latitude" value="<?= $record['latitude'] ?>">
      </div>
      <div>
        経度: <input type="text" name="longitude" value="<?= $record['longitude'] ?>">
      </div>
      <div>
        <input type="hidden" name="id" value="<?= $record['id'] ?>">
      </div>

      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>