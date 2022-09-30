<?php
$app=App::get_instance();
$notifiaction=$app->get_table('notification')->get_one_notification(strip_tags($_GET['id']));
echo '<div class="notification">';
echo '<h3>'.$notifiaction->titre.'</h3>';
echo '<hr>';
echo '<p>'.$notifiaction->contenu.'</p>';
echo '</div>';
?>