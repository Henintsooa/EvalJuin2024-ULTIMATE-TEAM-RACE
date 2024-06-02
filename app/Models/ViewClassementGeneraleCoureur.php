<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClassementGeneraleCoureur extends Model
{
    use HasFactory;
    protected $table = 'viewclassementgeneralcoureur';
    protected $fillable = ['nomcoureur','classementgeneral','totalpoints'];


}
