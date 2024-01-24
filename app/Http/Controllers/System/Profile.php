<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\PersonalEducation;
use App\Models\PersonalExperience;
use App\Models\PersonalFamily;
use App\Models\PersonalProfile;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDepartment;
use App\Models\UserDocument;
use App\Models\UserGallery;
use App\Models\UserIdentityDocument;
use App\Models\UserProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller
{
    public function Index(Request $request)
    {
        if ($request->has('submit_profile_image')) {
            $image = $request->file('profile_image');
            $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $image->storeAs('public/dp', $filename);

            PersonalProfile::updateOrCreate([
                'user_id' => auth()->user()->id,
            ], [
                'profile_image' => $filename,
            ]);
        }

        if ($request->has('submit_add_identity_document')) {
            $document = $request->file('document');
            $filename = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $document->storeAs('public/identity_documents', $filename);

            UserIdentityDocument::create([
                'user_id' => $request->get('id'),
                'type' => $request->get('type'),
                'document_name' => $filename,
                'created_at' => now(),
            ]);
        }

        if ($request->has('submit_download_identity_document')) {
            $document_name = UserIdentityDocument::where('id', $request->get('identity_document_id'))->first()->document_name;
            $path = storage_path() . '\\app\\public\\identity_documents\\' . $document_name;
            return Response::download($path);
        }

        if ($request->has('submit_delete_identity_document')) {
            UserIdentityDocument::where('id', $request->get('identity_document_id'))->delete();
        }

        if ($request->has('submit_add_project')) {
            UserProject::create([
                'user_id' => $request->get('id'),
                'project_name' => $request->get('project_name'),
                'project_description' => $request->get('project_description'),
                'start_date' => $request->get('start_date'),
                'end_date' => $request->get('end_date'),
                'status' => 'NEW',
            ]);
        }

        if ($request->has('submit_update_project')) {
            UserProject::where('id', $request->get('project_id'))->update([
                'project_name' => $request->get('project_name'),
                'project_description' => $request->get('project_description'),
                'start_date' => $request->get('start_date'),
                'end_date' => $request->get('end_date'),
                'status' => $request->get('status'),
            ]);
        }

        if ($request->has('submit_delete_project')) {
            UserProject::where('id', $request->get('project_id'))->delete();
        }

        if ($request->has('submit_add_document')) {
            foreach ($request->file('documents') as $document) {
                $filename = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
                $document->storeAs('public/documents', $filename);

                UserDocument::create([
                    'user_id' => $request->get('id'),
                    'document_name' => $filename,
                    'created_at' => now(),
                ]);
            }
        }

        if ($request->has('submit_download_document')) {
            $document_name = UserDocument::where('id', $request->get('document_id'))->first()->document_name;
            $path = storage_path() . '\\app\\public\\documents\\' . $document_name;
            return Response::download($path);
        }

        if ($request->has('submit_delete_document')) {
            UserDocument::where('id', $request->get('document_id'))->delete();
        }

        if ($request->has('submit_add_photo')) {
            foreach ($request->file('photos') as $photo) {
                $filename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($photo->getClientOriginalName(), PATHINFO_EXTENSION);
                $photo->storeAs('public/photos', $filename);

                UserGallery::create([
                    'user_id' => $request->get('id'),
                    'photo_name' => $filename,
                    'created_at' => now(),
                ]);
            }
        }

        if ($request->has('submit_delete_photo')) {
            UserGallery::where('id', $request->get('photo_id'))->delete();
        }

        return view('system.profile.index', [
            'user' => User::find($request->input('id')),
            'projects' => UserProject::where('user_id', $request->get('id'))->get(),
            'documents' => UserDocument::where('user_id', $request->get('id'))->get(),
            'identity_documents' => UserIdentityDocument::where('user_id', $request->get('id'))->get(),
            'photos' => UserGallery::where('user_id', $request->get('id'))->get(),
        ]);
    }

    public function Personal(Request $request)
    {
        if ($request->has('submit_add')) {
            if (auth()->user()->isHigherUp()) {
                User::where('id', $request->get('id'))->update([
                    'role' => $request->get('role'),
                ]);
            }

            PersonalProfile::updateOrCreate([
                'user_id' => $request->get('id'),
            ], [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'initial' => strtoupper($request->get('first_name')[0] . $request->get('last_name')[0]),
                'about' => $request->get('about'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'join_date' => $request->get('join_date'),
                'position' => $request->get('position'),
            ]);

            UserDepartment::updateOrCreate([
                'user_id' => $request->get('id'),
            ], [
                'department_id' => $request->get('department'),
            ]);

            return redirect()->route('profile', ['id' => $request->get('id')]);
        }

        return view('system.profile.personal', [
            'user' => User::find($request->get('id')),
            'departments' => Department::all(),
            'roles' => Role::all(),
        ]);
    }

    public function Family(Request $request)
    {
        if ($request->has('submit_add')) {
            PersonalFamily::create([
                'user_id' => $request->get('id'),
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'date_of_birth' => $request->get('date_of_birth'),
                'relationship' => $request->get('relationship'),
                'emergency_flag' => $request->get('emergency'),
            ]);
        }

        if ($request->has('submit_update')) {
            PersonalFamily::where('id', $request->get('family_id'))->update([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'date_of_birth' => $request->get('date_of_birth'),
                'relationship' => $request->get('relationship'),
                'emergency_flag' => $request->get('emergency'),
            ]);
        }

        if ($request->has('submit_delete')) {
            PersonalFamily::where('id', $request->get('family_id'))->delete();
        }

        return view('system.profile.family', [
            'user' => User::find($request->get('id'))
        ]);
    }

    public function Experience(Request $request)
    {
        if ($request->has('submit_add')) {
            PersonalExperience::create([
                'user_id' => $request->get('id'),
                'company_name' => $request->get('company_name'),
                'date_from' => $request->get('date_from'),
                'date_until' => $request->get('date_until'),
                'position' => $request->get('position'),
                'jobscope' => $request->get('jobscope'),
            ]);
        }

        if ($request->has('submit_update')) {
            PersonalExperience::where('id', $request->get('experience_id'))->update([
                'company_name' => $request->get('company_name'),
                'date_from' => $request->get('date_from'),
                'date_until' => $request->get('date_until'),
                'position' => $request->get('position'),
                'jobscope' => $request->get('jobscope'),
            ]);
        }

        if ($request->has('submit_delete')) {
            PersonalExperience::where('id', $request->get('experience_id'))->delete();
        }

        return view('system.profile.experience', [
            'user' => User::find($request->get('id'))
        ]);
    }

    public function Education(Request $request)
    {
        if ($request->has('submit_add')) {
            PersonalEducation::create([
                'user_id' => $request->get('id'),
                'institution_name' => $request->get('institution_name'),
                'date_from' => $request->get('date_from'),
                'date_until' => $request->get('date_until'),
                'course' => $request->get('course'),
                'result' => $request->get('result'),
            ]);
        }

        if ($request->has('submit_update')) {
            PersonalEducation::where('id', $request->get('education_id'))->update([
                'institution_name' => $request->get('institution_name'),
                'date_from' => $request->get('date_from'),
                'date_until' => $request->get('date_until'),
                'course' => $request->get('course'),
                'result' => $request->get('result'),
            ]);
        }

        if ($request->has('submit_delete')) {
            PersonalEducation::where('id', $request->get('education_id'))->delete();
        }

        return view('system.profile.education', [
            'user' => User::find($request->get('id'))
        ]);
    }

    public function Password(Request $request)
    {
        $message = null;

        if ($request->has('submit_update')) {
            $old_password = $request->get('old_password');
            $password = $request->get('password');
            $password_confirmation = $request->get('password_confirmation');

            if ($old_password and $password and $password_confirmation) {
                if (Hash::check($old_password, auth()->user()->password)) {
                    if ($password === $password_confirmation) {
                        User::query()
                            ->where('id', $request->get('id'))
                            ->update([
                                'password' => Hash::make($password),
                                'updated_at' => now(),
                            ]);

                        return redirect()->route('profile', ['id' => $request->get('id')]);
                    } else {
                        $message = "Confirm Password not match.";
                    }
                } else {
                    $message = "Existing password not match.";
                }
            } else {
                $message = "All field is required.";
            }
        }

        return view('system.profile.password', [
            'message' => $message,
        ]);
    }
}
