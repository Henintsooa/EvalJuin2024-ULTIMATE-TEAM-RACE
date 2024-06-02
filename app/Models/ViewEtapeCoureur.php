<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewEtapeCoureur extends Model
{
    use HasFactory;
    protected $table = 'viewetapecoureur';
    protected $fillable = ['rang','nometape','idequipe','nomequipe','idcoureur','nomcoureur'];

}
