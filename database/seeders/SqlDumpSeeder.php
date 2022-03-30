<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqlDumpSeeder extends Seeder
{
    public $sql = [
        'indonesia',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sql as $name) {
            DB::unprepared(file_get_contents(database_path("dump/$name.sql")));
        }
    }
}
