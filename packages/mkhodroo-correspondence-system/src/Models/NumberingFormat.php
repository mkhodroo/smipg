<?php 

namespace Mkhodroo\CorrespondenceSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberingFormat extends Model
{
    use SoftDeletes;
    public $table = "correspondence_" . "numbering_formats";
    protected $fillable = [
        'name', 'format', 'start_from'
    ];
}