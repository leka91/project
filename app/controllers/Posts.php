<?php

class Posts extends Controller {

	public function __construct() {

		if (!isLoggedIn()) {
			
			redirect('users/login');

		} 

		$this->postModel = $this->model('Post');

	}

	public function index() {

		$posts = $this->postModel->getPosts();

		$data = [
			'posts' => $posts
		];

		$this->view('posts/index', $data);

	}

	public function add() {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'title'     => trim($_POST['title']),
				'body'      => trim($_POST['body']),
				'user_id'   => $_SESSION['user_id'],
				'title_err' => '',
				'body_err'  => ''
			];

			if (empty($data['title'])) {
				$data['title_err'] = 'Please enter title';
			}

			if (empty($data['body'])) {
				$data['body_err'] = 'Please enter body text';
			}

			if (empty($data['title_err']) && empty($data['body_err'])) {
				
				if ($this->postModel->addPost($data)) {
					
					flash('post_message','Post Added');
					redirect('posts');

				} else {

					die('Something went wrong');

				}

			} else {

				$this->view('posts/add', $data);

			}

		} else {

			$data = [
				'title'     => '',
				'body'      => '',
				'title_err' => '',
				'body_err'  => ''
			];

			$this->view('posts/add', $data);

		}

	}

	public function edit($id = null) {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'id'        => $id,
				'title'     => trim($_POST['title']),
				'body'      => trim($_POST['body']),
				'title_err' => '',
				'body_err'  => ''
			];

			if (empty($data['title'])) {
				$data['title_err'] = 'Please enter title';
			}

			if (empty($data['body'])) {
				$data['body_err'] = 'Please enter body text';
			}

			if (empty($data['title_err']) && empty($data['body_err'])) {
				
				if ($this->postModel->updatePost($data)) {
					
					flash('post_message','Post Updated');
					redirect('posts');

				} else {

					die('Something went wrong');

				}

			} else {

				$this->view('posts/edit', $data);

			}

		} else {

			$post = $this->postModel->getPostById($id);

			// Check for owner
			if ($post->user_id != $_SESSION['user_id']) {
				redirect('posts');
			}

			$data = [
				'id'        => $id,
				'title'     => $post->title,
				'body'      => $post->body,
				'title_err' => '',
				'body_err'  => ''
			];

			$this->view('posts/edit', $data);

		}

	}

	public function show($id = null) {

		$post = $this->postModel->getPostById($id);

		if (!$post) {
			redirect('posts');
		}

		$data = [
			'post' => $post
		];

		$this->view('posts/show', $data);

	}

	public function delete($id) {

		$post = $this->postModel->getPostById($id);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			if ($this->postModel->deletePost($id) && $post->user_id == $_SESSION['user_id']) {
				
				flash('post_message', 'Post Removed');
				redirect('posts');

			} else {

				die('Something went wrong');

			}

		} else {
			redirect('posts');
		}

	}

}