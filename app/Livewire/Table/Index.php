<?php

namespace App\Livewire\Table;

use App\Models\Table;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public bool $openModal = false;
    public bool $editModal = false;
    public ?int $tableId = null;



    // --- Filtres ---
    public string $search  = '';



    public function render()
    {
        $tables = Table::query()
                    ->when($this->search,function($query){
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->latest()
                    ->get();

        return view('livewire.table.index', compact('tables'));
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[On('global-search-updated')]
    public function updateSearch($value)
    {
        $this->search = $value;
    }

    public function openCreate():void
    {
        $this->resetForm();
        $this->editModal = false;
        $this->openModal = true;
    }

    // public function openEdite(int $id):void
    // {
    //     $table = Table::findOrFail($id);

    //     $this->tableId = $table->id;
    //     $this->name = $table->name;
    //     $this->status = $table->status;
    //     $this->capacity = $table->capacity;
    //     $this->zone = $table->zone;
    //     $this->editModal = true;
    //     $this->openModal = true;
    // }

    public function closeModal(): void
    {
        $this->openModal = false;
        $this->resetForm();
    }

    public function store():void
    {
        $this->editModal = false;
        $this->validate();

        $data = [
            'name'=> $this->name,
            'status'=> $this->status,
            'capacity'=> $this->capacity,
            'zone'=> $this->zone,
        ];

        Table::create($data);

        session()->flash('success', 'Table créé avec succès !');
        $this->closeModal();
    }

    public function update(): void
    {
        $this->editModal = true;
        $this->validate();

        $table = Table::findOrFail($this->tableId);

        $data = [
            'name'=> $this->name,
            'status'=> $this->status,
            'capacity'=> $this->capacity,
            'zone'=> $this->zone,
        ];

        $table->update($data);

        session()->flash('success', 'Table mis à jour !');
        $this->closeModal();
    }

    public function destroy(int $id): void
    {
        $table = Table::findOrFail($id);

        $table->delete();

        session()->flash('success', 'Table supprimé !');
    }

    public function save()
    {
        if ($this->editModal) {
            $this->update();
        } else {
            $this->store();
        }
    }
}
