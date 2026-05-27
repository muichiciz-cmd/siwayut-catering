<div class="content-header">
    <h1 class="content-title">Events</h1>
    <a href="/events/create" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
        Add Event
    </a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($events)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem;">No events found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= e($event['id']) ?></td>
                            <td><?= e($event['name']) ?></td>
                            <td>
                                <?= e(date('d M Y', strtotime($event['start_date']))) ?> - 
                                <?= e(date('d M Y', strtotime($event['end_date']))) ?>
                            </td>
                            <td>
                                <?php if ($event['status'] === 'active'): ?>
                                    <span class="badge" style="background-color: var(--success); color: white;">Active</span>
                                <?php else: ?>
                                    <span class="badge" style="background-color: var(--text-muted); color: white;">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="/events/<?= e($event['id']) ?>/edit" class="btn btn-sm btn-secondary">Edit</a>
                                    <form method="POST" action="/events/<?= e($event['id']) ?>/delete" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        <?= \App\Core\Csrf::field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($pagination['last_page'] > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pagination['last_page']; $i++): ?>
            <a href="?page=<?= $i ?>" class="btn btn-sm <?= $i === $pagination['current_page'] ? 'btn-primary' : 'btn-secondary' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>
