Spider
<br></br>
<?php
include 'functions.php';
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
    






















?>