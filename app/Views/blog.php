<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="text-4xl font-bold text-center mb-12"><?= $title ?></h1>

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-3">
        <?= $this->include('partials/innerSidebar') ?>
    </div>
    <div class="col-span-9">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php foreach ($posts as $post) : ?>
                <?= view_cell('\App\Libraries\Blog::postItem', ['title' => $post]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>