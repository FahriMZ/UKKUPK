<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_detail_penilaian
 * @property int $id_penilaian
 * @property int $id_komponen
 * @property int $skor
 * @property Komponen $komponen
 * @property Penilaian $penilaian
 */
class DetailPenilaian extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'detail_penilaian';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_detail_penilaian';

    /**
     * @var array
     */
    protected $fillable = ['id_penilaian', 'id_komponen', 'skor'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function komponen()
    {
        return $this->belongsTo('App\Komponen', 'id_komponen', 'id_komponen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penilaian()
    {
        return $this->belongsTo('App\Penilaian', 'id_penilaian', 'id_penilaian');
    }
}
