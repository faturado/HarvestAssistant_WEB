<?php

function pluck($array, $column) {
    return array_map(function($item) use ($column) {
        return $item[$column];
    }, $array);
}