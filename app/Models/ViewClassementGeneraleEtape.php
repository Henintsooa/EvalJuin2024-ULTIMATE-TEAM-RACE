<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClassementGeneraleEtape extends Model
{
    use HasFactory;
    protected $table = 'viewclassementgeneraletape';
    protected $fillable = ['nomequipe','classementgeneral','pointetape1','pointetape2','pointetape3','pointetape4','pointetape5'];


}
