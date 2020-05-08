<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Event as Event;
use Carbon\Carbon as Carbon;


class ProfileComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!auth()->user()->boss_id == 0) {
            $id_U = auth()->user()->boss_id;
        } else {
            $id_U = auth()->user()->id;
        }
        $now = Carbon::now()->format('Y-m-d H:i:s');
       // dd($now);
        setlocale(LC_ALL,"es_ES");
        $events = Event::where('user_id', $id_U )->where('start' ,'>',$now)->orderBy('start', 'asc')->get();
        $view->with('count', $events->count())->with('events', $events);
    }
}
