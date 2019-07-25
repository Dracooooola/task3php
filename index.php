<?php
require ('src/functions.php');

echo 'Задание 1';
//task1('data.xml');

echo '<br><br><br> Задание 2';
$arrayTask2 = [
    'allusers' => [
        'premiumUsers' => [
            ['name' => 'Katya Ponomareva', 'email' => 'katya@gmail.com', 'endPremium' => '12.10.2020'],
            ['name' => 'Andrey Truchachev', 'email' => 'amdreytru@gmail.com', 'endPremium' => '12.10.2020'],
        ],
        'users' => [
            ['name' => 'Valerya Vishnakova', 'email' => 'valeria@gmail.com'],
            ['name' => 'Sergey Korzh', 'email' => 'sergey@gmail.com'],
            ['name' => 'Dmityy Zimin', 'email' => 'dmitry@gmail.com'],
            ['name' => 'Vasiliy Ivanov', 'email' => 'vasya@gmail.com'],
        ]
    ],
    'admins' => [
        ['name' => 'Petr', 'email' => 'petr@gmail.com'],
        ['name' => 'Andrey', 'email' => 'amdrey@gmail.com']
    ]
];
task2($arrayTask2);

echo '<br><br><br> Задание 3';
//task3('data.csv');

echo '<br><br><br> Задание 4';
//task4();







