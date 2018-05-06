<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_asesor
 * @property int $id_user
 * @property int $id_perusahaan
 * @property string $nama
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 * @property string $kontak
 * @property User $user
 * @property Perusahaan $perusahaan
 */
class Asesor extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'asesor';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_asesor';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_perusahaan', 'nama', 'alamat', 'jenis_kelamin', 'tanggal_lahir', 'kontak'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan', 'id_perusahaan', 'id_perusahaan');
    }

    public function dokumenAsesor() {
        return $this->hasMany('App\DokumenAsesor', 'id_asesor');
    }
}
