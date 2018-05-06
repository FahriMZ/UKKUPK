<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tahun_aktif
 * @property int $id_tahun_ajar
 * @property TahunAjar $tahunAjar
 */
class TahunAktif extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tahun_aktif';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_tahun_aktif';

    /**
     * @var array
     */
    protected $fillable = ['id_tahun_ajar'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahunAjar()
    {
        return $this->belongsTo('App\TahunAjar', 'id_tahun_ajar', 'id_tahun_ajar');
    }
}
