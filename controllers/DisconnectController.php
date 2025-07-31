<?php
require_once dirname(__DIR__) . '/controllers/include/function.php';
session_start();
session_unset();
session_destroy();
redirect('index.php?action=login.php');
