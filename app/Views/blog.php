<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="text-4xl font-bold text-center mb-12"><?= $title ?></h1>

<div class="grid gap-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-center content-center">
        <?php foreach ($posts as $post) : ?>
            <?= view_cell('\App\Libraries\Blog::postItem', ['title' => $post['post_title'], 'content' => $post['post_description'], 'image' => $post['post_image'], 'id' => $post['post_id']]) ?>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>