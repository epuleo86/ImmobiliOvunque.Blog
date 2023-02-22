<?php 
	if ( !is_single()){
		get_template_part( 'template-parts/loop-item');
	}
	else{
		get_template_part( 'template-parts/single-post'); 
	}
?>