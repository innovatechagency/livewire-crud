<?php

namespace App\Livewire\Reservation;

use App\Models\Reservation;
use App\Models\Table;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public bool $openModal = false;
    public bool $editModal = false;
    public ?int $reservationId = null;
    public ?int $openDropdown = null;

    public ?int $tableId = null;
    public string $guest_name = '';
    public string $guest_phone = '';
    public string $reservation_date = '';
    public string $reservation_time = '';
    public ?int $guest_count = 1;

    public string $search = '';

    public function rules(): array
    {
        return [
            'tableId' => 'required|exists:tables,id',
            'guest_name' => 'required|max:255',
            'guest_phone' => 'required|max:20',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'guest_count' => 'required|integer|min:1',
        ];
    }

    public function toggleDropdown(int $id): void
    {
        $this->openDropdown = $this->openDropdown === $id ? null : $id;
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

    public function openEdite(int $id):void
    {
        $reservation = Reservation::findOrFail($id);

        $this->reservationId = $reservation->id;
        $this->tableId = $reservation->table_id;
        $this->guest_name = $reservation->guest_name;
        $this->guest_phone = $reservation->guest_phone;
        $this->reservation_date = $reservation->reservation_date;
        $this->reservation_time = $reservation->reservation_time;
        $this->guest_count = $reservation->guest_count;
        $this->editModal = true;
        $this->openModal = true;
    }

    public function closeModal(): void
    {
        $this->openModal = false;
        $this->resetForm();
    }

    public function store()
    {

        $this->validate();

        if ($this->editModal) {
            $reservation = Reservation::findOrFail($this->reservationId);
            $reservation->update([
                'table_id'         => $this->tableId,
                'guest_name'       => $this->guest_name,
                'guest_phone'      => $this->guest_phone,
                'reservation_date' => $this->reservation_date,
                'reservation_time' => $this->reservation_time,
                'guest_count'      => $this->guest_count,
            ]);
            session()->flash('message', 'Réservation modifiée avec succès !');
        } else {
            Reservation::create([
                'table_id'         => $this->tableId,
                'guest_name'       => $this->guest_name,
                'guest_phone'      => $this->guest_phone,
                'reservation_date' => $this->reservation_date,
                'reservation_time' => $this->reservation_time,
                'guest_count'      => $this->guest_count,
                'status'           => 'pending',
            ]);
            session()->flash('message', 'Réservation créée avec succès !');
        }

        $this->closeModal();
    }

    public function show (int $id): void
    {
        Reservation::findOrFail($id);
    }

    public function destroy(int $id): void
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        session()->flash('message', 'Réservation supprimée avec succès !');
    }

    public function confirmReservation(int $id):void
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);
        $reservation->table->update(['status' => 'reserved']);
        session()->flash('message', 'Réservation confirmée !');
    }

    public function markAsOccupied(int $id):void
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'completed']);
        $reservation->table->update(['status' => 'occupied']);
        session()->flash('message', 'Table marquée comme occupée !');
    }

    public function cancelReservation(int $id):void
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'canceled']);
        $reservation->table->update(['status' => 'available']);
        session()->flash('message', 'Réservation annulée !');
    }

    public function freeTable(int $id):void
    {
        $table = Table::findOrFail($id);
        $table->update(['status' => 'available']);
        session()->flash('message', 'Table libérée !');
    }

    private function resetForm(): void
    {
        $this->reset(['tableId', 'guest_name', 'guest_phone', 'reservation_date', 'reservation_time', 'guest_count']);
        $this->resetValidation();
    }


    public function render()
    {

        $tables = Table::with(['reservations' => function ($query) {
            $query->whereIn('status', ['pending', 'confirmed', 'completed'])
                ->latest(); // la plus récente en premier
        }])
        ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
        ->get();

        $reservations = Reservation::with('table')
            ->when($this->search, fn($q) => $q->where('guest_name', 'like', "%{$this->search}%"))
            ->orderBy('reservation_time')
            ->get();


        return view('livewire.reservation.index', compact('tables', 'reservations'));
    }
}
