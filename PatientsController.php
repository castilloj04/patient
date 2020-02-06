<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index()
    {
     $patients=Patient::latest()->paginate(3);
 
 
 
     return view ('/patients/patient',compact('patients'));
    }

   public function show($id)
   {
    $patients=Patient::find($id);

    return view ('/patients/patientview',compact('patients'));
   }

   public function edit($id)
   {
      $patients=Patient::findorFail($id);
      return view('/patients/edit',compact('patients'));
   }

   public function create()
   {
   
      return view('/patients/create');
   }

   public function update($id)
   
   
      {

        
         $patients=Patient::findorFail($id);

         $patients->patient_id=request('patient_id');
         $patients->date_time=request('date_time');
         $patients->remarks=request('remarks');
         
         $patients->save();

         return redirect('/patients/patientview/'.$id);
   }

   public function store(Request $request)
   {

    $this->validate($request, [
        'patient_id' => 'required',
        'remarks' => 'required'
]);

      $patients=new Patient;

      $patients->patient_id=request('patient_id');
      $patients->date_time=request('date_time');
      $patients->remarks=request('remarks');
      
      $patients->save();
      

      return redirect('/patients/patient');
}

public function destroy($id)
{

   $patients=Patient::findorFail($id)->delete();
   return redirect('/patients/patient');
}



}
