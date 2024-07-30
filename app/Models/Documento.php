<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'id', 'protocolo', 'descricao', 'path', 'user_id', 'created_at', 'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}
