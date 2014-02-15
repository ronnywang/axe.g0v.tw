<?php

include(__DIR__ . '/webdata/init.inc.php');

Pix_Controller::addCommonHelpers();
Pix_Controller::addDispatcher(function($url){
    list($uri, $params) = explode('&', $url, 2);
    $terms = explode('/', $uri);
    if ($terms[1] == 'level') {
        return array('index', 'level', $terms[2]);
    }
    if ($terms[1] == 'check') {
        return array('index', 'check', $terms[2]);
    }
});
Pix_Controller::dispatch(__DIR__ . '/webdata/');
