<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pet;
use App\Models\PetAdoption;
use App\Models\Specie;
use App\Models\Breed;
use App\Models\PrimaryColor;
use App\Models\Age;
use App\Models\Size;

class PetAdoptions extends Component
{
    use WithPagination;

    public $specie;
    public $breed;
    public $primaryColor;
    public $age;
    public $size;
    public $gender;
    public $search = '';
    public $perPage = 9;

    protected $queryString = [
        'specie' => ['except' => ''],
        'search' => ['except' => ''],
        'breed' => ['except' => ''],
        'primaryColor' => ['except' => ''],
        'age' => ['except' => ''],
        'size' => ['except' => ''],
        'gender' => ['except' => ''],
    ];

    public function render()
    {
        sleep(1);
        $species = Specie::all();

        $breeds = collect();
        if (!empty($this->specie)) {
            $breeds = Breed::where('specie_id', $this->specie)->get();
        }

        $primaryColors = PrimaryColor::all();
        $ages = Age::all();
        $sizes = Size::all();

        $litsPetAdoptions = PetAdoption::query()
            ->where('adopted', false)
            ->when($this->specie, function ($query) {
                $query->whereHas('pet.breed.specie', function ($query) {
                    $query->where('specie_id', $this->specie);
                });
            })
            ->when($this->breed, function ($query) {
                $query->whereHas('pet.breed', function ($query) {
                    $query->where('breed_id', $this->breed);
                });
            })
            ->when($this->primaryColor, function ($query) {
                $query->whereHas('pet.primaryColor', function ($query) {
                    $query->where('primary_color_id', $this->primaryColor);
                });
            })
            ->when($this->age, function ($query) {
                $query->whereHas('pet.age', function ($query) {
                    $query->where('age_id', $this->age);
                });
            })
            ->when($this->size, function ($query) {
                $query->whereHas('pet.size', function ($query) {
                    $query->where('size_id', $this->size);
                });
            })
            ->when($this->gender, function ($query) {
                $query->whereHas('pet', function ($query) {
                    $query->where('gender', $this->gender);
                });
            })
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->perPage);

        return view('livewire.pet-adoptions', [
            'litsPetAdoptions' => $litsPetAdoptions,
            'species' => $species,
            'breeds' => $breeds,
            'primaryColors' => $primaryColors,
            'ages' => $ages,
            'sizes' => $sizes,
        ]);
    }

    public function updatedSpecie()
    {
        $this->resetPage();
    }

    public function updatedBreed()
    {
        $this->resetPage();
    }

    public function updatedPrimaryColor() {
        $this->resetPage();
    }

    public function updatedAge() {
        $this->resetPage();
    }

    public function updatedSize() {
        $this->resetPage();
    }

    public function updatedGender() {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
