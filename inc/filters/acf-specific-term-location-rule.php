<?php 

  /* 
    Custom location rule to add fields to specific term
    
    This is explained here: http://www.advancedcustomfields.com/resources/custom-location-rules/
    
    For those looking to do this and other custom rules here is some code for this specific case:
    
  */

// Step 1: Add custom type

// Creating a new group rather than putting the rule under one of the existing groups.

add_filter('acf/location/rule_types', 'acf_location_rules_types', 999);
function acf_location_rules_types($choices) {
    // create a new group for the rules called Terms
    // if it does not already exist
    if (!isset($choices['Terms'])) {
        $choices['Terms'] = array();
    }
    // create new rule type in the new group
    $choices['Terms']['category_id'] = 'Specific Category Rule';
    return $choices;
}

// Step 2: We can skip step 2 because we don’t need to create a custom operator

// Step 3: Add custom values

add_filter('acf/location/rule_values/category_id', 'acf_location_rules_values_category');
function acf_location_rules_values_category($choices) {
    // get terms and build choices
    $taxonomy = 'category';
    $args = array('hide_empty' => false);
    $terms = get_terms($taxonomy, $args);
    if (count($terms)) {
        foreach ($terms as $term) {
            $choices[$term->term_id] = $term->name;
        }
    }
    return $choices;
}

// Step 4: Matching the rule

add_filter('acf/location/rule_match/category_id', 'acf_location_rules_match_category', 10, 3);
function acf_location_rules_match_category($match, $rule, $options) {
    if (!isset($_GET['tag_ID']) || 
            !isset($_GET['taxonomy']) || 
            $_GET['taxonomy'] != 'category') {
        // bail early
        return $match;
    }
    $term_id = $_GET['tag_ID'];
    $selected_term = $rule['value'];
    if ($rule['operator'] == '==') {
        $match = ($selected_term == $term_id);
    } elseif ($rule['operator'] == '!=') {
        $match = ($selected_term != $term_id);
    }
    return $match;
}

?>