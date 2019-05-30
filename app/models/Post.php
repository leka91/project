<?php

class Post {

	private $db;

	public function __construct() {

		$this->db = new Database;

	}

	public function getPosts() {

		$this->db->query('SELECT *,
						posts.id as postId,
						users.id as userId,
						posts.created_at as postCreated,
						users.created_at as userCreated
						FROM posts
						JOIN users
						ON posts.user_id = users.id
						ORDER BY posts.created_at DESC');

		return $this->db->resultSet();

	}

	public function addPost($data) {

		$this->db->query('INSERT INTO posts 
						(user_id, title, body)
						VALUES 
						(:user_id, :title, :body)');

		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);

		if ($this->db->execute()) {
		 	
			return true;

		} else {

			return false;

		}

	}

	public function updatePost($data) {

		$this->db->query('UPDATE posts SET
						title = :title,
						body  = :body
						WHERE 
						id = :id');

		$this->db->bind(':id', $data['id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);

		if ($this->db->execute()) {
		 	
			return true;

		} else {

			return false;

		}

	}

	public function getPostById($id) {

		$this->db->query('SELECT *,
						posts.id as postId,
						posts.created_at as postCreated
						FROM posts
							JOIN users ON
						    posts.user_id = users.id
						WHERE posts.id = :id');
		$this->db->bind(':id', $id);

		return $this->db->single();

	}

	public function deletePost($id) {

		$this->db->query('DELETE FROM
						posts
						WHERE 
						id = :id');

		$this->db->bind(':id', $id);
		
		if ($this->db->execute()) {
		 	
			return true;

		} else {

			return false;

		}

	}

}