<?php
/*
place it within functions.php and change the POST-OBJECT-FIELD-NAME with your custom field name of the post field
*/

function search_by_title_only( $where, $wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}

add_filter('acf/fields/post_object/query/name=POST-OBJECT-FIELD-NAME', 'my_acf_fields_post_object_query', 10, 3);
function my_acf_fields_post_object_query( $args, $field, $post_id ) {
	add_filter( 'posts_where', 'search_by_title_only', 10, 2 );
    $args['post_title_like'] = $args['s'];
    return $args;
	remove_filter( 'posts_where', 'search_by_title_only', 10, 2 );
}

/*
Example 2:

added the posts_status, order by date, and the order to the $args

*/

function search_by_title_only( $where, $wp_query ) {
global $wpdb;
if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
$where .= ' AND ' . $wpdb->posts . '.post_title LIKE '%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%'';
}
return $where;
}

add_filter('acf/fields/post_object/query/name=post_object', 'my_acf_fields_post_object_query', 10, 3);
function my_acf_fields_post_object_query( $args, $field, $post_id ) {
add_filter( 'posts_where', 'search_by_title_only', 10, 2 );
$args['post_title_like'] = $args['s'];

$args['orderby'] = 'date';
$args['order'] = 'DESC';
$args['post_status'] = array('publish');

return $args;
remove_filter( 'posts_where', 'search_by_title_only', 10, 2 );
}


/*
acf/fields/post_object/query Applies to all fields.

*/

function search_by_title_only( $where, $wp_query ) {
global $wpdb;
if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
$where .= ' AND ' . $wpdb->posts . '.post_title LIKE '%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%'';
}
return $where;
}

add_filter('acf/fields/post_object/query', 'my_acf_fields_post_object_query', 10, 3);
function my_acf_fields_post_object_query( $args, $field, $post_id ) {
add_filter( 'posts_where', 'search_by_title_only', 10, 2 );
$args['post_title_like'] = $args['s'];
return $args;
remove_filter( 'posts_where', 'search_by_title_only', 10, 2 );
}
