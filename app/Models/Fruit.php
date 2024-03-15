<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    // Sushi is used to create a model that is not connected to a database
    // You need to install it with composer first
    use \Sushi\Sushi;

    protected $rows = [
        [
            'name' => 'mango',
            'price' => 10,
        ],
        [
            'name' => 'apple',
            'price' => 15,
        ],
        [
            'name' => 'banana',
            'price' => 10,
        ],
        [
            'name' => 'orange',
            'price' => 5,
        ]
    ];
}
