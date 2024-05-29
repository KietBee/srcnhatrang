<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Story;
use App\Models\Category;

class ListNewAndPost extends Component
{
    use WithPagination;

    public $category;
    public $search = '';
    public $perPage = 9;

    protected $queryString = [
        'category' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function render()
    {
        sleep(1);
        $categories = Category::all();

        $stories = Story::query()
            ->where('is_approved', true)
            ->when(!empty($this->category), function ($query) {
                $query->whereHas('storyCategories.category', function ($subquery) {
                    $subquery->where('category_id', $this->category);
                });
            })
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->perPage);

        return view('livewire.list-new-and-post', [
            'stories' => $stories,
            'categories' => $categories,
        ]);
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
