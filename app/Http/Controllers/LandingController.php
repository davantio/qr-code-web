<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SealDow;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $code = $request->query('c');

        // Jika ada parameter code, lakukan sesuatu dengan code tersebut
        if ($code) {
            // Misalnya, cari product berdasarkan code
            // $product = SealDow::where('code', $code)->first();

            // Atau tampilkan di view
            return view('layouts.scan', ['code' => $code]);
        }

        return view('layouts.app');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $code = $request->input('code');

        // Cari kode di database
        $seal = SealDow::where('code', $code)->first();

        if ($seal) {
            // Kode ditemukan - autentikasi berhasil
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your purchase of a genuine product.',
                'data' => $seal
            ]);
        } else {
            // Kode tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'We are not certain about your product. Please contact our customer service team.'
            ], 404);
        }
    }
}
