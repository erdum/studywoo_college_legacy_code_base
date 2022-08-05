<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Subpages Model
use Modules\College\Entities\CollegeSubpage;

// College Model
use Modules\College\Entities\College;

use App\Http\Controllers\CollegeController;

class CollegeSubpagesController extends Controller
{
    public function index(Request $request)
    {
        $rows = CollegeSubpage::where('college_id', $request->id)->get();

        foreach ($rows as $row)
        {
            $row->college_id = $row->college?->name;
            $row->posted_by = $row->author?->name;
            // dd($row->author->name);
        }
        
        return response()->json($rows);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        try {
            
            CollegeSubpage::create([
                'college_id' => $request->query()['id'],
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'type' => $request->type ?? '',
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'tab_name' => $request->tab_name ?? '',
                'created_by' => $request->user()->id
            ]);
            
        } catch (Exception $e) {
            dd($e);
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach ($rowsToBeEffected as $row)
        {
            $subpage = CollegeSubpage::find($row);
            
            if (!$subpage) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            CollegeController::check_and_save($request->query()['id'], $subpage, 'college_id');
            CollegeController::check_and_save($request->title, $subpage, 'title');
            CollegeController::check_and_save($request->slug, $subpage, 'slug');
            CollegeController::check_and_save($request->content, $subpage, 'content');
            CollegeController::check_and_save($request->type, $subpage, 'type');
            CollegeController::check_and_save($request->meta_title, $subpage, 'meta_title');
            CollegeController::check_and_save($request->meta_description, $subpage, 'meta_description');
            CollegeController::check_and_save($request->tab_name, $subpage, 'tab_name');
            
            $subpage->created_by = $request->user()->id;
            
            $subpage->save();
            
        }
        
        return response()->json(['message' => 'success']);        
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            CollegeSubpage::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
