<?php

namespace App\Http\Livewire;

use App\Models\Bidang as ModelsBidang;
use Livewire\Component;
use Livewire\WithPagination;

class Bidang extends Component
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
        return view('livewire.bidang', [
            'data' => $this->search === null ?
                ModelsBidang::orderBy('id', 'desc')->Paginate(4)->withQueryString() :
                ModelsBidang::orderBy('id', 'desc')->where('kode_bidang', 'like', '%' . $this->search . '%')
                ->orWhere('nama_bidang', 'like', '%' . $this->search . '%')
                ->paginate(4)->withQueryString()
        ]);
    }
}
