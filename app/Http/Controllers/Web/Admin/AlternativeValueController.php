<?php
namespace App\Http\Controllers\Web\Admin;


    use App\Http\Controllers\Controller;
    use App\Models\BobotKriteria;
    use App\Models\NilaiAlternatif;
    use Illuminate\Http\Request;

    class AlternativeValueController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            //
            $alternativesvalues = NilaiAlternatif::with('kriteria')->get();
            $bobot = BobotKriteria::with('kriteria')->get();
            return view('pages.alternative-value.alternative-value-page', ['title' => 'Nilai Alternatif', 'alternativesvalues' => $alternativesvalues, 'bobot' => $bobot]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            //
        }
    }
