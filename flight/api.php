<?php
require 'flight/Flight.php';
include 'controllers/comments.php';
# Database Information #
Flight::register('db', 'PDO', array('mysql:host=localhost;port=3306;dbname=coding_challenge', 'root', ''), function($db) {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});

Flight::register('comments', 'comments');
Flight::register('commentModel', 'commentModel');

$route_pattern = '/api.php';

Flight::route($route_pattern.'/comments', function(){

    $comments = Flight::comments()->getComments();
    Flight::json($comments, 200);

});
Flight::route('POST ' . $route_pattern.'/comment', function() {
    $new_comment = Flight::comments()->addComment(Flight::request()->data->getData());
    Flight::json($new_comment, 200);
});
Flight::start();

