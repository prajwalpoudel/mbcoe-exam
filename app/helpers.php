<?php

function getStrAsRow($string) {
    return strtolower(str_replace(' ', '_', $string));
}
