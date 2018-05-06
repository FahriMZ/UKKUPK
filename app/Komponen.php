<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_komponen
 * @property int $parent_komponen
 * @property string $komponen
 * @property Komponen $komponen
 * @property DetailKomponen[] $detailKomponens
 * @property DetailPenilaian[] $detailPenilaians
 * @property Indikator[] $indikators
 */
class Komponen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'komponen';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_komponen';

    /**
     * @var array
     */
    protected $fillable = ['parent_komponen', 'komponen'];

    /**
     * Indicates if the model should be timestamped.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
    public function children() {
        return $this->hasMany(self::class, 'parent_komponen');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_komponen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailKomponen()
    {
        return $this->hasMany('App\DetailKomponen', 'id_komponen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPenilaian()
    {
        return $this->hasMany('App\DetailPenilaian', 'id_komponen', 'id_komponen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indikator()
    {
        return $this->hasMany('App\Indikator', 'id_komponen', 'id_komponen');
    }

    // Hapus komponen beserta semua relasinya
    public function delete() {

        $this->indikator()->delete();

        $this->detailKomponen()->delete();

        return parent::delete();
    }
}
