<?php

$users = [
    ['id'=> 1, 'name'=> 'Ona', 'psw' => md5('Rytas'), 'full_name' => 'Ona Onaityte'],
    ['id'=> 2, 'name'=> 'Petras', 'psw' => md5('Rytas'), 'full_name' => 'Petras Petrauskas'],
    ['id'=> 3, 'name'=> 'Vardenis', 'psw' => md5('Rytas'), 'full_name' => 'Vardenis Pavardenis']
];

file_put_contents(__DIR__.'/users.json',json_encode($users));