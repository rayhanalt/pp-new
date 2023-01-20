@extends('app')
@section('content')
    <div class="overflow-x-auto">
        <div class="card shadow-xl">
            <h3 class="sticky top-0 text-lg font-bold">Ubah Data Denda
                <hr>
            </h3>
            <div class="card-body">
                <form action="/denda/{{ $item->kode_denda }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-control w-full max-w-full">
                        <label class="label">
                            <span class="label-text">Data Rental</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <select class="select-bordered select" name="kode_rental">
                            <option disabled selected>Pick one</option>
                            @foreach ($getRental as $rental)
                                <option {{ old('kode_rental') == $rental->kode_rental ? 'selected' : '' }}
                                    @if ($rental->kode_rental == $item->kode_rental) selected @endif value="{{ $rental->kode_rental }}">
                                    {{ $rental->getCustomer->nama }} | {{ $rental->getMobil->nopol }} |
                                    {{ 'Rp. ' . number_format($rental->getMobil->harga_sewa, 0, ',', '.') }}
                                </option>
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
                            <span class="label-text">Tanggal Denda</span>
                            <span class="label-text-alt"></span>
                        </label>
                        <input name="tanggal_denda" type="date" placeholder="Type here"
                            value="{{ old('tanggal_denda', $item->tanggal_denda) }}"
                            class="datepicker input-bordered input w-full max-w-full" />
                        <label class="label">
                            <span class="label-text-alt">Tanggal Kembali: <input readonly type="date"
                                    name="tanggal_kembali"></span>
                            <span class="label-text-alt text-red-600">
                                @error('tanggal_denda')
                                    {{ $message }}
                                @enderror
                            </span>
                        </label>
                    </div>
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn-error btn">Reset</button>
                        <button type="submit"class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
