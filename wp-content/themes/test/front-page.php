<?php
/*
Template Name: Homepage 
*/

$fields = get_fields();

$title = $fields['title'];
$image = $fields['image'];
 
dd('44444');
?>

<?php if(!empty($title)) : ?>

    <h1><?php echo $title; ?></h1>

<?php endif ?>


<?php if(!empty($image)) : ?>

    <?php insertImage($image) ?>

<?php endif ?>