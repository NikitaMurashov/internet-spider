<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <button class="j-worker">Старт</button>
    <script type="text/javascript">
        (function() {
            document.querySelector('.j-worker').addEventListener('click', pagesProcessing);
     
            // Массив с ссылками для перебора
             
            let uri = [
              'http://spider.lc/spider1.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider1.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider2.php',
              'http://spider.lc/spider2.php'



            ];
             
            async function pagesProcessing() {
              while(1){
              for (let [i, page] of uri.entries()) {
                // Запускаем функцию открытия страницы в новом окне. После выполнения инструкций, выводим в консоль данные о uri.
                await callPage(page).then(() => {
                  console.log(`uri: ${page} by index ${i} just called!`);
                });
             
                // «Спим» 2 секунды и продолжаем итерацию callPage()
                await delay(25000);
              }
            }}
             
            async function callPage(page) {
              try {
                let dialogPageObject = window.open(page, '', 'resizable');

                delay(20000).then(() => dialogPageObject.close());
              } catch (e) {
                return e;
              }
            }
             
            function delay(ms) {
              return new Promise((resolve) => setTimeout(resolve, ms));
            }
        })();
    </script>
</body>
</html>
1