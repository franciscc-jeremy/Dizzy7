<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<title><?php wp_title(); ?></title>
    <meta property="og:image" content="<?php echo $theSrc; ?>" />
	
	<?php wp_head(); ?>
	
	<!-- Add Customizations here -->
	
	<style>
		:root {
			--main-color: <?php if (get_theme_mod( 'diz-theme-main-color')) {?><?php echo get_theme_mod( 'diz-theme-main-color', '' ); ?><?php } else { ?>#CCC<?php }?>;
			--second-color: <?php if (get_theme_mod( 'diz-theme-second-color')) {?><?php echo get_theme_mod( 'diz-theme-second-color', '' ); ?><?php } else { ?>#EEF<?php }?>;
			--highlight-color: <?php if (get_theme_mod( 'diz-theme-third-color')) {?><?php echo get_theme_mod( 'diz-theme-third-color', '' ); ?><?php } else { ?>#0AF<?php }?>;
			--special-color: <?php if (get_theme_mod( 'diz-theme-fourth-color')) {?><?php echo get_theme_mod( 'diz-theme-fourth-color', '' ); ?><?php } else { ?>#333<?php }?>;
		}
		body {
			margin:0px;
			background-image:url('https://d3p7wdg430n2je.cloudfront.net/wp-content/uploads/d7-fallback-bg-e1525574357880.jpg');
			<?php if(is_front_page() || is_archive()) {?>
				<?php if(get_theme_mod( 'diz-bgimg')) { ?>
			background-image:url('<?php echo get_theme_mod( 'diz-bgimg', '' ); ?>');/*Theme bg*/<?php } else { ?>
			background-image:url('https://d3p7wdg430n2je.cloudfront.net/wp-content/uploads/d7-fallback-bg-e1525574357880.jpg');/*Default BG*/
				<?php }?>
			<?php } else if( get_field('big-pic') || has_post_thumbnail() || get_theme_mod( 'diz-bgimg') ){ ?>
			background-image:url('<?php if( get_field('big-pic') ) { ?><?php the_field('big-pic'); ?><?php } else if(has_post_thumbnail()) { ?><?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?><?php } else if(get_theme_mod( 'diz-bgimg')) { ?><?php echo get_theme_mod( 'diz-bgimg', '' ); ?><?php } else { ?>https://d3p7wdg430n2je.cloudfront.net/wp-content/uploads/d7-fallback-bg-e1525574357880.jpg<?php }?>');
			<?php }?>
			background-position: center bottom;
			background-attachment: fixed;
            <?php if (wp_is_mobile()) {?>background-size: auto 100%;<?php } else { ?>background-size: 110%;<?php }?>
			font:300 10px/1.2em 'Open Sans', sans-serif;
		}
		/* Formating on load */
		:hover {
			-moz-transition:all 0.35s ease-in-out;
			-webkit-transition:all 0.35s ease-in-out;
		}
		a {
			text-decoration:none;
			overflow-wrap: break-word;
		    	word-wrap: break-word;
		    	-ms-word-break: break-all;
    			word-break: break-all;
    			word-break: break-word;
    			-ms-hyphens: auto;
    			-moz-hyphens: auto;
    			-webkit-hyphens: auto;
    			hyphens: auto;
		}
		.animated {
			opacity:0;
		}
		.go, .go .title {
			opacity:1;
			-webkit-filter: blur(0px) brightness(100%)!important;
			filter: blur(0px) brightness(100%)!important;
			-moz-transition: all 2.5s ease-in-out;
			-webkit-transition: all 2.5s ease-in-out;
		}
		body>nav, main, footer, header {
			width:100%;
			margin:0;
			box-sizing:border-box;
			min-height:40px;
			position:relative;
		}
		body>nav, main section, header, footer {
			display:grid;
			grid-template-columns: 10% 1fr 1fr 1fr 1fr 1fr 1fr 10%;
			grid-column-gap: 1.5em;
			grid-auto-rows: minmax(10px, max-content);
		}
		body>nav > *, header > *, footer > * {
			grid-column:2/8
		}
		main, footer {
			padding:4em;
		}
		body>nav {
			grid-template-columns: 5% 1fr 1fr 1fr 1fr 1fr 1fr 5%;
			grid-template-rows:76px;
			background:#fff;
			position:fixed;
			top:0px;
			z-index:10000;
		}
		.floating {
			box-shadow: 0px 10px 20px -10px rgba(0,0,0,.6);
			-moz-transition:all 0.35s ease-in-out;
			-webkit-transition:all 0.35s ease-in-out;
	  	}
		body>nav div, .menu-main {
			display:table;
			margin:0 10px;
			float:right;
			grid-column: 4/8;
		}
	  	.menu {
			position:relative;
			margin: 0px;
			padding: 0px;
			display: table;
			float: right;
	  	}
		body>nav a {
			color:#fff;
			font-size:1.5em;
		}
		.menu a {
			text-transform:uppercase;
			font-size:1.2em;
		}
	  	.menu li {
			list-style:none;
			float:left;
			position:relative;
			padding: 1.65em 1.75em;
			margin: 0 1px;	
			box-sizing:border-box;
	  	}
	  	.menu li:hover {
			background:#ccc;
			background:var(--main-color);
	  	}
		.menu li:hover a {
			color:#fff;
		}
	  	.sub-menu {
			position:absolute;
			top:100%;
			left:0;
			background:#eef;
			background:var(--second-color);
			visibility:hidden;
			padding:0px;
			width:250px;
	  	}
	  	.menu li:hover .sub-menu {
			visibility:visible;
	  	}
	  	.sub-menu::before {
			content: "";
			position: absolute;
			top: -19px;
			left: 10px;
			border: 10px solid transparent;
			border-bottom: 10px solid #eef;
			border-bottom: 10px solid var(--second-color);
	  	}
	  	.sub-menu li {
			display: inline-table;
			width: 100%;
	  	}
	  	.sub-menu li:hover {
			background:none;
			box-shadow:inset 0px -30px 90px -45px rgba(0,0,0,.7);
	  	}
	  	.menu-button {
			position: absolute;
			top: 1.5em;
			right: 30px;
			text-transform: uppercase;
			border: 1px solid ;
			padding: .5em .75em 0;
			display:none;
	  	}
	  	.menu-button i {
	 		float: left;
			position: relative;
			margin: 0.05em 0.65em 0.25em 0;
	  	}
		.logo {
			display:table;
			margin:.5em;
			float: left;
			padding: .25em;
			font: normal 1.6em 'Open Sans Condensed', sans-serif;
			grid-column: 2/4;
	  	}
        .logo img {
			float:left;
			height:25px;
			width:auto;
	  	}
		header {
			padding:6em 0;
		}
		.home>header {
			min-height:95vh;
		}
		.home>header .container {
			max-width: 75%;
			position:absolute;
			top:50%;
			left:50%;
			transform:translate(-50%,-50%)
		}
		.home>header .container h1 {
			color: rgba(255,255,255, .85);
			letter-spacing: 0px;
			font-size: 9em;
		}
		.home>header .container h1 span {
			display: block;
			font-size: .45em;
			line-height: 1.25em;
			text-transform: uppercase;
			font-weight: 300;
			letter-spacing: 1px;
		}
		.home>header .container .button {
			font-size: 2em;
			margin: 2em auto;
		}
		main {
			background:#eee;
			min-height:400px;
		}
		footer {
			background:#444;
		}
		@media screen and (max-width: 782px) {
			#menu-main, #nav div>div>ul {
				display:none;
			}
			.menu-button {
				display:table;
			}
		}
		<?php if (get_theme_mod( 'diz-custom-css')) {?>/* -- Dizzy Custom Css -- */
  			<?php echo get_theme_mod( 'diz-custom-css', '' ); ?> 
		<?php }?>
		@media screen and (max-width: 1024px) {
			body>nav {
				grid-template-columns: 0px 1fr 1fr 1fr 1fr 1fr 1fr 0px;
			}
			.logo {
				grid-column: 1/3;
			}
			body>nav div, .menu-main {
				grid-column:3/8;
			}
		}
		@media screen and (max-width: 768px) {
			body>nav div, .menu-main {
				grid-column: 1/8;
			}
			.logo {
				grid-column: 1/5;
			}
			.grid a {
				width: 100%;
			}
			main article {
				grid-column: 2/8!important;
			}
			main aside {
				grid-column: 2/8!important;
				padding: 0em;
			}
			.home>header .container {
				max-width: 100%;
				grid-column: 1/-1;
			}	
			.home>header .container h1 {
				font-size: 5em;
			}
		}
		@media screen and (max-width: 425px) {
			.grid {
				display:table!important;
			}
			.grid article { 
				margin: 3em 0;
			}
			main, footer {
				padding:3em;
			}
			section article, section aside {
				grid-column:1/-1!important;
			}
			.home>header .container .button {
				font-size: 2em;
				padding: .75em 1.45em;
			}
		}

	</style>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="dns-prefetch" href="//ajax.googleapis.com" />
    <link rel="dns-prefetch" href="//fonts.googleapis.com/">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	 <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
  
</head>
<?php tha_html_before(); ?>
<body <?php body_class(); ?>>
	<a id="top"></a>
	<a class="to-top off" href="#top"><i class="fas fa-chevron-up"></i></a>
<?php tha_body_top(); ?>
	<nav id="nav" class="animatedParent">
		<a class="logo" href="<?php bloginfo('url');?>/"><?php if (get_theme_mod('diz-nav-logo')) {
				echo '<img src="';
				echo get_theme_mod( 'diz-nav-logo', '' ); 
				echo '" alt="';
				echo wp_title();
				echo '"/>';
			}
		else if (get_theme_mod( 'ds_busname_setting', '' )) {
			    echo get_theme_mod( 'ds_busname_setting', '' );
		    }
		else {
				echo wp_title();
			}
		?>
		</a>
		<?php wp_nav_menu( array( 'container_class' => 'menu-main animated fadeInRight slow', 'theme_location' => 'primary' ) ); ?> 
		<a class="menu-button animated fadeInRight slow" href="javascript:ReverseDisplay('menu-main')"><i class="fas fa-bars"></i> Menu</a>
	</nav>
	<?php tha_header_before(); ?>
	<header class="animatedParent" data-sequence="500">
		<?php tha_header_top(); ?>
		<?php if (is_front_page()) {?> 
			<?php echo get_theme_mod( 'diz-header-content', 'Place your Header Content Here' ); ?>
		<?php } else if(is_home()) {?>
				<h1>Latest Posts from <?php if (get_theme_mod( 'ds_busname_setting', '' )) {
			    echo get_theme_mod( 'ds_busname_setting', '' );
		    		} else {
				echo wp_title();
				}?></h1>
	        <?php $the_query = new WP_Query( 'posts_per_page=1' ); ?><?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                <div class="latest-post blur animated fadeInDown slow" data-id="1">
					<h2 class="title"><?php the_title();?><?php if ( get_post_meta(get_the_id(), 'subtitle', true) ) { ?><br/><span class="subtitle"><?php echo get_post_meta(get_the_id(), 'subtitle', true) ?></span><?php } ?></h2>
                <?php echo get_avatar( get_the_author_meta('ID'), 60); ?>
                <p>Posted By: <?php the_author_posts_link(); ?> <br/><span><?php the_date();?></span></p>
                <p class="cat"><?php $cats=get_the_category(); echo $cats[0]->name; ?></p>
                <a href="<?php the_permalink();?>#article-header" class="button">Read More</a>
				</div>
            <?php endwhile; wp_reset_postdata();?>
     	<?php } else if (is_author()) {?>
			<h1 class="author-archive archive-title title blur animated fadeInDown slow" data-id="2"><span>Posts By:</span><br/><?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?><?php the_author_posts_link(); ?></h1>
		<?php } else if ( is_post_type_archive('jetpack-portfolio') ) { ?>
			<!--Post Type Archive-->
			<h1 class="title blur animated fadeInDown slow" data-id="2"><?php post_type_archive_title(); ?></h1>
		<?php } else if (is_archive()) {?>
			<h1 class="title blur animated fadeInDown slow" data-id="2"><?php single_cat_title( '', true ); ?></h1>
		<?php } else if (is_archive('archive-jetpack-portfolio')) {?>
		
		<h1>Latest Project</h1>
	        <?php $the_query = new WP_Query( 'posts_per_page=1' ); ?><?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                <div class="latest-post blur animated fadeInDown slow" data-id="1">
					<h2 class="title"><?php the_title();?><?php if ( get_post_meta(get_the_id(), 'subtitle', true) ) { ?><br/><span class="subtitle"><?php echo get_post_meta(get_the_id(), 'subtitle', true) ?></span><?php } ?></h2>
                <a href="<?php the_permalink();?>#article-header" class="button">Read More</a>
				</div>
            <?php endwhile; wp_reset_postdata();?>
		
		<?php } else if (is_single()) { ?>
			<h1 class="title blur animated fadeInDown slow" data-id="2"><?php the_title();?><?php if ( get_post_meta(get_the_id(), 'subtitle', true) ) { ?><br/><span class="subtitle"><?php echo get_post_meta(get_the_id(), 'subtitle', true) ?></span><?php } ?></h1>
			<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
			<?php echo get_avatar( get_the_author_meta('ID'), 96); ?>
		<p>Posted By: <?php the_author_posts_link(); ?> <br/><span><?php the_date();?></span></p>
				<p class="cat"><?php $cats=get_the_category(); echo $cats[0]->name; ?></p>
			<?php endwhile; endif; ?>
		<?php } else if(is_page()) { ?>
			<h1 class="title blur animated fadeInDown slow" data-id="2"><?php the_title();?><?php if ( get_post_meta(get_the_id(), 'subtitle', true) ) { ?><br/><span class="subtitle"><?php echo get_post_meta(get_the_id(), 'subtitle', true) ?></span><?php } ?></h1>
		<?php }?>    
		<?php tha_header_bottom(); ?>
		<a id="trigger"></a>
	</header> 
	<?php tha_header_after(); ?>
	<!--Break header.php -->
