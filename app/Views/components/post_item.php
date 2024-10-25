<div class="bg-white rounded-lg shadow-lg">
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-[100%]">
        <a href="#">
            <img class="rounded-t-lg"
                src="<?= base_url('uploads/images/' . $image) ?>" alt="Blog" class="object-cover">
        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $title ?></h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                <?php
                // if content length is more than 100 characters
                if (strlen($content) > 100) {
                    // truncate content to 100 characters
                    $content = substr($content, 0, 100) . '...';
                }
                ?>
                <?= $content ?>
            </p>
            <!-- add 2 button for edit and delete -->
            <div class="flex justify-left gap-2">
                <a href="<?= base_url('blog/edit/' . $id) ?>"
                    class="text-blue-500 hover:text-blue-700">Edit</a>
                <!-- delete in form  -->
                <form action="<?= base_url('admin/blog/delete/' . $id) ?>" method="POST">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>