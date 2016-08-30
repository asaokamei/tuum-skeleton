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

<h1>Sample Documents</h1>

<p>This is a PHP document rendered by FileMap. </p>

<?php $this->stop(); ?>