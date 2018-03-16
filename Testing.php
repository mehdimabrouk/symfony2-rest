<?php
/**
 * @author Mehdi Mabrouk <m.mabrouk@esystema.fr>
 */

require __DIR__.'/vendor/autoload.php';


$client = new \GuzzleHttp\Client([
    'base_url'  => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false,
    ]
]);


$nickname = 'ObjectOrienter'.rand(0,99);

$data = [
    'nickname'=> $nickname,
    'avatarNumber' => 5,
    'tagLine' => 'a test dev!'
];

$response = $client->post('/api/programmers',[
    'body' => json_encode($data)
]);


$programmerUrl = $response->getHeader('Location');

$response = $client->get($programmerUrl);
//$response = $client->get('/api/programmers/'.$nickname);

echo $response;

echo '\n';
