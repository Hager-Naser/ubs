Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('dashboard')->name('dashboard')->group(function () {

                Route::get('/', [DashboardController::class, "index"]);
                //////////////////////departments////////////////////////////////////////
                Route::prefix('/sections')->name('.sections')->group(function () {

                    Route::get('/', [SectionController::class, "index"]);
                    Route::get('/add', [SectionController::class, "add"])->name('.add');
                    Route::post('/store', [SectionController::class, "store"])->name('.store');
                    Route::get('/edit/{id}', [SectionController::class, "find"])->name('.indexEdit');
                    Route::post('/edit/{id}', [SectionController::class, "update"])->name('.edit');
                    Route::delete("/delete/{id}", [SectionController::class, "delete"])->name(".delete");
                });
                Route::prefix("/doctors")->name(".doctors")->group(function(){
                    Route::get('/', [DoctorController::class, "index"]);
                });
            });
        });



<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard.index');
    }
}



<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    // public function __construct(protected SectionService $section)
    // {
    // }
    public function index()
    {
        $sections = Section::paginate(PAGINATION_COUNT);
        return view("Dashboard.departments", compact("sections"));
    }
    public function add()
    {
        return view('Dashboard.add-department');
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:150|min:10|unique:section_translations,name",
                "description" => "string|min:10|nullable",
                "status" => "required|boolean"
            ],
            [
                "name.required" => "Name is required",
                "name.unique" => "Name must be unique",
                "name.string" => "Name must be string",
                "name.max"   => "Name must be 150 maximum char",
                "name.min"  => "Name must be 10 minumum char",
                "description.string" => "description must be string",
                "description.min" => "description must be 10 minumum char",
                "status.required" => "Status is required",
                "status.boolean" => "Status must be 0 or 1",
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        Section::create($request->all());
        return redirect()->route('admin.dashboard.sections')->with('add', 'Section Added Successfully');
    }
    public function find($id){
        $section = Section::find($id);
        return view("Dashboard.edit-department" , compact("section"));
    }
    public function update(Request $request , int $id){
        // dd($request->id);
        $section_id_trans = Section::where("section_id" , $id)->first();
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:150|min:10|unique:section_translations,name,$section_id_trans->id",
                "description" => "string|min:10|nullable",
                "status" => "required|boolean"
            ],
            [
                "name.required" => "Name is required",
                "name.unique" => "Name must be unique",
                "name.string" => "Name must be string",
                "name.max"   => "Name must be 150 maximum char",
                "name.min"  => "Name must be 10 minumum char",
                "description.string" => "description must be string",
                "description.min" => "description must be 10 minumum char",
                "status.required" => "Status is required",
                "status.boolean" => "Status must be 0 or 1",
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $section = Section::findOrFail($id);
        $section = $section->update($request->all());
        return redirect()->route("admin.dashboard.sections");
    }
    public function delete(int $id){
        $section = Section::findOrFail($id);
        $section = $section->delete();
        return redirect()->route("admin.dashboard.sections");
    }
}
