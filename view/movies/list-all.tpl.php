			
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
					</tr>
				</thead>
				<tbody>
			
					<tr>
	<?php foreach ($movies as $movie):?>

				
				<?php $property = $movie->getProperties();
				$url = $this->url->create('movies/id/' . $property['id']);
    			

				?>

						<td scope="row"><?=$property['id']?></td>
						<td scope="row"><a href='<?=$this->url->asset($url)?>'><?=$property['title']?></a></td>
						<td scope="row"><?=$property['director']?></td>
						<td scope="row"><?=$property['YEAR']?></td>
						<td scope="row"><?=$property['plot']?></td>
						<td scope="row"><img src="<?=$property['image']?>"></td>					
						<td scope="row"><?=$property['price']?>SEK</td>
						<td scope="row"><a href='<?=$this->url->asset($property["imdb"])?>'>IMDB Link</a></td>
						<td scope="row"><a href='<?=$this->url->asset($property["trailer"])?>'>Youtube Link</a></td>
	</tr>
				
	<?php endforeach ?>




	</tbody>
</table>
		
	
