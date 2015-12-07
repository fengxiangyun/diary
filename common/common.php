<?php
function getMicrosecond() {
    list($usec, $sec) = explode(" ", microtime());
    return $sec*1000000 + (int)($usec * 1000000);
}
