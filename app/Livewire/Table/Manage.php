<?php

namespace App\Livewire\Table;

use App\Models\Table;
use Livewire\Component;

class Manage extends Component
{

    public string $name = '';
    public string $status = '';
    public int $capacity = 0;
    public string $zone = '';
    public ?int $tableId = null;

    public function rules(): array
    {
        return [
            'name'=>'required|max:255',
            'status'=>'required|max:255',
            'capacity'=>'required|min:1',
            'zone'=>'required|max:255',
        ];
    }

    public function mount(int $id = null): void
    {
        if ($id) {
            $table = Table::findOrFail($id);
            $this->tableId = $table->id;
            $this->name     = $table->name;
            $this->status   = $table->status;
            $this->capacity = $table->capacity;
            $this->zone     = $table->zone;
        }
    }

    public function render()
    {
        return view('livewire.table.manage');
    }

    public function store():void
    {
        $this->validate();

        $data = [
            'name'=> $this->name,
            'status'=> $this->status,
            'capacity'=> $this->capacity,
            'zone'=> $this->zone,
        ];

        if ($this->tableId) {
            Table::findOrFail($this->tableId)->update($data);
            session()->flash('success', 'Table mise à jour !');
        } else {
            Table::create($data);
            session()->flash('success', 'Table créée avec succès !');
        }

        

        $this->redirect('/tables');
    }

    public function update(): void
    {
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
}
