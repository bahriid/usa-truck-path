@component('mail::message')
# Enrollment Status Update

Dear {{ $enrollment->full_name }},

Your enrollment status has been updated to **{{ ucfirst($status) }}**.

@if($status == 'approved')
Your enrollment has been approved. Congratulations! Please follow the next steps on our website.

**Important:** You will receive a Telegram group invite link in your course curriculum page. This link is for one-time use only.

**Need Help?** If, for any reason, the Telegram group link does not work for you, please contact us directly on WhatsApp at **+1 (614) 605-2310**. This number is for support purposes only to help resolve your issue — it is not a general communication line.
@elseif($status == 'rejected')
We regret to inform you that your enrollment has been rejected. For further inquiries, please contact our support team.
@else
Your enrollment is currently pending. We will update you once a decision has been made.
@endif

@isset($course)
@component('mail::button', ['url' => route('front.course.details', $course->slug)])
View Course Details
@endcomponent
@endisset

Thanks,<br>
{{ config('app.name') }}
@endcomponent
