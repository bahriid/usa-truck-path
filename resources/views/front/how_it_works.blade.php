@extends('partials.master')

@section('main')

<main class="main">

  <!-- Page Title -->
  <!-- <div class="page-title" data-aos="fade">
    <div class="heading">
      <div class="container text-center">
        <h1>How It Works</h1>
        <p class="mb-0">Step-by-step guidance for truck drivers worldwide.</p>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="current">How It Works</li>
        </ol>
      </div>
    </nav>
  </div> -->

  <!-- Content Section -->
  <section id="how-it-works" class="section">

    <style>
      :root{
        --bg:#0b3d2e; --card:#0f6b57; --accent:#f0b323; --accent-2:#e6f4ef;
        --ink:#0f1d1a; --ink-on-dark:#ffffff;
      }
      .hero{
        background:
          radial-gradient(1200px 600px at 110% -10%, rgba(255,255,255,.08), transparent 60%),
          linear-gradient(160deg, var(--bg) 0%, #125c47 60%, #157a62 100%);
        color:var(--ink-on-dark);
        padding: clamp(32px, 5vw, 72px) 20px;
        text-align:center;
        position:relative; overflow:hidden;
      }
      .badge{display:inline-block; background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25); padding:6px 12px; border-radius:999px; font-weight:600; letter-spacing:.3px;}
      h1{margin:.6rem 0 .4rem; font-size: clamp(28px, 4.5vw, 52px); line-height:1.08}
      .hero p{margin:.3rem auto 1.2rem; max-width: 850px; font-size: clamp(16px, 2.3vw, 20px)}
      .cta{display:flex; gap:12px; justify-content:center; flex-wrap:wrap;}
      .btn{background:var(--accent); color:#1b1706; font-weight:800; padding:14px 22px; border-radius:12px; border:none; cursor:pointer; text-decoration:none; box-shadow: 0 10px 18px rgba(0,0,0,.18);}
      .btn.secondary{ background:#ffffff; color:#0b3d2e; }
      .ribbon{background:#fff; color:#0b3d2e; margin-top:18px; display:inline-flex; gap:10px; align-items:center; padding:8px 14px; border-radius:999px; box-shadow:0 4px 12px rgba(0,0,0,.12); font-weight:700;}
      .ribbon b{color:var(--bg)}
      .ribbon .slash{opacity:.45}
      .strip{ padding: clamp(28px, 5vw, 56px) 20px; }
      .max{ max-width:1100px; margin:0 auto; }
      .highlights{ display:grid; gap:16px; grid-template-columns: repeat(12, 1fr); }
      .card{ grid-column: span 12; background:#fff; border-radius:16px; padding:18px; box-shadow:0 10px 30px rgba(11,61,46, .12); display:flex; gap:14px; align-items:flex-start; border:1px solid rgba(15,107,87,.08);}
      .icon{ width:44px; height:44px; border-radius:12px; display:grid; place-items:center; font-size:22px; background:linear-gradient(135deg, var(--accent) 0%, #ffe19a 100%); color:#1b1706; flex:0 0 auto; }
      .card h3{margin:.1rem 0 .25rem; font-size:20px}
      .card p{margin:0; color:#334; opacity:.88}
      .card.alt{ background:linear-gradient(160deg, #0f6b57 0%, #0c5b49 100%); color:#fff; border:none;}
      .card.alt p{color:#fff; opacity:.92}
      .span-6{ grid-column: span 6 }
      .span-4{ grid-column: span 4 }
      @media (max-width:900px){ .span-6, .span-4{ grid-column:span 12 } }
      .flow{ background:linear-gradient(180deg, #ffffff 0%, #f7fbf9 100%); border:1px solid rgba(15,107,87,.08); border-radius:16px; padding:22px; margin-top:8px;}
      .flow p{ margin:0; font-size:18px; color:#1d2b27 }
      .flow b{ color:#0b3d2e }
      .note{ margin-top:16px; color:#0b3d2e; background:#e9f7f1; border-left:6px solid var(--accent); padding:14px 16px; border-radius:12px;}
      .faq{ display:grid; gap:14px; margin-top:18px;}
      details{ background:#fff; border-radius:12px; padding:14px 16px; border:1px solid rgba(15,107,87,.12);}
      summary{font-weight:700; cursor:pointer}
      footer.hiw-footer{ background: var(--bg); color:#fff; text-align:center; padding:28px 16px; margin-top:40px; border-radius:12px;}
      footer.hiw-footer a{color:#fff; text-decoration:underline}
    </style>

    <!-- HERO -->
  <!-- Hero Section -->
  <section class="py-5 text-center bg-success text-white">
    <div class="container">
      <p class="mb-2">For applicants worldwide → U.S. & Canada</p>
      <h1 class="fw-bold">How USTruckPath Works</h1>
      <p class="lead mb-4">
        Wherever you live today, if your goal is to drive a truck in the 
        <b>United States</b> or <b>Canada</b>, we give you the roadmap, 
        training, and daily mentorship to make it real – step by step 
        from your country to your first job, and beyond.
      </p>
      <div class="d-flex justify-content-center gap-3 mb-3 flex-wrap">
        <a href="{{ route('register') }}" class="btn btn-warning fw-bold">Enroll Now</a>
        <a href="{{ route('register') }}" class="btn btn-light fw-bold">Speak to a Mentor</a>
      </div>
      <div class="bg-light text-dark px-4 py-2 rounded-pill d-inline-block shadow-sm fw-semibold">
        Private Telegram Mentorship <span class="text-muted">• Join after purchase</span>
      </div>
    </div>
  </section>

    <!-- Highlights -->
    <section class="strip">
      <div class="max">
        <div class="highlights">
          <div class="card span-6">
            <div class="icon">🌍</div>
            <div>
              <h3>Global Pathway</h3>
              <p>We support applicants from any country—guiding you on visas, forms, timelines, and what to do first.</p>
            </div>
          </div>
          <div class="card span-6">
            <div class="icon">📱</div>
            <div>
              <h3>Private Telegram Group</h3>
              <p>Daily answers and coaching after purchase. Real mentors, real progress, no guesswork.</p>
            </div>
          </div>
          <div class="card alt span-4">
            <div class="icon" style="background:#fff;color:#0b3d2e;">🎯</div>
            <div>
              <h3>Company Applications</h3>
              <p>Get a curated list of trucking companies in the U.S. & Canada and help preparing interview answers.</p>
            </div>
          </div>
          <div class="card span-4">
            <div class="icon">🧾</div>
            <div>
              <h3>Visa Guidance</h3>
              <p>We explain the visa options, show how to complete forms correctly, and help you assemble strong references.</p>
            </div>
          </div>
          <div class="card span-4">
            <div class="icon">📚</div>
            <div>
              <h3>CDL/Commercial Permit Prep</h3>
              <p>Study materials & coaching to pass your permit—then guidance through full training.</p>
            </div>
          </div>
        </div>

        <!-- Flow -->
        <div class="flow">
          <p>
            After you purchase, you unlock the lessons that explain trucking in <b>the U.S. and Canada</b> step by step. 
            You’re then added to our <b>private Telegram mentorship</b> for daily support while still in your country—
            helping with your <b>CV</b>, company applications, interviews, <b>visa</b> process, and CDL training until your first job. 
            Later, we even guide you on how to <b>run your own trucking business</b>.
          </p>
        </div>

        <!-- Note -->
        <div class="note">
          ✅ Designed for newcomers • 🌐 Works from any country • 🧭 Clear roadmap • 🤝 Real mentors • 🚚 Training to license • 📈 Business guidance
        </div>

        <!-- FAQ -->
        <div class="faq">
          <details>
            <summary>Who is this for?</summary>
            Anyone outside the U.S. or Canada who wants to become a professional truck driver with a guided path.
          </details>
          <details>
            <summary>What do I get after purchase?</summary>
            Immediate access to the course + a private Telegram mentorship invite for daily support.
          </details>
          <details>
            <summary>Do I need experience?</summary>
            No. We start from basics and coach you through permits, training, and job applications.
          </details>
        </div>
      </div>
    </section>

     <!-- Call To Action Footer -->
  <section class="py-4 bg-success text-white text-center">
    <div class="container">
      <p class="mb-2">Ready to start your journey?</p>
      <a href="{{ route('register') }}" class="btn btn-warning fw-bold me-2">Enroll Now</a>
    </div>
  </section>
  </section>
</main>

@endsection
