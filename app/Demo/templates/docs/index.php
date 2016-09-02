<?php
/** @var Template $this */
/** @var ViewHelper $view */

use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

/**
 * specify layout file to use.
 */
$this->layout('layouts/layout', [
    'title' => 'Controller Sample Page'
]);

?>

<?php $this->start('contents'); ?>

<style type="text/css">
    div.main {
        text-align: left;
        line-height: 1.5em;
        width: 40em;
        margin: auto;
        
    }
</style>
<h1>About Slim3 + Tuum</h1>

<div class="main">

    1. A Micro-Framework:
    
    <ul>
        <li><a href="http://www.slimframework.com/" >Slim 3</a>: 
            A micro-framework for PHP. </li>

    </ul>
    
    2. Add a Respond Module for creating views (and redirect and errors):
    
    <ul>
        <li><a href="https://github.com/TuumPHP/Respond" >Tuum/Respond</a>: 
            A view module for various micro-frameworks based on PSR-7. </li>
        
        <li><a href="https://github.com/TuumPHP/Builder" >Tuum/Builder</a>:
            A generic application builder to manage environment etc. </li>

        <li><a href="https://github.com/TuumPHP/FileMap" >Tuum/FileMap</a>:
            file mapper for providing response. </li>
    </ul>

    3. Some Other Popular Projects:
    
    <ul>
        <li>Monolog: a de fact standard logger library. </li>
        <li>League/Plates: raw PHP as a template. </li>
    </ul>
</div>

<p>&nbsp;</p>
<p>This is a PHP document rendered by FileMap. </p>

<?php $this->stop(); ?>