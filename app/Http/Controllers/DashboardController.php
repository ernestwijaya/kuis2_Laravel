<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswaprodi = DB::select(query: '
        SELECT prodi.nama, COUNT(*) as jumlah 
        from mahasiswas join prodi on 
        mahasiswas.prodi_id = prodi.id 
        GROUP by prodi.nama'
    );

        return view(view: 'dashboard.index',
        data: compact
        (var_name: 'mahasiswaprodi')
    );
    }
}
