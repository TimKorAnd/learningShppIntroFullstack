<?php
declare(strict_types=1);
$results = [];

/*variables initialize*/
$results['task1'] = $results['task2'] = 'check some box, enter values, and press Sum, please ';

if (!empty($_REQUEST['doAdd'])) {
    require_once('private/task12.php');

} else {

}
include "./view.php";
?>
