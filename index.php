
Spider
<br></br>
<?php
/*include 'functions.php';
//test_get_href("https://www.electro-mpo.ru");


$t = get_href("https://tvoydom.ru");



foreach($t as $t1)
{
    foreach($t1 as $t2)
    {
    //$problem = array('"', '>');
    //$newt = str_replace($problem, '', $t2);
     echo $t2;
     echo "<br>";
    
     //echo (get_title ($newt));
    echo '<br>';

        echo $newt;
    
       // too($newt);
    
    

    }
     


}
    
*/
?>

Ок
<br><br>
 
<?php
 
include "functions.php";

$url = "https://aif.ru/society/na_ukraine_poyavilsya_nekrolog_o_zenitchike_vsu_na_fone_zrk_patriot";
 
$u=get_href($url);         //$u - многомерный массив, первый столбик которого - ссылка, а второй признак
//print_r($u);



for ($i=0; $i<count($u[0]); $i++) 
{
too($u[0][$i],$u[1][$i]); // пишем ссылку в БД

}


?>
