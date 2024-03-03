<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $taskId)
 * @method static create(array $data)
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];

    /**
     * @param $value
     * @return void
     */
    public function setStatusAttribute($value): void
    {
        $this->attributes['status'] = strtolower($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getStatusAttribute($value): string
    {
        return ucfirst($value);
    }

    /**
     * @return mixed
     */
    public function getRawStatusAttribute(): mixed
    {
        return $this->attributes['status'];
    }
}
