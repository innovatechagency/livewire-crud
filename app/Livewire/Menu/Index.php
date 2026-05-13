<?php

namespace App\Livewire\Menu;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{

    use WithFileUploads;
    use WithPagination;

    public bool $openModal = false;
    public bool $editModal = false;
    public ?int $productId = null;

    // ---Champs de formulaire---
    public string $name = '';
    public string $category = '';
    public string $price = '';
    public int $quantity = 0;
    public  $image = null;
    public ?string $currentImage = null;

    // --- Filtres ---
    public string $search  = '';
    public string $categorySearch  = '';
    public int    $perPage = 5;

    public function rules(): array
    {
        return [
            'name'=>'required|max:255',
            'category'=>'required|max:255',
            'price'=>'required|min:1',
            'quantity'=>'required|min:1',
            'image'=> $this->editModal
            ? 'nullable|image|max:2048'
            : 'required|image|max:2048',
        ];
    }

    // ==========================================
    // HELPERS PRIVÉS
    // ==========================================

    private function resetForm(): void
    {
        $this->reset(['name', 'category', 'price', 'quantity', 'currentImage', 'productId', 'editModal']);
        $this->resetValidation();
    }


    public function render()
    {

        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->categorySearch, function ($query) {
                $query->where('category', $this->categorySearch);
            })
            ->latest()
            ->get();

        return view('livewire.menu.index', compact('products'));
    }

    // ==========================================
    // WATCHERS (pas dans un controller classique)
    // Déclenchés automatiquement quand une propriété change
    // ==========================================

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
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->currentImage = $product->image;
        $this->image = null;
        $this->editModal = true;
        $this->openModal = true;
    }

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
            'name'=>$this->name,
            'category'=>$this->category,
            'price' => $this->price,
            'quantity' =>$this->quantity
        ];

        if($this->image){
            $data['image'] = $this->image->store('produits','public');
        }

        Product::create($data);

        session()->flash('success', 'Produits créé avec succès !');
        $this->closeModal();
    }

    public function show(int $id): void
    {
        // Tu pourrais ouvrir un modal de détail ici
        $product = Product::findOrFail($id);
        // ex: $this->selectedArticle = $article;
        //     $this->isDetailOpen = true;
    }

    public function update(): void
    {
        $this->editModal = true;
        $this->validate();

        $product = Product::findOrFail($this->productId);

        $data = [
            'name'=>$this->name,
            'category'=>$this->category,
            'price' => $this->price,
            'quantity' =>$this->quantity
        ];

        if ($this->image) {
            // Supprimer l'ancienne image avant d'enregistrer la nouvelle
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->image->store('produits', 'public');
        }

        $product->update($data);

        session()->flash('success', 'Produits mis à jour !');
        $this->closeModal();
    }

    public function destroy(int $id): void
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        session()->flash('success', 'Produits supprimé !');
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
