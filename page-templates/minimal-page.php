<?php
/**
 * Template Name: Minimal Page
 *
 */
 ?>
 <!DOCTYPE html>
 <html <?php language_attributes(); ?> >

 <head>
 <!-- Global site tag (gtag.js) - Google Analytics -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108060896-1"></script>
	<script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());

  		gtag('config', 'UA-108060896-1');
	</script>
 	<meta charset="<?php bloginfo( 'charset' ); ?>">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="profile" href="http://gmpg.org/xfn/11">
 	<style>
		html{font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,Helvetica,Arial,sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}a:active,a:hover{outline:0}h1{margin:.67em 0}*,:after,:before{-webkit-box-sizing:border-box;box-sizing:border-box}html{color:#212121;font-size:100%;font-weight:400;line-height:1.5}body{background-color:#fafafa;font-size:1em;position:relative;-webkit-transition:left .2s ease;transition:left .2s ease;word-wrap:break-word}a{color:#009688;text-decoration:none}a:hover{color:#64ffda}a:active,a:visited{color:#00bfa5}h1{font-size:2em;margin:2.1rem 0 1.68rem}h1,h2{font-weight:300}h2{font-size:1.62em;margin:1.78rem 0 1.424rem}p{font-size:1.25em;font-weight:400;margin:0 0 30px;padding:0}img,video{height:auto;max-width:100%}.hubaga-grid:after{clear:both;content:"";display:table}.col{float:left;padding:15px;width:100%}.ps1{width:10%}.ps2{width:20%}.ps3{width:30%}.ps4{width:40%}.ps5{width:50%}.ps6{width:60%}.ps7{width:70%}.ps8{width:80%}.ps9{width:90%}.ps10{width:100%}@media only screen and (min-width:620px){.pm1{width:10%}.pm2{width:20%}.pm3{width:30%}.pm4{width:40%}.pm5{width:50%}.pm6{width:60%}.pm7{width:70%}.pm8{width:80%}.pm9{width:90%}.pm10{width:100%}}.btn,button{background-color:#009688;border:none;border-radius:2px;-webkit-box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);color:#fafafa;cursor:pointer;display:inline-block;height:36px;letter-spacing:.5px;line-height:36px;outline:0;padding:0 2rem;-webkit-tap-highlight-color:transparent;text-align:center;text-decoration:none;text-transform:uppercase;-webkit-transition:all .2s ease-out;transition:all .2s ease-out;vertical-align:middle}.btn:focus,button:focus{background-color:#00897b;outline:none}.btn:hover,button:hover{background-color:#00796b}.site-inner{background:#fafafa}.container{margin:0 auto;max-width:1024px;width:90%}@media only screen and (min-width:601px){.container{width:85%}}@media only screen and (min-width:993px){.container{width:90%}}.feature-section{background:#009688;background:-webkit-gradient(linear,left top,right top,from(#4db6ac),color-stop(#009688),color-stop(#00897b),color-stop(#00897b),to(#00897b));background:linear-gradient(90deg,#4db6ac,#009688,#00897b,#00897b,#00897b);color:#fafafa;min-height:400px;min-height:100vh;padding:30px 0}.feature-section .container{margin-top:20px}@media only screen and (min-width:620px){.feature-section .container{margin-top:100px}}.feature-section .btn{background-color:#fafafa;color:#009688}.feature-section h1{margin:0}@media only screen and (min-width:620px){.feature-section h1{font-size:4em;margin:2.1rem 0 1.68rem}}.hero-text{font-size:1.3em;font-weight:300}
	</style>
	<title>Hubaga - A WordPress eCommerce Plugin for Software Developers</title>
 </head>

<body <?php body_class(); ?>>
		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) : the_post();
				the_content(  );
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

</body>
</html>
