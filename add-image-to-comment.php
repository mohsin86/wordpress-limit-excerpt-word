<?php

function add_review_title_field_on_comment_form() {
    echo '<p class="comment-form-title uk-margin-top"><label for="title">' . __( 'Review title', 'text-domain' ) . '</label><input type="file" id="img" name="review_img" accept="image/*"></p>';
}
add_action( 'comment_form_logged_in_before', 'add_review_title_field_on_comment_form',3 );
add_action( 'comment_form_before_fields', 'add_review_title_field_on_comment_form',3 );

add_action( 'comment_post', 'instacraftcbd_review_title_save_comment' );
function instacraftcbd_review_title_save_comment( $comment_id ){
    if( isset( $_FILES['review_img'] ) ){
        if (!function_exists('wp_handle_upload')){
            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
            require_once(ABSPATH . "wp-admin" . '/includes/file.php');
            require_once(ABSPATH . "wp-admin" . '/includes/media.php');
        }
        $uploadedfile = $_FILES ['review_img'];
        if (! empty ( $uploadedfile ['name'] )) {
            $upload_overrides = array( 'test_form' => false ); // for multiple file Upload
            $attach = wp_handle_upload ( $uploadedfile, $upload_overrides );
            update_comment_meta( $comment_id, 'review_img', esc_url($attach['url']) );
        }
    }
    /*
     if( isset( $_POST['review_img'] ) )
         update_comment_meta( $comment_id, 'review_img', esc_attr( $_POST['review_img'] ) );
    */
}

/**
 * Add the title to our admin area, for editing, etc
 */
add_action( 'add_meta_boxes_comment', 'pmg_comment_tut_add_meta_box' );
function pmg_comment_tut_add_meta_box()
{
    add_meta_box( 'pmg-comment-title', __( 'Comment Title' ), 'pmg_comment_tut_meta_box_cb', 'comment', 'normal', 'high' );
}

function pmg_comment_tut_meta_box_cb( $comment )
{
    $url = get_comment_meta( $comment->comment_ID, 'review_img', true );

    ?>
    <p>
        <img src="<?php  echo esc_url( $url ); ?>" width="200px" >

    </p>
    <?php
}

//add_filter('woocommerce_rest_prepare_product_review','add_field_to_review');

function add_field_to_review($response, $review, $request){
    print_r($response);
}