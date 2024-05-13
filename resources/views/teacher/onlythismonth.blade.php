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
                                        <h2 class="title-content text-center" style="font-weight: bold; font-size: 32px; width: 100%;">You've already cancelled your subscription</h2>
                                    </div>
                                    <div class="sec-content fw-ct">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                You can use your account on this month, you've cancelled your subscription before
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
