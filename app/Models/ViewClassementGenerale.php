<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewClassementGenerale extends Model
{
    use HasFactory;
    protected $table = 'viewclassementgeneral';
    protected $fillable = ['idequipe','nomequipe','classementgeneral','totalpoints'];


}
