@extends('app')
@section('content')
    <div>
        <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
            <div>
                <a href="/pekerjaProyek/create/{{ $item->kode_proyek }}" class="btn-outline btn-success btn-sm btn mr-2">➕
                    Data</a>
            </div>
            <div>
                @include('layout.notif')
            </div>
            <div>
                <span class="btn-ghost btn-sm btn ml-2">{{ $item->nama_proyek }} | {{ $item->getPegawai->nama }}</span>
            </div>
        </div>
        <table class="mt-10 table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TIM</th>
                    <th class="text-center">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->getPegawai->nama }}</td>
                        <td class="text-center">
                            <form action="/pekerjaProyek/{{ $item->kode_pekerja_proyek }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn-outline btn-error btn-sm btn"
                                    onclick="return confirm('yakin hapus {{ $item->getPegawai->nama }} dari tim {{ $item->getProyek->nama_proyek }} ?')">
                                    🗑
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
