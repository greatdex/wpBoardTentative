<?php

get_header();

?>
<?php


?>
<style>
	
	#contact { 
		background: #e3e3e3; 
		padding: 1em 2em; 
		z-index:1000;
		position: relative;
	}

	.js #contact {
		position: absolute;
		top: 0;
		width: inherit;
		display: none;
	}	

	#contact h2 { margin-top: 0; }

	#contact ul { padding: 0; }

	#contact li { 
		list-style: none;
		margin-bottom: 1em;
		float:left;
		width:100%;
	}
	

	/* Close button on form */
	.close {
		position: absolute;
		right: 10px;
		top: 10px;
		font-weight: bold;
		font-family: sans-serif;
		cursor: pointer;
	}	

	button {
		float:right;
	}
	/* Form inputs */
	input, textarea { width: 100%; line-height: 2em;}
	input[type=submit] { width: auto;  }
	label { display: block; text-align: left; }
	
	#contact li:first-child { 
		float:left;
		width:45%;
		margin-right:3em;
	}	
	#contact li:nth-child(2) { 
		float:left;
		width:45%;
		margin-right:3em;
	}	


</style>

	<?php
		$sidebar = get_option(THEME_SHORT_NAME.'_search_archive_sidebar','no-sidebar');
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}
	?>
	<?php
				echo '<div class="gdl-page-title-wrapper">';
				echo '<h1 class="gdl-page-title gdl-title title-color">';
				if( is_category() || is_tax('portfolio-category') ){
					_e('Category','gdl_front_end');
				}else if( is_tag() || is_tax('portfolio-tag') ){
					_e('Tag','gdl_front_end');
				}else if( is_day() ){
					_e('Day','gdl_front_end');
				}else if( is_month() ){
					_e('Month','gdl_front_end');
				}else if( is_year() ){
					_e('Year','gdl_front_end');
				}
				echo '</h1>';
				echo '<div class="gdl-page-caption">';
				if(is_category() || is_tag() || is_tax('portfolio-category') || is_tax('portfolio-tag') ){
					echo single_cat_title('', false);
				}else if( is_day() ){
					echo get_the_date( 'F j, Y' );
				}else if( is_month() ){
					echo get_the_date( 'F Y' );
				}else if( is_year() ){
					echo get_the_date( 'Y' );
				}
				echo '</div>';
				echo '<div class="gdl-page-title-left-bar"></div>';
				echo '<div class="clear"></div>';
				echo '</div>'; // gdl-page-title-wrapper
				echo '<br />'; // sixteen columns		
	?>



<div class="cont conta">
	
<!-- 	<div style="width:920px; padding:0px; margin:0px; height:14px; background-color:#EEE; color:black; font-weight:bold">컨설팅</div> -->
<hr style='padding:0px; margin:0px;'/>
<?php
if ( have_posts() ) : 
	while( have_posts() ) : 
		the_post();
		?>
		 
		<a href=<?=the_permalink(); ?>><?= the_title();?> </a> 
		<div style="float:right">
			<div style="width:100px; float:left;">
		<?=$post->post_name; ?> 
			</div>
			<div style="width:100px; float:left;">
		<?=the_time(' F j l'); ?> 	
			</div>	
		</div>
		<?php
		
				echo "<hr style='padding:1px; margin:0px;'/>";
				
	endwhile;
endif;

?>



</div>


<?php 
//if(/*is_user_logged_in() ||*/ current_user_can('read_post')) : 
?>
<br />
<!-- <a style="float:right; font-weight:bold;" href="<?php get_bloginfo('url'); ?>/wp/wp-admin/post-new.php?post_type=post&cat=14" title="Contribute">글쓰기</a>
<?php // endif; ?> 가입글쓰기 
 --> 


<div id="contact">
	<h2>글쓰기</h2>
	<form action="" method="post" name="test">
		<ul>
			<li>
				<label for="name">Name: </label>
	 			<input name="post_name" id="name">
			</li>

			<li>
				<label for="email">Email Address: </label>
		 		<input name="post_email" id="email">
			</li>

			<li>
				<label for="post_title">Title: </label>
		 		<input name="post_title" id="post_title">
			</li>

			<li>
				<label for="post_content">What's Up?</label>
				<textarea name="post_content" id="post_content" cols="30" rows="10"></textarea>
			</li>
			<li>
				<button>글쓰기</button>
			</li>
		</ul>
	</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>

<?php
$my_post = array(
  'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
  'post_content'  => $_POST['post_content'],
  'post_status'   => 'publish',
  'post_name' => $_POST['post_name'],
  'post_category' => array(14)
);
// Create post object
  wp_insert_post( $my_post );


?>

$(function(){

$('html').addClass('js');
var contactForm = {
	container:$('#contact'),

	config:{
		effect: 'slideToggle'
	},
	init: function(config){
		$.extend(this.config, config);

		$('<button></button>',{
			text:'글쓰기'
		}).insertAfter('hr:last')
		  .on('click', this.show);
	},
	show: function(){
		contactForm.close.call(contactForm.container);
		contactForm.container[contactForm.config.effect](contactForm.config.speed);
	},
	close:function(){
		var $this = $(this);
		$('<span class = close>X</span>')
			.prependTo(this)
			.on('click', function(){
				$this[contactForm.config.effect](contactForm.config.speed);
			})
	}

};


contactForm.init({
	effect:'slideToggle',
	speed:700
});

});	


</script>

<?php

get_footer();

?>