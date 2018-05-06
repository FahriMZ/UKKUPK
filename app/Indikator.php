<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_indikator
 * @property int $id_komponen
 * @property string $indikator
 * @property string $standar_skor
 * @property Komponen $komponen
 */
class Indikator extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'indikator';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_indikator';

    /**
     * @var array
     */
    protected $fillable = ['id_komponen', 'indikator', 'standar_skor'];

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
