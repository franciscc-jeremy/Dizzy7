<?php tha_footer_before(); ?>
	<footer id="footer">
		<?php tha_footer_top(); ?>
			<!-- Footer Content-->
			<?php if (get_theme_mod('diz-footer-content')) { echo get_theme_mod( 'diz-footer-content', '' ); }	?>
	        <p class="copyright">&copy; Copyright <?php echo date ("Y");?> - <a href="<?php bloginfo('url');?>">
			<?php if (get_theme_mod( 'ds_busname_setting', '' )) {
			    echo get_theme_mod( 'ds_busname_setting', '' );
			}
			else {
				echo wp_title();
			}
				?></a>  |  All rights reserved  |  <a href="<?php bloginfo('url');?>/privacy">Privacy Policy</a>  |  <a href="<?php bloginfo('url');?>/disclaimer">Disclaimer</a></p>
		<?php tha_footer_bottom(); ?>
		
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800%7cOpen+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


		
		<?php wp_footer(); ?>
		<style>
			/*Buttons and stuff*/
		a[href$=".pdf"] {
			padding: .5em 7em .5em 1.5em;
		}
		form button, input[type=button], input[type=submit], .teaser_link, .button, a[href$=".pdf"], .wp-block-button__link {
  			background:var(--main-color)!important;
  			border:none!important;
  			color:#fff!important;
  			text-transform:uppercase!important;
		}
		form button:hover, input[type=button]:hover, input[type=submit]:hover, .teaser_link:hover, .button:hover, a[href$=".pdf"]:hover, .wp-block-button__link:hover {
  			background:var(--second-color)!important;
  			cursor:pointer!important;
  			color:#fff!important;
  			border:none!important;
		}
		form button, input[type=button], input[type=submit], .teaser_link, .button {
  			text-transform:uppercase!important;
			padding:.75em 1.5em!important;
			display:table!important;
		}
		a {
  			color:var(--main-color);
			text-decoration:none;
		}
		a:hover {
  			color:var(--second-color);
		}
		input, textarea, .frm_submit button {
  			padding:1.5em!important;
  			border-radius:0px!important;
  			box-shadow:none!important;
		}
		input[type=text], textarea {
  			width: 100%!important;
  			box-sizing: border-box!important;
		}
		.frm_submit button {
  			border:none!important;
		}
		label {
    		float: none!important;
    		clear: both!important;
    		display: block!important;
		}
			.plyr__controls button {
				padding:initial!important;
				display:initial!important;
			}
		</style>
		<script>// <![CDATA[
        	jQuery(document).ready( function() {
				jQuery(window).scroll( function() {
                	if (jQuery(window).scrollTop() > jQuery('#trigger').offset().top)
                    	jQuery('#nav').addClass('floating');
                	else
                    	jQuery('#nav').removeClass('floating');
            	} );
				
				jQuery(window).scroll( function() {
                	if ( jQuery(window).scrollTop() >  jQuery('#trigger').offset().top)
						jQuery('.to-top').removeClass('off');
                	else
						jQuery('.to-top').addClass('off');
            	} );
				
        	} );
			// ]]>
		</script>
		
		<script>
			// Find all iframes
				var $iframes = $( "iframe" );
 
			// Find &amp;amp;#x26; save the aspect ratio for all iframes
				$iframes.each(function () {
				  $( this ).data( "ratio", this.height / this.width )
		    // Remove the hardcoded width &amp;amp;#x26; height attributes
				    .removeAttr( "width" )
				    .removeAttr( "height" );
				});
			// Resize the iframes when the window is resized
				$( window ).resize( function () {
				  $iframes.each( function() {
		    // Get the parent container&amp;amp;#x27;s width
			    var width = $( this ).parent().width();
			      $( this ).width( width )
			      .height( width * $( this ).data( "ratio" ) );
			    });
			// Resize to fix all iframes on page load.
				}).resize();
		</script>
		<script>// <![CDATA[
			function HideContent(d) { document.getElementById(d).style.display = "none"; } function ShowContent(d) { document.getElementById(d).style.display = "table"; } function ReverseDisplay(d) { if(document.getElementById(d).style.display == "table") { document.getElementById(d).style.display = "none"; } else { document.getElementById(d).style.display = "table"; } }
			// ]]>
		</script>
		<script>
			$(document).on('click', 'a[href^="#"]', function (event) {
    			event.preventDefault();

    		$('html, body').animate({
        		scrollTop: $($.attr(this, 'href')).offset().top
    			}, 1500);
			});
		</script>
		
		<script>
			$(document).ready(function(){
				$.doTimeout(2500, function(){
					$('.repeat.go').removeClass('go');
						return true;
				});
				$.doTimeout(2520, function(){
					$('.repeat').addClass('go');
					return true;
				});
	
			});
</script>

		
		<?php if (is_front_page() || is_home() || is_archive()) {?>
		<script type="text/javascript" async="" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.pkgd.min.js"></script>
		
		<script>
			function resizeGridItem(item){
  				grid = document.getElementsByClassName("grid")[0];
  				rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
  				rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
  				rowSpan = Math.ceil((item.querySelector('.teaser').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
    			item.style.gridRowEnd = "span "+rowSpan;
			}

			function resizeAllGridItems(){
  				allItems = document.getElementsByClassName("item");
  				for(x=0;x<allItems.length;x++){
    			resizeGridItem(allItems[x]);
  				}
			}

			function resizeInstance(instance){
				item = instance.elements[0];
  				resizeGridItem(item);
			}

			window.onload = resizeAllGridItems();
			window.addEventListener("resize", resizeAllGridItems);

			allItems = document.getElementsByClassName("item");
			//for(x=0;x<allItems.length;x++){
  			//imagesLoaded( allItems[x], resizeInstance);
			//}
		</script>
		<?php }?>

	</footer>
	<?php tha_footer_after(); ?>
</body>
</html>