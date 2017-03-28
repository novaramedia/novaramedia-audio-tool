<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       novaramedia.com
 * @since      1.0.0
 *
 * @package    Novaramedia_Audio_Tool
 * @subpackage Novaramedia_Audio_Tool/admin/partials
 */

$recent_posts = get_posts(array(
  'posts_per_page' => -1,
  'category_name' => 'audio',
  'post_status'    => array('draft', 'publish')
));

?>
<h1>Novara Audio Tool</h1>

<section>
  <h3>Choose Audio post source</h3>

  <select id="latest-select">
    <?php
      foreach($recent_posts as $recent_post) {
        echo '<option value="' . $recent_post->ID . '">' . $recent_post->post_title . '</option>';
      }
    ?>
  </select>
  <button id="get-data" class="button button-primary">Get Data</button>
</section>

<section>
  <h3>Metadata</h3>

  *** here goes a replication of the podcast tool's metadata section but a correct one ***
</section>

<section>
  <h3>Artwork</h3>

  *** here goes a replication of the podcast tool's artwork generator ***
</section>

<section>
  <h3>MP3 tagger</h3>

  *** here goes a drag/drop UI element for tagging mp3 files ***
</section>