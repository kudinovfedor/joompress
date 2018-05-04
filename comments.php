<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="">

  <?php if (have_comments()) : ?>

    <h2 class="">
      <?php
      $comments_number = get_comments_number();
      if ('1' === $comments_number) {
        printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'joompress'), get_the_title());
      } else {
        printf(
          _nx(
            '%1$s Reply to &ldquo;%2$s&rdquo;',
            '%1$s Replies to &ldquo;%2$s&rdquo;',
            $comments_number,
            'comments title',
            'joompress'
          ),
          number_format_i18n($comments_number),
          get_the_title()
        );
      }
      ?>
    </h2>

    <ul class="">
      <?php wp_list_comments(); ?>
    </ul>

    <?php the_comments_pagination(); ?>

  <?php endif; ?>

  <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
    <p class="no-comments"><?php _e('Comments are closed.', 'joompress'); ?></p>
  <?php endif; ?>

  <?php comment_form(); ?>

</div>
