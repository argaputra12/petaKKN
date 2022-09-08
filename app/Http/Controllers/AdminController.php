<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kota;
use App\Models\Lokasi;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Console\View\Components\Component;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        if($request->ajax()) {

            $search = $request->get('search');
            $lokasis = array();

            // Search by kota
            $kota = Kota::where('nama', 'like', '%'.$search.'%')->get('id');
            $desa = Desa::whereIn('kota_id', $kota)->get('id');
            $lokasi = Lokasi::whereIn('desa_id', $desa)->paginate(10);

            foreach($lokasi as $l) {
                $lokasis[] = $l;
            }

            // Search by desa
            $desa = Desa::where('nama_desa', 'like', '%'.$search.'%')
                ->orWhere('nama_kecamatan', 'like', '%'.$search.'%')
                ->get('id');
            $lokasi = Lokasi::whereIn('desa_id', $desa)->paginate(10);

            foreach($lokasi as $l){
                array_push($lokasis, $l);
            }

            // Search by kelompok
            $identitas_kelompok = Kelompok::where('identitas_kelompok', 'like', '%'.$search.'%')->get('id');
            $lokasi = Lokasi::whereIn('kelompok_id', $identitas_kelompok)->paginate(10);

            foreach($lokasi as $l){
                array_push($lokasis, $l);
            }

            array_unique($lokasis);


            return view('components.admin-dashboard', compact('lokasis'));

        }



    }
}
