<?php 
namespace Anax\Movies;

class MoviesController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
    

	/**
	 * initialize the controller
	 * @return void
	 *
	 */

	public function initialize(){

		$this->movies = new \Anax\Movies\Movie();
		$this->flash = new \Anax\Flash\CFlashBasic();
		$this->movies->setDI($this->di);
	}

	public function listAction(){

		$this->initialize();

		$all = $this->movies->findAll();


		$this->theme->setTitle('All movies');
		$this->views->add('movies/list-all', [
		'movies' => $all,


		]);
	}

	public function indexAction(){

		$this->initialize();

		$all = $this->movies->findAll();


		$this->theme->setTitle('All movies');
		$this->views->add('movies/list-all', [
		'movies' => $all,


		]);
	}

	public function idAction($id){

		$this->initialize();
		$all= $this->movies->find($id);

		$properties = $all;
		$name = $all->getProperties();
		
		$this->theme->setTitle("View Movie");
		$this->views->add('movies/view-aMovie', [
			'movies' => $properties->getProperties(),
			'title' => '<h1 class="text-capitalize text-danger text-center">'.$name['title'].'</h1>',

		]);
	}

	public function addAction($title = null){

		$msg = $this->flash;
		$this->initialize();
		if(!isset($title)){

		$this->session();
		$form = $this->form;
		$form = $this->form->create([''],[
			'title' => [
				'type'        => 'text',
                    'label'       => 'Title:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
			],

			'director' => [
				'type'        => 'text',
                    'label'       => 'Director:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
			],
			'YEAR' => [
				'type'        => 'text',
                    'label'       => 'Year of Prod:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
			],
			'plot' => [
				'type'        => 'text',
                    'label'       => 'Summary:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
			],
			'img' => [
				'type'        => 'text',
                    'label'       => 'Img url:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
			],
			'price' => [
				'type'        => 'text',
                    'label'       => 'Price:',
                    'required'    => true,
                    'validation'  => ['numeric','not_empty'],
			],
			'imdb' => [
				'type'        => 'text',
                    'label'       => 'imdb:',
                    'validation'  => ['not_empty'],
			],
			'trailer' => [
				'type'        => 'text',
                    'label'       => 'trailer:',
                    'validation'  => ['not_empty'],
			],
			'submit' => [
                    'type'      => 'submit',
                    'callback'  => function($form) {
                        $form->saveInSession = true;
                        return true;
                    }
                ],


		]);

		}
		$status = $form->check();
		// print_r($_SESSION);
		if($status === true){
			echo "string";
			$title = $_SESSION['mos/cform-cform#save']['title']['value'];
			$director = $_SESSION['mos/cform-cform#save']['director']['value'];
			$plot = $_SESSION['mos/cform-cform#save']['plot']['value'];
			$img = $_SESSION['mos/cform-cform#save']['img']['value'];
			$price = $_SESSION['mos/cform-cform#save']['price']['value'];
			$imdb = $_SESSION['mos/cform-cform#save']['imdb']['value'];
			$trailer = $_SESSION['mos/cform-cform#save']['trailer']['value'];
			$YEAR = $_SESSION['mos/cform-cform#save']['YEAR']['value'];
			session_unset($_SESSION['mos/cform-cform#save']);
			
				

			$this->movies->save([

				'title' => $title,
				'director' => $director,
				'YEAR' => $YEAR,
				'plot' => $plot,
				'image' => $img,
				'price' => $price,
				'imdb' => $imdb,
				'trailer' => $trailer,

			]);
			
			$msg = $this->flash->setMessage("Movie upploaded", "alert alert-success");

			

    		$url = $this->url->create('movies/id/' . $this->movies->id);
			$this->response->redirect($url); // the redirect goes here
			
    		

    		

		//}
		

		
		}
		$this->theme->setTitle('Add movie');
		$this->views->add("movies/add",[
			'title' => 'Add Movie',
			'content' => $form->getHTML(),
		]);
		


}

public function updateAction($id = null){

	if (!isset($id)) {
        die("Missing id");
    }

	$this->initialize();

	if(isset($id)){
		if(is_numeric($id)){

			$movie = $this->movies->find($id);
		}

		$form = $this->form;
		$form = $form->create([], [
			'id' => [
				'type' => 'hidden',
				'label' => 'id',
				'required' =>  true,
				'validation' => ['not_empty'],
				'value' => $movie->id,
			],
			'title' => [
				'type'        => 'text',
                    'label'       => 'Year of Prod:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
                    'value' => $movie->title,
			],

			'director' => [
				'type'        => 'text',
                    'label'       => 'Director:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
                    'value' => $movie->director,
			],
			'YEAR' => [
				'type'        => 'text',
                    'label'       => 'Year of Prod:',
                    'required'    => true,
                    'validation'  => ['not_empty'],
                    'value' => $movie->YEAR,
			],
			'plot' => [
				'type'        => 'text',
                    'label'       => 'Summary:',
                    'required'    => true,
                    'value' => $movie->plot,

			],
			'img' => [
				'type'        => 'text',
                    'label'       => 'Img url:',
                    'required'    => true,
                    'value' => $movie->image,
			],
			'price' => [
				'type'        => 'text',
                    'label'       => 'Price:',
                    'required'    => true,
                    'value' => $movie->price,
			],
			'imdb' => [
				'type'        => 'text',
                    'label'       => 'imdb:',
                    'value' => $movie->imdb,
			],
			'trailer' => [
				'type'        => 'text',
                    'label'       => 'trailer:',
                    'value' => $movie->trailer,
			],
			'submit' => [
                    'type'      => 'submit',
                    'callback'  => function($form) {
                        $form->saveInSession = true;
                        return true;
                    }
                ],


		]);

		$status =  $form->check();

		if($status === true){
			$title = $_SESSION['mos/cform-cform#save']['title']['value'];
			$director = $_SESSION['mos/cform-cform#save']['director']['value'];
			$plot = $_SESSION['mos/cform-cform#save']['plot']['value'];
			$img = $_SESSION['mos/cform-cform#save']['img']['value'];
			$price = $_SESSION['mos/cform-cform#save']['price']['value'];
			$imdb = $_SESSION['mos/cform-cform#save']['imdb']['value'];
			$trailer = $_SESSION['mos/cform-cform#save']['trailer']['value'];
			$YEAR = $_SESSION['mos/cform-cform#save']['YEAR']['value'];

			$movie->id = $id;
			$movie->title = $title;
			$movie->director = $director;
			$movie->YEAR = $YEAR;
			$movie->plot = $plot;
			$movie->image = $img;
			$movie->price = $price;
			$movie->imdb = $imdb;
			$movie->trailer = $trailer;
			

			$movie->save([
				'id' => $movie->id,
				'title' => $movie->title,
				'director' => $movie->director,
				'YEAR' => $movie->YEAR,
				'plot' => $movie->plot,
				'image' => $movie->image,
				'price' => $movie->price,
				'imdb' => $movie->imdb,
				'trailer' => $movie->trailer,
			]);
			session_unset($_SESSION['mos/cform-cform#save']);
			$url = $this->url->create('movies/list');
			$this->response->redirect($url);


		}
		$this->theme->setTitle('Update ');
		$this->views->add('movies/add', [
			'movies' => $movie,
			'title' => 'Edit movie',
			'content' => $form->getHTML(),
		]);

	}



}




	public function deleteAction($id = null){

		if (!isset($id)) {
        die("Missing id");
    	}

		$this->initialize();
		$this->theme->setTitle('Delete User');

		$res = $this->movies->delete($id);
		$url = $this->url->create('movies/list');
		$this->response->redirect($url);

		
	}
}
 