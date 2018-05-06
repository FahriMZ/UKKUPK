<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_dokumen
 * @property int $id_asesor
 * @property string $nama_dokumen
 * @property string $tanggal_diupload
 * @property Asesor $asesor
 */
class DokumenAsesor extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'dokumen_asesor';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_dokumen';

    /**
     * @var array
     */
    protected $fillable = ['id_asesor', 'nama_dokumen', 'tanggal_diupload'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asesor()
    {
        return $this->belongsTo('App\Asesor', 'id_asesor', 'id_asesor');
    }
}
