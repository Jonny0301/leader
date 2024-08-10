<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::orderBy('name', 'asc')->get();

        return view('barang.barang', [
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.barang-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs',
            'phone' => 'required',
            'link' => 'required',
        ]);

        $phone = $validated['phone'];
        $leader = Barang::where('phone',$phone)
        ->first();

        if($leader){
            Alert::success('alert', 'Leader has already exists!');
        }else{
            $barang = Barang::create($request->all());
            Alert::success('Success', 'Barang has been saved !');
        }

        return redirect('/barang');
    }


    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = barang::findOrFail($id);
        return view('barang.barang-edit', [
            'barang' => $barang,
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs,name,' . $id . ',id',
            'phone' => 'required',
            'link' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($validated);

        Alert::info('Success', 'Barang has been updated !');
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deletedbarang = Barang::findOrFail($id);

            $deletedbarang->delete();

            Alert::error('Success', 'Barang has been deleted !');
            return redirect('/barang');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Barang already used !');
            return redirect('/barang');
        }
    }
}
