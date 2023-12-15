<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatAlat;
use App\Models\PaketAlat;
use App\Models\User;
use App\Models\Admin;

class PaketController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $paket = PaketAlat::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('description', $keyword)->paginate(10);
        return view('user/paketpage', ['pakets' => $paket]);
    }
    public function listpaket()
    {
        $userCount = User::count();
        $paketCount = PaketAlat::count();
        $catCount = CatAlat::count();
        $adminCount = Admin::count();
        $dataCat = CatAlat::All();
        $data['pakets'] = PaketAlat::all();
        return view('admin/listpaket', $data, ['cats' => $dataCat, 'user_count' => $userCount, 'paket_count' => $paketCount, 'cat_count' => $catCount, 'admin_count' => $adminCount]);
    }

    public function create()
    {
        $data['cat'] = CatAlat::All();
        return view(
            'admin/addpaket',
            $data
        );
    }

    public function store(Request $request)
    {
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('picture'), $imageName);

        $pakets = new PaketAlat();
        $pakets->name = $request->name;
        $pakets->price = $request->price;
        $pakets->description = $request->deskripsi;
        $pakets->cat_id = $request->kategori;
        $pakets->image = $imageName;

        $pakets->save();

        return redirect()->route('showlistpaket')->with('success', 'Paket berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['pakets'] = PaketAlat::findOrFail($id);
        $item['cats'] = CatAlat::All();
        return view('admin/updatepaket', $data, $item);
    }

    public function update(Request $request, $id)
    {
        $pakets = PaketAlat::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('picture'), $imageName);

            $pakets->image = $imageName;
        }

        $pakets->name = $request->name;
        $pakets->price = $request->price;
        $pakets->description = $request->deskripsi;
        $pakets->cat_id = $request->kategori;
        $pakets->image = $imageName;

        $pakets->save();

        return redirect()->route('showlistpaket')->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = PaketAlat::findOrFail($id);

        $data->delete();

        return redirect()->route('showlistpaket')->with('success', 'Paket berhasil dihapus');
    }
}
