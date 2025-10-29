@extends('master')
@section('title', 'Tambah Jabatan')
@section('content')
  @php($positionColumns = (new \App\Models\Position())->getFillable())

  <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Jabatan</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Lengkapi data jabatan baru pada form berikut.</p>
      </div>

      @if($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
          <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('positions.store') }}" method="POST" class="bg-white dark:bg-gray-900">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
          @if(in_array('nama_jabatan', $positionColumns, true))
            <div class="sm:col-span-2">
              <label for="nama_jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Jabatan</label>
              <input type="text" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('nama_jabatan')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('gaji_pokok', $positionColumns, true))
            <div class="w-full">
              <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gaji Pokok</label>
              <input type="number" step="0.01" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('gaji_pokok')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
          <a href="{{ route('positions.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-primary-200 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">Batal</a>
          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">Simpan</button>
        </div>
      </form>
    </div>
  </section>
@endsection