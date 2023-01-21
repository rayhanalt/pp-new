<div>
    <div class="fixed top-[72px] bottom-2 right-2 left-2 flex flex-grow justify-between">
        <div>
            <a href="/pegawai/create" class="btn-outline btn-success btn-sm btn">➕ Data</a>
        </div>
        <div>
            @include('layout.notif')
        </div>
        <div>
            <input wire:model="search" type="text" class="input-info input input-sm" placeholder="Search">
        </div>
    </div>
    <table class="mt-10 table w-full">
        <!-- head -->
        <thead class="sticky top-0">
            <tr>
                <th></th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Bidang</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                @if ($item->nip == auth()->user()->nip)
                    <tr>
                        <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->getUser->jabatan }}</td>
                        <td>{{ $item->getBidang->nama_bidang }}</td>
                        <td>
                            <a href="/pegawai/{{ $item->nip }}/edit" class="btn-outline btn-accent btn-sm btn mb-1">
                                ✎
                            </a>
                        </td>
                    </tr>
                @endif
                @if ($item->nip != auth()->user()->nip)
                    <tr>
                        <th>{{ $loop->iteration + $data->FirstItem() - 1 }}</th>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->getUser->jabatan }}</td>
                        <td>{{ $item->getBidang->nama_bidang }}</td>
                        <td>
                            <a href="/pegawai/{{ $item->nip }}/edit" class="btn-outline btn-accent btn-sm btn mb-1">
                                ✎
                            </a>
                            <form action="/pegawai/{{ $item->nip }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn-outline btn-error btn-sm btn"
                                    onclick="return confirm('yakin hapus data {{ $item->nama }} ?')">
                                    🗑
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="fixed bottom-28 left-0 right-0">
        <div class="btn-group mx-auto grid w-fit grid-cols-2">
            <button wire:click="previousPage" @if ($data->onFirstPage()) disabled @endif
                class="btn-outline btn-sm btn">previous</button>

            <button wire:click="nextPage" @if (!$data->hasMorePages()) disabled @endif
                class="btn-outline btn-sm btn">next</button>
        </div>
    </div>
</div>
