<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Clients
 * @package App\Models
 * @version February 5, 2019, 7:06 am UTC
 *
 * @property string first_name
 * @property string last_name
 * @property string phone_number
 * @property string email
 * @property string client_type
 */
class Clients extends Model
{
    use SoftDeletes;

    public $table = 'clients';
    

    protected $dates = ['deleted_at'];

    public $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'client_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'client_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required'
    ];

    public function clientTypes()
    {
        return $this->hasMany(ClientTypes::class);

    }
}
