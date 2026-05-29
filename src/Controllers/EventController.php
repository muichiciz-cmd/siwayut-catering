<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\Validator;
use App\Exceptions\NotFoundException;
use App\Services\EventService;
use App\Services\MenuService;

class EventController extends BaseController {
    public function __construct(
        private EventService $eventService,
        private MenuService $menuService
    ) {
        parent::__construct();
    }

    public function index(Request $request): void {
        $page = (int) $request->input('page', 1);
        $search = $request->input('search', '');
        $orderBy = $request->input('sort_by', 'created_at');
        $direction = $request->input('dir', 'DESC');
        $filters = [
            'status' => $request->input('status', ''),
        ];
        $result = $this->eventService->paginate($page, 10, $search, $filters, $orderBy, $direction);

        $eventIds = array_column($result['data'], 'id');
        $menuCounts = $this->menuService->countByEventIds($eventIds);
        $events = array_map(fn($e) => [...$e, 'menu_count' => $menuCounts[$e['id']] ?? 0], $result['data']);
        
        $this->render('event/index', [
            'title' => 'Events',
            'events' => $events,
            'pagination' => $result,
            'search' => $search,
            'filters' => $filters,
            'sort_by' => $orderBy,
            'dir' => $direction,
        ]);
    }

    public function create(Request $request): void {
        $this->render('event/create', [
            'title' => 'Add Event',
        ]);
    }

    public function store(Request $request): void {
        $data = $request->only(['name', 'start_date', 'end_date', 'status']);

        $validator = new Validator();
        $validator->validate($data, [
            'name' => 'required|min:3|max:100',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            if ($request->isAjax()) {
                Response::jsonError('Validation failed.', $validator->errors());
            }
            $this->withOldInput($data);
            Session::flash('errors', json_encode($validator->errors()));
            $this->redirect('/events/create');
        }

        try {
            $this->eventService->create($data);
            if ($request->isAjax()) {
                Response::jsonSuccess(null, 'Event successfully added.');
            }
            $this->redirectWithFlash('/events', 'success', 'Event successfully added.');
        } catch (\Exception $e) {
            if ($request->isAjax()) {
                Response::jsonError('Failed to add event: ' . $e->getMessage());
            }
            $this->withOldInput($data);
            Session::flash('error', 'Failed to add event: ' . $e->getMessage());
            $this->redirect('/events/create');
        }
    }

    public function apiShow(Request $request): void {
        $id = (int) $request->param('id');
        $event = $this->eventService->find($id);
        if (!$event) Response::jsonError('Not found', [], 404);
        Response::jsonSuccess($event);
    }

    public function update(Request $request): void {
        $id = (int) $request->param('id');
        $data = $request->only(['name', 'start_date', 'end_date', 'status']);

        $validator = new Validator();
        $validator->validate($data, [
            'name' => 'required|min:3|max:100',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            if ($request->isAjax()) Response::jsonError('Validation failed.', $validator->errors());
            $this->withOldInput($data);
            Session::flash('errors', json_encode($validator->errors()));
            $this->redirect("/events/{$id}/edit");
        }

        try {
            $this->eventService->update($id, $data);
            if ($request->isAjax()) Response::jsonSuccess(null, 'Event successfully updated.');
            $this->redirectWithFlash('/events', 'success', 'Event successfully updated.');
        } catch (\Exception $e) {
            if ($request->isAjax()) Response::jsonError('Update failed: ' . $e->getMessage());
            $this->withOldInput($data);
            Session::flash('error', 'Failed to update event: ' . $e->getMessage());
            $this->redirect("/events/{$id}/edit");
        }
    }

    public function destroy(Request $request): void {
        $id = (int) $request->param('id');
        
        try {
            if ($this->eventService->delete($id)) {
                $this->redirectWithFlash('/events', 'success', 'Event successfully deleted.');
            } else {
                $this->redirectWithFlash('/events', 'error', 'Failed to delete event.');
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->redirectWithFlash('/events', 'error', 'Cannot delete event. It is still used by a menu or order.');
            } else {
                $this->redirectWithFlash('/events', 'error', 'Database error: ' . $e->getMessage());
            }
        }
    }
}
