<?

/*  

Change default role dynamically on role selection change
ACF role-based conditions on user new / edit forms

USed within functions.php
*/

add_action( 'acf/input/admin_head', 'acf_dynamic_default_role' );
function acf_dynamic_default_role() {
	global $pagenow;

	if ( $pagenow == 'user-new.php' ) {
		?>
        <script>
            jQuery(document).ready(function ($) {
                $('select#role').on('change', function (e) {
                    $.ajax({
                        url: '<?= admin_url( 'admin-ajax.php' ) ?>',
                        type: 'post',
                        data: {
                            action: 'acf_dynamic_default_role',
                            security: '<?= wp_create_nonce( 'acf_dynamic_default_role' ) ?>',
                            default_role: e.target.value,
                        },
                        success: function () {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
		<?php
	} else if ( $pagenow == 'user-edit.php' ) {
		?>
        <script>
            jQuery(document).ready(function ($) {
                $('select#role').on('change', function (e) {
                    $.ajax({
                        url: '<?= admin_url( 'admin-ajax.php' ) ?>',
                        type: 'post',
                        data: {
                            action: 'acf_dynamic_user_role',
                            security: '<?= wp_create_nonce( 'acf_dynamic_user_role' ) ?>',
                            user_id: <?= $_GET['user_id'] ?>,
                            user_role: e.target.value,
                        },
                        success: function () {
                            window.location.reload();
                        }
                    });
                });
            });
        </script>
		<?php
	}
}

// Update the default role and refresh
add_action( 'wp_ajax_acf_dynamic_default_role', 'ajax_acf_dynamic_default_role' );
function ajax_acf_dynamic_default_role() {
	check_ajax_referer( 'acf_dynamic_default_role', 'security' );
	if ( $default_role = $_POST['default_role'] ) {
		update_option( 'default_role', $default_role );
	}
	wp_redirect( $_SERVER['HTTP_REFERER'] );
}

// Update the user's role and refresh
add_action( 'wp_ajax_acf_dynamic_user_role', 'ajax_acf_dynamic_user_role' );
function ajax_acf_dynamic_user_role() {
	check_ajax_referer( 'acf_dynamic_user_role', 'security' );
	if ( ( $user_id = $_POST['user_id'] ) && ( $user_role = $_POST['user_role'] ) ) {
		$user = new WP_User( $user_id );
		$user->set_role( $user_role );
	}
	wp_redirect( $_SERVER['HTTP_REFERER'] );
}