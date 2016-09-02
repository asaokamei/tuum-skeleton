<?php
/** @var Template $this */
/** @var ViewHelper $view */

use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?= isset($title) ? $title . ' / ': ''; ?>Tuum + Slim 3</title>
    <style>
        body {
            margin: 50px 0 0 0;
            padding: 0;
            width: 100%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-align: center;
            color: #40664c;
            font-size: 18px;
        }

        h1#title {
            color: #586a87;
            letter-spacing: -1px;
            font-family: "Helvetica Neue", 'Lato', sans-serif;
            font-size: 100px;
            font-weight: 200;
            margin-bottom: 0;
            margin-left: -.2em;
        }
        span.sub-title {
            font-size:16px;
            letter-spacing: normal;
        }
        div.header {
            margin-left:4em;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="header">
    <h1 id="title">Slim 3 + Tuum</h1>
    <a href="/" ><span class="sub-title">a micro-framework with a view.</span></a>
</div>

<br/>
<hr color="#e0e0e0" size="1">
<br/>

<?= $this->section('contents'); ?>

</body>
</html>