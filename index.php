Hey
<br><br>

<?php

include "functions.php";

$record = intoo("www");
$id = $record['id'];
$url = "https://aif.ru";   //$record['href'];

echo "Получено: <br>";
echo "URL:";  echo $url;
echo "<br>";
echo "id:";   echo $id;

echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>";

$u=get_href($str, $url);         //$u - многомерный массив, первый столбик которого - ссылка, а второй признак

for ($i=0; $i<count($u[0]); $i++) too($u[0][$i], $u[1][$i]); // пишем ссылку в БД






?>