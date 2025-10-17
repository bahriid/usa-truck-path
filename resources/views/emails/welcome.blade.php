<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to USATruckPath</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 200px;
            height: auto;
        }
        h1 {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .content {
            font-size: 15px;
            margin-bottom: 25px;
        }
        .steps {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .step {
            margin-bottom: 20px;
            padding-left: 30px;
            position: relative;
        }
        .step-number {
            position: absolute;
            left: 0;
            top: 0;
            background-color: #28a745;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        .contact-info {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .signature {
            margin-top: 30px;
            font-size: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 13px;
            color: #6c757d;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #28a745;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('frontend/img/logo.png') }}" alt="USATruckPath Logo" class="logo">
        </div>

        <h1>Welcome—let's get you licensed and rolling!</h1>

        <div class="greeting">
            <strong>Hi {{ $user->name }},</strong>
        </div>

        <div class="content">
            <p>Idris here—founder of CDLCity Truck Driving School (4 school yards) and USAtruckpath.</p>

            <p>Thanks for trusting me with your new career; I'll mentor you every mile until you're licensed and rolling.</p>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-number">1</div>
                <strong>Join our private Telegram group</strong> (link inside the course) and read the pinned rules, class hours, and Q&A schedule.
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <strong>Block out study time and come ready</strong>—your U.S. & Canada CDL journey starts now.
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <strong>Need me?</strong> WhatsApp <a href="https://wa.me/16692045626">1-669-204-5626</a> or email <a href="mailto:shaqo408@gmail.com">shaqo408@gmail.com</a> (keep these private, please).
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="btn">Access Your Courses</a>
        </div>

        <div class="signature">
            <p>Hope to meet you in Columbus one day and celebrate your new career.<br>
            Let's hit the road!</p>
            <p><strong>—Idris</strong></p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} USATruckPath.com | All Rights Reserved</p>
            <p>Columbus, Ohio, USA</p>
        </div>
    </div>
</body>
</html>
