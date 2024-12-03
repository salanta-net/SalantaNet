<?php

namespace App\Livewire;

use App\Models\Snippet;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Trix extends Component
{
    use WithFileUploads;

    public Snippet $form;

    public $value;
    public $trixId;
    public $photos = [];

    protected $rules = [
        'value' => 'required',
    ];

    public function mount($value = ''){
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updatedContent($value){
        $this->dispatch('trix_value_updated',value: $value);
    }

    public function completeUpload(string $uploadedUrl, string $trixUploadCompletedEvent){

        foreach($this->photos as $photo){
            if($photo->getFilename() == $uploadedUrl) {
                // store in the public/photos location
                $newFilename = $photo->store('public/photos');

                // get the public URL of the newly uploaded file
                $url = Storage::url($newFilename);

                $this->dispatchBrowserEvent($trixUploadCompletedEvent, [
                    'url' => $url,
                    'href' => $url,
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.trix');
    }
}
