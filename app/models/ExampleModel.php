<?php

namespace App\Models;

use Core\Model;

class ExampleModel extends Model {
    public function getData() {
        $result = $this->db->query("SELECT * FROM example_table");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
