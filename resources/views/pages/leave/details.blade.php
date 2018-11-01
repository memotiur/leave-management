@extends('layouts.app')

@section('title', 'All Leave')


@section('content')
    <h3>My Leave</h3>
    <hr>


    <button type="submit" class="btn btn-sm btn-primary" onclick="printDiv('printableArea')">Print Area</button>
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default" id="printableArea">

                <div class="panel-body">
                    <div class="leave" style="margin:0 10% 10% 10%;"><p>
                            {{ date("jS  F Y") }}<br>
                            To<br>The Commissioner <br>Custom House <br>
                            Benapole, Jessore<br>

                            <br><br>
                            <strong>Subject : Application for Leave.</strong><br><br>
                            Sir,<br>
                            This is to inform you that I have
                            been working as {{$result->designation}} position in Custom House, Benpole, Jessore.<br>
                            For the reason "{{$result->applicant_leave_reason }} " I will not be able to attend
                            from {{$result->applicant_leave_from }} to {{$result->applicant_leave_to}}.

                            <br><br>Therefore kindly grant me leave for {{$result->applicant_leave_duration}} days.
                        </p>

                        <br>
                        Regards<br>{{$result->name}}<br>
                        <hr>


                        <br> Recommend Officer: @if($result->recommend_officers_decision==0)
                            <div class="label label-warning">Pending
                            </div> @elseif($result->recommend_officers_decision==1)
                            <div class="label label-success">Approved</div> @else
                            <div class="label label-danger">Canceled</div>@endif

                        @if(is_null($recommend_officer))

                        @else
                            By: {{$recommend_officer->name}}
                            , Designation: {{$recommend_officer->designation}}
                        @endif
                        <br>
                        Approving Authority: @if($result->grant_officers_decision==0)
                            <div class="label label-warning">Pending
                            </div> @elseif($result->grant_officers_decision==1)
                            <div class="label label-success">Approved</div> @else
                            <div class="label label-danger">Canceled</div>@endif

                        @if(is_null($grant_officer))

                        @else
                            By: {{$grant_officer->name}}
                            , Designation: {{$grant_officer->designation}}
                        @endif
                    </div>

                </div>
            </div>
        </div>


    </div>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection