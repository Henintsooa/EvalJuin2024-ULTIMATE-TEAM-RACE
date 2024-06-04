<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClassementEquipeCategorie extends Model
{
    use HasFactory;
    protected $table = 'viewclassementequipecategorie';
    protected $fillable = ['nomcategorie','nomequipe','totalpoints','classement'];


}
