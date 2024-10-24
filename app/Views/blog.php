<div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-center mb-12"><?= $title ?></h1>
    <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
        <?php foreach ($posts as $post) : ?>
            <?= view_cell('\App\Libraries\Blog::postItem', ['title' => $post]) ?>
        <?php endforeach; ?>
    </div>

</div>