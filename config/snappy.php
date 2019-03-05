<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => '/vendor/bin/wkhtmltopdf-amd64',
        //'binary'  => '/usr/local/bin/wkhtmltopdf-amd64',
        //'binary' => 'C:/Program Files (x86)/wkhtmltopdf/bin/wkhtmltopdf.exe',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage-amd64',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
