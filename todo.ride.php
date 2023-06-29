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

//
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
foreach ($result as $record1) {
    $output .= "
    <tr>
      <td>{$record1["bus_station_name"]}</td>
      <td>{$record1["latitude"]}</td>
      <td>{$record1["longitude"]}</td>
      <td>
        <a href='todo.ride.php?id={$record1["id"]}'>edit</a>
      </td>
    </tr>
  ";
}

$sql = 'SELECT * FROM busstation_teble WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
$record2 = $stmt->fetch(PDO::FETCH_ASSOC);

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
        </fieldset>
    </form>
    <fieldset>
        <legend>登録済みバス停一覧画面</legend>
        <a href="todo_input.php">入力画面へ戻る</a>
        <p>行き先を選択</p>
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
    <fieldset>
        <legend>バス停登録画面</legend>
        <a href="todo_read.php">バス停一覧画面</a>
        <div>
            バス停名: <input type="text" name="bus_station_name" value="<?= $record2['bus_station_name'] ?>">
        </div>
        <div>
            緯度: <input type="text" name="latitude" value="<?= $record2['latitude'] ?>">
        </div>
        <div>
            経度: <input type="text" name="longitude" value="<?= $record2['longitude'] ?>">
        </div>
        <div>
            <input type="hidden" name="id" value="<?= $record2['id'] ?>">
        </div>
    </fieldset>
</body>

</html>