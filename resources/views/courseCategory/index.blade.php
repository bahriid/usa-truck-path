@extends('partials.master')

@section('main')
<div class="container py-5">

    {{-- Hero Section --}}
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">{{ $title ?? 'Dummy Course Title' }}</h1>
        <p class="lead text-muted">{{ $intro ?? 'This is a sample course setup for testing the full flow.' }}</p>
        <a href="#plan" class="btn btn-primary btn-lg">View Course Plan</a>
    </div>

    {{-- Choose Your Plan --}}
    <div id="plan" class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="{{ $thumb ?? 'https://placehold.co/500x300' }}" 
                 alt="Course Preview" 
                 class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h3>What's Included In This Course</h3>
            <p>Dummy description of the course. Includes 23 lessons, ebook, and restricted content access.</p>
            <ul>
                <li>23 structured lessons</li>
                <li>Downloadable ebook (restricted until payment)</li>
                <li>Sample quizzes</li>
                <li>Lifetime access</li>
            </ul>
            <p class="fw-bold">Price: $1.00</p>
            <a href="" class="btn btn-success btn-lg">Buy & Enroll</a>
        </div>
    </div>

    {{-- About This Course --}}
    <div class="mb-5">
        <h3>About This Course</h3>
        <p>This is a demo course built to replicate the CDL permit page flow. You can preview lessons, see structure, and
           test the purchase process for just $1. After payment, ebook and full lessons unlock inside the restricted area.</p>
    </div>

    {{-- Why Choose Us --}}
    <div class="mb-5">
        <h3 class="text-center mb-4">Why Choose Our Platform?</h3>
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h5>Easy Access</h5>
                    <p>Mobile and web-friendly learning system.</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h5>Practical Learning</h5>
                    <p>Step-by-step lessons designed like real courses.</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h5>Affordable</h5>
                    <p>Test flow with just $1 before committing fully.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Course Curriculum --}}
    <div class="mb-5">
        <h3>Course Curriculum</h3>
        <div class="accordion" id="curriculumAccordion">
            @for($i = 1; $i <= 4; $i++)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $i }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#lesson{{ $i }}">
                            Lesson {{ $i }} - Dummy Lesson Title
                        </button>
                    </h2>
                    <div id="lesson{{ $i }}" class="accordion-collapse collapse" 
                         data-bs-parent="#curriculumAccordion">
                        <div class="accordion-body">
                            Lesson {{ $i }} content is restricted. Please enroll to unlock.
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- About Platform --}}
    <div class="mb-5">
        <h3>About Our Platform</h3>
        <p>We help learners prepare with structured online content. This dummy setup ensures your flow from
           course selection to payment and restricted content works seamlessly.</p>
    </div>

    {{-- Final CTA --}}
    <div class="text-center p-5 bg-light rounded shadow">
        <h3>Get Started Now</h3>
        <p class="text-muted">Purchase the course for $1 and unlock all lessons plus the ebook section.</p>
        <a href="" class="btn btn-success btn-lg">Buy & Enroll</a>
    </div>

</div>
@endsection
