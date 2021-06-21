<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;    

use Carbon\Carbon;
use PDF;
class TuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        
        
        $dokumens = new Dokumen;
        $dokumens = $dokumens
        ->get();

        $nosurat_index = [];
        foreach ($dokumens as $key => $value) {
       
            if ($value['nosurat_index'] == NULL) {
                array_push($nosurat_index, 0);
            }else{
            array_push($nosurat_index, $value['nosurat_index']);
            }
        }
        $currentIndex = max($nosurat_index) + 1;

        $month = date('m');
        $nosuratString ;
        if (strlen($currentIndex) == 1) {
            $nosuratString = 'B-00'.$currentIndex.'/BPS-SULTENG/7256/'.$month.'/2021';
            
        } elseif (strlen($currentIndex) == 2) {
            $nosuratString = 'B-0'.$currentIndex.'/BPS-SULTENG/7256/'.$month.'/2021';
        } else{
            $nosuratString = 'B-'.$currentIndex.'/BPS-SULTENG/7256/'.$month.'/2021';
        }
        
        $datenow = date("d-m-Y");
        // dd($dokumens[0]);

        if ($user->isIpds == 1) {
            # code...
            $dokumens = new Dokumen;
            $dokumens = $dokumens
            ->where('status', '<>', 'Gudang')
            ->where('status' ,'<>', 'Guillotine')
            ->get();

            return Inertia::render('Dashboard2', [
                'dokumens' => $dokumens,
                'nosuratString' => $nosuratString,
                'currentIndex' => $currentIndex,
                'datenow' => $datenow
            ]);
        }
        return Inertia::render('Dashboard', [
            'dokumens' => $dokumens,
            'nosuratString' => $nosuratString,
            'currentIndex' => $currentIndex,
            'datenow' => $datenow
        ]);
    }

    public function submitguillotine(Request $request)
    {
        $dokumen = New Dokumen;
        $user = Auth::user();

        $date = Carbon::now();
        //Get date and time
        $waktu = $date->toDateTimeString();
        // dd($waktu);
        $dokumen = $dokumen->where('id', $request->id)->first();
        $dokumen->status = 'Guillotine';
        $dokumen->petugas = $user->name;
        $dokumen->updated_at_custom = $waktu;


        $dokumen->save();
        // dd($dokumen);
        $dokumens = new Dokumen;
        $dokumens = $dokumens
        ->get();
        
        // dd($user);
        return redirect('dashboard');
                // return Inertia::render('Dashboard', [
        //     'dokumens' => $dokumens
        // ]);
        
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
            $key->status = 'Guillotine';
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
            if ($key->status == 'Guillotine') {
                // dd('statusnya Guilotine, ubah ke Gudang');
                $key->status = 'Gudang';
            } elseif ($key->status == 'Gudang') {
                // dd('statusnya Gudang, ubah ke Gudang');
                $key->status = 'Gudang';
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

    public function submitMultipleKirimipds(Request $request){
        
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
            $key->status = 'Kirim IPDS';
            $key->petugas = $user->name;
            $key->updated_at_custom = $waktu;    
            $key->nosurat_index = $request[2];
            $key->nosurat_string = $request[1];
            
            $key->save();
        }

       

        return redirect('dashboard');
    }


    public function createPDF($data2) {
        
        // $data2 = $request;
        //   dd($data2);
        $pdf = PDF::loadView('pdf2', $data2);
    
        return $pdf->download('itsolutionstuff.pdf');
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
}
