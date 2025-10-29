@extends('master')
@section('title', 'Edit Pegawai')
@section('content')
  @php($employeeColumns = (new \App\Models\Employee())->getFillable())

  <section class="bg-white dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Pegawai</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Perbarui informasi pegawai sesuai kebutuhan.</p>
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

      <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="bg-white dark:bg-gray-900">
        @csrf
        @method('PUT')

        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
          @if(in_array('nama_lengkap', $employeeColumns, true))
            <div class="sm:col-span-2">
              <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
              <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('nama_lengkap')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('email', $employeeColumns, true))
            <div class="w-full">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('nomor_telepon', $employeeColumns, true))
            <div class="w-full">
              <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
              <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('nomor_telepon')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('tanggal_lahir', $employeeColumns, true))
            <div class="w-full">
              <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
              <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('tanggal_lahir')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('alamat', $employeeColumns, true))
            <div class="sm:col-span-2">
              <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
              <textarea id="alamat" name="alamat" rows="3" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ old('alamat', $employee->alamat) }}</textarea>
              @error('alamat')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('tanggal_masuk', $employeeColumns, true))
            <div class="w-full">
              <label for="tanggal_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk</label>
              <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('tanggal_masuk')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('departemen_id', $employeeColumns, true))
            <div class="w-full">
              <label for="departemen_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departemen</label>
              <select id="departemen_id" name="departemen_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="" disabled {{ old('departemen_id', $employee->departemen_id) ? '' : 'selected' }}>-- Pilih Departemen --</option>
                @foreach($departments as $department)
                  <option value="{{ $department->id }}" @selected(old('departemen_id', $employee->departemen_id) == $department->id)>
                    {{ $department->nama_departemen }}
                  </option>
                @endforeach
              </select>
              @error('departemen_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('jabatan_id', $employeeColumns, true))
            <div class="w-full">
              <label for="jabatan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
              <select id="jabatan_id" name="jabatan_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="" disabled {{ old('jabatan_id', $employee->jabatan_id) ? '' : 'selected' }}>-- Pilih Jabatan --</option>
                @foreach($positions as $position)
                  <option value="{{ $position->id }}" @selected(old('jabatan_id', $employee->jabatan_id) == $position->id)>
                    {{ $position->nama_jabatan }}
                  </option>
                @endforeach
              </select>
              @error('jabatan_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('status', $employeeColumns, true))
            <div class="sm:col-span-2">
              <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
              <select id="status" name="status" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="" disabled {{ old('status', $employee->status) ? '' : 'selected' }}>-- Pilih Status --</option>
                @foreach($statuses as $statusOption)
                  <option value="{{ $statusOption }}" @selected(old('status', $employee->status) == $statusOption)>{{ ucfirst($statusOption) }}</option>
                @endforeach
              </select>
              @error('status')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
          <a href="{{ route('employees.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-primary-200 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">Batal</a>
          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">Update</button>
        </div>
      </form>
    </div>
  </section>
@endsection