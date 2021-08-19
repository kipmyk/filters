<?php

//Use the code snippet within your functions.php file
//image field to avatar
add_filter('get_avatar_data', 'change_the_avatar', 100);
function change_the_avatar($args) {
    $img = get_field("profile", "user_".get_current_user_id());
    //Where the "profile" is the field name of the image field with the return format set to url
    $args['url'] = $img;
    return $args;
}

?>