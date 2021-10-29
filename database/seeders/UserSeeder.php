<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'users';
        $filename = database_path("/seeders/seeds/$table".".csv");

        if(!file_exists($filename) || !is_readable($filename)){
            exit("Sorry! CSV file not found or not readable.");
        }

        $header = null;
        $data = array();
        $delimiter = ',';

        if (($handle = fopen($filename, 'r')) !== false){
            while (count($row = fgetcsv($handle, 1000, $delimiter)) !== 1){
                if(!$header){
                    $header = $row;
                } else {
                    $data = array_combine($header, $row);
                    $user = User::create([
                        'name' => $data['Name'],
                        'email' => $data['Email Address'],
                        'dob' => $data['Birthday'],
                        'phone' => $data['Phone'],
                        'ip' => $data['IP'],
                        'country' => $data['Country'],
                    ]);
                    /* Display beauty */
                    echo ($user->id == 1) ? "...\n" : "";
                }
            }
            fclose($handle);
        }
    }
}
