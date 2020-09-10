<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $nickname 
 * @property string $mobile 
 * @property string $email 
 * @property int $gender 
 * @property string $country 
 * @property string $province 
 * @property string $city 
 * @property string $password 
 * @property string $update_time 
 * @property string $add_time 
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'gender' => 'integer'];
}