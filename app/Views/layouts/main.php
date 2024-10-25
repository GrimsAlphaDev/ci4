<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (isset($meta_title) ? $meta_title : 'CodeIgniter4') ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>css/tailwind/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <?= $this->include('partials/navbar') ?>

    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-8">
        <?= $this->renderSection('content') ?>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $this->renderSection('script') ?>
    <script>
        // Mobile Menu Toggle
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            iconMenu.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });

        // Dropdown Toggle (similar logic)
        const userMenuButton = document.getElementById('user-menu-button');
        const dropdownMenu = document.querySelector('[role="menu"]');

        userMenuButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (session()->getFlashdata('success')): ?>
                Swal.fire({
                    title: 'Success!',
                    text: '<?= session()->getFlashdata('success') ?>',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            <?php elseif (session()->getFlashdata('error')): ?>
                Swal.fire({
                    title: 'Error!',
                    text: '<?= session()->getFlashdata('error') ?>',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            <?php elseif (session()->getFlashdata('validation')): ?>
                const errors = <?= json_encode(session()->getFlashdata('validation')) ?>;
                const errorMessages = Object.values(errors).flat().join('\n'); // Gabungkan semua pesan error
                Swal.fire({
                    title: 'Kesalahan Input!',
                    text: errorMessages,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>
        });
    </script>

</body>

</html>