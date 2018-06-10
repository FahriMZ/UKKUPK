<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_jurusan_aktif
 * @property int $id_jurusan
 * @property Jurusan $jurusan
 */
class JurusanAktif extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'jurusan_aktif';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_jurusan_aktif';

    /**
     * @var array
     */
    protected $fillable = ['id_jurusan'];

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
        return $this->belongsTo('App\Jurusan', 'id_jurusan', 'id_jurusan');
    }
}
