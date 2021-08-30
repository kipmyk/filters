# Filters

WordPress [actions](https://developer.wordpress.org/plugins/hooks/actions/) and [filters](https://developer.wordpress.org/plugins/hooks/filters/) are wonderful because they allow plugin, theme and core developers to offer large amounts of customization with very little effort.

#### Action -  
WordPress actions let you append your own functionality at a specific process
##### Filter 
WordPress filters allow you to change and modify data as it is processed

#### THE ANALOGY
[Mike](https://github.com/kipmyk) is making a burger, and he offers to add/modify the layers as you wish.

THE BREAKDOWN
<p>&nbsp;<img align="center" src="https://raw.githubusercontent.com/kipmyk/filters/main/inc/assets/analogy.png" alt="Anology of Actions and Filters" /></p>
As we can see do_action function lets you put anything between the layers, and apply filter lets you change what the layer is. Now, lets use the burger analogy with the code:

WordPress Hook: Action

#### Susan Request

[Mike](https://github.com/kipmyk), Please add pickles before lettuce

`add_action('before_vegetable', 'my_custom_layer_before_vegetable');`

`function  my_custom_layer_before_vegetable(){`
      
      echo 'I am the pickles layer';

`}`

Then you can add pickles and coriander before lettuce

`add_action('before_vegetable', 'pickles_layer_before_vegetable', 1);`

`function  pickles_layer_before_vegetable(){ `
      
      echo 'I am the pickles layer';

`}`

`add_action('before_vegetable', 'coriander_layer_before_vegetable', 2);`

`function  coriander_layer_before_vegetable(){` 
      
      echo 'I am the coriander layer';

`}`

Notes: the number 1 & 2 stand for priority, if you wanted coriander to appear above pickles then you just need to switch the priority.

WordPress Hook: Filter

Nathan comes, Hi [Mike](https://github.com/kipmyk), I don’t want lettuce on my burger, please use pickles instead

`add_filter('vegetable_filter', 'change_vegetable_filter' );`

`function change_vegetable_filter( $default ){`
      
      return 'I am the pickles layer';

`}`

I want a crispy patty

`add_filter('patty_filter', 'make_it_crispy');`

`function make_it_crispy( $meat ){`

      $cooked = deep_fry_task( $meat );`
      return $cooked;

`}`



## Examples of ACF Filters & Functions

##### 1. [acf-delete-images-when-removed-from-gallery.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf-delete-images-when-removed-from-gallery.php)

This is an example of how to delete images from the media library when they are removed from a gallery field

##### 2. [acf-delete-images-when-removed-from-gallery.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf-image-field-change-user-avatar-wp.php)
This is an example of how to use the acf image field as user avatar wordpress. Please make use that the return format of the image field is set to url.

##### 3. [acf-specific-term-location-rule.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf-specific-term-location-rule.php)
This is an example of how to create a custom location rule to add fields to specific term. 
For more info on the same, please [read more here](http://www.advancedcustomfields.com/resources/custom-location-rules/).
For those looking to do this and other custom rules here is some code for this specific case.

##### 4. [acf-to-wc-attributes.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf-to-wc-attributes.php)
This is an example of how to add fields to WC attributes.

##### 5. [acf-dynamic-change-on-user-creation.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf-dynamic-change-on-user-creation.php)
This is an example of how to change fields dynamically on role selection change
ACF role-based conditions on user new / edit forms

##### 6. [acf-update-all-ACF-post-fields.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf-update-all-ACF-post-fields.php)
This is an example of how to update All ACF Post Fields. You can call this function by hooking into `init`.
`add_action( 'init', 'mass_update_posts' );`

You can add the action and function, load the website once, and then comment it out so it doesn't load again.

##### 7. [acf_is_admin-acf-location-rule.php](https://github.com/kipmyk/filters/blob/main/inc/filters/acf_is_admin-acf-location-rule.php)
This is another custom location rule example. This rule lets you choose a field group to be used only in the in the admin or on a front end form.
