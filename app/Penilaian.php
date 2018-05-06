<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_penilaian
 * @property int $id_asesor
 * @property int $id_peserta
 * @property string $paket_soal
 * @property DetailPenilaian[] $detailPenilaians
 */
class Penilaian extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'penilaian';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_penilaian';

    /**
     * @var array
     */
    protected $fillable = ['id_asesor', 'id_peserta', 'paket_soal'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPenilaian()
    {
        return $this->hasMany('App\DetailPenilaian', 'id_penilaian', 'id_penilaian');
    }

    public function peserta() {
        return $this->belongsTo('App\Peserta', 'id_peserta');
    }

    public function delete() {
        $this->detailPenilaian()->delete();

        return parent::delete();
    }

}
