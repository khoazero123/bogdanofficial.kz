<?
namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Payment extends Model {
    protected $table = 'payment';

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
?>