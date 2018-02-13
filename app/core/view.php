<?php 

class View
{

	protected $data;

	public function content($data=null)
	{
		$this->data = $data;

		echo "<html>";
		$this->header();
		$this->body();
		$this->footer();
		echo "</html>";
	}
	public function header()
	{
		echo "<head>";
		$this->title();
		$this->css();
		$this->script();
		echo "</head>";
	}
	public function footer()
	{
		echo "<footer>";
		echo "</footer>";
	}
	public function title()
	{
		echo "<title>Главная страница</title>";
	}
	public function css()
	{
		echo '<link rel="stylesheet" href="./css/bootstrap.min.css">';
		echo '<link rel="stylesheet" href="./css/style.css">';
	}
	public function script()
	{
		echo '<script src="./js/jquery-3.2.1.min.js"></script>';
		echo '<script src="./js/bootstrap.min.js"></script>';
	}
	public function nav()
	{

	}
	public function body()
	{
		echo "<body>";
		$this->nav();	
		$this->all();
		echo "</body>";
	}
	public function all()
	{
		
	}
	
}
