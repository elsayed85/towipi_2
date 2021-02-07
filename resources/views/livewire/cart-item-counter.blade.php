<input type="number" wire:model="quantity" min="{{ $min }}" max="{{ $max }}" value="{{ $quantity }}" @error("quantity") class="valid-feedback" @enderror>
