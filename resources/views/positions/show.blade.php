@extends('master')
@section('title', 'Detail Jabatan')
@section('content')
  @php
    $details = [
      'Nama Jabatan' => $position->nama_jabatan,
      'Gaji Pokok'   => 'Rp ' . number_format($position->gaji_pokok, 2, ',', '.'),
    ];
  @endphp

  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Jabatan</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Ringkasan informasi jabatan.</p>
      </div>

      <div class="relative overflow-x-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <tbody>
            @foreach($details as $label => $value)
              <tr class="{{ $loop->last ? 'bg-white dark:bg-gray-800' : 'bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700' }}">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/3">
                  {{ $label }}
                </th>
                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                  {{ $value }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="flex justify-end mt-6">
        <a href="{{ route('positions.index') }}"
          class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-primary-200 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
          Kembali ke daftar
        </a>
      </div>
    </div>
  </section>
@endsection