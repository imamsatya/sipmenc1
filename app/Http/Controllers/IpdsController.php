<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Models\Dokumen;
use Inertia\Inertia;

use Carbon\Carbon;
class IpdsController extends Controller
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

    public function submitMultipleBackStep(Request $request){
        $dokumen = New Dokumen;
        $user = Auth::user();

        $date = Carbon::now();
        //Get date and time
        $waktu = $date->toDateTimeString();
        $array = (array) $request;
        // dd($array['request'], gettype($array));
        // dd($request[1]['id']);
        foreach ($array['request'] as $item => $value ) {

            // dd( $item, $value['id']);
            $key = $dokumen->where('id', $value['id'])->first();
            if ($key->status == 'Gudang Akhir') {
                // dd('statusnya Guilotine, ubah ke Gudang');
                $key->status = 'Diterima IPDS';
            } elseif ($key->status == 'Diterima IPDS') {
                // dd('statusnya Gudang, ubah ke Gudang');
                $key->status = 'Kirim IPDS';
            }
            elseif ($key->status == 'Kirim IPDS') {
                // dd('statusnya Kirim IPDS, ubah ke Guillotine');
                $key->status = 'Guillotine';
            }
             
            
            $key->petugas = $user->name;
            $key->updated_at_custom = $waktu;     
            $key->save();
        }
        $dokumens = new Dokumen;
        $dokumens = $dokumens
        ->get();
        
        // dd($user);
        return redirect('dashboard');
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

    public function submitMultipleGuillotine(Request $request){
        $dokumen = New Dokumen;
        $user = Auth::user();

        $date = Carbon::now();
        //Get date and time
        $waktu = $date->toDateTimeString();
        $array = (array) $request;
        // dd($array['request'], gettype($array));
        // dd($request[1]['id']);
        foreach ($array['request'] as $item => $value ) {

            // dd( $item, $value['id']);
            $key = $dokumen->where('id', $value['id'])->first();
            $key->status = 'Diterima IPDS';
            $key->petugas = $user->name;
            $key->updated_at_custom = $waktu;     
            $key->save();
        }
        $dokumens = new Dokumen;
        $dokumens = $dokumens
        ->get();
        
        // dd($user);
        return redirect('dashboard');
    }
    public function submitMultipleGudang(Request $request){
        // dd($request);
        
        $dokumen = New Dokumen;
        $user = Auth::user();

        $date = Carbon::now();
        //Get date and time
        $waktu = $date->toDateTimeString();
        $array = (array) $request[0];
        // dd($array['request'], gettype($array));
        // dd($request[1]['id']);
        foreach ($array as $item => $value ) {

            // dd( $item, $value['id']);
            $key = $dokumen->where('id', $value['id'])->first();
            $key->status = 'Gudang Akhir';
            $key->petugas = $user->name;
            $key->updated_at_custom = $waktu; 
            $key->nogudang_index = $request[2];
            $key->nosurat_string = $request[1];    
            $key->save();
        }
        $dokumens = new Dokumen;
        $dokumens = $dokumens
        ->get();
        
        // dd($user);
        return redirect('dashboard');
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
}
