<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function storeJadwal(Request $request){
        $data = new Jadwal();
        $data->destinasi_awal = $request->destinasi_awal;
        $data->destinasi_tujuan = $request->destinasi_tujuan;
        $data->jam_keberangkatan = $request->jam_keberangkatan;
        $data->lama_perjalanan = $request->lama_perjalanan;
        $data->tanggal = $request->tanggal;
        $data->jumlah_tiket_tersedia = $request->jumlah_tiket_tersedia;
        $data->save();

        return response()->json(['message' , 'berhasil memasukan jadwal tiket']);

    }

    public function jadwal(){
        $data = Jadwal::all();

        return response()->json($data);
    }

    public function jadwadFind($id){
        $data = Jadwal::find($id);

        return response()->json($data);
    }

    public function delete($id){
        $data = Jadwal::find($id);
        $data->delete();

        return response()->json(['message' , 'berhasil menghapus tiket']);

    }

    public function pesan($id , Request $request){
        $data = Jadwal::find($id);
        $data->jumlah_tiket_tersedia = $data->jumlah_tiket_tersedia - $request->pesan;
        if ( $data->jumlah_tiket_tersedia < 0){
            return response()->json(['message' , 'tiket tidak tersedia']);
        }else{
            $data->update();

            return response()->json(['message' , 'berhasil ' . $request->pesan . ' memesan tiket']);
        }

    }

    public function update($id , Request $request){
        $data = Jadwal::find($id);


        if ($request->destinasi_awal != null){
            $data->destinasi_awal = $request->destinasi_awal;
        }

        if ($request->destinasi_tujuan != null){
            $data->destinasi_tujuan = $request->destinasi_tujuan;
        }

        if ($request->jam_keberangkatan != null){
            $data->jam_keberangkatan = $request->jam_keberangkatan;
        }


        if ($request->lama_perjalanan != null){
            $data->lama_perjalanan = $request->lama_perjalanan;
        }

        if ($request->tanggal != null){
            $data->tanggal = $request->tanggal;
        }

        if ($request->jumlah_tiket_tersedia != null){
            $data->jumlah_tiket_tersedia = $request->jumlah_tiket_tersedia;
        }


        $data->update();
        return response()->json(['message' , 'berhasil megnubah tiket']);


    }
}
