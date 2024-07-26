<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Ambil bulan dan tahun saat ini
         $currentMonth = Carbon::now()->month;
         $currentYear = Carbon::now()->year;
 
         // Query untuk mengambil data transaksi berdasarkan bulan dan tahun saat ini
         $data = Transaksi::whereMonth('tgl_beli', $currentMonth)
             ->whereYear('tgl_beli', $currentYear)
             ->with('item')
             ->get();

             // Misalnya $data[0]->tgl_beli adalah string tanggal
        $tgl_beli = $data[0]->tgl_beli;

        // Konversi string tanggal menjadi objek Carbon
        $date = Carbon::parse($tgl_beli);

        // Set locale ke bahasa Indonesia (opsional, sesuaikan dengan kebutuhan)
        Carbon::setLocale('id');

        // Format tanggal menjadi nama bulan
        $month = $date->translatedFormat('F');

        // Jika Anda ingin menyimpan hasilnya dalam array atau variabel lain
        $data[0]->month_name = $month;

        $title = 'Laporan Transaksi ' . $month . ' ' . $currentYear;

        return view('admin.transaksi.index', [
            'page_title' => $title,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataSupplier = Supplier::all();
        return view('admin.transaksi.create', [
            'page_title' => 'Buat Transaksi',
            'dataSupplier' => $dataSupplier
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataTransaksi = Transaksi::latest()->first();
        $Code = 'TR';

        if ($dataTransaksi == null) {
            $kodeTransaksi = $Code . '001';
        } else {
            $kode = substr($dataTransaksi->id_transaksi, 2, 3) + 1;
            $kode = str_pad($kode, 3, '0', STR_PAD_LEFT);
            $kodeTransaksi = $Code . $kode;
        }

        $transaksi = new Transaksi();
        $transaksi->fill([
            'id_transaksi' => $kodeTransaksi,
            'user_id' => auth()->user()->id_user,
            'total_harga' => $request->total_harga,
            'tgl_beli' => Carbon::now()
        ]);
        $transaksi->save();

        $no_daftar = 0;
        foreach ($request->id_product as $id_products) {
            $daftar = Product::where('id_product', $id_products)->first();
            $transaksi_item = new TransaksiItem();
            $transaksi_item->fill([
                'id_transaksi' => $kodeTransaksi,
                'id_daftar' => $id_products,
                'nama' => $daftar->name_product,
                'harga' => $daftar->harga_satuan,
                'quantity' => $request->quantity[$no_daftar]
            ]);
            $transaksi_item->save();

            // Mengurangi stok produk
            $daftar->stok_product -= $request->quantity[$no_daftar];
            $daftar->save();

            $no_daftar++;
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function getProductsBySupplier($supplier_id)
    {
        $products = Product::where('id_supplier', $supplier_id)->get();
        return response()->json($products);
    }

    public function exportItemsPdf($id)
    {
        $data = TransaksiItem::where('id_transaksi', $id)->get();
        $pdf = Pdf::loadView('admin.transaksi.exportitem', [
            'id_invoice' => $data[0]->id_transaksi,
            'data' => $data
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function exportPdf()
    {
        // Ambil bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Query untuk mengambil data transaksi berdasarkan bulan dan tahun saat ini
        $data = Transaksi::whereMonth('tgl_beli', $currentMonth)
            ->whereYear('tgl_beli', $currentYear)
            ->get();

        // Misalnya $data[0]->tgl_beli adalah string tanggal
        $tgl_beli = $data[0]->tgl_beli;

        // Konversi string tanggal menjadi objek Carbon
        $date = Carbon::parse($tgl_beli);

        // Set locale ke bahasa Indonesia (opsional, sesuaikan dengan kebutuhan)
        Carbon::setLocale('id');

        // Format tanggal menjadi nama bulan
        $month = $date->translatedFormat('F');

        // Jika Anda ingin menyimpan hasilnya dalam array atau variabel lain
        $data[0]->month_name = $month;

        $pdf = Pdf::loadView('admin.transaksi.exportpdf', [
            'id_invoice' => $data[0]->id_transaksi,
            'data' => $data,
            'month' => $month,
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
