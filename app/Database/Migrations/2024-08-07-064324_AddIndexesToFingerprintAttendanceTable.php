<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndexesToFingerprintAttendanceTable extends Migration
{
    public function up()
    {
        // Add indexes
        $this->db->query('CREATE INDEX idx_direction_time ON finger_print_attendance_table (Direction, time)');
    }

    public function down()
    {
        $this->db->query('DROP INDEX idx_direction_time ON finger_print_attendance_table');
    }
}
