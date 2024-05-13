@extends('layouts.master-front')

@section('content')
<section class="container-fluid aos-init aos-animate">
  <div class="justify">
    <div class="content sec-pad">
      <div class="team-detail-wrap shape-wrap">

        <div class="container">
          <div class="membersingle-info team-detail-space">
            <div class="row align-items-start">
              <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2 mx-auto">
                <div class="contact-content">
                  <div class="sec-title mb-5">
                    <h2>Contact Us</h2>
                  </div>
                  <div class="contact-info-blocks row mb-3">
                    <div class="contact-block col-12 col-sm-6">
                      <div class="contact-tilte">
                        <h5>Address</h5>
                      </div>
                      <div class="contact-content">
                        <p>Houston, TX</p>
                      </div>
                    </div>
                    <div class="contact-block col-12 col-sm-6">
                      <div class="contact-tilte">
                        <h5>Contact</h5>
                      </div>
                      <div class="contact-content mb-3">
                        <p class="d-inline-block mb-0">Call Us: <a href="tel:+(469)431-0809" class="mb-1 d-inline-block">(469)431-0809</a></p><br>
                        <p class="d-inline-block mb-0">Email Us: <a href="mailto:teach@upliftk12.com" class="mb-0 d-inline-block">teach@upliftk12.com</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="contact-form-wrap icustom-forms">
                    <iframe width="100%" height="1000" src="https://forms.zohopublic.com/upliftk12/form/ProductEnquiry/formperma/c9pG18L6Z2rtjV0XswgHl4qJsx8GP5mcl6csPYIQ8kM"></iframe>
                    {{-- <form method="post" action="">
                      @csrf
                      <div class="row">
                        <div class="col-12">
                          @if(session('success'))
                              <div class="alert alert-success">{!!session('success')!!}</div>
                          @endif
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                        </div>
                        <div class="col-12 col-sm-6 form-group mrgn-b-2 mb-lg-5">
                          <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                        </div>
                        <div class="col-12 col-sm-6 form-group mrgn-b-2 mb-lg-5">
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                        </div>
                        <div class="col-12 col-sm-6 form-group mrgn-b-2 mb-lg-5">
                          <input type="text" class="form-control" name="district_name" placeholder="District Name" value="{{ old('district_name') }}">
                        </div>
                        <div class="col-12 col-sm-6 form-group mrgn-b-2 mb-lg-5">
                          <input type="text" class="form-control" name="school_name" placeholder="School Name" value="{{ old('school_name') }}">
                        </div>
                        <div class="col-12 col-sm-6 form-group mrgn-b-2 mb-lg-5">
                          <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                        </div>
                        <div class="col-12 col-sm-6 form-group mrgn-b-2 mb-lg-5">
                          <input type="text" class="form-control" name="email" placeholder="Email address" value="{{ old('email') }}">
                        </div>
                        <div class="col-12 form-group mrgn-b-2 mb-lg-5">
                          <select name="tyon" class="form-control">
                            <option value="">Type of Assessment Needed</option>
                            <option value="Social Emotional Learning">Social Emotional Learning</option>
                            <option value="Online Reading Fluency (WPM) + Reading Comprehension ">Online Reading Fluency (WPM) + Reading Comprehension </option>
                            <option value="Math 3rd-8th Grade Misconceptions Analysis">Math 3rd-8th Grade Misconceptions Analysis</option>
                            <option value="Grammar 3rd-8th Grade Misconceptions Analysis">Grammar 3rd-8th Grade Misconceptions Analysis</option>
                            <option value="English Language Learning Benchmark Assessment">English Language Learning Benchmark Assessment</option>
                            <option value="Future Career Profile ">Future Career Profile</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <button class="btn btn-dark" type="submit">Send</button>
                        </div>
                      </div>
                    </form> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection