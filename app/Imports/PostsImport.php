<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Post([
            'title' => $row['title'],
            'slug' => Str::slug($row['description']),
            'description' => $row['description'],
            'excerpt' => Str::words($row['description'], 30, ' ...'),
            'category_id' => $row['category_id'],
            'user_id' => $row['user_id'],
        ]);
    }
}
