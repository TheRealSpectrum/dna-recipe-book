<div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 h-9">
    <div class="grid grid-rows-1 grid-cols-4 justify-center items-center gap-3 h-full">
        <span class="col-span-1 border-gray-200 border-r align-middle"><?= $label ?></span>
        <input type="<?= $type ?>" class="col-span-3 align-middle" name="<?= $name ?>" value="<?= $inputValue ?>" <?= $attribute ?>>
    </div>
</div>