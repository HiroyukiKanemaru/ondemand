<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>バス停登録（入力画面）</title>
</head>

<body>
  <form action="todo_create.php" method="POST">
    <fieldset>
      <legend>バス停登録入力画面</legend>
      <a href="todo_read.php">バス停一覧画面</a>
      <div>
        バス停名: <input type="text" name="bus_station_name">
      </div>
      <div>
        latitude: <input type="text" name="latitude">
      </div>
      <div>
        longitude: <input type="text" name="longitude">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>