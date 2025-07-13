<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Book",
 *     title="Book",
 *     description="Book model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="O Cão e o Livro"),
 *     @OA\Property(property="author", type="string", example="Carlos Alberto"),
 *     @OA\Property(property="genre", type="string", example="Ficção"),
 *     @OA\Property(property="year", type="integer", example=2024),
 *     @OA\Property(property="available", type="boolean", example=true)
 * )
 */


class Book extends Model
{


    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = ['title', 'author', 'genre', 'year', 'available'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
