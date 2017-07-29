# Movies API v1

## Használata

```` php
<?php

    require_once 'movies.php';

    $connectionDetails = [
        'host'      => '127.0.0.1',
        'username'  => 'root',
        'password'  => '',
        'db_name'   => 'id2322644_polakosz',
        'charset'   => 'utf8',
        'tableName' => 'movies',
    ];

    $details = [
        'fields' => [
            'csillag'     => 'Not important text',
            'filmcim'     => 'Not important text',
            'cover_image' => 'Not important text',
        ],
        'query' => [
            'filmcim' => '',
            'csillag' => '',
            //'datum' => '2017-07-28' this will be a FEATURE
        ],
        'order' => [
            'filmcim' => 'DESC',
            'csillag' => 'ASC',
        ],
        'limit' => '999999',
    ];

    $pdo = new PdoDB($connectionDetails, $details, true);


    var_dump($pdo->getResults());
?>
````

## Végcél
Az alábbi végpontok kialakítása lesz a cél:

`movies.php?query=ghost`

`movies.php?limit=10`

`movies.php?limit=20,10`

`movies.php?fields=filmcim,csillag,cover_image`

### Kötelező

`$_GET['fields']`

### Alapértékkel rendelkőzők

`$_GET['limit']=0,10`

`$_GET['query']={ALL}`
