<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline()
    {
        $user = Auth::user();
        $fototerbaru = Galeri::where('id_user', '=', $user->id)->orderby('created_at','desc')->get();
        return view('timeline',compact('fototerbaru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $user = Auth::user()->id;
        $namafoto = $request->foto->getClientOriginalName();
        $request->foto->move(public_path('foto'), $namafoto);


        Galeri::create([
            'id_user' => $user,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namafoto,
            'tanggal' => now(),
            
        ]);
        return redirect('timeline');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = Auth::user()->id;
        if ($request->foto == null) {
            Galeri::where('id', '=', $id)->update([
                'id_user' => $user,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
        $namafoto = $request->foto->getClientOriginalName();
        $request->foto->move(public_path('foto'), $namafoto);
            Galeri::where('id', '=', $id)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $namafoto
            ]);
        }
        
        return redirect('timeline');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Galeri::where('id', '=', $id)->delete();
        return redirect('timeline');
    }
}
