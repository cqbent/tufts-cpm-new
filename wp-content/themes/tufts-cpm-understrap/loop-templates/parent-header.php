<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/29/19
 * Time: 4:16 PM
 */

/*
 * landing page?
 *  yes: load title and image from page
 *  no:
 *   has parent?
 *      yes: load parent data
 *      no: load
 *
 */

if ($landing_page_id = landing_page_header(get_the_ID())) {
  ?>
  <div class="banner parent-header">
    <h2 class="parent-title"><?php print get_the_title($landing_page_id); ?></h2>
	  <?php print get_the_post_thumbnail($landing_page_id, 'full', array('class' => 'parent-logo')); ?>
  </div>
  <?php
}
?>

<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
  <div class="container">
	  <?php
	  if (function_exists('bcn_display')) {
		  //bcn_display();
	  }
	  ?>
  </div>

</div>
