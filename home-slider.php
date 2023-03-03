<?php
/**
 * /template-parts/home/main-slider.php
 */
if (have_rows('slider')):
    $section1 = array();
    while (have_rows('slider')) : the_row();
        if (get_row_layout() == 'slide'):
            $item = new stdClass();
            $item->link = get_sub_field('link');
            $item->image = wp_get_attachment_image_src(get_sub_field('image'), 'full');
            $item->mobile_image = wp_get_attachment_image_src(get_sub_field('mobile_image'), 'full');
            $item->description = get_sub_field('description');
            $section1[] = $item;
        endif;
    endwhile;
endif;
?>
<div class="swiper homeSwiper">
    <div class="swiper-wrapper">
        <?php foreach ($section1 as $item): ?>
            <div class="swiper-slide"><a href="<?php echo $item->link; ?>">
                    <picture>
                        <source srcset="<?php echo $item->mobile_image[0]; ?>"
                                media="(max-width: 414px)">
                        <img src="<?php echo $item->image[0]; ?>"
                             alt="<?php echo $item->description; ?>"/>
                    </picture>
                </a></div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
