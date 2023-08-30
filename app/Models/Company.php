<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // entryページへ会社情報を送る
    public static function getAllCompanies()
    {
        return Company::all();
    }
}
