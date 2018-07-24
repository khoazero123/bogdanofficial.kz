<?
namespace App;
use Illuminate\Database\Eloquent\Model;


class Faq extends Model {
    protected $table = 'faq';


    public function scopeIsActive($query)
    {
        return $query->where('active', 1);
    }

}
?>