@extends('teacher.layouts.master')
@section('title', 'Unsubscribe')
@section('style')
    <style>
        h1 {
            color: hsla(215, 5%, 10%, 1);
            margin-bottom: 2rem;
        }
        section {
            display: flex;
            flex-flow: row wrap;
        }
        section > div {
            flex: 1;
            padding: 0.5rem;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:not(:disabled) ~ label {
             cursor: pointer;
         }
        input[type="radio"]:disabled ~ label {
            color: hsla(150, 5%, 75%, 1);
            border-color: rgba(65,42,143, 1);
            box-shadow: none;
            cursor: not-allowed;
        }
        label {
            height: 100%;
            display: block;
            background: white;
            border: 2px solid rgba(65,42,143, 1);
            border-radius: 20px;
            padding: 1rem;
            margin-bottom: 1rem;
        //margin: 1rem;
            text-align: center;
            box-shadow: 0px 3px 10px -2px hsla(150, 5%, 65%, 0.5);
            position: relative;
        }
        input[type="radio"]:checked + label {
            background: rgba(65,42,143, 0.8);
            color: hsla(215, 0%, 100%, 1);
            box-shadow: 0px 0px 20px rgba(65, 42, 143, 0.55);
        }
        input[type="radio"]:checked + label::after {
             color: hsla(215, 5%, 25%, 1);
             font-family: FontAwesome;
             border: 2px solid hsla(246, 75%, 45%, 1);
             content: "\f00c";
             font-size: 24px;
             position: absolute;
             top: -25px;
             left: 50%;
             transform: translateX(-50%);
             height: 50px;
             width: 50px;
             line-height: 50px;
             text-align: center;
             border-radius: 50%;
             background: white;
             box-shadow: 0px 2px 5px -2px hsla(0, 0%, 0%, 0.25);
         }
        p {
            font-weight: 900;
        }


        @media only screen and (max-width: 700px) {
            section {
                flex-direction: column;
            }
        }

        label {
            display: flex;
        }

        h2 {
            margin: auto;
        }

    </style>

@endsection
@section('content')
    <div class="tab-data">
        <div class="container-fluid">
            <div class="divider"></div>
            <div class="tab-content">
                <div class="tab-pane active" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2" style="margin-top: 50px;">
                                <div class="team-detail-content">
                                    <div class="clearfix header-section-content hasbutton doublebutton">
                                        <h2 class="title-content text-center" style="font-weight: bold; font-size: 32px; width: 100%;">Unsubscribe</h2>
                                    </div>
                                    <div class="sec-content fw-ct">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="x_content">
                                                        <div class="text-justify" style="margin-bottom: 50px; font-size: 20px;">
                                                            <strong>Canceling your Upliftk12 account will deactivate your login and [Remove Anything Created]
                                                            at the end of your current billing cycle</strong>.Everything will stop functioning at that time, but your data and
                                                            settings will be saved for 12 months - just in case you choose to re-activate your account during that time
                                                        </div>
                                                        <section>
                                                            <div>
                                                                <input type="radio" id="control_01" name="type" value="cost" checked>
                                                                <label for="control_01">
                                                                    <h2>COST</h2>
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="control_02" name="type" value="difficulty_of_use">
                                                                <label for="control_02">
                                                                    <h2>DIFFICULTY OF USE</h2>
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="control_03" name="type" value="missing_functionality">
                                                                <label for="control_03">
                                                                    <h2>MISSING FUNCTIONALITY</h2>
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="control_04" name="type" value="using_other_product">
                                                                <label for="control_04">
                                                                    <h2>USING OTHER PRODUCT</h2>
                                                                </label>
                                                            </div>
                                                            <div>
                                                                <input type="radio" id="control_05" name="type" value="not_using_it">
                                                                <label for="control_05">
                                                                    <h2>NOT USING IT</h2>
                                                                </label>
                                                            </div>
                                                        </section>
                                                        <div class="text-justify" style="margin: 30px 0; font-size: 20px;">
                                                            Before you click Cancel Subscription, we would love to know simple reason about that:
                                                        </div>
                                                        <textarea class="form-control" name="reason" rows="5"></textarea>
                                                        <span role="alert" style="display: block; color: red;">
                                                            <strong>{{ $errors->first('reason') }}</strong>
                                                        </span>

                                                        <div class="pull-right" style="padding: 30px 0;">
                                                            <button class="btn btn-danger" type="submit">Cancel Subscription</button>
                                                            <a class="btn btn-primary" href="/teacher">Back</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        setTimeout(function(){
            $(".notification").hide();
        }, 2000);

    </script>
@endpush
