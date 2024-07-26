<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\TransaksiItem;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transaksi::with('item')->get();

        return view('admin.transaksi.index', [
            'page_title' => 'Daftar Transaksi',
            'data' => $data
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
            $kode = substr($dataTransaksi->id_product, 2, 3) + 1;
            $kode = str_pad($kode, 4, '0', STR_PAD_LEFT);
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
}
