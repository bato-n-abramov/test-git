<?php 

if (is_category() || is_tax()) {
    $blocks = get_field('blocks', get_queried_object()); 
} else {
    $blocks = get_field('blocks', $post->ID); 
}

?>

<?php if (empty($blocks)): ?>

<!--     <section class="page-content">
        <div class="page-content__wrapper wrapper">
            <?php //the_content(); ?>
        </div>
    </section> -->

<?php else: ?>

<?php 
    foreach($blocks as $block) {
        $blockname = str_replace("_", "-", $block['acf_fc_layout']);
        get_template_part(
            'blocks/' . $blockname, 
            NULL, 
            array('fields' => $block)
        ); 
    }
?>

<?php endif ?>