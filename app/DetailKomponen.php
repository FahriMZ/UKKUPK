<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_detail_komponen
 * @property int $id_komponen
 * @property int $skor_maksimal
 * @property int $bobot
 * @property Komponen $komponen
 */
class DetailKomponen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'detail_komponen';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_detail_komponen';

    /**
     * @var array
     */
    protected $fillable = ['id_komponen', 'skor_maksimal', 'bobot'];

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
}
