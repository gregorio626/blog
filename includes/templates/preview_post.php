<!-- Requires:
              $post_id
              $post_title
              $post_author
              $post_date
              $post_image
              $post_content
-->
<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php  echo $post_title ?></a>
</h2>
<p class="lead">
    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php  echo $post_author ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span><?php  echo $post_date ?></p>
<hr>
<a href="post.php?p_id=<?php echo $post_id; ?>">
  <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="image">
</a>                                    <hr>
<p><?php  echo $post_content ?></p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
