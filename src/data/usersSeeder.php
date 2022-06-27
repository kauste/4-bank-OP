<?php

$users = [
    ['id'=> 1, 'name'=> 'Ona', 'psw' => md5('Rytas'), 'full_name' => 'Ona Onaityte', 'token' => ''],
    ['id'=> 2, 'name'=> 'Petras', 'psw' => md5('Rytas'), 'full_name' => 'Petras Petrauskas', 'token' => ''],
    ['id'=> 3, 'name'=> 'Vardenis', 'psw' => md5('Rytas'), 'full_name' => 'Vardenis Pavardenis', 'token' => '']
];

file_put_contents(__DIR__.'/users.json',json_encode($users));