<?php

if (!defined('ABSPATH')) {
    exit;
}

global $product;


if (0 < $product->get_stock_quantity()) {
    echo '<div class="in-stock">' . wc_format_stock_for_display($product) . '</div>';
}