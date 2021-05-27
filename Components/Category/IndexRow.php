<!-- Parts of code are copyrighted 2020 Mert Cukuren. Code released under the MIT license. See ThirdParty/Licenses/Tailblocks -->

<div class="bg-gray-800 bg-opacity-40 rounded-lg px-6 py-3">
    <div class="grid grid-rows-1 grid-cols-5 justify-center items-center">
        <form action="/categories/<?= $category->id ?>" method="get" class="col-span-3">
            <button type="submit" class="border-color-gray-200 border-2 p-1 m-1 rounded-lg text-gray-100"><?= $category->title ?></button>
        </form>
        <form action="/categories/<?= $category->id ?>/edit" method="get" class="col-span-1">
            <button type="submit" class="bg-green-700 p-1 m-1 rounded-lg text-gray-100">Edit</button>
        </form>
        <form action="/categories/<?= $category->id ?>" method="post" class="col-span-1">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="bg-red-700 p-1 m-1 rounded-lg text-gray-100">Delete</button>
        </form>
    </div>
</div>