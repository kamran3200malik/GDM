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
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with(['user.role', 'currentSection', 'placeOfBirthTehseel', 'religionDetail', 'primaryContact', 'guardianDetail', 'transport'])
            ->when($request->search, function($query, $search) {
                $query->where('student_name', 'like', "%{$search}%")
                    ->orWhere('form_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('email', 'like', "%{$search}%");
                    });
            })
            ->when($request->current_class, function($query, $class) {
                $query->where('current_class', $class);
            })
            ->orderBy('student_name')
            ->paginate(10);

        // Transform students data to match Vue component expectations
        $transformedStudents = $students->getCollection()->map(function($student) {
            return [
                'id' => $student->id,
                'student_id' => $student->form_number,
                'full_name' => $student->student_name,
                'father_name' => $student->father_name,
                'image' => $student->image,
                'phone' => $student->primaryContact?->mobile_no,
                'user' => $student->user ? [
                    'email' => $student->user->email,
                ] : null,
                'class_level' => $student->current_class,
                'section' => $student->currentSection?->name,
                'category' => $student->guardianDetail?->category,
                'using_van' => $student->transport?->using_van,
                'is_active' => $student->is_active,
            ];
        });

        $students->setCollection($transformedStudents);

        return Inertia::render('Students/Index', [
            'students' => $students,
            'filters' => $request->only(['search', 'current_class']),
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
        Log::info('Student creation attempt started', ['request_data' => $request->all()]);

        $validator = Validator::make($request->all(), [
            // Student core fields
            'form_number' => 'required|string|max:255|unique:students,form_number',
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'current_class' => 'nullable|in:Junior,Senior,Advance',
            'current_section_id' => 'nullable|exists:sections,id',
            'place_of_birth_tehseel_id' => 'nullable|exists:tehseels,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'religion' => 'nullable|string|max:100',
            'religion_id' => 'nullable|exists:religions,id',
            'bloodgroup' => 'nullable|in:A+ve,A-ve,B+ve,B-ve,AB+ve,AB-ve,O+ve,O-ve',
            'polio_vaccination' => 'boolean',

            // Guardian Detail fields
            'guardian_category' => 'nullable|in:Officer,civilian,CNE',
            'guardian_pak_no' => 'nullable|string|max:50',
            'guardian_cnic_number' => 'nullable|string|max:50',
            'guardian_unit_id' => 'nullable|exists:units,id',
            'guardian_trade_id' => 'nullable|exists:trades,id',
            'guardian_section' => 'nullable|string|max:255',
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
            Log::error('Student validation failed', ['errors' => $validator->errors()->toArray()]);
            return back()->withErrors($validator)->withInput();
        }

        Log::info('Validation passed, starting database transaction');
        DB::beginTransaction();
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('students/images', $imageName, 'public');
                Log::info('Image uploaded successfully', ['path' => $imagePath]);
            }

            // Create Student
            Log::info('Attempting to create student record');
            $student = Student::create([
                'user_id' => null,
                'form_number' => $request->form_number,
                'student_name' => $request->student_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'current_class' => $request->current_class,
                'current_section_id' => $request->current_section_id,
                'place_of_birth_tehseel_id' => $request->place_of_birth_tehseel_id,
                'image' => $imagePath,
                'religion' => $request->religion,
                'religion_id' => $request->religion_id,
                'bloodgroup' => $request->bloodgroup,
                'polio_vaccination' => $request->polio_vaccination ?? false,
                'is_active' => true,
            ]);

            // Create Guardian Detail
            if ($request->guardian_category || $request->guardian_pak_no || $request->guardian_cnic_number ||
                $request->guardian_unit_id || $request->guardian_trade_id || $request->guardian_section ||
                $request->guardian_rank_id) {
                GuardianDetail::create([
                    'personalable_id' => $student->id,
                    'personalable_type' => Student::class,
                    'category' => $request->guardian_category,
                    'pak_no' => $request->guardian_pak_no,
                    'cnic_number' => $request->guardian_cnic_number,
                    'unit_id' => $request->guardian_unit_id,
                    'trade_id' => $request->guardian_trade_id,
                    'section' => $request->guardian_section,
                    'rank_id' => $request->guardian_rank_id,
                ]);
                Log::info('Guardian detail created');
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
                Log::info('Current address created');
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
                Log::info('Permanent address created');
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
                Log::info('Contact created');
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
            Log::info('Admission detail created');

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
                Log::info('Transport detail created');
            }

            DB::commit();
            Log::info('Transaction committed successfully');

            return redirect()->route('admin.students.index')
                ->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Student creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return back()->with('error', 'Error creating student: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Student $student)
    {
        $student->load([
            'user.role',
            'currentSection',
            'placeOfBirthTehseel',
            'religionDetail',
            'primaryContact',
            'currentAddress.district',
            'currentAddress.tehseel',
            'currentAddress.province',
            'permanentAddress.district',
            'permanentAddress.tehseel',
            'permanentAddress.province',
            'admissionDetail.admissionSection',
            'guardianDetail.unit',
            'guardianDetail.trade',
            'guardianDetail.rank',
            'transport'
        ]);

        // Transform student data to match Vue component expectations
        $transformedStudent = [
            'id' => $student->id,
            'student_id' => $student->form_number,
            'full_name' => $student->student_name,
            'student_name' => $student->student_name,
            'father_name' => $student->father_name,
            'mother_name' => $student->mother_name,
            'dob' => $student->dob,
            'gender' => $student->gender,
            'current_class' => $student->current_class,
            'current_section' => $student->currentSection?->name,
            'place_of_birth_tehseel' => $student->placeOfBirthTehseel?->name,
            'image' => $student->image,
            'religion' => $student->religion,
            'religion_name' => $student->religionDetail?->name,
            'bloodgroup' => $student->bloodgroup,
            'polio_vaccination' => $student->polio_vaccination,
            'is_active' => $student->is_active,
            'user' => $student->user ? [
                'email' => $student->user->email,
            ] : null,
            'primary_contact' => $student->primaryContact ? [
                'office_phone' => $student->primaryContact->office_phone,
                'whatsapp_no' => $student->primaryContact->whatsapp_no,
                'mobile_no' => $student->primaryContact->mobile_no,
                'emergency_contact' => $student->primaryContact->emergency_contact,
                'emergency_contact_relation' => $student->primaryContact->emergency_contact_relation,
            ] : null,
            'current_address' => $student->currentAddress ? [
                'colony' => $student->currentAddress->colony,
                'address' => $student->currentAddress->address,
                'city' => $student->currentAddress->city,
                'district' => $student->currentAddress->district?->name,
                'tehseel' => $student->currentAddress->tehseel?->name,
                'province' => $student->currentAddress->province?->name,
                'postal_code' => $student->currentAddress->postal_code,
            ] : null,
            'permanent_address' => $student->permanentAddress ? [
                'colony' => $student->permanentAddress->colony,
                'address' => $student->permanentAddress->address,
                'city' => $student->permanentAddress->city,
                'district' => $student->permanentAddress->district?->name,
                'tehseel' => $student->permanentAddress->tehseel?->name,
                'province' => $student->permanentAddress->province?->name,
                'postal_code' => $student->permanentAddress->postal_code,
            ] : null,
            'admission_detail' => $student->admissionDetail ? [
                'admission_date' => $student->admissionDetail->admission_date,
                'admission_year' => $student->admissionDetail->admission_year,
                'admission_type' => $student->admissionDetail->admission_type,
                'admission_class' => $student->admissionDetail->admission_class,
                'admission_section' => $student->admissionDetail->admissionSection?->name,
                'prospectus_issued' => $student->admissionDetail->prospectus_issued,
                'card_generated_date' => $student->admissionDetail->card_generated_date,
                'previous_school' => $student->admissionDetail->previous_school,
                'admission_notes' => $student->admissionDetail->admission_notes,
            ] : null,
            'guardian_detail' => $student->guardianDetail ? [
                'category' => $student->guardianDetail->category,
                'pak_no' => $student->guardianDetail->pak_no,
                'cnic_number' => $student->guardianDetail->cnic_number,
                'unit' => $student->guardianDetail->unit?->name,
                'trade' => $student->guardianDetail->trade?->name,
                'section' => $student->guardianDetail->section,
                'rank' => $student->guardianDetail->rank?->name,
            ] : null,
            'transport' => $student->transport ? [
                'using_van' => $student->transport->using_van,
                'van_route' => $student->transport->van_route,
                'van_driver_name' => $student->transport->van_driver_name,
                'van_driver_phone' => $student->transport->van_driver_phone,
                'transport_fee' => $student->transport->transport_fee,
            ] : null,
        ];

        return Inertia::render('Students/Show', [
            'student' => $transformedStudent,
        ]);
    }

    public function edit(Student $student)
    {
        $student->load([
            'user.role',
            'currentSection',
            'placeOfBirthTehseel',
            'religionDetail',
            'primaryContact',
            'currentAddress.district',
            'currentAddress.tehseel',
            'currentAddress.province',
            'permanentAddress.district',
            'permanentAddress.tehseel',
            'permanentAddress.province',
            'admissionDetail.admissionSection',
            'guardianDetail.unit',
            'guardianDetail.trade',
            'guardianDetail.rank',
            'transport'
        ]);

        // Transform student data to match Vue component expectations
        $transformedStudent = [
            'id' => $student->id,
            'student_id' => $student->form_number,
            'full_name' => $student->student_name,
            'student_name' => $student->student_name,
            'father_name' => $student->father_name,
            'mother_name' => $student->mother_name,
            'dob' => $student->dob ? $student->dob->format('Y-m-d') : null,
            'gender' => $student->gender,
            'current_class' => $student->current_class,
            'current_section_id' => $student->current_section_id,
            'current_section' => $student->currentSection?->name,
            'place_of_birth_tehseel_id' => $student->place_of_birth_tehseel_id,
            'place_of_birth_tehseel' => $student->placeOfBirthTehseel?->name,
            'image' => $student->image,
            'religion' => $student->religion,
            'religion_id' => $student->religion_id,
            'religion_name' => $student->religionDetail?->name,
            'bloodgroup' => $student->bloodgroup,
            'polio_vaccination' => $student->polio_vaccination,
            'is_active' => $student->is_active,
            'user' => $student->user ? [
                'email' => $student->user->email,
            ] : null,
            'primary_contact' => $student->primaryContact ? [
                'office_phone' => $student->primaryContact->office_phone,
                'whatsapp_no' => $student->primaryContact->whatsapp_no,
                'mobile_no' => $student->primaryContact->mobile_no,
                'emergency_contact' => $student->primaryContact->emergency_contact,
                'emergency_contact_relation' => $student->primaryContact->emergency_contact_relation,
            ] : null,
            'current_address' => $student->currentAddress ? [
                'colony' => $student->currentAddress->colony,
                'address' => $student->currentAddress->address,
                'city' => $student->currentAddress->city,
                'district_id' => $student->currentAddress->district_id,
                'district' => $student->currentAddress->district?->name,
                'tehseel_id' => $student->currentAddress->tehseel_id,
                'tehseel' => $student->currentAddress->tehseel?->name,
                'province_id' => $student->currentAddress->province_id,
                'province' => $student->currentAddress->province?->name,
                'postal_code' => $student->currentAddress->postal_code,
            ] : null,
            'permanent_address' => $student->permanentAddress ? [
                'colony' => $student->permanentAddress->colony,
                'address' => $student->permanentAddress->address,
                'city' => $student->permanentAddress->city,
                'district_id' => $student->permanentAddress->district_id,
                'district' => $student->permanentAddress->district?->name,
                'tehseel_id' => $student->permanentAddress->tehseel_id,
                'tehseel' => $student->permanentAddress->tehseel?->name,
                'province_id' => $student->permanentAddress->province_id,
                'province' => $student->permanentAddress->province?->name,
                'postal_code' => $student->permanentAddress->postal_code,
            ] : null,
            'admission_detail' => $student->admissionDetail ? [
                'admission_date' => $student->admissionDetail->admission_date ? $student->admissionDetail->admission_date->format('Y-m-d') : null,
                'admission_year' => $student->admissionDetail->admission_year,
                'admission_type' => $student->admissionDetail->admission_type,
                'admission_class' => $student->admissionDetail->admission_class,
                'admission_section_id' => $student->admissionDetail->admission_section_id,
                'admission_section' => $student->admissionDetail->admissionSection?->name,
                'prospectus_issued' => $student->admissionDetail->prospectus_issued,
                'card_generated_date' => $student->admissionDetail->card_generated_date ? $student->admissionDetail->card_generated_date->format('Y-m-d') : null,
                'previous_school' => $student->admissionDetail->previous_school,
                'admission_notes' => $student->admissionDetail->admission_notes,
            ] : null,
            'guardian_detail' => $student->guardianDetail ? [
                'category' => $student->guardianDetail->category,
                'pak_no' => $student->guardianDetail->pak_no,
                'cnic_number' => $student->guardianDetail->cnic_number,
                'unit_id' => $student->guardianDetail->unit_id,
                'unit' => $student->guardianDetail->unit?->name,
                'trade_id' => $student->guardianDetail->trade_id,
                'trade' => $student->guardianDetail->trade?->name,
                'section' => $student->guardianDetail->section,
                'rank_id' => $student->guardianDetail->rank_id,
                'rank' => $student->guardianDetail->rank?->name,
            ] : null,
            'transport' => $student->transport ? [
                'using_van' => $student->transport->using_van,
                'van_route' => $student->transport->van_route,
                'van_driver_name' => $student->transport->van_driver_name,
                'van_driver_phone' => $student->transport->van_driver_phone,
                'transport_fee' => $student->transport->transport_fee,
            ] : null,
        ];

        $units = Unit::where('is_active', true)->get();
        $ranks = Rank::where('is_active', true)->get();
        $trades = Trade::where('is_active', true)->get();
        $sections = Section::where('is_active', true)->get();
        $religions = Religion::where('is_active', true)->get();
        $provinces = Province::where('is_active', true)->get();
        $districts = District::where('is_active', true)->get();
        $tehseels = Tehseel::where('is_active', true)->get();

        return Inertia::render('Students/Edit', [
            'student' => $transformedStudent,
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

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            // Personal Information
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bloodgroup' => 'nullable|in:A+ve,A-ve,B+ve,B-ve,AB+ve,AB-ve,O+ve,O-ve',
            'polio_vaccination' => 'boolean',
            'religion_id' => 'nullable|exists:religions,id',
            'place_of_birth_tehseel_id' => 'nullable|exists:tehseels,id',
            'current_class' => 'nullable|in:Junior,Senior,Advance',
            'current_section_id' => 'nullable|exists:sections,id',
            'is_active' => 'boolean',

            // Contact Information
            'office_phone' => 'nullable|string|max:20',
            'whatsapp_no' => 'nullable|string|max:20',
            'mobile_no' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:100',

            // Current Address
            'current_colony' => 'nullable|in:AMF,MRF,APF,ARF,BASE,OTHER',
            'current_address' => 'nullable|string|max:500',
            'current_city' => 'nullable|string|max:100',
            'current_province_id' => 'nullable|exists:provinces,id',
            'current_district_id' => 'nullable|exists:districts,id',
            'current_tehseel_id' => 'nullable|exists:tehseels,id',
            'current_postal_code' => 'nullable|string|max:20',

            // Permanent Address
            'permanent_colony' => 'nullable|in:AMF,MRF,APF,ARF,BASE,OTHER',
            'permanent_address' => 'nullable|string|max:500',
            'permanent_city' => 'nullable|string|max:100',
            'permanent_province_id' => 'nullable|exists:provinces,id',
            'permanent_district_id' => 'nullable|exists:districts,id',
            'permanent_tehseel_id' => 'nullable|exists:tehseels,id',
            'permanent_postal_code' => 'nullable|string|max:20',

            // Admission Details
            'admission_date' => 'nullable|date',
            'admission_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'admission_type' => 'nullable|in:new_admission,transfer,readmission',
            'admission_class' => 'nullable|in:Junior,Senior,Advance',
            'admission_section_id' => 'nullable|exists:sections,id',
            'prospectus_issued' => 'boolean',
            'card_generated_date' => 'nullable|date',
            'previous_school' => 'nullable|string|max:255',
            'admission_notes' => 'nullable|string|max:1000',

            // Guardian Details
            'guardian_category' => 'nullable|in:Officer,civilian,CNE',
            'guardian_pak_no' => 'nullable|string|max:50',
            'guardian_cnic_number' => 'nullable|string|max:50',
            'guardian_unit_id' => 'nullable|exists:units,id',
            'guardian_trade_id' => 'nullable|exists:trades,id',
            'guardian_section' => 'nullable|string|max:255',
            'guardian_rank_id' => 'nullable|exists:ranks,id',

            // Transport Details
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
            $imagePath = $student->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($student->image && Storage::disk('public')->exists($student->image)) {
                    Storage::disk('public')->delete($student->image);
                }
                $imagePath = $request->file('image')->store('students', 'public');
            }

            // Update student
            $student->update([
                'student_name' => $request->student_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'image' => $imagePath,
                'bloodgroup' => $request->bloodgroup,
                'polio_vaccination' => $request->polio_vaccination ?? false,
                'religion_id' => $request->religion_id,
                'place_of_birth_tehseel_id' => $request->place_of_birth_tehseel_id,
                'current_class' => $request->current_class,
                'current_section_id' => $request->current_section_id,
                'is_active' => $request->is_active ?? true,
            ]);

            // Update or create contact
            if ($student->primaryContact) {
                $student->primaryContact->update([
                    'office_phone' => $request->office_phone,
                    'whatsapp_no' => $request->whatsapp_no,
                    'mobile_no' => $request->mobile_no,
                    'emergency_contact' => $request->emergency_contact,
                    'emergency_contact_relation' => $request->emergency_contact_relation,
                ]);
            } elseif ($request->mobile_no || $request->office_phone || $request->whatsapp_no) {
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

            // Update or create current address
            if ($student->currentAddress) {
                $student->currentAddress->update([
                    'colony' => $request->current_colony ?? 'AMF',
                    'address' => $request->current_address,
                    'city' => $request->current_city,
                    'province_id' => $request->current_province_id,
                    'district_id' => $request->current_district_id,
                    'tehseel_id' => $request->current_tehseel_id,
                    'postal_code' => $request->current_postal_code,
                ]);
            } elseif ($request->current_address || $request->current_city) {
                Address::create([
                    'addressable_id' => $student->id,
                    'addressable_type' => Student::class,
                    'address_type' => 'current',
                    'colony' => $request->current_colony ?? 'AMF',
                    'address' => $request->current_address,
                    'city' => $request->current_city,
                    'province_id' => $request->current_province_id,
                    'district_id' => $request->current_district_id,
                    'tehseel_id' => $request->current_tehseel_id,
                    'postal_code' => $request->current_postal_code,
                ]);
            }

            // Update or create permanent address
            if ($student->permanentAddress) {
                $student->permanentAddress->update([
                    'colony' => $request->permanent_colony ?? 'AMF',
                    'address' => $request->permanent_address,
                    'city' => $request->permanent_city,
                    'province_id' => $request->permanent_province_id,
                    'district_id' => $request->permanent_district_id,
                    'tehseel_id' => $request->permanent_tehseel_id,
                    'postal_code' => $request->permanent_postal_code,
                ]);
            } elseif ($request->permanent_address || $request->permanent_city) {
                Address::create([
                    'addressable_id' => $student->id,
                    'addressable_type' => Student::class,
                    'address_type' => 'permanent',
                    'colony' => $request->permanent_colony ?? 'AMF',
                    'address' => $request->permanent_address,
                    'city' => $request->permanent_city,
                    'province_id' => $request->permanent_province_id,
                    'district_id' => $request->permanent_district_id,
                    'tehseel_id' => $request->permanent_tehseel_id,
                    'postal_code' => $request->permanent_postal_code,
                ]);
            }

            // Update or create admission detail
            if ($student->admissionDetail) {
                $student->admissionDetail->update([
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
            } elseif ($request->admission_date) {
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
            }

            // Update or create guardian detail
            if ($student->guardianDetail) {
                $student->guardianDetail->update([
                    'category' => $request->guardian_category,
                    'pak_no' => $request->guardian_pak_no,
                    'cnic_number' => $request->guardian_cnic_number,
                    'unit_id' => $request->guardian_unit_id,
                    'trade_id' => $request->guardian_trade_id,
                    'section' => $request->guardian_section,
                    'rank_id' => $request->guardian_rank_id,
                ]);
            } elseif ($request->guardian_category || $request->guardian_pak_no) {
                GuardianDetail::create([
                    'personalable_id' => $student->id,
                    'personalable_type' => Student::class,
                    'category' => $request->guardian_category,
                    'pak_no' => $request->guardian_pak_no,
                    'cnic_number' => $request->guardian_cnic_number,
                    'unit_id' => $request->guardian_unit_id,
                    'trade_id' => $request->guardian_trade_id,
                    'section' => $request->guardian_section,
                    'rank_id' => $request->guardian_rank_id,
                ]);
            }

            // Update or create transport
            if ($student->transport) {
                $student->transport->update([
                    'using_van' => $request->using_van ?? false,
                    'van_route' => $request->van_route,
                    'van_driver_name' => $request->van_driver_name,
                    'van_driver_phone' => $request->van_driver_phone,
                    'transport_fee' => $request->transport_fee,
                ]);
            } elseif ($request->using_van) {
                StudentTransport::create([
                    'student_id' => $student->id,
                    'using_van' => $request->using_van ?? false,
                    'van_route' => $request->van_route,
                    'van_driver_name' => $request->van_driver_name,
                    'van_driver_phone' => $request->van_driver_phone,
                    'transport_fee' => $request->transport_fee,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Student update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', 'Error updating student: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Student $student)
    {
        DB::beginTransaction();
        try {
            // Delete user if exists
            if ($student->user) {
                $student->user->delete();
            }

            // Delete student (this will cascade delete related records)
            $student->delete();

            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Student deletion failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', 'Error deleting student: ' . $e->getMessage());
        }
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
