<?php

$address = '/code/birthdays.txt';

$name = readline("Введите имя: ");
$date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");

if(validate($date)){
    $data = $name . ", " . $date . "\r\n";

    $fileHandler = fopen($address, 'a');
    
    if(fwrite($fileHandler, $data)){
        echo "Запись $data добавлена в файл $address";
    }
    else {
        echo "Произошла ошибка записи. Данные не сохранены";
    }
    
    fclose($fileHandler);
}
else{
    echo "Введена некорректная информация";
}

function validate(string $date): bool {
    $dateBlocks = explode("-", $date);

    if (count($dateBlocks) != 3) {
        return false;
    }

    // Проверяем формат с помощью встроенной функции checkdate
    [$day, $month, $year] = $dateBlocks;

    // Преобразуем строки в целые числа
    $day = (int)$day;
    $month = (int)$month;
    $year = (int)$year;

    // Проверка года, чтобы он не был в будущем
    if ($year > date('Y')) {
        return false;
    }

    // Проверка корректности даты
    return checkdate($month, $day, $year);
}