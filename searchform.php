<?php
	$val = get_search_query();
	$class = 'hubaga-field';
	if(!$val){
		$class .= ' hubaga-is-empty';
	}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class='hubaga-label'>
		<i class="screen-reader-text">Search for:</i>
		<input class="<?php echo $class;?>" value="<?php echo $val ?>" name="s" />
		<span><span>Search</span></span>
	</label>
	<button type="submit" class="search-submit"><svg width="24" height="32" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
		<title>Search Submit</title>
		<path d="M12 3.984l8.016 8.016-8.016 8.016-1.406-1.406 5.578-5.625h-12.188v-1.969h12.188l-5.578-5.625z"></path>
	</svg><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'twentysixteen' ); ?></span></button>
</form>
