@extends('layout.app')

@section('content')




<?php

function plus($numbers){
    static $number = 0;
    if ($number == 5){
        $number = 0;
    }
    return $result = $numbers > $number ? ++$number:0;
}

$numbers = 5;


?>







@endsection