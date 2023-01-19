@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data Rental
                <hr>
            </h3>
            <div class="card-body">
                <form action="/rental/{{ $item->kode_rental }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">NIK</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" name="nik">
                            <option disabled selected>Pick one</option>
                            @foreach ($getCustomer as $customer)
                                <option {{ old('nik') == $customer->nik ? 'selected' : '' }}
                                    @if ($customer->nik == $item->nik) selected @endif value="{{ $customer->nik }}">
                                    {{ $customer->nama }} | {{ $customer->nik }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nik')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Nopol</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" name="nopol">
                            <option disabled selected>Pick one</option>
                            @foreach ($getMobil as $mobil)
                                <option {{ old('nopol') == $mobil->nopol ? 'selected' : '' }}
                                    @if ($mobil->nopol == $item->nopol) selected @endif value="{{ $mobil->nopol }}">
                                    {{ $mobil->merk }} | {{ $mobil->model }} | {{ $mobil->nopol }}</option>
                            @endforeach
                        </select>
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('nopol')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tanggal Rental</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tanggal_rental" type="date" placeholder="Type here"
                            value="{{ old('tanggal_rental', $item->tanggal_rental) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tanggal_rental')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Tanggal Kembal</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tanggal_kembali" type="date" placeholder="Type here"
                            value="{{ old('tanggal_kembali', $item->tanggal_kembali) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tanggal_kembali')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    {{-- <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Durasi</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="durasi" type="text" placeholder="click here"
                            value="{{ old('durasi', $item->durasi) }}" class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('durasi')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Total Harga</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="total_harga" type="text" placeholder="Type here"
                            value="{{ old('total_harga', $item->total_harga) }}"
                            class="input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt"></span>
                            <span class="label-text-alt text-red-600">
                                @error('total_harga')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div> --}}
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn-error btn">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
