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
    <p>Try <a href="/SlimFramework">/SlimFramework</a>
<?php endif; ?>

<?php $this->stop(); ?>