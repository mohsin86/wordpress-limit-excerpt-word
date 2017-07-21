<?php
/**
 * Created by PhpStorm.
 * User: mohammed.mohasin
 * Date: 20-Jul-17
 * Time: 2:19 PM
 */


/************************ Excerpt Limit   */
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return '<p>'.$excerpt.'</p>';
}