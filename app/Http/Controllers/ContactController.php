<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\ContactAdminMail;

use App\Mail\ContactUserMail;

use App\Models\SiteSetting;

use App\Models\ContactUs;



class ContactController extends Controller

{

    public function sendEmail(Request $request)

    {

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email',

            'subject' => 'required|string|max:255',

            'message' => 'required|string|max:500',

        ]);

        

            // Save data to database

        $contact = ContactUs::create([

            'name' => $request->name,

            'email' => $request->email,

            'subject' => $request->subject,

            'message' => $request->message,

            'status' => 'Pending'

        ]);



        $data = $request->all();

        $setting = SiteSetting::first();

        // dd($setting);

        // Send email to Admin

        $adminRecipients = [ 
            $setting->contact_email?? 'info@passyourpermit.com',
            'AbaadirAcademy@gmail.com',
            // 'iammianhamza@gmail.com'
        ]; 
        Mail::to($adminRecipients)->send(new ContactAdminMail($data));

        // Mail::to($setting->contact_email?? 'info@passyourpermit.com')->send(new ContactAdminMail($data));



        // Send confirmation email to User

        Mail::to($data['email'])->send(new ContactUserMail($data));



        return  redirect()->back()->with('success', 'Your message has been sent successfully.');

    }

    

    

       public function index(Request $request)

        {

            $query = ContactUs::query();

        

            // Filter by status if provided

            if ($request->has('status') && $request->status != '') {

                $query->where('status', $request->status);

            }

        

            $contacts = $query->paginate(10); // Paginate results

        

            return view('admin.contacts.index', compact('contacts'));

        }



    

        public function updateStatus(Request $request, $id) {

            $contact = ContactUs::findOrFail($id);

            $contact->update(['status' => $request->status]);

    

            return redirect()->back()->with('success', 'Status updated successfully!');

        }

}

