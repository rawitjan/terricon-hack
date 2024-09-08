<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


            $csvData = fopen(base_path('database/csv/books.csv'), 'r');

            $transRow = true;
            while (($data = fgetcsv($csvData, 115000, ',')) !== false) {
                if (!$transRow) {

                    $book = new Books();
                    $book->isbn13 = isset($data[0]) ? trim($data[0]) : null;
                    $book->isbn10 = isset($data[1]) ? trim($data[1]) : null;
                    $book->title = isset($data[2]) ? trim($data[2]) : null;
                    $book->subtitle =  isset($data[3]) ? trim($data[3]) : null;
                    $book->authors =  isset($data[4]) ? trim($data[4]) : null;
                    $book->categories = isset($data[5]) ? trim($data[5]) : null;
                    $book->thumbnail = isset($data[6]) ? trim($data[6]) : null;
                    $book->description =  isset($data[7]) ? addslashes(trim($data[7])) : null;
                    $book->publish_year = isset($data[8]) ? trim($data[8]) : null;
                    $book->num_pages = isset($data[10]) ? trim($data[10]) : null;
                    $book->uploader = 1;
                    $book->save();
                }
                $transRow = false;
            }

            fclose($csvData);
    }
}
