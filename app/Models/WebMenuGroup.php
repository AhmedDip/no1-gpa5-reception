<?php
// app/Models/WebMenuGroup.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebMenuGroup extends Model
{
    protected $table = 'tm_wmng';

    protected $fillable = [
        'wmng_name', 'wmng_code', 'cont_id', 'lfcl_id',
        'aemp_iusr', 'aemp_eusr', 'var', 'attr1', 'attr2', 'attr3', 'attr4'
    ];

    public function userGroupMenus(): HasMany
    {
        return $this->hasMany(UserGroupMenu::class, 'wmng_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'wmng_id');
    }
}
