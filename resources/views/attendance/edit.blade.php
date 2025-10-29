@extends('master')
@section('title', 'Edit Absensi')
@section('content')
  @php($attendanceColumns = (new \App\Models\Attendance())->getFillable())

  <section class="bg-white dark:bg-gray-900">
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Data Absensi</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Perbarui informasi absensi karyawan sesuai kebutuhan.</p>
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

      <form action="{{ route('attendance.update', $attendance->id) }}" method="POST" class="bg-white dark:bg-gray-900">
        @csrf
        @method('PUT')

        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
          @if(in_array('karyawan_id', $attendanceColumns, true))
            <div class="sm:col-span-2">
              <label for="karyawan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Karyawan</label>
              <select id="karyawan_id" name="karyawan_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="" disabled {{ old('karyawan_id', $attendance->karyawan_id) ? '' : 'selected' }}>-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                  <option value="{{ $employee->id }}" @selected(old('karyawan_id', $attendance->karyawan_id) == $employee->id)>
                    {{ $employee->nama_lengkap }} (ID: {{ $employee->id }})
                  </option>
                @endforeach
              </select>
              @error('karyawan_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('tanggal', $attendanceColumns, true))
            <div class="w-full">
              <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
              <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $attendance->tanggal) }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('tanggal')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('waktu_masuk', $attendanceColumns, true))
            <div class="w-full">
              <label for="waktu_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Masuk</label>
              <input type="time" id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('waktu_masuk')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('waktu_keluar', $attendanceColumns, true))
            <div class="w-full">
              <label for="waktu_keluar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waktu Keluar</label>
              <input type="time" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
              @error('waktu_keluar')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif

          @if(in_array('status_absensi', $attendanceColumns, true))
            <div class="w-full sm:col-span-2">
              <label for="status_absensi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Absensi</label>
              <select id="status_absensi" name="status_absensi" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option value="" disabled {{ old('status_absensi', $attendance->status_absensi) ? '' : 'selected' }}>-- Pilih Status --</option>
                @foreach($statuses as $status)
                  @php($statusLabel = ucfirst(str_replace('_', ' ', $status)))
                  <option value="{{ $status }}" @selected(old('status_absensi', $attendance->status_absensi) == $status)>{{ $statusLabel }}</option>
                @endforeach
              </select>
              @error('status_absensi')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          @endif
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
          <a href="{{ route('attendance.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-primary-200 focus:ring-offset-2 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">Batal</a>
          <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">Update</button>
        </div>
      </form>
    </div>
  </section>
@endsection