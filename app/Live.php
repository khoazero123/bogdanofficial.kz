<?
namespace App;
use Illuminate\Database\Eloquent\Model;


class Live extends Model {
    protected $table = 'live';

    public function scopeIsActive($query)
    {
        return $query->where('active', 1);
    }

    public function ForecasterPeople()
    {
        return $this->hasOne('App\ForecasterPeople', 'id', 'id_forecaster_people');
    }

}
?>