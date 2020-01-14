<?php

return [
    'server' => [
        'default' => 'http',
        'modes'   => [
            'http'   => [
                'protocol' => 'http',
                'path'     => 'hprose',
            ],
            'socket' => [
                'protocol' => 'socket',
                'uri'      => 'tcp://0.0.0.0:1315/',
            ],
        ],
    ],
    'client' => [
        'default'     => 'http',
        'connections' => [
            'http'   => [
                'protocol' => 'http',
                'uri'      => 'http://127.0.0.1:1314/hprose',
                'async'    => false,
            ],
            'socket' => [
                'protocol' => 'socket',
                'uri'      => 'tcp://127.0.0.1:1315/',
                'async'    => false,
            ],
        ],
    ],
];
