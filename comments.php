<div class="clearfix"></div>
<div class="comments">
	<h3><i class="fa fa-comments"></i> Comentarios</h3>
	<ul class="commentlist">
		<?php wp_list_comments( 
				array(
					'reply_text' => '<i class="fa fa-reply"></i> Responder'
				)
			);?>
	</ul>

	<?php comment_form();?>
</div>