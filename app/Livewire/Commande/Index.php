<?php

namespace App\Livewire\Commande;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Table;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{

    public bool $openModal = false;
    public bool $editModal = false;
    public ?int $commandeId = null;

    // Formulaire
    public ?int $tableId = null;
    public string $notes = '';
    public string $status = 'in_progress';

    // Panier
    public array $cart = [];

    // Recherche
    public string $search = '';
    public string $searchProduct = '';
    public string $filterCategory = '';
    public string $filterStatus = '';

    public function rules(): array
    {
        return [
            'tableId'    => 'nullable|exists:tables,id',
            'notes'      => 'nullable|string|max:500',
            'status'     => 'required|in:pending,in_progress,completed,cancelled',
            'cart'       => 'required|array|min:1',
            'cart.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function addToCart(int $productId): void
    {
        $product = Product::findOrFail($productId);

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity']++;
        } else {
            $this->cart[$productId] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price,
            ];
        }

        $this->updateSubtotal($productId);
    }

    public function removeFromCart(int $productId): void
    {
        unset($this->cart[$productId]);
    }

    public function incrementQuantity(int $productId): void
    {
        $this->cart[$productId]['quantity']++;
        $this->updateSubtotal($productId);
    }

    public function decrementQuantity(int $productId): void
    {
        if ($this->cart[$productId]['quantity'] <= 1) {
            $this->removeFromCart($productId);
            return;
        }

        $this->cart[$productId]['quantity']--;
        $this->updateSubtotal($productId);
    }

    private function updateSubtotal(int $productId): void
    {
        $this->cart[$productId]['subtotal'] =
            $this->cart[$productId]['price'] * $this->cart[$productId]['quantity'];
    }

    public function getTotal(): float
    {
        return collect($this->cart)->sum('subtotal');
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

    // --- Modal ---

    public function openCreate(): void
    {
        $this->resetForm();
        $this->editModal = false;
        $this->openModal = true;
    }

    public function openEdit(int $id): void
    {
        $order = Order::with('items.product')->findOrFail($id);

        $this->commandeId = $order->id;
        $this->tableId    = $order->table_id;
        $this->notes      = $order->notes ?? '';
        $this->status     = $order->status;

        // Reconstruire le panier
        $this->cart = [];
        foreach ($order->items as $item) {
            $this->cart[$item->product_id] = [
                'name'     => $item->product->name,
                'price'    => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
            ];
        }

        $this->editModal = true;
        $this->openModal = true;
    }

    public function closeModal(): void
    {
        $this->openModal = false;
        $this->resetForm();
    }

    // --- CRUD ---

    public function store(): void
    {
        $this->validate();

        if ($this->editModal) {
            $order = Order::findOrFail($this->commandeId);

            $order->update([
                'table_id' => $this->tableId,
                'notes'    => $this->notes,
                'status'   => $this->status,
                'total'    => $this->getTotal(),
            ]);

            // Supprimer les anciens items et recréer
            $order->items()->delete();
            $this->createOrderItems($order);

            session()->flash('message', 'Commande modifiée avec succès !');
        } else {
            $order = Order::create([
                'reference' => $this->generateReference(),
                'table_id'  => $this->tableId,
                'notes'     => $this->notes,
                'status'    => 'in_progress',
                'total'     => $this->getTotal(),
            ]);

            $this->createOrderItems($order);

            session()->flash('message', 'Commande créée avec succès !');
        }

        $this->closeModal();
    }

    public function delete(int $id): void
    {
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();

        session()->flash('message', 'Commande supprimée !');
    }

    public function updateStatus(int $id, string $status): void
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);

        session()->flash('message', 'Statut mis à jour !');
    }

    // --- Helpers ---

    private function createOrderItems(Order $order): void
    {
        foreach ($this->cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'subtotal'   => $item['subtotal'],
            ]);
        }
    }

    private function generateReference(): string
    {
        return 'CMD-' . strtoupper(uniqid());
    }

    private function resetForm(): void
    {
        $this->reset(['commandeId', 'tableId', 'notes', 'status', 'cart']);
        $this->status = 'in_progress';
        $this->resetValidation();
    }


    public function render()
    {
        $orders = Order::with(['table', 'items.product'])
        ->when($this->search, fn($q) => $q->where('reference', 'like', "%{$this->search}%"))
        ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
        ->orderBy('created_at', 'desc')
        ->get();

        $tables   = Table::where('status', '!=', 'occupied')->get();
        $products = Product::orderBy('category', 'asc')
            ->orderBy('name')
            ->when($this->searchProduct, fn($q) => $q->where('name', 'like', "%{$this->searchProduct}%"))
            ->when($this->filterCategory, fn($q) => $q->where('category', $this->filterCategory))
            ->get();

        $categories = Product::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('livewire.commande.index', compact('orders', 'tables', 'products','categories'));
    }

}
