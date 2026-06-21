<?php
// app/Models/UserGroupMenu.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserGroupMenu extends Model
{
    protected $table = 'tl_wsmu';

    protected $fillable = [
        'wsmn_id', 'wmng_id', 'wsmu_vsbl', 'wsmu_crat', 'wsmu_read',
        'wsmu_updt', 'wsmu_delt', 'cont_id', 'lfcl_id',
        'aemp_iusr', 'aemp_eusr', 'var', 'attr1', 'attr2', 'attr3', 'attr4'
    ];

    protected $casts = [
        'wsmu_vsbl' => 'boolean',
        'wsmu_crat' => 'boolean',
        'wsmu_read' => 'boolean',
        'wsmu_updt' => 'boolean',
        'wsmu_delt' => 'boolean',
    ];

    public function subMenu(): BelongsTo
    {
        return $this->belongsTo(SubMenu::class, 'wsmn_id');
    }

    public function webMenuGroup(): BelongsTo
    {
        return $this->belongsTo(WebMenuGroup::class, 'wmng_id');
    }
}
