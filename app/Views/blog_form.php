<form action="/admin/blog/new" method="post">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" />
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id=""></textarea>
    </div>
    <input type="text" name="honeypot" style="display:none;">
    <div>
        <input type="submit" value="Create">
    </div>
</form>