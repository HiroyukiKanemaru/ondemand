<?php
include('functions.php');

//入力チェック
if (
  !isset($_POST['bus_station_name']) || $_POST['bus_station_name'] === '' ||
  !isset($_POST['latitude']) || $_POST['latitude'] === '' ||
  !isset($_POST['longitude']) || $_POST['longitude'] === ''
) {
  exit('paramError');
}

//データの受け取り
$bus_station_name = $_POST['bus_station_name'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// DB接続
$pdo = connect_to_db();

//SQL作成＆実行
$sql = 'INSERT INTO busstation_teble(id, bus_station_name, created_at, updated_at, latitude, longitude) VALUES(NULL, :bus_station_name, now(), now(), :latitude, :longitude)';
$stmt = $pdo->prepare($sql);

//バインド変数
$stmt->bindValue(':bus_station_name', $bus_station_name, PDO::PARAM_STR);
$stmt->bindValue(':latitude', $latitude, PDO::PARAM_STR);
$stmt->bindValue(':longitude', $longitude, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:todo_input.php");
exit();
