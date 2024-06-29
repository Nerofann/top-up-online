<div class="row mb-2">
    <div class="col-6 mb-2">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" required wire:model.live="name" wire:blur.debounce="generate()">
    </div>

    <div class="col-6 mb-2">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" disabled wire:model="slug">
    </div>
</div>
