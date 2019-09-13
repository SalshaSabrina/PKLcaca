<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengembalianRequest;
use App\Pengembalian;
use Session;
use DataTables;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengembalian::with('petugas','anggota','buku')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('pengembalian');
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
    public function store(PengembalianRequest $request)
    {
        $tanggal_kembali = strtotime($request->tanggal_kembali);
        $jatuh_tempo = strtotime($request->jatuh_tempo);
        $jumlah = $tanggal_kembali - $jatuh_tempo;
        $jumlah_hari = floor($jumlah / (60 * 60 * 24));
        if ($jumlah_hari <= 0) {
            $jumlah_hari = 0;
            $total_denda = $jumlah_hari*2000;
        }else {
            $total_denda = $jumlah_hari*2000;
        }
        Pengembalian::updateOrCreate(['id' => $request->pengembalian_id],
                ['kode_kembali' => $request->kode_kembali,
                 'tanggal_kembali' => $request->tanggal_kembali,
                 'jatuh_tempo' => $request->jatuh_tempo,
                 'denda_perhari' => 2000,
                 'jumlah_hari' => $jumlah_hari,
                 'total_denda' => $total_denda,
                 'kode_petugas' => $request->kode_petugas,
                 'kode_anggota' => $request->kode_anggota,
                 'kode_buku' => $request->kode_buku
                 ]);        
   
        return response()->json(['success'=>'pengembalian saved successfully.']);
    }

    /**
     * Display the specified resource.
     * 
     * 
     * 
     * 
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
        $pengembalian = Pengembalian::find($id);
        return response()->json($pengembalian);
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
        Pengembalian::find($id)->delete();
     
        return response()->json(['success'=>'pengembalian deleted successfully.']);
    }
}
