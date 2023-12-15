<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatAlat;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaketAlat;

class CatController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $catCount = CatAlat::count();
        $adminCount = Admin::count();
        $data['categories'] = CatAlat::All();
        return view('admin/listcategory', $data, ['user_count' => $userCount, 'paket_count' => $paketCount, 'cat_count' => $catCount, 'admin_count' => $adminCount]);

    }

    public function create()
    {
        return view('admin/addcat');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        CatAlat::create([
            'name' => $request['name']
        ]);

        return redirect()->route('showlistcat')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['cat'] = CatAlat::findOrFail($id);
        return view(
            'admin/updatecat',
            $data
        );
    }

    public function update(Request $request, $id)
    {
        $dataCat['cat'] = CatAlat::findOrFail($id);

        $request->validate([
            'name' => 'string'
        ]);

        CatAlat::where('id', $id)->update([
            'name' => $request['name']
        ]);

        return redirect()->route('showlistcat')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = CatAlat::findOrFail($id);

        $data->delete();

        return redirect()->route('showlistcat')->with('success', 'Kategori berhasil dihapus');
    }
}
