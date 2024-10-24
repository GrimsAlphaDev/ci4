<?= $this->extend('layouts/main_admin') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    .dataTables_length label {
        display: flex;
        align-items: center;
        /* untuk menyelaraskan ikon dan teks */
    }

    .dataTables_length label select {
        margin-left: 0.5rem;
        /* jarak antara ikon dan teks */
        width: 4rem;
        /* lebar dropdown */
        margin-right: 1rem;
        /* jarak antara dropdown dan teks */
    }
</style>

<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium mb-4">ALL Posts</h3>
    <div class="w-full mt-8 overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table id="example" class="display w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($posts as $post) : ?>
                        <tr class="text-gray-700">
                            <td class="px-4 py-3"><?= $no++ ?></td>
                            <td class="px-4 py-3"><img src="<?= $post['post_image'] ?>" alt="<?= $post['post_title'] ?>"
                                    class="w-20 h-20"></td>
                            <td class="px-4 py-3"><?= $post['post_title'] ?></td>
                            <td class="px-4 py-3"><?= $post['post_description'] ?></td>
                            <td class="px-4 py-3"><?= $post['username'] ?></td>
                            <td class="px-4 py-3 flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">
                                <a href=""
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                <form action="" method="post" class="inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            searching: true,
            paging: true,
            ordering: true,
        });
    });
</script>
<?= $this->endSection() ?>