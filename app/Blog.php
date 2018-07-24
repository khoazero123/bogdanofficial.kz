<?
namespace App;
use Illuminate\Database\Eloquent\Model;


class Blog extends Model {
    protected $table = 'blog';


    public function scopeIsActive($query)
    {
        return $query->where('active', 1);
    }

}
?>