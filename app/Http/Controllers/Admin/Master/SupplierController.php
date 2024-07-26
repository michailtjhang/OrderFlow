<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::get();
        return view('admin.master.supplier.index', [
            'data' => $data,
            'page_title' => 'Daftar Supplier',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master.supplier.create', [
            'page_title' => 'Daftar Akun Supplier',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required | min:3 | string',
                'alamat' => 'required | min:10 | string',
                'telp' => 'required | min:10 | numeric',
                'email' => 'required | email',
                'password' => 'required | min:8 | string',
            ],
            [
                'nama.required' => 'Masukan Nama Supplier',
                'alamat.required' => 'Masukan Alamat Supplier',
                'telp.required' => 'Masukan Telepon Supplier',
                'email.required' => 'Masukan Email Supplier',
                'password.required' => 'Masukan Password Supplier',
            ]
        );

        $user = User::latest()->first();
        $kodeUser = "US";

        if ($user == null) {
            $id_user = $kodeUser . "001";
        } else {
            $id_user = $user->id_user;
            $urutan = (int) substr($id_user, 3, 3);
            $urutan++;
            $id_user = $kodeUser . sprintf("%03s", $urutan);
        }

        User::create([
            'id_user' => $id_user,
            'name' => $request->nama,
            'email' => $request->email,
            'role' => 'supplier',
            'password' => Hash::make($request->password),
        ]);

        $dataSupplier = Supplier::latest()->first();
        $Code = 'SP';

        if ($dataSupplier == null) {
            $kodeSupplier = $Code . '001';
        } else {
            $kode = substr($dataSupplier->id_product, 2, 3) + 1;
            $kode = str_pad($kode, 4, '0', STR_PAD_LEFT);
            $kodeSupplier = $Code . $kode;
        }

        Supplier::create([
            'id_supplier' => $kodeSupplier,
            'name_supplier' => $request->nama,
            'address_supplier' => $request->alamat,
            'phone_supplier' => $request->telp,
            'email_supplier' => $request->email,
            'id_user' => $id_user,
        ]);    

        return redirect('/admin/supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::where('id_user', $id)->get();

        return view('admin.master.supplier.show', [
            'data' => $data,
            'page_title' => 'Daftar Product Supplier',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
