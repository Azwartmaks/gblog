<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Categories</div>

  <!-- Table -->
  <table class="table">
    <tr>
      <td><b>Title</b></td>
      <td><b>Alias</b></td>
      <td><b>IS Active</b></td>
      <td><b>Edit</b></td>
      <td><b>Remove</b></td>
    </tr>
  <?php foreach($categories as $category):?>
  	<tr>
  		<td><?= $category['title'];?></td>
  		<td><?= $category['alias'];?></td>
  		<td><?php if ($category['is_active']==1)
  			{
  				echo 'Active';
  			}
  			else 
			{
				echo 'Inactive';
			}?>  				
		</td>
		<td><a href="<?php base_url()?>categories/editcategory/<?=$category['id']?>">Edit</a></td>
		<td><a href="<?php base_url()?>categories/removecategory/<?=$category['id']?>">Delete</a></td>
  	</tr>
  <?php endforeach;?>

  </table>

		<?php echo $this->pagination->create_links();?>
</div>