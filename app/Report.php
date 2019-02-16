<?php

namespace App;


interface Report{
    public static function periodic($start, $end);
}