<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'jurusan';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_jurusan';

    /**
     * @var array
     */
    protected $fillable = ['id_jurusan', 'nama_jurusan', 'deskripsi_jurusan'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'id_jurusan');
    }
}
