<?php

function task1($filename)
{
    $fileData = file_get_contents($filename);
    $xml = new SimpleXMLElement($fileData);

    foreach ($xml->Address as $address){
        echo '<div style="border:1px solid black; width: 300px; padding:5px; margin: 10px 0;">';
        echo '<b>Type dlevery</b>: ' . $address->attributes()->Type . '<br>';
        echo '<b>Name</b>: ' . $address->Name . '<br>';
        echo '<b>Street</b>: ' . $address->Street . '<br>';
        echo '<b>City</b>: ' . $address->City . '<br>';
        echo '<b>State</b>: ' . $address->State . '<br>';
        echo '<b>Zip</b>: ' . $address->Zip . '<br>';
        echo '<b>Country</b>: ' . $address->Country . '<br>';
        echo '</div>';
    }
    foreach ($xml->Items->Item as $item){
        echo '<div style="border:1px solid black; width: 300px; padding:5px; margin: 10px 0;">';
        echo '<b>PartNumber</b>: ' . $item->attributes()->PartNumber . '<br>';
        echo '<b>ProductName</b>: ' . $item->ProductName . '<br>';
        echo '<b>Quantity</b>: ' . $item->Quantity . '<br>';
        echo '<b>USPrice</b>: ' . $item->USPrice . '$'. '<br>';
        if($item->Comment){
            echo '<b>Comment</b>: ' . $item->Comment . '<br>';
        }
        if($item->ShipDate){
            echo '<b>ShipDate</b>: ' . $item->ShipDate . '<br>';
        }
        echo '</div>';
    }
    if($xml->DeliveryNotes){
        echo '<b>DeliveryNotes</b>: ' . $xml->DeliveryNotes . '<br>';
    }
}

function task2($arrayTask)
{
//Помещаем данные в файл JSON
    $file = 'output.json';
    $file2 = 'output2.json';
    file_put_contents($file, json_encode($arrayTask, JSON_PRETTY_PRINT));

//Получаем данные из файла
    $json = file_get_contents('output.json');
    $data = json_decode($json, true);

//Решаем надо ли изменять файл или нет, записываем данные в новый файл
    $change = rand(0,1);
    if($change){
        $data[] = rand(0, 100);
        $data['newvalue'] = 'random-value';
    }
    file_put_contents($file2, json_encode($data, JSON_PRETTY_PRINT));

// Получаем данные из файлов (не уверен что нужно было каждый раз из файла доставать файлы, но как понял так надо по заданию)
    $json = file_get_contents($file);
    $json2 = file_get_contents($file2);
    $data = json_decode($json, true);
    $data2 = json_decode($json2, true);

    if($data == $data2){
        echo 'Различия в файлах нет<br>';
    } else {
        $result = array_diff_assoc($data2, $data);
        echo 'Отличие от исходного файла в следующих значениях <br>';
        foreach ($result as $key => $value){
            echo $key . '=>' . $value . '<br>';
        }
    }
}

function task3($path)
{
    $array = [];
    for($i=0; $i<50; $i++){
        $array[] = rand(1, 100);
    }

    $fp = fopen($path, 'w');
    fputcsv($fp, $array, ";");
    fclose($fp);

    $fp = fopen($path, 'r');
    while(($data = fgetcsv($fp, 124*124, ";")) !== false){
        $result = 0;
        for($i=0; $i < count($data); $i++){
            $result = ($data[$i]%2 == 0) ? ++$result : $result;
        }
    }
    echo $result;
}

function task4()
{
    $json = file_get_contents("https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
    $data = json_decode($json, true);
    function searchData($data){
        foreach ($data as $key => $value){
            if ($key == 'title'){
                $checkTitle = true;
                echo $value . '<br>';
            }
            if ($key == 'pageid'){
                $checkPageId = true;
                echo $value . '<br>';
            }
            if(isset($checkPageId) && isset($checkTitle)){
                break;
            }
            if(is_array($value)){
                searchData($value);
            }
        }
    }
    searchData($data);
}