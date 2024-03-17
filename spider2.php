<!DOCTYPE html>
<html>
    <head>
          
        <title>Паук №2</title>
        
        
    </head>
    <body>
   <h1> Паук 2 запущен </h1>
   <img src="spa.jpg" > 
<br>
   <?php
include "functions.php";

$record = intoo("loc");
$id = $record['id'];
$url = $record['href'];

echo "Получено: <br>";
echo "URL:";  echo $url;
echo "<br>";
echo "id:";   echo $id;

echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>";

$t=get_title($url);
title_too($t, $id);


$u=get_href($url);         //$u - многомерный массив, первый столбик которого - ссылка, а второй признак

for ($i=0; $i<count($u[0]); $i++) too($u[0][$i], $u[1][$i]); // пишем ссылку в БД
/*
{
  echo $u[0][$i];  echo "<br>";

}

*/




?>