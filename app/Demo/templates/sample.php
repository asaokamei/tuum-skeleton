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

    <h1>Controller and Presenter Sample</h1>

<h2><?= $view->message->onlyOne(); ?></h2>

<form method="post" action="" >
    <label>Your Name: <input type="text" name="name" value="tuum" /></label>
    <input type="hidden" name="csrf_name" value="<?= $view->attributes('csrf_name'); ?>">
    <input type="hidden" name="csrf_value" value="<?= $view->attributes('csrf_value'); ?>">
    <button>post it</button>
</form>
<?php $this->stop(); ?>