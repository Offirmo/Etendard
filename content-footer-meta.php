<?php if(is_single()){ ?>
	
	<footer class="post-footer">
		
		<?php if(has_tag()) { ?>
		
			<span class="footer-meta icon-tags" itemscope="keywords">
			
				<?php echo get_the_tag_list('',' | ',''); ?>
			
			</span>
		
		<?php } ?>
	
		<?php if(etendard_is_paginated_post()){ ?>
			
				<?php wp_link_pages(array(
					'before'=>'<nav><div class="page-links"><span class="page-links-title">'.__('Pages:', 'etendard').'</span>', 
					'after'=>'</div></nav>'
				)); ?>
			
		<?php } ?>
	
	</footer>
	
<?php } ?>