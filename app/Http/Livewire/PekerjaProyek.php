<?php

namespace App\Http\Livewire;

use App\Models\PekerjaProyek as ModelsPekerjaProyek;
use Livewire\Component;
use Livewire\WithPagination;

class pekerjaProyek extends Component
{
    use WithPagination;
    public $search;
    public $page = 1;

    protected $updatesQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']],
    ];
    public function render()
    {
        return view('livewire.pekerja-proyek', [
            'data' => $this->search === null ?
                ModelsPekerjaProyek::with('getProyek', 'getPegawai')->orderBy('id', 'desc')->Paginate(3)->withQueryString() :
                ModelsPekerjaProyek::with('getProyek', 'getPegawai')->orderBy('id', 'desc')->where('kode_pekerja_proyek', 'like', '%' . $this->search . '%')
                ->orWhere('kode_proyek', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orWhereHas('getProyek', function ($query) {
                    $query
                        ->where('nama_proyek', 'like', '%' . $this->search . '%')
                        ->where('nip', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('getPegawai', function ($query) {
                    $query
                        ->where('nama', 'like', '%' . $this->search . '%');
                })
                ->paginate(3)->withQueryString()
        ]);
    }
}
