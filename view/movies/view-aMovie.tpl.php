	<?=$title?>

	
			
	<? if (isset($movies) && is_object($movies)): ?>

		<table class="table table-responsive table-bordered">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Director</th>						
						<th scope="col">Publish Year</th>
						<th scope="col">Plot</th>		
						<th scope="col">Image</th>
						<th scope="col">Price</th>						
						<th scope="col">IMDB</th>					
						<th scope="col">Trailer</th>
						<th scope="col">Update movie</th>
						<th scope="col">Delete movie</th>
					</tr>
				</thead>
				<tbody>
			
					<tr> 

				
				<?php $property = $movies?>
						<td scope="row"><?=$property['id']?></td>
						<td scope="row"><?=$property['title']?></td>
						<td scope="row"><?=$property['director']?></td>
						<td scope="row"><?=$property['YEAR']?></td>
						<td scope="row"><?=$property['plot']?></td>
						<td scope="row"><img src="../<?=$property['image']?>"></td>					
						<td scope="row"><?=$property['price'] . " "?>SEK</td>
						<td scope="row"><a href='<?=$this->url->asset($property["imdb"])?>'>IMDB Link</a></td>
						<td scope="row"><a href='<?=$this->url->asset($property["trailer"])?>'>Youtube Link</a></td>
						<?php $url = $this->url->create('movies/update/' . $property['id']) ?>
            <td><a href="<?=$url?>" title="Edit"> <i class="fa fa-pencil-square-o"></i> </a></td>
            <?php $url = $this->url->create('movies/delete/' . $property['id']) ?>
            <td><a href="<?=$url?>" title="Remove"> <i class="fa fa-times"></i> </a></td>
			</tr> 

	</tbody>
</table>