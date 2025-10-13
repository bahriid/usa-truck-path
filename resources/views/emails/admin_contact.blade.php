<!DOCTYPE html>
<html>
<head>
    <title>New Contact Query </title>
     <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; padding: 20px; margin: 0; }
        .container { 
            background: #fff; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            text-align: center;
            max-width: 100%; 
            margin: auto; 
        }
        .logo img { 
            max-width: 150px; /* Adjust size as needed */
            margin-bottom: 10px; 
        }
        h2 { color: #4CAF50; }
        p { font-size: 16px; color: #333; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        
            @php
             use Illuminate\Support\Facades\Storage;
            $setting = App\Models\SiteSetting::first();
            @endphp
    
         <!-- Logo at the top -->
        <div class="logo">
           <img src="{{ asset('storage/' . $setting->main_logo) }}" alt="Logo">

        </div>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
        <p><strong>Message:</strong> {{ $data['message'] }}</p>
        <p class="footer">This message was sent from your website contact form.</p>
    </div>
</body>
</html>
