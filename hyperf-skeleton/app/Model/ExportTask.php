<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 *
 * @property int id
 * @property int created_user_id
 * @property int type
 * @property int status
 * @property string export_filters
 * @property string export_file_path
 * @property string created_at
 * @property string updated_at
 */
class ExportTask extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'export_task';
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
    protected $casts = [];
}