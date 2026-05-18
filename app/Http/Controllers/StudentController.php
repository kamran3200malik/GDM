<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use App\Models\Unit;
use App\Models\Rank;
use App\Models\Trade;
use App\Models\Section;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with(['user.role', 'unit', 'rank', 'trade', 'section', 'religion'])
            ->when($request->search, function($query, $search) {
                $query->where('student_name', 'like', "%{$search}%")
                    ->orWhere('form_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('email', 'like', "%{$search}%");
                    });
            })
            ->when($request->class, function($query, $class) {
                $query->where('class', $class);
            })
            ->orderBy('student_name')
            ->paginate(10);

        return Inertia::render('Students/Index', [
            'students' => $students,
            'filters' => $request->only(['search', 'class']),
        ]);
    }

    public function create()
    {
        $units = Unit::where('is_active', true)->get();
        $ranks = Rank::where('is_active', true)->get();
        $trades = Trade::where('is_active', true)->get();
        $sections = Section::where('is_active', true)->get();
        $religions = Religion::where('is_active', true)->get();
        
        return Inertia::render('Students/Create', [
            'units' => $units,
            'ranks' => $ranks,
            'trades' => $trades,
            'sections' => $sections,
            'religions' => $religions,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'bloodgroup' => 'nullable|in:A+ve,A-ve,B+ve,B-ve,AB+ve,AB-ve,O+ve,O-ve',
            'place_of_birth' => 'nullable|string|max:255',
            'stu_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'admission_type' => 'nullable|in:new_admission,transfer,readmission',
            'class' => 'nullable|in:Junior,Senior,Advance',
            'pak_no' => 'nullable|string|max:50',
            'unit_id' => 'nullable|exists:units,id',
            'trade_id' => 'nullable|exists:trades,id',
            'section_id' => 'nullable|exists:sections,id',
            'religion_id' => 'nullable|exists:religions,id',
            'rank_id' => 'nullable|exists:ranks,id',
            'admission_class' => 'nullable|in:Junior,Senior,Advance',
            'admission_section_id' => 'nullable|exists:sections,id',
            'office_phone' => 'nullable|string|max:20',
            'whatsapp_no' => 'nullable|string|max:20',
            'mobile_no' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:100',
            'admission_date' => 'required|date',
            'student_group' => 'nullable|string|max:100',
            'using_van' => 'boolean',
            'admission_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'directress' => 'nullable|string|max:255',
            'reason' => 'nullable|string|max:500',
            'devices_health_issues' => 'boolean',
            'note' => 'nullable|string|max:1000',
            'polio_vaccination' => 'boolean',
            'grandparents_alive' => 'boolean',
            'prospectus_issued' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('stu_image')) {
            $image = $request->file('stu_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('students/images', $imageName, 'public');
        }

        $student = Student::create([
            'user_id' => null, // No user account for now
            'form_number' => $this->generateFormNumber(),
            'student_name' => $request->student_name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'bloodgroup' => $request->bloodgroup,
            'place_of_birth' => $request->place_of_birth,
            'stu_image' => $imagePath,
            'admission_type' => $request->admission_type,
            'class' => $request->class,
            'pak_no' => $request->pak_no,
            'unit_id' => $request->unit_id,
            'trade_id' => $request->trade_id,
            'section_id' => $request->section_id,
            'religion_id' => $request->religion_id,
            'rank_id' => $request->rank_id,
            'admission_class' => $request->admission_class,
            'admission_section_id' => $request->admission_section_id,
            'office_phone' => $request->office_phone,
            'whatsapp_no' => $request->whatsapp_no,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'category' => $request->category,
            'admission_date' => $request->admission_date,
            'student_group' => $request->student_group,
            'using_van' => $request->using_van ?? false,
            'admission_year' => $request->admission_year,
            'directress' => $request->directress,
            'reason' => $request->reason,
            'devices_health_issues' => $request->devices_health_issues ?? false,
            'note' => $request->note,
            'polio_vaccination' => $request->polio_vaccination ?? false,
            'grandparents_alive' => $request->grandparents_alive ?? true,
            'prospectus_issued' => $request->prospectus_issued ?? false,
            'is_active' => true,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['user.role', 'unit', 'rank', 'trade', 'section', 'religion']);
        
        return Inertia::render('Students/Show', [
            'student' => $student,
        ]);
    }

    public function edit(Student $student)
    {
        $student->load(['user', 'unit', 'rank', 'trade', 'section', 'religion']);
        
        $units = Unit::where('is_active', true)->get();
        $ranks = Rank::where('is_active', true)->get();
        $trades = Trade::where('is_active', true)->get();
        $sections = Section::where('is_active', true)->get();
        $religions = Religion::where('is_active', true)->get();
        
        return Inertia::render('Students/Edit', [
            'student' => $student,
            'units' => $units,
            'ranks' => $ranks,
            'trades' => $trades,
            'sections' => $sections,
            'religions' => $religions,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'enrollment_date' => 'required|date',
            'class_level' => 'required|in:junior,senior,advance',
            'section' => 'nullable|string|max:10',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $student->user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
        ]);

        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'enrollment_date' => $request->enrollment_date,
            'class_level' => $request->class_level,
            'section' => $request->section,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    private function generateFormNumber()
    {
        $year = date('Y');
        $lastStudent = Student::where('form_number', 'like', "STU{$year}%")
            ->orderBy('form_number', 'desc')
            ->first();

        if ($lastStudent) {
            $lastNumber = (int) substr($lastStudent->form_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return "STU{$year}" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
