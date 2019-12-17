<?php
class Cart {
	// Holds the items: id => num
	private $items = [];

	public function addItem($item, $num) {
		if (!isset($this->items[$item])) {
			$this->items[$item] = 0;
		}
		$this->items[$item] += $num;
	}

	public function removeItem($item, $num) {
		if (isset($this->items[$item])) {
			$this->items[$item] -= $num;
			if ($this->items[$item] <= 0) {
				unset($this->items[$item]);
			}
		}
	}
/*
	public function updateItem($item,$num){
		if (isset($this->items[$item])) {

		}
	}*/

	public function getItems() {
		return $this->items;
	}

	public function isEmpty() {
		return count($this->items) == 0;
	}

	public function render() {
		if ($this->isEmpty()) {
			echo "<div class=\"cart empty\">[Empty Cart]</div>";
		} else {
			echo "<div class=\"cart\"><table>";
			echo "<tr><th>Article-Id</th><th>#</th></tr>";
			foreach ($this->items as $item => $num) {
				echo "<tr><td>$item</td><td>$num</td></tr>";
			}
			echo "</table></div>";
		}
	}
}
