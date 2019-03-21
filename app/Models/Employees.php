<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employees
 * @package App\Models
 * @version February 13, 2019, 7:59 pm UTC
 *
 * @property string name
 * @property string email
 * @property string phone
 * @property string role
 */
class Employees extends Model
{
    //use SoftDeletes;

    public $table = 'users';
    

    //protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'gender',
        'password',
        'branch_id',
        'activated_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'role' => 'integer',
        'gender'=>'string',
        'password'=>'string',
        'branch_id'=>'integer',
        'activated_user'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required',
        'gender'=>'required',
        'branch_id'=>'required',
        'activated_user'=>'required',
    ];

    
}
