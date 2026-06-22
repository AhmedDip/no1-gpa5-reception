<?php
// app/Models/SubMenu.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubMenu extends Model
{
    protected $table = 'tm_wsmn';

    protected $fillable = [
        'wsmn_name', 'wsmn_wurl', 'wmnu_id', 'wsmn_oseq', 'wsmn_ukey',
        'cont_id', 'lfcl_id', 'aemp_iusr', 'aemp_eusr',
        'var', 'attr1', 'attr2', 'attr3', 'attr4'
    ];

    public function webMenu(): BelongsTo
    {
        return $this->belongsTo(WebMenu::class, 'wmnu_id');
    }

    public function userGroupMenus(): HasMany
    {
        return $this->hasMany(UserGroupMenu::class, 'wsmn_id');
    }

    public function scopeActive($query)
    {
        return $query->where('var', 1);
    }
}
