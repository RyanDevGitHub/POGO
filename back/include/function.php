<?php

define('BASE_URL', '/'); // site à la racine de http://pogo/
function asset(string $path): string
{
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}
