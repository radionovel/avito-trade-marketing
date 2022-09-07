<?php
declare(strict_types=1);

return [
    [
       [ 'date' => 'invalid date',]
    ],
    [
        ['date' => '20.20.2000',]
    ],
    [[]],
    [[
        'date' => '2022-01-01',
        'clicks' => -1
    ]],
    [[
        'date' => '2022-01-01',
        'clicks' => 1.5
    ]],
    [[
        'date' => '2022-01-01',
        'views' => -1
    ]],
    [[
        'date' => '2022-01-01',
        'views' => 1.5
    ]],
    [[
        'date' => '2022-01-01',
        'cost' => -1
    ]],
];
