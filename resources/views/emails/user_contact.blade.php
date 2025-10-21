<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Contacting Us</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; padding: 20px; margin: 0; }
        .container { 
            background: #fff; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            text-align: center;
            width: 100%; 
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
     @php
      use Illuminate\Support\Facades\Storage;
    $setting = App\Models\SiteSetting::first();
  
    @endphp
    <div class="container">
        <!-- Logo at the top -->
        <div class="logo">
             <img src="{{ asset('storage/' . $setting->main_logo) }}" alt="Logo">
        </div>
        
        <h2>Thank You for Contacting Us!</h2>
        <p>Dear {{ $data['name'] }},</p>
        <p>We have received your message and will get back to you as soon as possible.</p>
        <p><strong>Your Message:</strong></p>
        <p>{{ $data['message'] }}</p>

        <p class="footer">Best regards,<br> USA Truck Path</p>
    </div>
</body>
</html>
