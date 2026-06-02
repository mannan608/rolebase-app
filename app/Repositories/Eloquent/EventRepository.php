<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{
    public function all()
    {
        return Event::with('seoMeta')
            ->latest()
            ->get();
    }

    public function paginate($limit = 10)
    {
        return Event::with('seoMeta')
            ->latest()
            ->paginate($limit);
    }

    public function findById($id)
    {
        return Event::with('seoMeta')->findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return Event::with('seoMeta')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update(
        $id,
        array $data
    ) {
        $event = $this->findById($id);

        $event->update($data);

        return $event;
    }

    public function delete($id)
    {
        return Event::destroy($id);
    }
}
