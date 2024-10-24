<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1 class="text-4xl font-bold text-center mb-12"><?= $title ?></h1>

<p class="text-center text-gray-500 dark:text-gray-400 mb-12"><?= $post['post_description']?></p>

<div class="grid grid-cols-6 gap-2">
    <!-- form delete button -->
    <form action="<?= base_url('blog/post/') ?><?= $post['post_id'] ?>" method="post" class="sm:col-span-1 md:col-span-1 col-span-3">
        <!-- override method -->
        <input type="hidden" name="_method" value="DELETE">
        <!-- csrf -->
        <input hidden name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 " onclick="return confirm('yakin ingin menghapus data ini ?')">Delete</button>
    </form>
    <!-- editbutton -->
    <a href="<?= base_url('blog/edit/') ?><?= $post['post_id'] ?> " class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:col-span-1 md:col-span-1 col-span-3">Edit</a>
</div>


<?= $this->endSection() ?>