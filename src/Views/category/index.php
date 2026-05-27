<div class="content-header">
    <h1 class="content-title"><?= htmlspecialchars($title ?? 'Menu Categories') ?></h1>
    <a href="/categories/create" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
        Add Category</a>
</div>

<div class="card">
    <?php if (empty($categories)): ?>
    <div class="empty-state">
        <p>No categories found.</p>
    </div>
    <?php else: ?>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= htmlspecialchars($cat['name']) ?></td>
                    <td><?= htmlspecialchars($cat['slug']) ?></td>
                    <td>
                        <div class="table-actions">
                            <a href="/categories/<?= $cat['id'] ?>/edit" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="/categories/<?= $cat['id'] ?>/delete" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                <?= \App\Core\Csrf::field() ?>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
