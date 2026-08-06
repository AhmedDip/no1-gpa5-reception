<?php
// app/Models/Zone.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Zone extends Model
{
    protected $table = 'tm_zone';
    protected $fillable = ['zone_name','zone_code','dirg_id','dirg_code','aemp_id','cont_id','lfcl_id','aemp_iusr','aemp_eusr','var','attr1','attr2','attr3','attr4'];

    public function dirg(): BelongsTo
    {
        return $this->belongsTo(Dirg::class, 'dirg_id');
    }
}
