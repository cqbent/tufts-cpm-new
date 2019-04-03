<?php
// title, authors, journal, pubdate, volume, pubmedId, link
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
  <h4 class="entry-title">
    <?php
    if ($link = get_field('publication_link')) {
      ?>
      <a href="<?php print $link; ?>" target="_blank"><?php print get_the_title(); ?></a>
      <?php
    }
    else {
	    print get_the_title();
    }
    ?>
  </h4>
  <div class="author-info"><?php print get_field('authors'); ?></div>
  <div class="pub-details">
    <span class="journal"><?php print get_field('journal'); ?></span>
    <?php if ($pubdate = get_field('publication_date')) {
	    $dateobj = new DateTime($pubdate);
	    ?><span class="date"><?php print $dateobj->format('F Y'); ?></span> &nbsp;<?php
    }
    if ($volume = get_field('volume_issue')) {
        ?><span class="volume-issue"><?php print $volume; ?></span><?php
    }
    if ($pubmed_id = get_field('pubmed_id')) {
	    ?><span class="pubmedid"><?php print $pubmed_id; ?></span><?php
    }
    ?>

  </div>

</article>
