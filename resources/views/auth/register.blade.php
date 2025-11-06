@extends('partials.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 0.375rem !important;
            min-height: 38px;
        }
    </style>
@endpush

@section('main')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-0">{{ __('Sign Up Free') }}</h3>
                        @if(request('course_id'))
                            <p class="mb-0 mt-2" style="font-size: 0.9rem;">Get instant access to your free course</p>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}" id="registration-form">
                            @csrf

                            {{-- Hidden course ID (passed from free course landing page) --}}
                            @if(request('course_id'))
                                <input type="hidden" name="course_id" value="{{ request('course_id') }}">
                            @endif

                            {{-- Personal Information --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror rounded-md"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autofocus
                                           autocomplete="name"
                                           placeholder="John Doe">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror rounded-md"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="email"
                                           placeholder="john@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                    <input id="phone" type="tel"
                                           class="form-control @error('phone') is-invalid @enderror rounded-md"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           required
                                           autocomplete="tel"
                                           placeholder="+1 (555) 123-4567">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="country" class="form-label">{{ __('Country') }} <span class="text-danger">*</span></label>
                                    <select id="country" name="country" class="form-select @error('country') is-invalid @enderror" required>
                                        <option value="">Select your country</option>
                                        <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Afghanistan" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                        <option value="Albania" {{ old('country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                        <option value="Algeria" {{ old('country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                        <option value="Andorra" {{ old('country') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                        <option value="Angola" {{ old('country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                        <option value="Argentina" {{ old('country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                        <option value="Armenia" {{ old('country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                        <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Azerbaijan" {{ old('country') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                        <option value="Bahamas" {{ old('country') == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                        <option value="Bahrain" {{ old('country') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                        <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="Barbados" {{ old('country') == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                        <option value="Belarus" {{ old('country') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                        <option value="Belgium" {{ old('country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                        <option value="Belize" {{ old('country') == 'Belize' ? 'selected' : '' }}>Belize</option>
                                        <option value="Benin" {{ old('country') == 'Benin' ? 'selected' : '' }}>Benin</option>
                                        <option value="Bhutan" {{ old('country') == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                        <option value="Bolivia" {{ old('country') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                        <option value="Bosnia and Herzegovina" {{ old('country') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                        <option value="Botswana" {{ old('country') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                        <option value="Brazil" {{ old('country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                        <option value="Brunei" {{ old('country') == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                        <option value="Bulgaria" {{ old('country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                        <option value="Burkina Faso" {{ old('country') == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                        <option value="Burundi" {{ old('country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                        <option value="Cambodia" {{ old('country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                        <option value="Cameroon" {{ old('country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                        <option value="Cape Verde" {{ old('country') == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                                        <option value="Central African Republic" {{ old('country') == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                        <option value="Chad" {{ old('country') == 'Chad' ? 'selected' : '' }}>Chad</option>
                                        <option value="Chile" {{ old('country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                        <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                        <option value="Comoros" {{ old('country') == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                        <option value="Congo" {{ old('country') == 'Congo' ? 'selected' : '' }}>Congo</option>
                                        <option value="Costa Rica" {{ old('country') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                        <option value="Croatia" {{ old('country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                        <option value="Cuba" {{ old('country') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                        <option value="Cyprus" {{ old('country') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                        <option value="Czech Republic" {{ old('country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                        <option value="Denmark" {{ old('country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                        <option value="Djibouti" {{ old('country') == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                        <option value="Dominica" {{ old('country') == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                        <option value="Dominican Republic" {{ old('country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                        <option value="East Timor" {{ old('country') == 'East Timor' ? 'selected' : '' }}>East Timor</option>
                                        <option value="Ecuador" {{ old('country') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                        <option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                        <option value="El Salvador" {{ old('country') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                        <option value="Equatorial Guinea" {{ old('country') == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                                        <option value="Eritrea" {{ old('country') == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                                        <option value="Estonia" {{ old('country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                        <option value="Ethiopia" {{ old('country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                        <option value="Fiji" {{ old('country') == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                        <option value="Finland" {{ old('country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                        <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Gabon" {{ old('country') == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                                        <option value="Gambia" {{ old('country') == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                                        <option value="Georgia" {{ old('country') == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                                        <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                        <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                        <option value="Greece" {{ old('country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                        <option value="Grenada" {{ old('country') == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                                        <option value="Guatemala" {{ old('country') == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                                        <option value="Guinea" {{ old('country') == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                                        <option value="Guinea-Bissau" {{ old('country') == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                                        <option value="Guyana" {{ old('country') == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                                        <option value="Haiti" {{ old('country') == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                                        <option value="Honduras" {{ old('country') == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                        <option value="Hungary" {{ old('country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                        <option value="Iceland" {{ old('country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                        <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Iran" {{ old('country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                        <option value="Iraq" {{ old('country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                        <option value="Ireland" {{ old('country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                        <option value="Israel" {{ old('country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                        <option value="Italy" {{ old('country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                        <option value="Jamaica" {{ old('country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                        <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                        <option value="Jordan" {{ old('country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                        <option value="Kazakhstan" {{ old('country') == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                        <option value="Kenya" {{ old('country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Kiribati" {{ old('country') == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                                        <option value="North Korea" {{ old('country') == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                                        <option value="South Korea" {{ old('country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                        <option value="Kuwait" {{ old('country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                        <option value="Kyrgyzstan" {{ old('country') == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                                        <option value="Laos" {{ old('country') == 'Laos' ? 'selected' : '' }}>Laos</option>
                                        <option value="Latvia" {{ old('country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                        <option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                        <option value="Lesotho" {{ old('country') == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                                        <option value="Liberia" {{ old('country') == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                        <option value="Libya" {{ old('country') == 'Libya' ? 'selected' : '' }}>Libya</option>
                                        <option value="Liechtenstein" {{ old('country') == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                                        <option value="Lithuania" {{ old('country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                        <option value="Luxembourg" {{ old('country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                        <option value="Madagascar" {{ old('country') == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                        <option value="Malawi" {{ old('country') == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                                        <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Maldives" {{ old('country') == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                        <option value="Mali" {{ old('country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                                        <option value="Malta" {{ old('country') == 'Malta' ? 'selected' : '' }}>Malta</option>
                                        <option value="Marshall Islands" {{ old('country') == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                                        <option value="Mauritania" {{ old('country') == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                                        <option value="Mauritius" {{ old('country') == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                                        <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                        <option value="Micronesia" {{ old('country') == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                                        <option value="Moldova" {{ old('country') == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                                        <option value="Monaco" {{ old('country') == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                        <option value="Mongolia" {{ old('country') == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                        <option value="Montenegro" {{ old('country') == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                                        <option value="Morocco" {{ old('country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="Mozambique" {{ old('country') == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                        <option value="Myanmar" {{ old('country') == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                        <option value="Namibia" {{ old('country') == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                        <option value="Nauru" {{ old('country') == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                                        <option value="Nepal" {{ old('country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                        <option value="Netherlands" {{ old('country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                        <option value="New Zealand" {{ old('country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                        <option value="Nicaragua" {{ old('country') == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                        <option value="Niger" {{ old('country') == 'Niger' ? 'selected' : '' }}>Niger</option>
                                        <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="North Macedonia" {{ old('country') == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                                        <option value="Norway" {{ old('country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                        <option value="Oman" {{ old('country') == 'Oman' ? 'selected' : '' }}>Oman</option>
                                        <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="Palau" {{ old('country') == 'Palau' ? 'selected' : '' }}>Palau</option>
                                        <option value="Palestine" {{ old('country') == 'Palestine' ? 'selected' : '' }}>Palestine</option>
                                        <option value="Panama" {{ old('country') == 'Panama' ? 'selected' : '' }}>Panama</option>
                                        <option value="Papua New Guinea" {{ old('country') == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                                        <option value="Paraguay" {{ old('country') == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                                        <option value="Peru" {{ old('country') == 'Peru' ? 'selected' : '' }}>Peru</option>
                                        <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                        <option value="Poland" {{ old('country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                        <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                        <option value="Qatar" {{ old('country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="Romania" {{ old('country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                        <option value="Russia" {{ old('country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                        <option value="Rwanda" {{ old('country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="Saint Kitts and Nevis" {{ old('country') == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" {{ old('country') == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines" {{ old('country') == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                        <option value="Samoa" {{ old('country') == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                                        <option value="San Marino" {{ old('country') == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                                        <option value="Sao Tome and Principe" {{ old('country') == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" {{ old('country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="Senegal" {{ old('country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                        <option value="Serbia" {{ old('country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                        <option value="Seychelles" {{ old('country') == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                        <option value="Sierra Leone" {{ old('country') == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                        <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="Slovakia" {{ old('country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                        <option value="Slovenia" {{ old('country') == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                        <option value="Solomon Islands" {{ old('country') == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                                        <option value="Somalia" {{ old('country') == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                                        <option value="South Africa" {{ old('country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="South Sudan" {{ old('country') == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                                        <option value="Spain" {{ old('country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                        <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                        <option value="Sudan" {{ old('country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                        <option value="Suriname" {{ old('country') == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                                        <option value="Sweden" {{ old('country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                        <option value="Switzerland" {{ old('country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="Syria" {{ old('country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                                        <option value="Taiwan" {{ old('country') == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                                        <option value="Tajikistan" {{ old('country') == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                                        <option value="Tanzania" {{ old('country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Togo" {{ old('country') == 'Togo' ? 'selected' : '' }}>Togo</option>
                                        <option value="Tonga" {{ old('country') == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                                        <option value="Trinidad and Tobago" {{ old('country') == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                        <option value="Tunisia" {{ old('country') == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                        <option value="Turkey" {{ old('country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                        <option value="Turkmenistan" {{ old('country') == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                                        <option value="Tuvalu" {{ old('country') == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                                        <option value="Uganda" {{ old('country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                        <option value="Ukraine" {{ old('country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                        <option value="United Arab Emirates" {{ old('country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                        <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="Uruguay" {{ old('country') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                        <option value="Uzbekistan" {{ old('country') == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                        <option value="Vanuatu" {{ old('country') == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                                        <option value="Vatican City" {{ old('country') == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
                                        <option value="Venezuela" {{ old('country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                        <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="Yemen" {{ old('country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                        <option value="Zambia" {{ old('country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                        <option value="Zimbabwe" {{ old('country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="row">
                                <div class="col-md-12 mb-3 position-relative">
                                    <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror rounded-md"
                                           name="password"
                                           required
                                           autocomplete="new-password"
                                           placeholder="Minimum 8 characters">
                                    <span class="position-absolute top-50 end-0 translate-bottom-y pe-3" onclick="togglePassword('password')">
                                        <i class="bi bi-eye-fill cursor-pointer"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3 position-relative">
                                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                    <input id="password_confirmation" type="password"
                                           class="form-control rounded-md"
                                           name="password_confirmation"
                                           required
                                           autocomplete="new-password"
                                           placeholder="Re-enter password">
                                    <span class="position-absolute top-50 end-0 translate-bottom-y pe-3" onclick="togglePassword('password_confirmation')">
                                        <i class="bi bi-eye-fill cursor-pointer"></i>
                                    </span>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <a class="text-decoration-none" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                                <button type="submit" class="btn btn-success px-4" id="register-button">
                                    {{ __('Sign Up Free') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }

        // Initialize Select2 for country dropdown
        $(document).ready(function() {
            $('#country').select2({
                theme: 'bootstrap-5',
                placeholder: 'Select your country',
                allowClear: false,
                width: '100%'
            });
        });
    </script>
@endsection
