<?= $this->extend('layouts/main_admin') ?>

<?= $this->section('content') ?>

<h1 class="text-4xl font-bold text-center mb-12">Edit Posts</h1>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger text-2xl">
        </span><?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/blog/update/') ?><?=$post['post_id']?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>" />
    <div class="relative z-0 w-full mb-5 group">
        <input type="title" name="title" id="floating_title" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required
            value="<?= (old('title') != '') ? old('title') : $post['post_title'] ?>" />
        <label for="floating_title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Post Title</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <textarea name="post_content" id="floating_content" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required><?= (old('post_content') != '') ? old('post_content') : $post['post_description'] ?></textarea>
        <label for="floating_content" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Post Content</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="file" name="image" id="floating_image" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " accept="image/*" />
        <label for="floating_image" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Post Image</label>
        <img src="<?= base_url('uploads/images/' . $post['post_image']) ?>" alt="" class="w-100" id="preview_image" />
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    const image = document.getElementById('floating_image');
    const preview = document.getElementById('preview_image');

    image.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                preview.setAttribute('src', this.result);
                preview.classList.remove('hidden');
            });

            reader.readAsDataURL(file);
        }
    });

</script>

<?= $this->endSection() ?>