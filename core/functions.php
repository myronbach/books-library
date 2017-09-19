<?php

function debug($arr)
{
    echo '<pre>';
    print_r($arr);

    echo '</pre>';
    echo '</br>';
}

function setData(array $value)
{
    $_SESSION['data'] = $value;
}

function data($key)
{
    if (isset($_SESSION['data'][$key])) {
        $data = $_SESSION['data'][$key];
        unset($_SESSION['data'][$key]);
        return $data;
    }
}

function setErrors($err)
{
    $_SESSION['errors'] = $err;
}

function error($key)
{
    if(isset($_SESSION['errors'][$key])){
        $errors =  $_SESSION['errors'][$key];
        unset($_SESSION['errors'][$key]);
        return $errors;
    }
    return false;
}


function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
