<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Product;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
public function index()
{
    $query = Transaction::with(['user', 'jadwalPengukuran', 'transactionDetails.product']);

    // Filter berdasarkan status
    if (request()->has('status') && request()->status != '') {
        $query->where('order_status', request()->status);
    } else {
        $query->where(function ($q) {
            $q->whereNull('order_status')
              ->orWhereIn('order_status', ['PESANAN_BARU', 'SEDANG_DIKERJAKAN', 'SELESAI']);
        });
    }

    // Urutan sort berdasarkan tanggal
    $sortOrder = request('sort', 'desc'); // default desc
    $query->orderBy('created_at', $sortOrder);

    $transactions = $query->get();

    return view('admin.transaction.index', compact('transactions'));
}

public function payment()
{
    $transactions = Transaction::with(['user', 'transactionDetails.product'])
        ->where(function ($q) {
            $q->whereNull('order_status')
                ->orWhereIn('order_status', ['PESANAN_BARU', 'SEDANG_DIKERJAKAN', 'SELESAI']);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    foreach ($transactions as $transaction) {
        $transaction->order_status_readable = $this->getOrderStatus($transaction);
        
        // Hitung total harga dari transaction details
        if ($transaction->transactionDetails && $transaction->transactionDetails->count() > 0) {
            $total = 0;
            foreach ($transaction->transactionDetails as $detail) {
                if ($detail->product && isset($detail->product->price)) {
                    $total += $detail->product->price * ($detail->quantity ?? 1);
                }
            }
            $transaction->total_price = $total;
        }
    }

    return view('admin.payment.index', compact('transactions'));
}

public function showPayment($id)
{
    $transaction = Transaction::with(['user', 'transactionDetails.product'])->findOrFail($id);
    $paymentData = Payment::where('transactions_id', $id)->first();
    
    if (!$paymentData) {
        return redirect()->route('admin.payment.index')->with('error', 'Bukti pembayaran tidak ditemukan');
    }
    
    return view('admin.payment.show', compact('paymentData', 'transaction'));
}

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'transactionDetails.product'])->findOrFail($id);
        return view('admin.transaction.show', compact('transaction'));
    }

    public function updateStatus($id) 
    {
        $data = Transaction::with('user')->findOrFail($id);

        if ($data->payment_status == 'UNPAID') {
            $data->update([
                'payment_status' => 'PAID',
                'order_status' => 'PESANAN_BARU'
            ]);
        } else {
            if ($data->order_status == 'PESANAN_BARU') {
                $data->update(['order_status' => 'SEDANG_DIKERJAKAN']);
            } elseif ($data->order_status == 'SEDANG_DIKERJAKAN') {
                $data->update(['order_status' => 'SELESAI']);
            }
        }

        return back()->with('success', 'Status transaksi berhasil diperbarui');
    }

    public function cancelOrder($id)
    {
        $data = Transaction::findOrFail($id);
        $data->update([
            'payment_status' => 'CANCELLED',
            'order_status' => 'CANCELLED'
        ]);

        return back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    protected function getOrderStatus($transaction)
    {
        $payment = Payment::where('transactions_id', $transaction->id)->first();

        if ($transaction->order_status === 'CANCELLED') {
            return 'Dibatalkan';
        } elseif ($transaction->order_status == null && isset($payment)) {
            return 'Menunggu Konfirmasi Pembayaran';
        } elseif ($transaction->order_status == null && !isset($payment)) {
            return 'Menunggu Pembayaran Customer';
        } else {
            return match ($transaction->order_status) {
                'PESANAN_BARU' => 'Pesanan Baru',
                'SEDANG_DIKERJAKAN' => 'Sedang Dikerjakan',
                'SELESAI' => 'Selesai',
                default => $transaction->order_status
            };
        }
    }
}