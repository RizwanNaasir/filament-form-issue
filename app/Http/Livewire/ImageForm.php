<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ImageForm extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;


    public function mount(): void
    {
        $image = Image::query()->first();
        if(isset($image)){
            $this->form->fill([
                'name' => Storage::url($image->name),
                //Which returns => '/storage/lhzqVslif5W4rivcnSnOr4RCeJFwLo0b0kNp8Z3r.jpg'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.image-form');
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('name')->required()
        ];
    }

    public function submit(): void
    {
        $imageModel = new Image();
        $imageModel->name = $this->getImageName();
        $imageModel->save();
    }

    protected function getFormModel(): string
    {
        return Image::class;
    }

    /*
     * just to get image from first element in array.
     * */
    private function getImageName(): mixed
    {
        return collect($this->name)->map(function ($file) {
            return $file->store('public');
        })->first();
    }
}
