<?php
use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

/** @var Template $this */
/** @var ViewHelper $view */

$this->layout('layouts/layout', ['view' => $view]);

?>

<?php $this->start('contents'); ?>

<h1>Generic Error</h1>
<p>It's a generic ERROR!</p>
<p>maybe uncaught exception?</p>
<p><a href="/">start from the beginning!</a></p>

<?php $this->stop(); ?>