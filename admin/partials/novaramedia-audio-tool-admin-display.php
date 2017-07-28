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

<hr>

<section>
  <h3>Metadata</h3>
  <table class="form-table output">
    <tbody>
      <tr>
        <th scope="row">Title:</th>
        <td><span id="output-title" class="easy-select"></span></td>
      </tr>
      <tr>
        <th scope="row">Author:</th>
        <td><span class="easy-select">Novara Media</span></td>
      </tr>
      <tr>
        <th scope="row">Album:</th>
        <td><span class="easy-select">Novara Audio: Radio for a Different Politics</span></td>
      </tr>
      <tr>
        <th scope="row">Permalink & MP3 comment tag:</th>
        <td><span id="output-permalink" class="easy-select"></span></td>
      </tr>
      <tr>
        <th scope="row">Safe filename:</th>
        <td><span id="output-filename" class="easy-select"></span></td>
      </tr>
      <tr>
        <th scope="row">Archive filename:</th>
        <td><span id="output-archive-filename" class="easy-select"></span></td>
      </tr>
      <tr>
        <th scope="row">Copy:</th>
        <td><p id="output-copy" class="easy-select"></p></td>
      </tr>
      <tr>
        <th scope="row">MP3 lyrics:</th>
        <td><p id="output-lyrics" class="easy-select"></p></td>
      </tr>
      <tr>
        <th scope="row">Archive.org HTML copy:</th>
        <td><p id="output-archive-org-copy" class="easy-select"></p></td>
      </tr>
      <tr>
        <th scope="row">Tags:</th>
        <td><p id="output-tags" class="easy-select"></p></td>
      </tr>
      <tr>
        <th scope="row">Actions:</th>
        <td><a id="output-archive-org-link" class="button button-primary" target="_blank" rel="noopener">Create Archive.org upload</a></td>
      </tr>
    </tbody>
  </table>
</section>

<hr>

<section>
  <h3>Artwork</h3>
  <canvas id="artwork-canvas" width="1200" height="1200" style="display: none;"></canvas>
  <img id="artwork-canvas-export" class="output" />
</section>

<hr>

<section>
  <h3>MP3 tagger</h3>

  <div class="output">
    *** here goes a drag/drop UI element for tagging mp3 files ***
  </div>
</section>