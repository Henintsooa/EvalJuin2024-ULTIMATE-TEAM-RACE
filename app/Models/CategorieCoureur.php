<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieCoureur extends Model
{
    use HasFactory;
    protected $table = 'categoriecoureur';
    protected $primaryKey = 'idcategoriecoureur';
    protected $fillable = ['idcoureur','idcategorie'];


}
