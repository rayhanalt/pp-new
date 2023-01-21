<?php

namespace App\Http\Livewire;

use App\Models\Pegawai as ModelsPegawai;
use Livewire\Component;
use Livewire\WithPagination;

class Pegawai extends Component
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
        return view('livewire.pegawai', [
            "data" => $this->search === null ?
                ModelsPegawai::with('getBidang')->orderBy('id', 'desc')->paginate(3)->withQueryString() :
                ModelsPegawai::with('getBidang')->orderBy('id', 'desc')->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orWhereHas('getBidang', function ($query) {
                    $query->where('nama_bidang', 'like', '%' . $this->search . '%');
                })
                ->paginate(3)->withQueryString()
        ]);
    }
}
