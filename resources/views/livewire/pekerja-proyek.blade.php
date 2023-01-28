<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <span class="btn btn-ghost btn-sm ml-2">Proyek Milik {{ Auth::user()->HasPegawai->nama }}</span>
        </div>
        <div>
            @include('layout.notif')
        </div>
        <div>
            <input wire:model="search" type="text" class="input-info input input-sm ml-2"
                placeholder="Search, if date: 'Y-m-d'">
        </div>
    </div>
    <table class="mt-10 table w-full">
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
                @can('staff')
                    <th>action</th>
                @endcan
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
                    @can('staff')
                        <td>
                            <div class="tooltip tooltip-left hover:tooltip-open"
                                data-tip="Lihat Anggota Tim Proyek {{ $item->nama_proyek }}">
                                <a href="/proyek/{{ $item->kode_proyek }}" wire:click="show({{ $item->kode_proyek }})"
                                    class="btn-info btn-outline btn btn-sm">
                                    👁
                                </a>
                            </div>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="fixed bottom-28 left-0 right-0">
        <div class="btn-group mx-auto grid w-fit grid-cols-2">
            <button wire:click="previousPage" @if ($data->onFirstPage()) disabled @endif
                class="btn-outline btn btn-sm">previous</button>

            <button wire:click="nextPage" @if (!$data->hasMorePages()) disabled @endif
                class="btn-outline btn btn-sm">next</button>
        </div>
    </div>
</div>
