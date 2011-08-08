<?
	class Fleet {
		private $units;
		
		public function Fleet($att_or_def) {
			$this->units = array();
			$postfix = $att_or_def ? "att" : "def";
			for ($i = 0; $i < (int)($_POST["WS_" . $postfix]); $i++) {
				$this->units[] = new WarSun($_POST["Admiral_WS_" . $postfix] != null ? true : false,
				                            $_POST["WS_no_sustain_" . $postfix] == null ? true : false);
			}
			for ($i = 0; $i < (int)($_POST["DN_" . $postfix]); $i++) {
				$this->units[] = new Dreadnought($_POST["Admiral_DN_" . $postfix] != null ? true : false,
				                                 $_POST["DN_no_sustain_" . $postfix] == null ? true : false);
			}
			for ($i = 0; $i < (int)($_POST["CA_" . $postfix]); $i++) {
				$this->units[] = new Cruiser($_POST["Admiral_DN_" . $postfix] != null ? true : false,
				                             false,
				                             $_POST["Hylar_V_" . $postfix] == null ? true : false);
			}
			for ($i = 0; $i < (int)($_POST["DD_" . $postfix]); $i++) {
				$this->units[] = new Destroyer($_POST["Admiral_DD_" . $postfix] != null ? true : false,
				                               $_POST["Hylar_V_" . $postfix] == null ? true : false);
			}
			for ($i = 0; $i < (int)($_POST["CR_" . $postfix]); $i++) {
				$this->units[] = new Carrier($_POST["Admiral_CR_" . $postfix] != null ? true : false);
			}
			$number_of_fighters = $_POST["FF_" . $postfix];
			for ($i = 0; $i < $this->fleet_size(); $i++) {
				$number_of_fighters = $this->ship_at($i)->add_fighters($number_of_fighters);
			}
		}
		
		public function fleet_size() {
			return count($this->units); // handle GF and fighters?
		}
		
		public function ship_at($index) {
			return $this->units[$index];
		}
		
		public function assign_hits($number_of_hits, $space) {
			
		}
		
		public function get_number_of_hits($space) {
			
		}
		
		private function assign_fighters() {
			
		}
	}
	
	class Unit {
		private $roll_to_hit;
		private $number_of_dice_space;
		private $number_of_dice_ground;
		private $sustain_damage_hits;
		
		public function Unit($roll_to_hit, $number_of_dice_space, $number_of_dice_ground, $sustain_damage_hits) {
			$this->roll_to_hit = $roll_to_hit;
			$this->number_of_dice_space = $number_of_dice_space;
			$this->number_of_dice_ground = $number_of_dice_ground;
			$this->sustain_damage_hits = $sustain_damage_hits;
		}
		
		public function get_number_of_hits($space) {
			$number_of_hits = 0;
			if ($space) {
				for ($i = 0; $i < $this->number_of_dice_space; $i++) {
					$number_of_hits += rand(1, 10) >= $this->roll_to_hit ? 1 : 0;
				}
			} else {
				for ($i = 0; $i < $this->number_of_dice_ground; $i++) {
					$number_of_hits += rand(1, 10) >= $this->roll_to_hit ? 1 : 0;
				}
			}
			return $number_of_hits;
		}
		
		public function add_fighters($number_of_fighters) {
			return $number_of_fighters;
		}
		
		public function get_number_of_fighters() {
			return 0;
		}
		
		public function to_table_cells() {
			return "<td>" . $this->get_name() . ($this->get_number_of_fighters() > 0 ? " (" . $this->get_number_of_fighters() . " fighters)" : "") . "</td>" .
				"<td class=\"small\">" . $this->get_cost() . "</td>" .
				"<td class=\"small\">" . $this->average_hits() . "</td>" .
				"<td class=\"small\">100%</td>";
		}
		
		protected function get_cost() {
			return 1;
		}
		
		protected function average_hits() {
			return (10 - $this->roll_to_hit) / 10 * $this->number_of_dice_space;
		}
	}
	
	class UnitWithFighters extends Unit {
		private $number_of_pds;
		protected $number_of_fighters;
		private $number_of_gf;
		private $capacity;
		
		public function UnitWithFighters($roll_to_hit, $number_of_dice_space, $number_of_dice_ground, $sustain_damage_hits, $capacity) {
			parent::Unit($roll_to_hit, $number_of_dice_space, $number_of_dice_ground, $sustain_damage_hits);
			$this->capacity = $capacity;
			$this->number_of_pds = 0;
			$this->number_of_fighters = 0;
			$this->number_of_gf = 0;
		}
		
		public function add_fighters($new_fighters) {
			$this->number_of_fighters += $new_fighters;
			$used_capacity = $this->number_of_fighters + $this->number_of_gf + $this->number_of_pds;
			if ($used_capacity > $this->capacity) {
				$this->number_of_fighters -= ($used_capacity - $this->capacity);
				return $used_capacity - $this->capacity;
			}
			return 0;
		}
		
		public function get_number_of_fighters() {
			return $this->number_of_fighters;
		}
		
		protected function average_hits() {
			return parent::average_hits() + $this->number_of_fighters * .1;
		}
	}
	
	class WarSun extends UnitWithFighters {
		public function WarSun($has_admiral, $can_sustain_damage) {
			parent::UnitWithFighters(
				3,
				$has_admiral ? 4 : 3,
				0,
				$can_sustain_damage ? 1 : 0,
				6);
		}
		
		protected function get_name() {
			return "War Sun";
		}
		
		protected function get_cost() {
			return 12 + $this->get_number_of_fighters() * .5;
		}
	}
	
	class Dreadnought extends Unit {
		public function Dreadnought($has_admiral, $can_sustain_damage) {
			parent::Unit(
				5,
				$has_admiral ? 2 : 1,
				0,
				$can_sustain_damage ? 1 : 0); // add Letnev tech here
		}
		
		protected function get_name() {
			return "Dreadnought";
		}
		
		protected function get_cost() {
			return 5;
		}
	}
	
	class Cruiser extends Unit {
		public function Cruiser($has_admiral, $can_sustain_damage, $hylar_V) {
			parent::Unit(
				$hylar_V ? 7 : 6,
				$has_admiral ? 2 : 1,
				0,
				$can_sustain_damage ? 1 : 0);
		}
		
		protected function get_name() {
			return "Cruiser";
		}
		
		protected function get_cost() {
			return 2;
		}
	}
	
	class Destroyer extends Unit {
		public function Destroyer($has_admiral, $hylar_V) {
			parent::Unit(
				$hylar_V ? 9 : 8,
				$has_admiral ? 2 : 1,
				0,
				$can_sustain_damage ? 1 : 0);
		}
		
		protected function get_name() {
			return "Destroyer";
		}
		
		protected function get_cost() {
			return 2;
		}
	}
	
	class Carrier extends UnitWithFighters {
		public function Carrier($has_admiral) {
			parent::UnitWithFighters(
				9,
				$has_admiral ? 2 : 1,
				0,
				0,
				6);
		}
		
		protected function get_name() {
			return "Carrier";
		}
		
		protected function get_cost() {
			return 3 + $this->get_number_of_fighters() * .5;
		}
	}
?>