<?php

return [
    'darksky' => [
        'apiKey' => env('DARKSKY_API_KEY'),
        'params' => [
            'units' => 'si',
            'exclude' => 'currently,minutely,hourly,alerts,flags',
        ],
    ],

    'weatherbit' => [
        'apiKey' => env('WEATHERBIT_API_KEY'),
        'params' => [
            'units' => 'M',
            'days' => '7',
        ],
    ],

    //Default params for weather api(Sevastopol lat, lon)
    'params' => [
        'lat' => 44.6,
        'lon' => 33.5,
        'lang' => 'en'
    ]
];
