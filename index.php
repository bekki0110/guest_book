<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'test';
$link = mysqli_connect($host, $user, $password, $dbName);
mysqli_query($link, "SET NAMES utf-8");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Гостевая книга</title>
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
<h1>Гостевая книга</h1>

<?php

if(!empty($_POST)) {
$formName = $_POST['formName'];
$formText = $_POST['formText'];
$query = "INSERT INTO guest_book (name, moment, mess) VALUES ('$formName', NOW(), '$formText')";
mysqli_query($link, $query) or die(mysqli_error($link));
}

$query = "SELECT * FROM guest_book ORDER BY moment DESC";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
for ($data = []; $row=mysqli_fetch_assoc($result); $data[]=$row);

foreach($data as $elem) {
echo '<div class="note">';
echo '<p>';
echo '<span class="date">' . date('d.m.Y H:i:s', strtotime($elem['moment'])) . ' </span>';
echo '<span class="name">' . $elem['name'] . ' </span>';
echo '</p>';
echo '<p>';
echo $elem['mess'];
echo '</p>';
echo '</div>';
}

if(!empty($_POST)) {

?>
<div class="info alert alert-info">
Запись успешно сохранена!
</div>

<?php
}
?>

<div id="form">
<form action="" method="POST">
<p><input class="form-control" name="formName" placeholder="Ваше имя"></p>
<p><textarea class="form-control" name="formText" placeholder="Ваш отзыв"></textarea></p>
<p><input type="submit" name="go" class="btn btn-info btn-block" value="Сохранить"></p>
</form>
</div>

</div>
</body>
</html>