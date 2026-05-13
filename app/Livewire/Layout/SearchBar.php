<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class SearchBar extends Component
{

    public string $globalSearch = '';

    public function updatedGlobalSearch(){
        $this->dispatch('global-search-updated',$this->globalSearch);
    }

    public function render()
    {
        return view('livewire.layout.search-bar');
    }
}
