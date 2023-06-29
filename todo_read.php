<?php
include('functions.php');

$pdo = connect_to_db();

$sql = 'SELECT * FROM busstation_teble';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["bus_station_name"]}</td>
      <td>{$record["latitude"]}</td>
      <td>{$record["longitude"]}</td>
      <td>
        <a href='todo.ride.php?id={$record["id"]}'>edit</a>
      </td>
      <td>
        <a href='todo_delete.php?id={$record["id"]}'>delete</a>
      </td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録済みバス停一覧</title>
</head>

<body>
  <fieldset>
    <legend>登録済みバス停一覧画面</legend>
    <a href="todo_input.php">入力画面へ戻る</a>
    <p>このスマートフォンのバス停を設定してください</p>
    <table>
      <thead>
        <tr>
          <th>バス停名</th>
          <th>緯度</th>
          <th>経度</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>