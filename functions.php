<?php
function get_ahref($url) //получение ссылок
{
    $str = file_get_contents($url);
    preg_match_all("~[a-z]+://\S+~i" , $str , $data);
    
    return($data);
}

function get_title($url) //получение ссылок
{
    $str = file_get_contents($url);
    preg_match_all("/<title>(.*?)<\\/title>/is" , $str , $data);
    
    return($data[1][0]);
}

function too($url)
{
$t = get_title($url);
$link = new mysqli('localhost', 'root', '', 'spider');
 
//$link = mysqli_connect("localhost", "root", "");
 
$sql = 'INSERT INTO `ahref` (`href`, `date`, `status`, `complete`, `title`) VALUES ("'.$url.'", now(), "new", 0, "'.$t.'")';
$result = mysqli_query($link, $sql);
 
$link->close();
 
return;
}







 
function get_href($url)
{
    $urlData = parse_url($url);      // парсим URL, разлогая его на элементы
    $scheme = $urlData["scheme"];    // записываем первую часть урла (http или https)
    $host = $urlData['host'];        // записываем домен урла ( например: site.ru)
    $first=$scheme."://".$host;      // из полученных данных формируем корневую конструкцию типа: https://site.ru 
                                     //(для дальнейшей подстановки во внутренние ссылки сайта)
 
//регулярное выражение для поиска строк вида: href="ссылка" (может быть с пробелами: href = "ссылка")
$regex = "/href*=*(\"|\')[^>]+?(\"|\')/";      
 // href    - начало строки
 // *       - знак равно может быть написан слитно или через пробелы, поэтому ставим звездочку
 // =       - знак равно
 // *       - после равно могут быть пробелы, поэтому ставим звездочку
 // (\"|\') - кавычки или апострофы для ссылки  (знак | - или) (перед кавычками и апострофами добавлено экранирование: \)
 // [^>]    - любой символ кроме закрывающего тега ">"
 // +       - может повторяться от одного до бесконечности раз (сколько угодно символов)
 // ?       - указывает брать минимальное значение символов между кавычками или апострофами
 
$str = file_get_contents($url);             // считывание страницы в переменную $str
preg_match_all($regex, $str, $u );          // поиск строк по регулярному выражению и запись их в массив $u[][]
 
$q = array(array());                        // создаем новый пустой двумерный массив (первый столбец для ссылок, второй для их типа)
$i=0;                                       // переменная - счетчик для ключей (индексов) нового массива
 
foreach ($u[0] as $el)                      // для каждого элемента первого столбца массива $u[][] 
{                                           // ДЕЛАЕМ:
    $el = preg_replace('/\s+/', '', $el);   // удаляем все пробелы
    $el = str_replace('href=', '', $el);    // удаляем href= (пробелов уже нет, так что href =  тоже удалится)
    $el = str_replace('"', '', $el);        // удаляем кавычки
    $el = str_replace("'", '', $el);        // удаляем апостофы
 
    if (                                    // НЕ ПРИНИМАЕМ:
        ($el != '#')                        // пустые ссылки с  символом #
    and ($el != '/')                        // ссылки на главную страницу
    ) {                                     // ЕСЛИ ВСЕ В ПОРЯДКЕ:
 
        $r=0;                               // признак уже совершенного действия (0 - действие не совершалось)
 
        if ((substr($el, 0, 1)=="/") and ($r==0))               // если ссылка без указания домена
        {
            $q[0][$i]=$first.$el; $q[1][$i]="loc"; $i++; $r=1;  // прибавляем конструкцию http(s)://site.ru и записываем, как loc
        }
        if ((strpos($el, "tel:")!==false) and ($r==0))          // если есть тег "tel:" 
        {
            $q[0][$i] = str_replace("tel:", '', $el); $q[1][$i]="tel"; $i++; $r=1;  // убираем "tel:" и записываем, как tel
        }
        if ((strpos($el, "mailto:")!==false) and ($r==0))       // если есть тег "mailto:"
        {
            $q[0][$i]= str_replace("mailto:", '', $el); $q[1][$i]="mail"; $i++; $r=1; // убираем "mailto:" и записываем, как mail
        }
        if ((strpos($el, $host)!==false ) and ($r==0)) // если указан внутренний домен, то проверяем, есть ли http(s):// 
        {                                              // если нет, добавляем и в любом случае записываем, как loc:
 
            if (strpos($el, $scheme)!==false ) {  $q[0][$i]=$el; $q[1][$i]="loc";         $i++; $r=1;}
            else                               {  $q[0][$i]=$scheme.$el; $q[1][$i]="loc"; $i++; $r=1;}
        }
        if ($r==0)                                       // если не одно из условий не выполнилось ($r==0)
        {
            $q[0][$i]=$el;  $q[1][$i]="www"; $i++; $r=1; // то записываем ссылку, как внешнюю (признак www)
        }    
    }                                       
}
return($u);                                            // возвращаем полученный массив $q[][]
}
 
// тест для функии get_href($url)
function test_get_href($url)
{
    $u=get_href($url);
 
    echo ' <table border="1">';
    for ($i=0; $i<count($u[0]); $i++)
    {
       echo " <tr> ";
       echo " <td> "; 
       echo $u[0][$i];
       echo " </td><td> ";
       echo $u[1][$i];
       echo " </td> ";
       echo " </tr> ";
    }
    echo " </table>";
}





















?>