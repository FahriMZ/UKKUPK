<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'kelas';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_kelas';

    /**
     * @var array
     */
    protected $fillable = ['id_kelas', 'nama_kelas', 'id_jurusan'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function peserta() {
        return $this->hasMany('App\Peserta', 'id_kelas');
    }
}
