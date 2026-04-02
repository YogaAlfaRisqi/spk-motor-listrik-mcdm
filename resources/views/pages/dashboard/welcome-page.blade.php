@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- Welcome Section --}}
  <div class="flex items-center justify-between p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
    
    <div>
      <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
        Selamat Datang 👋
      </h1>

      <p class="mt-1 text-gray-500 dark:text-gray-400">
        Kelola sistem pendukung keputusan pemilihan motor listrik dengan mudah.
      </p>
    </div>

    <div class="hidden md:block">
      <span class="px-4 py-2 text-sm font-medium rounded-lg 
      bg-gradient-to-r from-green-500 to-emerald-500 text-white shadow">
        Admin {{ Auth::user()->name }}
      </span>
    </div>

  </div>




  {{-- Shortcut Menu --}}
<div class="p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">

  <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-5">
    Menu Cepat
  </h2>

  <div class="grid grid-cols-3 md:grid-cols-6 gap-4">


    {{-- Data Motor --}}
    <a href="#"
       class="group p-5 border border-gray-100 dark:border-gray-800 rounded-xl 
       hover:shadow-md hover:-translate-y-1 transition duration-200
       bg-gray-50/50 dark:bg-gray-800/40 text-center">

      <div class="flex justify-center mb-3">
        <div class="p-3 rounded-xl bg-blue-100 dark:bg-blue-900/40">
          <i data-lucide="bike" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
        </div>
      </div>

      <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
        Kriteria
      </p>

    </a>


    {{-- Kriteria --}}
    <a href="#"
       class="group p-5 border border-gray-100 dark:border-gray-800 rounded-xl 
       hover:shadow-md hover:-translate-y-1 transition duration-200
       bg-gray-50/50 dark:bg-gray-800/40 text-center">

      <div class="flex justify-center mb-3">
        <div class="p-3 rounded-xl bg-green-100 dark:bg-green-900/40">
          <i data-lucide="sliders-horizontal" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
        </div>
      </div>

      <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
        Data Motor
      </p>

    </a>


    {{-- Alternatif --}}
    <a href="#"
       class="group p-5 border border-gray-100 dark:border-gray-800 rounded-xl 
       hover:shadow-md hover:-translate-y-1 transition duration-200
       bg-gray-50/50 dark:bg-gray-800/40 text-center">

      <div class="flex justify-center mb-3">
        <div class="p-3 rounded-xl bg-purple-100 dark:bg-purple-900/40">
          <i data-lucide="git-branch" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
        </div>
      </div>

      <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
        Bobot
      </p>

    </a>


    {{-- Perhitungan --}}
    <a href="#"
       class="group p-5 border border-gray-100 dark:border-gray-800 rounded-xl 
       hover:shadow-md hover:-translate-y-1 transition duration-200
       bg-gray-50/50 dark:bg-gray-800/40 text-center">

      <div class="flex justify-center mb-3">
        <div class="p-3 rounded-xl bg-orange-100 dark:bg-orange-900/40">
          <i data-lucide="calculator" class="w-6 h-6 text-orange-600 dark:text-orange-400"></i>
        </div>
      </div>

      <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
        Perhitungan
      </p>

    </a>

    <a href="#"
       class="group p-5 border border-gray-100 dark:border-gray-800 rounded-xl 
       hover:shadow-md hover:-translate-y-1 transition duration-200
       bg-gray-50/50 dark:bg-gray-800/40 text-center">

      <div class="flex justify-center mb-3">
        <div class="p-3 rounded-xl bg-orange-100 dark:bg-orange-900/40">
          <i data-lucide="calculator" class="w-6 h-6 text-orange-600 dark:text-orange-400"></i>
        </div>
      </div>

      <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
        Perbandingan Bobot
      </p>

    </a>

    <a href="#"
       class="group p-5 border border-gray-100 dark:border-gray-800 rounded-xl 
       hover:shadow-md hover:-translate-y-1 transition duration-200
       bg-gray-50/50 dark:bg-gray-800/40 text-center">

      <div class="flex justify-center mb-3">
        <div class="p-3 rounded-xl bg-orange-100 dark:bg-orange-900/40">
          <i data-lucide="calculator" class="w-6 h-6 text-orange-600 dark:text-orange-400"></i>
        </div>
      </div>

      <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
        Perbandingan Ranking
      </p>

    </a>


  </div>

</div>

</div>
@endsection