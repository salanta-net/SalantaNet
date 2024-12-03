<x-trix-field id="{{ $trixId }}" name="{{ $trixId }}"  wire:model.live="value" placeholder="{{ __('Share something in a snippet...') }}" autocomplete="off" />




{{--<div  wire:ignore>--}}
{{--    <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}" >--}}
{{--    <trix-editor wire:ignore input="{{ $trixId }}" class="prose prose-slate max-w-none prose-li:my-0" ></trix-editor>--}}

{{--    <script>--}}
{{--        var trixEditor = document.getElementById("{{ $trixId }}")--}}
{{--        var mimeTypes = ["image/png", "image/jpeg", "image/jpg"];--}}

{{--        addEventListener("trix-blur", function(event) {--}}
{{--            @this.set('value', trixEditor.getAttribute('value'))--}}
{{--            $wire.dispatch('trix_value_updated',{value: trixEditor.getAttribute('value')});--}}
{{--        });--}}


{{--        addEventListener("trix-file-accept", function(event) {--}}
{{--            if (! mimeTypes.includes(event.file.type) ) {--}}
{{--                // file type not allowed, prevent default upload--}}
{{--                return event.preventDefault();--}}
{{--            }--}}
{{--        });--}}

{{--        addEventListener("trix-attachment-add", function(event){--}}
{{--            uploadTrixImage(event.attachment);--}}
{{--        });--}}

{{--        function uploadTrixImage(attachment){--}}
{{--            // upload with livewire--}}
{{--        @this.upload(--}}
{{--            'photos',--}}
{{--            attachment.file,--}}
{{--            function (uploadedURL) {--}}

{{--                // We need to create a custom event.--}}
{{--                // This event will create a pause in thread execution until we get the Response URL from the Trix Component @completeUpload--}}
{{--                const trixUploadCompletedEvent = `trix-upload-completed:${btoa(uploadedURL)}`;--}}
{{--                const trixUploadCompletedListener = function(event) {--}}
{{--                    attachment.setAttributes(event.detail);--}}
{{--                    window.removeEventListener(trixUploadCompletedEvent, trixUploadCompletedListener);--}}
{{--                }--}}

{{--                window.addEventListener(trixUploadCompletedEvent, trixUploadCompletedListener);--}}

{{--                // call the Trix Component @completeUpload below--}}
{{--            @this.call('completeUpload', uploadedURL, trixUploadCompletedEvent);--}}
{{--            },--}}
{{--            function() {},--}}
{{--            function(event){--}}
{{--                attachment.setUploadProgress(event.detail.progress);--}}
{{--            },--}}
{{--        )--}}
{{--            // complete the upload and get the actual file URL--}}
{{--        }--}}
{{--    </script>--}}
{{--</div>--}}
