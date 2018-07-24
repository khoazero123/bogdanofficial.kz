<?
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Subscription extends Model {
    protected $table = 'subscription';

    public function SubscriptionType()
    {
        return $this->hasOne('App\SubscriptionType', 'id', 'subscription_type_id');
    }

}
?>