<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKursus extends Model
{
    use HasFactory;

    protected $table = 'peserta_kursus';

    protected $fillable = [
        'kursus_id',
        'user_id',
        'tanggal_daftar',
        'status_pembayaran', // BELUM_BAYAR, SUDAH_BAYAR
        'bukti_pembayaran',
        'catatan',
        'status_kehadiran', // AKTIF, TIDAK_AKTIF, SELESAI
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
    ];

    // Relasi ke kursus
    public function kursus()
    {
        return $this->belongsTo(KursusMenjahit::class, 'kursus_id');
    }

    // Relasi ke user (peserta)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk status pembayaran yang readable
    public function getStatusPembayaranReadableAttribute()
    {
        $statusMap = [
            'BELUM_BAYAR' => 'Belum Bayar',
            'SUDAH_BAYAR' => 'Sudah Bayar',
        ];

        return $statusMap[$this->status_pembayaran] ?? $this->status_pembayaran;
    }

    // Accessor untuk status kehadiran yang readable
    public function getStatusKehadiranReadableAttribute()
    {
        $statusMap = [
            'AKTIF' => 'Aktif',
            'TIDAK_AKTIF' => 'Tidak Aktif',
            'SELESAI' => 'Selesai',
        ];

        return $statusMap[$this->status_kehadiran] ?? $this->status_kehadiran;
    }
}