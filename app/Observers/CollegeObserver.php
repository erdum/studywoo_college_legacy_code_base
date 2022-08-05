<?php

namespace App\Observers;

use Modules\College\Entities\College;
use Modules\College\Entities\CollegeSubpage;

class CollegeObserver
{
    /**
     * Handle the College "created" event.
     *
     * @param  \App\Models\College  $college
     * @return void
     */
    public function created(College $college)
    {
        // dd($college);
        CollegeSubpage::create([
            'college_id'=> $college->id,
            'title'=>'Course',
            'slug'=>'course',
            'type'=>'course',
            'created_by'=>auth()->user()->id
        ]);

        CollegeSubpage::create([
            'college_id'=> $college->id,
            'title'=>'Review',
            'slug'=>'review',
            'type'=>'review',
            'created_by'=>auth()->user()->id
        ]);

        CollegeSubpage::create([
            'college_id'=> $college->id,
            'title'=>'Comment',
            'slug'=>'comment',
            'type'=>'comment',
            'created_by'=>auth()->user()->id
        ]);

        CollegeSubpage::create([
            'college_id'=> $college->id,
            'title'=>'Image',
            'slug'=>'image',
            'type'=>'image',
            'created_by'=>auth()->user()->id
        ]);

        CollegeSubpage::create([
            'college_id'=> $college->id,
            'title'=>'Video',
            'slug'=>'video',
            'type'=>'video',
            'created_by'=>auth()->user()->id
        ]);

        CollegeSubpage::create([
            'college_id'=> $college->id,
            'title'=>'Faq',
            'slug'=>'faq',
            'type'=>'faq',
            'created_by'=>auth()->user()->id
        ]);


    }

    /**
     * Handle the College "updated" event.
     *
     * @param  \App\Models\College  $college
     * @return void
     */
    public function updated(College $college)
    {
        //
    }

    /**
     * Handle the College "deleted" event.
     *
     * @param  \App\Models\College  $college
     * @return void
     */
    public function deleted(College $college)
    {
        //
    }

    /**
     * Handle the College "restored" event.
     *
     * @param  \App\Models\College  $college
     * @return void
     */
    public function restored(College $college)
    {
        //
    }

    /**
     * Handle the College "force deleted" event.
     *
     * @param  \App\Models\College  $college
     * @return void
     */
    public function forceDeleted(College $college)
    {
        //
    }
}
