<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wing extends Model
{
    protected $table = 'tm_wing';
    protected $fillable = ['wing_name','wing_code','aemp_id','slgp_id','cont_id','lfcl_id','aemp_iusr','aemp_eusr','var','attr1','attr2','attr3','attr4'];
}
