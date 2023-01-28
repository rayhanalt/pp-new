@extends('app')
@section('content')
    <div>
        <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
            <div>
                @cannot('staff')
                    <a href="/pekerjaProyek/create/{{ $item->kode_proyek }}" class="btn-success btn-outline btn btn-sm mr-2">➕
                        Data</a>
                @endcannot
            </div>
            <div>
                @include('layout.notif')
            </div>
            <div>
                <span class="btn btn-ghost btn-sm ml-2">{{ $item->nama_proyek }} | {{ $item->getPegawai->nama }}</span>
            </div>
        </div>
        <table class="mt-10 table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TIM</th>
                    @cannot('staff')
                        <th class="text-center">action</th>
                    @endcannot
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->getPegawai->nama }}</td>
                        @cannot('staff')
                            <td class="text-center">
                                <form action="/pekerjaProyek/{{ $item->kode_pekerja_proyek }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn-outline btn-error btn btn-sm"
                                        onclick="return confirm('yakin hapus {{ $item->getPegawai->nama }} dari tim {{ $item->getProyek->nama_proyek }} ?')">
                                        🗑
                                    </button>
                                </form>
                            </td>
                        @endcannot
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
