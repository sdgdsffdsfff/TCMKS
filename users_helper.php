<?php

function get_authors($dbc, $article_id, $role){
    $query = "select * from authorship where article_id = '$article_id' and role = '$role'";
    
    $result = mysqli_query($dbc, $query) or die('Error querying database3.');
    $authors = array();
    while ($row = mysqli_fetch_array($result)) {
       array_push($authors, $row['author_id']); 
    }
    return $authors;
}

function render_reviewer_list($dbc, $article_id){
    
    $authors = get_authors($dbc, $article_id, 'reviewer');
    render_user_list($dbc, $authors);
    
}

function render_author_list($dbc, $article_id){
    
    $authors = get_authors($dbc, $article_id, 'author');
    render_user_list($dbc, $authors);
    
}

function render_publisher_list($dbc, $article_id){
    
    $authors = get_authors($dbc, $article_id, 'publisher');
    render_user_list($dbc, $authors);
    
}

function render_user_list($dbc, $selected) {
    
    $query = "select * from users";
    $result = mysqli_query($dbc, $query) or die('Error querying database3.');

    while ($row = mysqli_fetch_array($result)) {
       
        $s = in_array($row['id'], $selected)? 'selected="selected"':'';
        
        echo '<option '. $s .' value ="' . $row['id'] . '">' . $row['real_name'] . '</option>';
    }
}
?>
