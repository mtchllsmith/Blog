<?php
  // returns all published posts
function getPublishedPosts() {
  global $conn;
  //use global $conn object in function
  $sql = "SELECT * FROM posts WHERE published=true";
  $result = mysqli_query($conn, $sql);

  // fetch all posts as an associative array called $posts
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $final_posts = array();
  foreach ($posts as $post) {
    $post['topic'] = getPostTopic($post['id']);
    array_push($final_posts, $post);
  }
  return $final_posts;
}
function getPostTopic($post_id){
  global $conn;
  $sql = "SELECT * FROM topics WHERE id= (SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
  $result = mysqli_query($conn, $sql);
  $topic = mysqli_fetch_assoc($result);
  return $topic;
}
?>
