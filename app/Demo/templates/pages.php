<?php
/** @var Template $this */
/** @var ViewHelper $view */

use League\Plates\Template\Template;
use Tuum\Pagination\Inputs;
use Tuum\Pagination\ToHtml\ToHtmlInterface;
use Tuum\Respond\Service\ViewHelper;

/**
 * specify layout file to use.
 */
$this->layout('layouts/layout', [
    'title' => 'Pagination Sample Page'
]);

/** @var Inputs $input */
/** @var ToHtmlInterface $pages */
$list  = $view->data->get('list');
$input = $view->data->get('input');
$pages = $view->data->get('pages');

?>
<?php $this->start('contents'); ?>

<style type="text/css">
    ul.pagination a {
        text-decoration: none;
        color: #525252;
    }
    ul.pagination a:visited {
        text-decoration: none;
        color: #525252;
    }

    ul.pagination li {
        display: inline-block;
        margin: 2px 0 2px 0;
        padding: 2px 8px 2px 2px;
        border-right: 1px solid #e0e0e0;
        width: 20px;
    }

    ul.pagination li.active a {
        font-weight:bold;
        color: #999999;
    }

    ul.pagination li.disable a {
        color: #999999;
    }
    
    ul.pagination li:first-child {
        font-weight:bold;
    }

    ul.pagination li:last-child {
        font-weight:bold;
        border-right: none;
    }

</style>
    <h1>Pagination Sample</h1>

    <h2><?= $view->message->onlyOne(); ?></h2>

<form method="get" action="">
    <div class="inputs">
        <label>Key: <input type="text" name="key" value="<?= $input->get('key'); ?>" style="width: 5em;"></label>
        <label>Happy? <input type="checkbox" name="happy" value="H"<?= $input->get('happy')? ' checked': '';?>></label>
        <label>Total: <input type="text" name="total" value="<?= $input->get('total'); ?>" style="width: 3em;"></label>
        <input type="submit" value="search">
    </div>
</form>

    <?= $pages; ?>

<?php
foreach($list as $key => $item) {
    echo $item, ' ';
    if (!(($key+1) % 5)) {
        echo '<br/>';
    }
}
?>

<p><a href="?_page" >reload last pagination page. </a></p>

<?php $this->stop(); ?>