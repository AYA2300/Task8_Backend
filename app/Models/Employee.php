<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'department_id',
        'position'

    ];


    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    public function setFirstNameAttribute($value)
{
    $this->attributes['first_name'] = ucfirst($value);
}

    public function setLastNameAttribute($value)
{
    $this->attributes['last_name'] = ucfirst($value);
}



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function notes(): MorphMany
    {

        return $this->morphMany(Note::class,'notable');

    }




}
