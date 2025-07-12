<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\UserDetail;
use App\Models\TransactionDetail;

class HistoryController extends Controller
{
     public function index()
    {
        $data = Transaction::where('users_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(5);
        $payment = Payment::whereIn('transactions_id', $data->pluck('id'))->get();
        // dd($payment);
        $userData = UserDetail::whereHas('user', function ($query) {
            $query->where('roles', 'Admin');
        })->first();

        return view('customer.profile.riwayat.index', compact('data', 'payment', 'userData'));
    }


    public function show($id)
{
    $userDetailData = UserDetail::where('users_id', auth()->id())->first();

    $provinceName = $userDetailData->provinces_id ?? '-';
    $cityName = $userDetailData->city_id ?? '-';

    // Ambil detail transaksi dan produk
    $transactionDetails = TransactionDetail::where('transactions_id', $id)->get();

    // Proses tiap item untuk cek custom dan sesuaikan data yang dikirim ke view
    $processedDetails = $transactionDetails->map(function ($item) {
        $is_custom = $item->custom_material || $item->custom_image || $item->custom_size;

        return [
            'product_name' => $item->product_name,
            'product_price' => $item->product_price,
            'qty' => $item->qty,
            'sub_total' => $item->sub_total,
            'product_image' => $is_custom && $item->custom_image ? $item->custom_image : $item->product_image,
            'custom_material' => $is_custom ? $item->custom_material : null,
            'custom_size' => $is_custom ? $item->custom_size : null,
            'custom_image' => $is_custom ? $item->custom_image : null,
            'is_custom' => (bool) $is_custom,
        ];
    });

    $transaction = Transaction::findOrFail($id);

    return view('customer.profile.riwayat.detail', [
        'data' => $processedDetails,
        'userDetailData' => $userDetailData,
        'provinceName' => $provinceName,
        'cityName' => $cityName,
        'transaction' => $transaction,
    ]);
}


    public function confirmOrderStatus($id)
    {
        $data = Transaction::with('user')->where('id', $id)->first();

        if ($data && $data->users_id == auth()->id()) {
            $data->update([
                'order_status' => 'SELESAI'
            ]);
        }

        return back()->with('success', 'Pesanan telah dikonfirmasi selesai');
    }
}
