<?
namespace App;
use Illuminate\Database\Eloquent\Model;


class Forecast extends Model {
    protected $table = 'forecast';

    public function ForecasterPeople()
    {
        return $this->hasOne('App\ForecasterPeople', 'id', 'id_forecaster_people');
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', 1);
    }

}
?>