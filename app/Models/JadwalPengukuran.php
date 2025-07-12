<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalPengukuran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pengukuran';

    protected $fillable = [
        'user_id',
        'tanggal_pengukuran',
        'waktu_pengukuran',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pengukuran' => 'date',
        'waktu_pengukuran' => 'datetime:H:i',
    ];

    // Accessor untuk hari dalam Bahasa Indonesia
    public function getHariAttribute()
    {
        return Carbon::parse($this->tanggal_pengukuran)->translatedFormat('l');
    }

    // Accessor untuk tanggal dengan format d F Y (contoh: 10 Juni 2025)
    public function getTanggalFormatAttribute()
    {
        return Carbon::parse($this->tanggal_pengukuran)->translatedFormat('d F Y');
    }

    // Accessor untuk waktu dengan format jam:menit 24-jam
    public function getJamFormatAttribute()
    {
        return Carbon::parse($this->waktu_pengukuran)->format('H:i');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'jadwal_pengukuran_id');
    }

    // Method untuk mengecek apakah waktu tertentu sudah terisi
    public static function isWaktuTerisi($tanggal, $waktu)
    {
        return self::where('tanggal_pengukuran', $tanggal)
                   ->where('waktu_pengukuran', $waktu)
                   ->exists();
    }

    // Method untuk mendapatkan semua jadwal pada tanggal tertentu
    public static function getJadwalByTanggal($tanggal)
    {
        return self::where('tanggal_pengukuran', $tanggal)
                   ->orderBy('waktu_pengukuran', 'asc')
                   ->get();
    }

    // Method untuk mendapatkan waktu yang sudah terisi pada tanggal tertentu
    public static function getWaktuTerisi($tanggal)
    {
        return self::where('tanggal_pengukuran', $tanggal)
                   ->pluck('waktu_pengukuran')
                   ->map(function($waktu) {
                       return Carbon::parse($waktu)->format('H:i');
                   })
                   ->toArray();
    }

    // Cek apakah jadwal sudah selesai berdasarkan status transaction
    public function isCompleted()
    {
        return $this->transaction && $this->transaction->order_status === 'SELESAI';
    }

    // Cek apakah jadwal dibatalkan
    public function isCancelled()
    {
        return $this->transaction && $this->transaction->order_status === 'CANCELLED';
    }

    // Method untuk validasi jam operasional
    public static function isJamOperasional($waktu)
    {
        $jam = Carbon::parse($waktu)->format('H:i');
        return $jam >= '08:00' && $jam <= '17:00';
    }

    // Scope untuk mendapatkan jadwal hari ini
    public function scopeToday($query)
    {
        return $query->where('tanggal_pengukuran', Carbon::today());
    }

    // Scope untuk mendapatkan jadwal minggu ini
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('tanggal_pengukuran', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }

    // Scope untuk jadwal yang akan datang
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_pengukuran', '>=', Carbon::today())
                    ->orderBy('tanggal_pengukuran', 'asc')
                    ->orderBy('waktu_pengukuran', 'asc');
    }
}

class CheckoutJadwalPengukuran extends Model
{
    use HasFactory;

    protected $table = 'checkout_jadwal_pengukuran';

    protected $fillable = [
        'session_id',
        'tanggal_pengukuran',
        'waktu_pengukuran',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pengukuran' => 'date',
        'waktu_pengukuran' => 'datetime:H:i',
    ];

    // Accessor untuk hari dalam Bahasa Indonesia
    public function getHariAttribute()
    {
        return Carbon::parse($this->tanggal_pengukuran)->translatedFormat('l');
    }

    // Accessor untuk tanggal dengan format d F Y (contoh: 10 Juni 2025)
    public function getTanggalFormatAttribute()
    {
        return Carbon::parse($this->tanggal_pengukuran)->translatedFormat('d F Y');
    }

    // Accessor untuk waktu dengan format jam:menit 24-jam
    public function getJamFormatAttribute()
    {
        return Carbon::parse($this->waktu_pengukuran)->format('H:i');
    }
}