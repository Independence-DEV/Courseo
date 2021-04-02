<div>
    @if($course->active)
        <button wire:click="deactivate" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            Active
        </button>
    @else
        <button wire:click="activate"  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
            Inactive
        </button>
    @endif
</div>
