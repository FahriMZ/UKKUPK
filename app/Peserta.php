<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id_peserta
 * @property int $id_tahun_ajar
 * @property string $nama
 * @property string $alamat
 * @property string $jenis_kelamin
 * @property string $tanggal_lahir
 * @property string $email
 * @property string $kontak
 * @property TahunAjar $tahunAjar
 */
class Peserta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'peserta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_peserta';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['id_tahun_ajar', 'nama', 'alamat', 'jenis_kelamin', 'tanggal_lahir', 'email', 'kontak', 'id_peserta', 'id_kelas'];

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

    public function penilaian() {
        return $this->hasMany('App\Penilaian', 'id_peserta');
    }

    public function kelas() {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
