<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClassementGeneralEquipe extends Model
{
    use HasFactory;
    protected $table = 'viewclassementgeneralequipe';
    protected $fillable = ['rangetape','nometape','nomequipe','totalpoints','classementetape'];


}
