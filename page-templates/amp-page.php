<?php
/**
 * Template Name: Amp Page
 *
 */
 $url = remove_query_arg( 'em' );
 ?>
 <!DOCTYPE html>
 <html ⚡ <?php language_attributes(); ?>>
 <head>
 	<meta charset="utf-8">
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<link rel="canonical" href="<?php echo $url;?>">
	<title>Hubaga - A WordPress eCommerce Plugin for Software Developers</title>
	<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style>
	<noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<style amp-custom>
		html{font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,Helvetica,Arial,sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}a:active,a:hover{outline:0}h1{margin:.67em 0}*,:after,:before{-webkit-box-sizing:border-box;box-sizing:border-box}html{color:#212121;font-size:100%;font-weight:400;line-height:1.5}body{background-color:#fafafa;font-size:1em;position:relative;-webkit-transition:left .2s ease;transition:left .2s ease;word-wrap:break-word}a{color:#009688;text-decoration:none}a:hover{color:#64ffda}a:active,a:visited{color:#00bfa5}h1{font-size:2em;margin:2.1rem 0 1.68rem}h1,h2{font-weight:300}h2{font-size:1.62em;margin:1.78rem 0 1.424rem}p{font-size:1.25em;font-weight:400;margin:0 0 30px;padding:0}img,video{height:auto;max-width:100%}.hubaga-grid:after{clear:both;content:"";display:table}.col{float:left;padding:15px;width:100%}.ps1{width:10%}.ps2{width:20%}.ps3{width:30%}.ps4{width:40%}.ps5{width:50%}.ps6{width:60%}.ps7{width:70%}.ps8{width:80%}.ps9{width:90%}.ps10{width:100%}@media only screen and (min-width:620px){.pm1{width:10%}.pm2{width:20%}.pm3{width:30%}.pm4{width:40%}.pm5{width:50%}.pm6{width:60%}.pm7{width:70%}.pm8{width:80%}.pm9{width:90%}.pm10{width:100%}}.btn,button{background-color:#009688;border:none;border-radius:2px;-webkit-box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);color:#fafafa;cursor:pointer;display:inline-block;height:36px;letter-spacing:.5px;line-height:36px;outline:0;padding:0 2rem;-webkit-tap-highlight-color:transparent;text-align:center;text-decoration:none;text-transform:uppercase;-webkit-transition:all .2s ease-out;transition:all .2s ease-out;vertical-align:middle}.btn:focus,button:focus{background-color:#00897b;outline:none}.btn:hover,button:hover{background-color:#00796b}.site-inner{background:#fafafa}.container{margin:0 auto;max-width:1024px;width:90%}@media only screen and (min-width:601px){.container{width:85%}}@media only screen and (min-width:993px){.container{width:90%}}.feature-section{background:#009688;background:-webkit-gradient(linear,left top,right top,from(#4db6ac),color-stop(#009688),color-stop(#00897b),color-stop(#00897b),to(#00897b));background:linear-gradient(90deg,#4db6ac,#009688,#00897b,#00897b,#00897b);color:#fafafa;min-height:400px;min-height:100vh;padding:30px 0}.feature-section .container{margin-top:20px}@media only screen and (min-width:620px){.feature-section .container{margin-top:100px}}.feature-section .btn{background-color:#fafafa;color:#009688}.feature-section h1{margin:0}@media only screen and (min-width:620px){.feature-section h1{font-size:4em;margin:2.1rem 0 1.68rem}}.hero-text{font-size:1.3em;font-weight:300}
		/* Wrapper that hosts the video and the overlay */
		.video-player {
    		position: relative;
    		overflow: hidden;
  		}

  /* Overlay fills the parent and sits on top of the video */
  .click-to-play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .poster-image {
    position: absolute;
    z-index: 1;
  }

  .poster-image img {
    object-fit: cover;
  }

  .video-title {
    position: absolute;
    z-index: 2;
    /* Align to the top left */
    top: 0;
    left: 0;
    font-size: 1.3em;
    background-color: rgba(0,0,0,0.8);
    color: #fafafa;
    padding: 0.5rem;
    margin: 0px;
  }

  .play-icon {
    position: absolute;
    z-index: 2;
    width: 100px;
    height: 100px;
    background-image: url(data:image/png;base64,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);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    /* Align to the middle */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    cursor: pointer;
    opacity: 0.9;
  }

  .play-icon:hover, .play-icon:focus {
    opacity: 1;
  }
	</style>
 </head>

<body <?php body_class(); ?>>
<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "UA-108060896-1"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
	},
	"trackClickOnHeader" : {
      "on": "click",
      "selector": ".play-icon",
      "request": "event",
      "vars": {
        "eventCategory": "ui-components",
        "eventAction": "video-play"
      }
    }
  }
}
</script>
</amp-analytics>
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
