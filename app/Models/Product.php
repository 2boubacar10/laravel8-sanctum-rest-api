<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasApiTokens, HasFactory;

    //protected $table = "Nom de la table dans la base de données";

    protected $fillable = [
        "name",
        "slug",
        "description",
        "price"
    ];
}
