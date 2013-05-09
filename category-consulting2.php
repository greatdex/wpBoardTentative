<?php

get_header();

?>

	<?php
		$sidebar = get_option(THEME_SHORT_NAME.'_search_archive_sidebar','no-sidebar');
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}
	?>

<h2>인테리어 관련</h2>

<?php

if ( have_posts() ) : 
	while( have_posts() ) : 
		the_post();
		?>
		<?=the_id(); ?> | 
		<a href=<?=the_permalink(); ?>><?= the_title();?> </a> 
		<div class="right">
		|<?=the_author(); ?> 
		|<?=the_date(); ?> 		
		</div>
		<?php
		echo "<hr />";
	endwhile;
endif;

?>
<?php 
//if(/*is_user_logged_in() ||*/ current_user_can('read_post')) : 
?>
<a href="<?php get_bloginfo('url'); ?>/wp/wp-admin/post-new.php?post_type=post&cat=14" title="Contribute">글쓰기</a>
<?php // endif; ?>

<?php


get_footer();


?>