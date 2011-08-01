<?
	class Fleet {
		private $ships;
		
		public function Fleet($att_or_def) {
			$this->ships = array();
			$postfix = $att_or_def ? "att" : "def";
			for($i = 0; $i < (int)($_POST["WS_" . $postfix]); $i++) {
				$this->ships[] = new WarSun($_POST["Admiral_WS_" . $postfix] != null ? true : false, $_POST["WS_no_sustain_" . $postfix] == null ? true : false);
			}
		}
		
		public function fleet_size() {
			return count($this->ships);
		}
		
		public function ship_at($index) {
			return $this->ships[$index];
		}
		
		public function assign_hits($number_of_hits, $space) {
			
		}
		
		public function get_number_of_hits($space) {
			
		}
	}
	
	class Unit {
		private $roll_to_hit;
		private $number_of_dice;
		private $sustain_damage_hits;
		
		public function Unit($roll_to_hit, $number_of_dice, $sustain_damage_hits) {
			$this->roll_to_hit = $roll_to_hit;
			$this->number_of_dice = $number_of_dice;
			$this->sustain_damage_hits = $sustain_damage_hits;
		}
		
		public function get_number_of_hits() {
			$number_of_hits = 0;
			for ($i = 0; $i < $this->number_of_dice; $i++) {
				$number_of_hits += rand(1, 10) >= $this->roll_to_hit ? 1 : 0;
			}
			return $number_of_hits;
		}
		
		public function to_table_cells() {
			return "<td>" . $this->get_name() . "</td>" .
				"<td class=\"small\">" . $this->get_cost() . "</td>" .
				"<td class=\"small\">" . ((10 - $this->roll_to_hit) / 10 * $this->number_of_dice) . "</td>";
		}
		
		protected function get_cost() {
			return 1;
		}
	}
	
	class WarSun extends Unit {
		public function WarSun($has_admiral, $can_sustain_damage) {
			parent::Unit(
				3,
				$has_admiral ? 4 : 3,
				$can_sustain_damage ? 1 : 0);
		}
		
		protected function get_name() {
			return "War Sun";
		}
		
		protected function get_cost() {
			return 12;
		}
	}
	
	class Dreadnought extends Unit {
		public function Dreadnought($has_admiral, $can_sustain_damage) {
			parent::Unit(
				5,
				$has_admiral ? 2 : 1,
				$can_sustain_damage ? 1 : 0);
		}
	}
	
	class Carrier extends Unit {
		private $number_of_fighters;
		private $number_of_gf;
		
		public function Carrier($has_admiral) {
			parent::Unit(
				9,
				$has_admiral ? 2 : 1);
		}
	}
?>