<?php

class User {

	private $db;

	public function __construct() {

		$this->db = new Database;

	}

	// Register User
	public function register($data) {

		$this->db->query('INSERT INTO users 
						(name, email, password)
						VALUES 
						(:name, :email, :password)');

		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);

		if ($this->db->execute()) {
		 	
			return true;

		} else {

			return false;

		}
		
	}

	//Login User
	public function login($email, $password) {

		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $email);

		$row = $this->db->single();
		$hashed_password = $row->password;

		if (password_verify($password, $hashed_password)) {
			
			return $row;

		} else {

			return false;

		}

	}

	// Find user by email
	public function findUserByEmail($email) {

		$this->db->query('SELECT COUNT(*) AS emailChek
						FROM users
						WHERE email = :email');
		$this->db->bind(':email', $email);
		$row = $this->db->single();

		if ($row->emailChek > 0) {

			return true;

		} else {

			return false;

		}

	}

	// Create User Session
	public function createUserSession($user) {

		$_SESSION['user_id']    = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name']  = $user->name;

		redirect('posts');

	}

}