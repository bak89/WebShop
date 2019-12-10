<?php 
class Student {
	private $id;
	private $firstname;
	private $lastname;
	private $semester;
	private $project_id;
	private $project_title;
	
	
	public function getId() {
		return $this->id;
	}
	public function getFirstname() {
		return $this->firstname;
	}
	public function getLastname() {
		return $this->lastname;
	}
	public function getSemester() {
		return $this->semester;
	}
	public function getProjectId() {
		return $this->project_id;
	}

	public function getName() {
		return $this->firstname . " " . $this->lastname;
	}
	
	public function __toString(){
		return sprintf("%d) %s, %d, %s", $this->id, $this->getName(), $this->semester, $this->project_title);
	}
	
	static public function getStudents($orderBy="id") {
		$orderByStr = '';
		if (in_array($orderBy, ['id', 'firstname', 'lastname', 'semester']) ) {
			$orderByStr = " ORDER BY $orderBy";
		}
		$students = array();
		$res = DB::doQuery("SELECT s.*, p.title AS 'project_title' FROM student s LEFT OUTER JOIN project p ON s.project_id = p.id$orderByStr");
		if ($res) {
			while ($student = $res->fetch_object(get_class())) {
				$students[] = $student;
			}
		}
		return $students;
	}
	
	static public function getStudentById($id) {
		$id = (int) $id;
		$res = DB::doQuery("SELECT * FROM student WHERE id = $id");
		if ($res) {
			if ($student = $res->fetch_object(get_class())) {
				return $student;
			}
		}
		return null;
	}
	
	static public function insert($values) {
		if ( $stmt = DB::getInstance()->prepare("INSERT INTO student (firstname, lastname, semester, project_id) VALUE (?,?,?,?)")){
			if ($stmt->bind_param('ssii', $values['firstname'], $values['lastname'], $values['semester'], $values['project_id'])) {
				if ($stmt->execute()) {
					return true;
				}
			}
		}
		return false;
	}
	
	static public function delete($id) {
		$id = (int) $id;
		$res = DB::doQuery("DELETE FROM student WHERE id = $id");
		return $res != null;
	}
	
	
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}
	// ... All other setter ...
	
	public function update($values) {
		$db = DB::getInstance();
		$this->firstname = $db->escape_string($values['firstname']);
		$this->lastname = $db->escape_string($values['lastname']);
		$this->semester = (int)$values['semester'];
		$this->project_id = (int)$values['project_id'];
	}
	
	public function save(){
		$sql = sprintf("UPDATE student SET firstname='%s', lastname='%s', semester=%d, project_id=%d WHERE id = %d;",$this->firstname, $this->lastname, $this->semester, $this->project_id, $this->id);
		$res = DB::doQuery($sql);
		return $res != null;
	}
	
}
