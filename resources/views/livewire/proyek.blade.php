<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/proyek/create" class="btn-success btn-outline btn btn-sm mr-2">➕ Data</a>
        </div>
        <div>
            @include('layout.notif')
        </div>
        <div>
            <input wire:model="search" type="text" class="input-info input input-sm ml-2"
                placeholder="Search, if date: 'Y-m-d'">
        </div>
    </div>
    <table class="table-compact mt-10 table w-full">
        <!-- head -->
        <thead>
            <tr>
                <th></th>
                <th>Kode Proyek</th>
                <th>Nama Proyek</th>
                <th>Penanggung Jawab</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Tanggal Dibuat</th>
                <th>Nama Mitra</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                    <td>{{ $item->kode_proyek }}</td>
                    <td>{{ $item->nama_proyek }}</td>
                    <td>{{ $item->getPegawai->nama }} | {{ $item->getPegawai->getUser->jabatan }}</td>
                    <td>{{ date('d F Y', strtotime($item->tgl_mulai)) }}</td>
                    <td>{{ date('d F Y', strtotime($item->tgl_selesai)) }}</td>
                    <td>{{ date('d F Y', strtotime($item->tgl_dibuat)) }}</td>
                    <td>{{ $item->nama_mitra }}</td>
                    <td>
                        <a href="/proyek/{{ $item->kode_proyek }}/edit" class="btn-accent btn-outline btn btn-sm mb-1">
                            ✎
                        </a>
                        <form action="/proyek/{{ $item->kode_proyek }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn-outline btn-error btn btn-sm mb-1"
                                onclick="return confirm('yakin hapus data {{ $item->nama_proyek }} ?')">
                                🗑
                            </button>
                        </form>
                        <div class="tooltip tooltip-left hover:tooltip-open"
                            data-tip="Lihat Anggota Tim Proyek {{ $item->nama_proyek }}">
                            <a href="/proyek/{{ $item->kode_proyek }}" wire:click="show({{ $item->kode_proyek }})"
                                class="btn-info btn-outline btn btn-sm">
                                👁
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="fixed bottom-10 left-0 right-0 md:bottom-28">
        <div class="btn-group mx-auto grid w-fit grid-cols-2">
            <button wire:click="previousPage" @if ($data->onFirstPage()) disabled @endif
                class="btn-outline btn btn-sm">previous</button>

            <button wire:click="nextPage" @if (!$data->hasMorePages()) disabled @endif
                class="btn-outline btn btn-sm">next</button>
        </div>
    </div>
</div>
