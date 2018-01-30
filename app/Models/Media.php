<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Media
 * @package App\Models
 *
 * @property int $id
 * @property string $type Mime Type
 * @property string $name
 * @property string $description
 * @property string $source The source path/url
 */
class Media extends Model
{
    use SoftDeletes;

    protected $table = 'media';

    protected $fillable = ['name', 'description', 'type', 'source'];
}
