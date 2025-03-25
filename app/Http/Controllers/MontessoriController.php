<?php

namespace App\Http\Controllers;

use App\Models\MontessoriAgeGroup;
use App\Models\MontessoriAreas;
use App\Models\Course;
use App\Models\CoursesAssign;
use App\Models\CourseUserPermission;
use App\Models\User;
use App\Models\CoursesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class MontessoriController extends Controller
{

    public function show(Request $request, $ageGroup, $area)
    {
        $ageGroupUrl=$ageGroup;
        $areaUrl=$area;

        $ageGroup = str_replace('-', ' ', ucfirst($ageGroup));
        $area = str_replace('-', ' ', ucfirst($area));

        $userId = Auth::id();
        $userType = Auth::user()->type;
        if ($userType == 'Superadmin' || $userType == 'Admin') {
            $query = Course::where('user_id', $userId);
        } else {
            $query = CoursesAssign::where('courses_assign.users_id', $userId)
                ->where('courses_assign.status', 1)
                ->join('courses', 'courses.id', '=', 'courses_assign.courses_id')
                ->select('courses.*'); // Select only needed fields
        }


        $query->where('courses.age_group', 'like', '%' . $ageGroup . '%')->where('courses.area', 'like', '%' . $area . '%');

        if ($request->has('name')) {
            $query->where('courses.course_full_name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('category')) {
            $query->where('courses.course_category', 'like', '%' . $request->category . '%');
        }
        $courses = $query->latest('courses.created_at')->paginate(12);

        if ($userType !== 'Superadmin' && $userType !== 'Admin') {
            $CourseUserPermission = CourseUserPermission::join('permissions', 'permissions.id', '=', 'courses_user_permissions.permission_id')
                ->where('courses_user_permissions.assign_user_id', $userId)
                ->select('courses_user_permissions.course_id', 'permissions.name')
                ->get()
                ->groupBy('course_id');
        } else {
            $CourseUserPermission = [];
        }

        // Fetch users and categories
        $users = User::where('status', 1)->get();
        $categories = CoursesCategory::where('user_id', $userId)->get();

        return view('courses.montessori_list', compact('courses', 'users', 'categories', 'CourseUserPermission', 'area', 'ageGroup','ageGroupUrl','areaUrl'));
    }




    function montessori_agegroup_delete($id)
    {

        $course = MontessoriAgeGroup::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Montenssori Age-Group deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course ID not found.');
        }
    }

    function montessori_areas_delete($id)
    {

        $course = MontessoriAreas::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Montessori Areas deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course ID not found.');
        }
    }

    function montessori_agegroup_edit($slug)
    {
        $getdata = MontessoriAgeGroup::where('slug', $slug)->first();
        $all_areas = MontessoriAreas::where('status', 1)->get();
        return view('montessori.agegroups_edit', compact('getdata', 'all_areas'));
    }

    function montessori_areas_edit($slug)
    {
        $getdata = MontessoriAreas::where('slug', $slug)->first();
        return view('montessori.areas_edit', compact('getdata'));
    }


    function montessori_areas_update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:200',
            'shortname' => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'areas_status' => 'required|in:0,1',
            'id' => 'required|exists:montessori_areas,id',


        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $slug = $this->generateUniqueSlug_agegroup($request->fullname);
            MontessoriAreas::where('id', $request->id)->update([
                'id' => (string) Str::uuid(),
                'slug' => $slug,
                'full_name' => ucwords(strtolower($request->fullname)),
                'short_name' => ucwords(strtolower($request->shortname)),
                'description' => $request->description,
                'status' => $request->areas_status,
                'updated_by' => Auth::user()->id,


            ]);
            return redirect()->route('montessori.areas_list')->with('success', 'Update Montessori Areas successfully!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }



    function montessori_agegroup_update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:200',
            'shortname' => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'age_status' => 'required|in:0,1',

            'id' => 'required|exists:montessori_age_groups,id',


        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $slug = $this->generateUniqueSlug_agegroup($request->fullname);
            MontessoriAgeGroup::where('id', $request->id)->update([
                'id' => (string) Str::uuid(),
                'slug' => $slug,
                'full_name' => ucwords(strtolower($request->fullname)),
                'short_name' => ucwords(strtolower($request->shortname)),
                'description' => $request->description,
                'status' => $request->age_status,
                'updated_by' => Auth::user()->id,

            ]);
            return redirect()->route('montessori.age_groups')->with('success', 'Update Montessori Age-Group successfully!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    function montessori_agegroup_stores(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:200',
            'shortname' => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'age_status' => 'required|in:0,1',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $slug = $this->generateUniqueSlug_agegroup($request->fullname);
            MontessoriAgeGroup::create([
                'id' => (string) Str::uuid(),
                'slug' => $slug,
                'full_name' => ucwords(strtolower($request->fullname)),
                'short_name' => ucwords(strtolower($request->shortname)),
                'description' => $request->description,
                'status' => $request->age_status,
                'created_by' => Auth::user()->id,


            ]);
            return redirect()->route('montessori.age_groups')->with('success', 'Create Montessori Age-Group successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function generateUniqueSlug_agegroup($FullName)
    {
        $slug = Str::slug($FullName);
        $originalSlug = $slug;
        $counter = 1;
        while (MontessoriAgeGroup::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }


    function montessori_areas_stores(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:200',
            'shortname' => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'areas_status' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $slug = $this->generateUniqueSlug($request->fullname);
            MontessoriAreas::create([
                'id' => (string) Str::uuid(),
                'slug' => $slug,
                'full_name' => ucwords(strtolower($request->fullname)),
                'short_name' => ucwords(strtolower($request->shortname)),
                'description' => $request->description,
                'status' => $request->areas_status,
                'created_by' => Auth::user()->id,

            ]);
            return redirect()->route('montessori.areas_list')->with('success', 'Create Montessori Areas successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    private function generateUniqueSlug($FullName)
    {
        $slug = Str::slug($FullName);
        $originalSlug = $slug;
        $counter = 1;
        while (MontessoriAreas::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }



    function montessori_areas_list()
    {
        $all_areas = MontessoriAreas::orderBy('created_at', 'asc')->get();

        return view('montessori.areas_list', compact('all_areas'));
    }

    function montessori_agegroup_list()
    {
        $all_agegroups = MontessoriAgeGroup::orderBy('created_at', 'asc')->get();

        return view('montessori.agegroups_list', compact('all_agegroups'));
    }


    function montessori_areas_create()
    {
        return view('montessori.areas_create');
    }

    function montessori_agegroup_create()
    {
        $all_areas = MontessoriAreas::where('status', 1)->get();

        return view('montessori.agegroups_create', compact('all_areas'));
    }
}
