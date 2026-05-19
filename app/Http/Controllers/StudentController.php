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
use App\Models\Province;
use App\Models\District;
use App\Models\Tehseel;
use App\Models\Address;
use App\Models\Contact;
use App\Models\GuardianDetail;
use App\Models\StudentAdmissionDetail;
use App\Models\StudentTransport;
use App\Models\StudentLeavingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
        $provinces = Province::where('is_active', true)->get();
        $districts = District::where('is_active', true)->get();
        $tehseels = Tehseel::where('is_active', true)->get();

        return Inertia::render('Students/Create', [
            'units' => $units,
            'ranks' => $ranks,
            'trades' => $trades,
            'sections' => $sections,
            'religions' => $religions,
            'provinces' => $provinces,
            'districts' => $districts,
            'tehseels' => $tehseels,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Student core fields
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'class' => 'nullable|in:Junior,Senior,Advance',
            'place_of_birth' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nationality' => 'nullable|string|max:100',
            'religion' => 'nullable|string|max:100',
            'bloodgroup' => 'nullable|in:A+ve,A-ve,B+ve,B-ve,AB+ve,AB-ve,O+ve,O-ve',
            'polio_vaccination' => 'boolean',

            // Guardian Detail fields
            'guardian_category' => 'nullable|in:Officer,civilian,CNE',
            'guardian_pak_no' => 'nullable|string|max:50',
            'guardian_cnic_number' => 'nullable|string|max:50',
            'guardian_unit_id' => 'nullable|exists:units,id',
            'guardian_trade_id' => 'nullable|exists:trades,id',
            'guardian_section_id' => 'nullable|exists:sections,id',
            'guardian_religion_id' => 'nullable|exists:religions,id',
            'guardian_rank_id' => 'nullable|exists:ranks,id',

            // Address fields
            'current_address' => 'nullable|string|max:500',
            'current_city' => 'nullable|string|max:100',
            'current_district_id' => 'nullable|exists:districts,id',
            'current_tehseel_id' => 'nullable|exists:tehseels,id',
            'current_province_id' => 'nullable|exists:provinces,id',
            'current_postal_code' => 'nullable|string|max:20',
            'current_colony' => 'nullable|in:AMF,MRF,APF,ARF,BASE,OTHER',

            'permanent_address' => 'nullable|string|max:500',
            'permanent_city' => 'nullable|string|max:100',
            'permanent_district_id' => 'nullable|exists:districts,id',
            'permanent_tehseel_id' => 'nullable|exists:tehseels,id',
            'permanent_province_id' => 'nullable|exists:provinces,id',
            'permanent_postal_code' => 'nullable|string|max:20',
            'permanent_colony' => 'nullable|in:AMF,MRF,APF,ARF,BASE,OTHER',

            // Contact fields
            'office_phone' => 'nullable|string|max:20',
            'whatsapp_no' => 'nullable|string|max:20',
            'mobile_no' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:100',

            // Admission Detail fields
            'admission_date' => 'required|date',
            'admission_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'admission_type' => 'nullable|in:new_admission,transfer,readmission',
            'admission_class' => 'nullable|in:Junior,Senior,Advance',
            'admission_section_id' => 'nullable|exists:sections,id',
            'prospectus_issued' => 'boolean',
            'card_generated_date' => 'nullable|date',
            'previous_school' => 'nullable|string|max:255',
            'admission_notes' => 'nullable|string|max:1000',

            // Transport fields
            'using_van' => 'boolean',
            'van_route' => 'nullable|string|max:100',
            'van_driver_name' => 'nullable|string|max:255',
            'van_driver_phone' => 'nullable|string|max:20',
            'transport_fee' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('students/images', $imageName, 'public');
            }

            // Create Student
            $student = Student::create([
                'user_id' => null,
                'form_number' => $this->generateFormNumber(),
                'student_name' => $request->student_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'class' => $request->class,
                'place_of_birth' => $request->place_of_birth,
                'image' => $imagePath,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'bloodgroup' => $request->bloodgroup,
                'polio_vaccination' => $request->polio_vaccination ?? false,
                'is_active' => true,
            ]);

            // Create Guardian Detail
            if ($request->guardian_category || $request->guardian_pak_no || $request->guardian_cnic_number ||
                $request->guardian_unit_id || $request->guardian_trade_id || $request->guardian_section_id ||
                $request->guardian_religion_id || $request->guardian_rank_id) {
                GuardianDetail::create([
                    'personalable_id' => $student->id,
                    'personalable_type' => Student::class,
                    'category' => $request->guardian_category,
                    'pak_no' => $request->guardian_pak_no,
                    'cnic_number' => $request->guardian_cnic_number,
                    'unit_id' => $request->guardian_unit_id,
                    'trade_id' => $request->guardian_trade_id,
                    'section_id' => $request->guardian_section_id,
                    'religion_id' => $request->guardian_religion_id,
                    'rank_id' => $request->guardian_rank_id,
                ]);
            }

            // Create Current Address
            if ($request->current_address || $request->current_city || $request->current_district_id) {
                Address::create([
                    'addressable_id' => $student->id,
                    'addressable_type' => Student::class,
                    'address_type' => 'current',
                    'colony' => $request->current_colony ?? 'AMF',
                    'address' => $request->current_address,
                    'city' => $request->current_city,
                    'district_id' => $request->current_district_id,
                    'tehseel_id' => $request->current_tehseel_id,
                    'province_id' => $request->current_province_id,
                    'postal_code' => $request->current_postal_code,
                ]);
            }

            // Create Permanent Address
            if ($request->permanent_address || $request->permanent_city || $request->permanent_district_id) {
                Address::create([
                    'addressable_id' => $student->id,
                    'addressable_type' => Student::class,
                    'address_type' => 'permanent',
                    'colony' => $request->permanent_colony ?? 'AMF',
                    'address' => $request->permanent_address,
                    'city' => $request->permanent_city,
                    'district_id' => $request->permanent_district_id,
                    'tehseel_id' => $request->permanent_tehseel_id,
                    'province_id' => $request->permanent_province_id,
                    'postal_code' => $request->permanent_postal_code,
                ]);
            }

            // Create Contact
            if ($request->office_phone || $request->whatsapp_no || $request->mobile_no) {
                Contact::create([
                    'contactable_id' => $student->id,
                    'contactable_type' => Student::class,
                    'office_phone' => $request->office_phone,
                    'whatsapp_no' => $request->whatsapp_no,
                    'mobile_no' => $request->mobile_no,
                    'emergency_contact' => $request->emergency_contact,
                    'emergency_contact_relation' => $request->emergency_contact_relation,
                    'is_primary' => true,
                ]);
            }

            // Create Admission Detail
            StudentAdmissionDetail::create([
                'student_id' => $student->id,
                'admission_date' => $request->admission_date,
                'admission_year' => $request->admission_year,
                'admission_type' => $request->admission_type,
                'admission_class' => $request->admission_class,
                'admission_section_id' => $request->admission_section_id,
                'prospectus_issued' => $request->prospectus_issued ?? false,
                'card_generated_date' => $request->card_generated_date,
                'previous_school' => $request->previous_school,
                'admission_notes' => $request->admission_notes,
            ]);

            // Create Transport
            if ($request->using_van) {
                StudentTransport::create([
                    'student_id' => $student->id,
                    'using_van' => $request->using_van,
                    'van_route' => $request->van_route,
                    'van_driver_name' => $request->van_driver_name,
                    'van_driver_phone' => $request->van_driver_phone,
                    'transport_fee' => $request->transport_fee,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating student: ' . $e->getMessage())->withInput();
        }
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
