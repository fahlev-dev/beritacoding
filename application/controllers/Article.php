<?php

class Article extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
	}

	public function index()
	{
		// ambil artikel yang statusnya bukan draft
		$data['articles'] = $this->article_model->get_published();

		if(count($data['articles']) > 0){
			$this->load->view('articles/list_article.php', $data);
		} else {
			$this->load->view('articles/empty_article.php');
		}
	}

	public function show($slug = null)
	{
		// jika gak ada slug di URL tampilkan 404
		if(!$slug) {
			show_404();
		}

		// ambil artikel dengan slug yang diberikan
		$data['article'] = $this->article_model->find_by_slug($slug);

		if(!$data['article']) {
			show_404();
		}

		// @TODO: get article from model
		$this->load->view('articles/show_article.php', $data);
	}
}