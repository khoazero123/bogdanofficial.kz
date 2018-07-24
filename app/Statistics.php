<?
namespace App;
use Illuminate\Database\Eloquent\Model;


class Statistics extends Model {
    protected $table = 'statistics';

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