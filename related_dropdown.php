<?php 
	class dbconnect {
		private $host = 'localhost';
		private $dbName = 'scratch';
		private $user = 'root';
		private $pass = '';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Database Error: ' . $e->getMessage();
			}
		}
	}

	if(isset($_POST['cid'])) {
		$db = new dbconnect();
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT distinct(module) FROM courses WHERE course_code =" . $_POST['cid']);
		$stmt->execute();
		$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($modules);
	}

	function loadAuthors() {
		$db = new dbconnect();
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM courses");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}

 ?>