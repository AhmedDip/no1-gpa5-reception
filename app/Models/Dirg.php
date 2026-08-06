<?php
// app/Models/Dirg.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dirg extends Model
{
    protected $table = 'tm_dirg';
    protected $fillable = ['dirg_name','dirg_code','aemp_id','sdvm_id','sdvm_code','cont_id','lfcl_id','aemp_iusr','aemp_eusr','var','attr1','attr2','attr3','attr4'];
}
