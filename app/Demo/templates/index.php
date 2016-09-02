<?php
/** @var Template $this */
/** @var ViewHelper $view */

use League\Plates\Template\Template;
use Tuum\Respond\Service\ViewHelper;

$this->layout('layouts/layout');

?>

<?php $this->start('contents'); ?>


<?php if (isset($name)) : ?>
    <h2>Hello <?= htmlspecialchars($name); ?>!</h2>
<?php else: ?>
    <p>Try <a href="/name/Slim-Tuum">/Slim+Tuum</a>
<?php endif; ?>

    <p>try <a href="/control">controller and presenter sample.</a></p>

    <p>try <a href="/docs">document rendered by FileMap.</a></p>

    <br/>
    <h2>error samples</h2>

    <p>try <a href="/not/found">not found error</a></p>

    <p>try <a href="/throw">uncaught exception</a></p>

    <form method="post" action="/control" style="display: inline;">
        try <input type="submit" value="forbidden error">
    </form>

<?php $this->stop(); ?>