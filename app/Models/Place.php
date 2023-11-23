<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Place extends Model
{
    protected $fillable = ['name', 'slug', 'city', 'state'];

    public static function validateStoreOrUpdate(array $data) {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);
    }
    public static function filterByName($name)
    {
        return self::where('name', 'like', '%' . $name . '%')->get();
    }
}
