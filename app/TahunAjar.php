<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tahun_ajar
 * @property string $tahun_ajar
 * @property Pesertum[] $pesertas
 * @property TahunAktif[] $tahunAktifs
 */
class TahunAjar extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tahun_ajar';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tahun_ajar';

    /**
     * @var array
     */
    protected $fillable = ['tahun_ajar'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function peserta()
    {
        return $this->hasMany('App\Pesertum', 'id_tahun_ajar', 'id_tahun_ajar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tahunAktif()
    {
        return $this->hasMany('App\TahunAktif', 'id_tahun_ajar', 'id_tahun_ajar');
    }
}
