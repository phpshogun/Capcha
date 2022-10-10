<?php

session_start();

$width = 180;  //ширина 
$height = 60; //высота 
$count = 4; //кол-во символов, которое будет отражаться на картинке
$count_small = 40; //кол-во символов мелких
$font_size = 16; //размер шрифта
$font = "cour.ttf"; //шрифт
$letters = array("G","W","Z","V","K","O","8","P","H"); // символы для капчи
$colors = array("90","110","130","150","170","190","210"); //массив с цветами

$img = imagecreatetruecolor($width,$height); //даем нашей переменной $img изображение, заданных широты и высоты
$fon = imagecolorallocate($img,250,250,250); //получаем цвет который нам далее понадобится для след функции
imagefill($img, 0, 0, $fon); // делаем картинку еле-еле заметной 

for($i = 0; $i < $count_small; $i++) { //для маленьких символов
    $size = rand($font_size-2, $font_size+2); //размер шрифта
    $angle = rand(0, 45); //размер шрифта
    $x = rand($width * 0.1, $width - $width *0.1); // рандомчик
    $y = rand($height * 0.2, $height); // буквы будут примерно посередине изображения
    $color = imagecolorallocatealpha($img, rand(0,255), rand(0,255), rand(0,255), 100);//конкретный рандом
    $fontfile = $font; //файлы шрифтов
    $text  = $letters[rand(0, count($letters)-1)]; // рандомчик из массива
    imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $text); //рисует текст поверх картинки + параметры
}

for($i = 0; $i < $count; $i++) {
    $size = rand($font_size*2-2, $font_size*2+2); //размер шрифта
    $angle = rand(-10, 15); //размер шрифта
    $x = ($i+1) * $size; // делаем так, чтобы буквы не отображались друг на друге
    $y = $height/2 + $size/2; // буквы будут примерно посередине изображения
    $color = imagecolorallocatealpha($img, $colors[rand(0, sizeof($colors)-1)], $colors[rand(0, sizeof($colors)-1)],
    $colors[rand(0, sizeof($colors)-1)], rand(20, 50)); //рандомный  цвет + прозрачность средняя (от 0 до 100)
    $fontfile = $font; //файлы шрифтов
    $text  = $letters[rand(0, count($letters)-1)]; // рандомчик из массива
    $captcha[] = $text;
    imagettftext($img, $size, $angle, $x, $y, $color, $fontfile, $text); //рисует текст поверх картинки + параметры
}

$captcha = strtolower(implode("", $captcha)); //делаем строку с символами
$_SESSION['captcha'] = $captcha; 
header("Content-type: image/gif"); //создаем заголовок файла (в нашем случае это gif)

imagegif($img); //выводим изображение на экран 

?>