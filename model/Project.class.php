<?php
class Project {
	private $id;
	private $title;


	public function getId() {
		return $this->id;
	}
	public function getTitle() {
		return $this->title;
	}

	public function __toString(){
		return sprintf("%d) %s", $this->id, $this->title);
	}

	static public function getProjects($orderBy='title') {
		$orderByStr = '';
		if (in_array($orderBy, ['id', 'title']) ) {
			$orderByStr = " ORDER BY $orderBy";
		}
		$projects = array();
		$res = DB::doQuery("SELECT * FROM project$orderByStr");
		if ($res) {
			while ($project = $res->fetch_object(get_class())) {
				$projects[] = $project;
			}
		}
		return $projects;
	}

	static public function getProjectById($id) {
		$id = (int) $id;
		$res = DB::doQuery("SELECT * FROM project WHERE id = $id");
		if ($res) {
			if ($project = $res->fetch_object(get_class())) {
				return $project;
			}
		}
		return null;
	}

}
