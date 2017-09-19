<?php


namespace app\models;


use core\Model;

class Language extends Model
{
    public function __construct()
    {
        parent::__construct('languages');
    }
}