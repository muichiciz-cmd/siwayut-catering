<div class="content-header">
    <h1 class="content-title">Edit Event</h1>
    <a href="/events" class="btn btn-secondary">
        &larr; Back to Events
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/events/<?= e($event['id']) ?>">
            <?= \App\Core\Csrf::field() ?>

            <?php component('form/input', [
                'name' => 'name',
                'label' => 'Event Name',
                'value' => old('name', $event['name']),
                'required' => true
            ]); ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <?php component('form/input', [
                    'name' => 'start_date',
                    'label' => 'Start Date',
                    'type' => 'date',
                    'value' => old('start_date', $event['start_date']),
                    'required' => true
                ]); ?>

                <?php component('form/input', [
                    'name' => 'end_date',
                    'label' => 'End Date',
                    'type' => 'date',
                    'value' => old('end_date', $event['end_date']),
                    'required' => true
                ]); ?>
            </div>

            <?php component('form/select', [
                'name' => 'status',
                'label' => 'Status',
                'options' => [
                    'active' => 'Active',
                    'inactive' => 'Inactive'
                ],
                'value' => old('status', $event['status']),
                'required' => true
            ]); ?>

            <div style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Update Event</button>
            </div>
        </form>
    </div>
</div>
