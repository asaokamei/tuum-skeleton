<?php
/** @var Template $this */
/** @var ViewHelper $view */

use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

$this->layout('layouts/layout');

?>

<?php $this->start('contents'); ?>

    <h1>This is sample file</h1>

<?= $view->message->onlyOne(); ?>

<form method="post" action="" >
    <label>Your Name: <input type="text" name="name" value="tuum" /></label>
    <input type="hidden" name="csrf_name" value="<?= $view->attributes('csrf_name'); ?>">
    <input type="hidden" name="csrf_value" value="<?= $view->attributes('csrf_value'); ?>">
    <button>post it</button>
</form>
<?php $this->stop(); ?>