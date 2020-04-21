<? php

namespace Source\Models;

use CoffeCode\DataLayer\DataLayer;

class User extends DataLayer {
	public function __construct(){
		parent::__construct("users", ["first_name", "last_name"], "id", false);
	}
}
