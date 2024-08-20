<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdjustIndexesOnFingerprintAttendanceTable extends Migration
{
    public function up()
    {
        // Drop existing indexes if they exist
        $this->forge->dropKey('finger_print_attendance_table', 'idx_direction_time');

        // Add a new index or adjust existing indexes
        $this->forge->addKey(['Direction', 'time', 'StaffID', 'Context', 'BaseStationName', 'DeviceName'], true); // true for UNIQUE index

        // Note: Use the appropriate addKey parameters based on the exact index configuration you need
    }

    public function down()
    {
        // Drop the new index if rolling back
        $this->forge->dropKey('finger_print_attendance_table', 'idx_direction_time');

        // Optionally, you can re-add the old index or other indexes
        $this->forge->addKey(['Direction', 'time']);
    }
}
