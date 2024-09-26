<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

function getStrAsRow($string) {
    return strtolower(str_replace(' ', '_', $string));
}

function getUser($attribute = null) {
    $user = Auth::user();
    if($attribute) {
        return $user->{$attribute};
    }
    return $user;
}

function getImageUrl($image = null) {
    if($image) {
        return Storage::url($image) ?? null;
    }
}
