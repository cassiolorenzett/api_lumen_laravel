<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'datainicio', 'dataprazo', 'dataconclusao', 'titulo', 'descricao', 'responsavel','status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}