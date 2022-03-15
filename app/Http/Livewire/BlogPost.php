<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class BlogPost extends Component
{
    public $categories, $title, $description, $category_id;

    // Validation Rules
    protected $rules = [
        'title'=>'required',
        'body'=>'required'
    ];

    public function render()
    {
        return view('livewire.blog-post');
    }

    public function store(){
        // Validate Form Request
        $this->validate();

        try{
            // Create Category
            Post::create([
                'title'=>$this->title,
                'description'=>$this->description
            ]);
    
            // Set Flash Message
            //session()->flash('success','Post Created Successfully!!');
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Blog Post Created Successfully!!"
            ]);

            // Reset Form Fields After Creating Post
            $this->resetFields();
        }catch(\Exception $e){
            // Set Flash Message
            //session()->flash('error','Something goes wrong while creating category!!');
            $this->dispatchBrowserEvent('alert',[
                'type'=>'error',
                'message'=>"Something goes wrong!"
            ]);

            // Reset Form Fields After Creating Post
            $this->resetFields();
        }
    }
}
