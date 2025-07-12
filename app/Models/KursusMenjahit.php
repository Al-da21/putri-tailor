<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class KursusMenjahit extends Model
{
    use HasFactory;

    protected $table = 'kursus_menjahit';

    protected $fillable = [
        'user_id',
        'nama_kursus',
        'deskripsi',
        'harga',
        'durasi_kursus', // dalam hari
        'tanggal_mulai',
        'tanggal_selesai',
        'jadwal_hari', // JSON array untuk hari (Senin, Selasa, dst)
        'jam_mulai',
        'jam_selesai',
        'max_peserta',
        'status', // BUKA, TUTUP, SELESAI
        'instruktur',
        'materi_kursus', // JSON array untuk list materi
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'jadwal_hari' => 'array',
        'materi_kursus' => 'array',
        'harga' => 'decimal:0',
    ];

    // Relasi ke User (admin yang membuat kursus)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke peserta kursus
    public function pesertaKursus()
    {
        return $this->hasMany(PesertaKursus::class, 'kursus_id');
    }

    // Accessor untuk status yang lebih readable
    public function getStatusReadableAttribute()
    {
        $statusMap = [
            'BUKA' => 'Pendaftaran Buka',
            'TUTUP' => 'Pendaftaran Tutup',
            'SELESAI' => 'Kursus Selesai',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    // Accessor untuk format harga
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Accessor untuk jadwal hari dalam format string
    public function getJadwalHariStringAttribute()
    {
        if (is_array($this->jadwal_hari)) {
            return implode(', ', $this->jadwal_hari);
        }
        return $this->jadwal_hari;
    }

    // Method untuk cek apakah kursus masih bisa didaftar
    public function canRegister()
    {
        return $this->status === 'BUKA' && 
               $this->pesertaKursus()->count() < $this->max_peserta &&
               $this->tanggal_mulai > Carbon::now();
    }

    // Method untuk hitung sisa slot
    public function sisaSlot()
    {
        return $this->max_peserta - $this->pesertaKursus()->count();
    }
}