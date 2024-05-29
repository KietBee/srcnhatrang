<div class="flex items-center my-5">
    <?php
      $author_id = get_the_author_meta('ID');
      $avatar_url = get_avatar_url($author_id, ['size' => 40]);
      echo '<img src="' . esc_url($avatar_url) . '" alt="Avatar of ' . get_the_author() . '" style="border-radius: 50%;">';
    ?>
    <div class="text-sm ml-5">
      <a href="{{ get_author_posts_url($author_id) }}" rel="author" class="fn text-gray-900 leading-none">
        {{ get_the_author() }}
      </a><br>
      <time class="updated text-gray-600 mt-5" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
    </div>
</div>
