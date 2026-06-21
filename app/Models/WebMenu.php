<?php
// app/Models/WebMenu.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebMenu extends Model
{
    protected $table = 'tm_wmnu';

    protected $fillable = [
        'wmnu_name', 'wmnu_icon', 'wmnu_oseq', 'cont_id', 'lfcl_id',
        'aemp_iusr', 'aemp_eusr', 'var', 'attr1', 'attr2', 'attr3', 'attr4'
    ];

    public function subMenus(): HasMany
    {
        return $this->hasMany(SubMenu::class, 'wmnu_id')->orderBy('wsmn_oseq');
    }

    public function scopeActive($query)
    {
        return $query->where('var', 1);
    }
}
