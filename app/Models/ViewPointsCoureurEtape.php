<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPointsCoureurEtape extends Model
{
    use HasFactory;
    protected $table = 'viewpointscoureuretape';
    protected $fillable = ['nometape','idetape','rangetape','nomcoureur','dureetape','classement','idcoureur','nomequipe','points'];


}
