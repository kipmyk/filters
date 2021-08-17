<?


function mass_update_posts() {
		
	$args = array(	'post_type'=>'post-type', //whatever post type you need to update 
					'posts_per_page'   => -1);
		
	$my_posts = get_posts($args);
	
	foreach($my_posts as $key => $my_post){
		$meta_values = get_post_meta( $my_post->ID);
		foreach($meta_values as $meta_key => $meta_value ){
			update_field($meta_key, $meta_value[0], $my_post->ID);
		}
	}
}


/*

You can call this function however you want. Usually it is done by using an action or something.

`add_action( 'init', 'mass_update_posts' );`


This function can run a long time so if you use this method make sure to comment out or remove the function / action after it runs.
*/
?>