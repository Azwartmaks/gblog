<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Articles</div>

  <!-- Table -->
  <table class="table">
    <tr>
      <td><b>Title</b></td>
      <td><b>Alias</b></td>
      <td><b>IS Active</b></td>
      <td><b>Edit</b></td>
      <td><b>Remove</b></td>
    </tr>
  <?php foreach($articles as $article):?>
  	<tr>
  		<td><?= $article['title'];?></td>
  		<td><?= $article['alias'];?></td>
  		<td><?php if ($article['is_active']==1)
  			{
  				echo 'Active';
  			}
  			else 
		    {
				  echo 'Inactive';
        }?>  				
		  </td>
		  <td><a href="<?php base_url()?>admin/editarticle/<?=$article['id']?>">Edit</a></td>
		  <td><a href="<?php base_url()?>admin/removearticle/<?=$article['id']?>">Delete</a></td>
    </tr>
  <?php endforeach;?>

  </table>

		<?php echo $this->pagination->create_links();?>
</div>