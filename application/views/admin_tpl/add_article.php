<?php 
/* CHECK MODEL DATA */
if(!empty($article_data))
{
	$article_data = $article_data[0];
}
	$title 				= (!empty($article_data['title']) ? $article_data['title'] : '');
	$meta_title 		= (!empty($article_data['meta_title']) ? $article_data['meta_title'] : '');
	$meta_description 	= (!empty($article_data['meta_description']) ?$article_data['meta_description'] : '');
	$alias 				= (!empty($article_data['alias']) ? $article_data['alias'] : '');
	$thumbnail 			= (!empty($article_data['thumbnail']) ? $article_data['thumbnail'] : '');
	$text 				= (!empty($article_data['text']) ? $article_data['text'] : '');
	$is_active 			= (!empty($article_data['is_active']) ?  $article_data['is_active'] : '');

?>

<div class="row">
	<div class="col-sm-6 col-xs-12">
		<form action="<?=base_url()?>admin/savearticle" method="post" enctype="multipart/form-data" >
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="<?=$title?>">
			</div>
			<?php if(!empty($mode) && $mode == 'edit'):?>
				<div class="form-group">
					<label>Is Active</label>
					<div><input type="radio" name="is_active" value="1" <?php if($is_active == 1){echo 'checked';}?>/>&nbsp;&nbsp;Active</div>
					<div><input type="radio" name="is_active" value="0" <?php if($is_active == 0){echo 'checked';}?>/>&nbsp;&nbsp;Inactive</div>
				</div>
			<?php endif;?>	
			<div class="form-group" style="max-height:200px;overflow:auto;">
				<label>Category</label>
				<?php foreach($categories as $category):?>
					<div>
						<input type="checkbox" name="genre[]" value="<?=$category['id']?>" <?php if(!empty($relations) &&in_array($category['id'], $relations)){echo 'checked';} ?>/>&nbsp;&nbsp;<?=$category['title']?>
					</div>
				<?php endforeach;?> 
			</div>
			<div class="form-group">
				<label>Meta title</label>
				<input type="text" name="meta_title" class="form-control" value="<?=$meta_title?>" />
			</div>
			<div class="form-group">
				<label>Meta Descr.</label>
				<input type="text" name="meta_descr" class="form-control" value="<?=$meta_description?>"/>
			</div>
			<div class="form-group">
				<label>Alias</label>
				<?php if($alias === ''):?>
					<input type="text" name="alias" class="form-control" value="<?=$alias?>" required/>
				<?php else:?>
					<div class="form-control" style="color:#9f9f9f;">
						<input type="hidden" name="alias" class="form-control" value="<?=$alias?>"/>
						<?=$alias?>							
					</div>
				<?php endif;?>
			</div>	
			<div class="form-group">
				<label>Thumbnail</label>
				<input type="text" name="thumbnail" class="form-control" value="<?=$thumbnail?>"/>
			</div>	
			<div class="form-group">
				<label>Content (write first max.300 symbols without images)</label>
				<textarea name="content" class="form-control" style="min-height:300px;">
					<?=$text?>
				</textarea>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Save Article">
			</div>
		</form>
	</div>
</div>
