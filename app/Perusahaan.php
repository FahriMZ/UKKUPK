<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_perusahaan
 * @property string $nama_perusahaan
 * @property string $alamat_perusahaan
 * @property string $direktur_perusahaan
 * @property Asesor[] $asesors
 */
class Perusahaan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'perusahaan';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_perusahaan';

    /**
     * @var array
     */
    protected $fillable = ['nama_perusahaan', 'alamat_perusahaan', 'direktur_perusahaan', 'tipe_perusahaan'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asesor()
    {
        return $this->hasMany('App\Asesor', 'id_perusahaan', 'id_perusahaan');
    }
}
