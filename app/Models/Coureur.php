<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coureur extends Model
{
    use HasFactory;
    protected $table = 'coureur';
    protected $primaryKey = 'idcoureur';
    protected $fillable = ['nomCoureur','numero','genre','datenaissance','idequipe'];


}
