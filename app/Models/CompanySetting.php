<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    protected $casts = [
        'type' => 'string',
    ];

    public function getValueAttribute($value)
    {
        if ($this->type === 'boolean') {
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }

        if ($this->type === 'json') {
            return json_decode($value, true);
        }

        if ($this->type === 'number') {
            return is_numeric($value) ? (float) $value : $value;
        }

        return $value;
    }

    public function setValueAttribute($value)
    {
        if ($this->type === 'json' && is_array($value)) {
            $this->attributes['value'] = json_encode($value);
        } elseif ($this->type === 'boolean') {
            $this->attributes['value'] = $value ? '1' : '0';
        } else {
            $this->attributes['value'] = $value;
        }
    }
}
