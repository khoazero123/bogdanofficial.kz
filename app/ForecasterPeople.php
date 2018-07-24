<?
namespace App;
use Illuminate\Database\Eloquent\Model;


class ForecasterPeople extends Model {
    protected $table = 'forecaster_people';

    public function scopeIsActive($query)
    {
        return $query->where('active', 1);
    }

}
?>