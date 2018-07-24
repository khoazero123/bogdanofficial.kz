<?
namespace App;
use Illuminate\Database\Eloquent\Model;

//https://medium.com/@ezp127/laravel-5-4-native-user-authentication-role-authorization-3dbae4049c8a
class Role extends Model {
    protected $table = 'roles';

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_roles', 'user_id', 'role_id');
    }


}
?>