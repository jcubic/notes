<?php

function hash36($str) {
    $arr = unpack("C*", pack("L", crc32($str)));
    return implode(array_map(function($number) {
        return base_convert($number, 10, 36);
    }, $arr));
}
function h($file) {
    return hash36(file_get_contents($file));
}

?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Notes</title>
    <meta name="Description" content="Take Notes - Single Page Application"/>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="favicon/manifest.json">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="favicon/favicon.ico">
    <meta name="msapplication-config" content="favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="vendor.js?<?= h('vendor.js') ?>"></script>
    <script src="app.js?<?= h('app.js') ?>"></script>
</head>
<body ng-app="app">
    <notifications-bar class="notifications"></notifications-bar>
    <header>
        <ul>
            <li ng-hide="auth.token"><a ui-sref="login">login</a></li>
            <li ng-hide="auth.token"><a ui-sref="register">register</a></li>
            <li ng-show="auth.token">{{auth.username}}</li>
            <li ng-show="auth.token">
                <a href="#" ng-click="logout(); $event.preventDefault()">logout</a>
            </li>
        </ul>
    </header>
    <div ui-view></div>
    <footer>
        Copyright &copy; {{year}} <a href="https://jcubic.pl/me">Jakub T. Jankiewicz</a> <a href="https://github.com/jcubic/notes">source code on github</a>
    </footer>
</body>
</html>
