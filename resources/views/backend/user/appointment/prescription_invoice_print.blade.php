<div  id="print_setion">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Main CSS -->
    {{--<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">--}}

    <style type="text/css">
        @media print {
            /*.wrapper { position: absolute; font-size: 200px !important; }*/
        }
    </style>
    <!-- Printable area end -->
    <div class="wrapper">
        <!-- Page Content -->
        <div class="card">
            <div class="card-body">
                <div class="card logo">
                    <a href="" class="navbar-brand logo">
                        <img src="{{asset('frontend/img/logo-pres.jpg')}}" class="img-fluid" alt="Logo">
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-6" style="float: left">
                        <div class="biller-info">
                            <h4 class="d-block">Patient Name: {{Auth::user()->name}}</h4>
                            <span class="d-block text-muted">Age: ---</span> <br>
                            <span class="d-block text-muted">Phone: {{ Auth::User()->phone}}</span>
                            <h4 class="d-block">Date: {{$infos->date}}</h4>
{{--                            <span class="d-block text-sm text-muted">{{$infos->doctor_speciality_name}}</span>--}}
    {{--                        <span class="d-block text-sm text-muted">Newyork, United States</span>--}}
                        </div>
                    </div>
                    <div class="col-md-6" style="float: right">
{{--                        <div class="billing-info">--}}
{{--                            <h4 class="d-block">{{$infos->date}}</h4>--}}
{{--                            <span class="d-block text-muted">#INV-{{$infos->invoice}}</span>--}}
{{--                        </div>--}}
                        <div class="billing-info">
                            {{--                            <h4 class="d-block">Date: {{$infos->date}}</h4>--}}
                            <h4 class="d-block">{{$infos->name}}</h4>
                            {{--                            <span class="d-block text-muted">#INV-{{$infos->invoice}}</span>--}}
                            <span class="d-block text-muted">Phone: {{ $infos->phone }}</span> <br>
                            <span class="d-block text-muted">Email: {{$infos->email}}</span>
                        </div>
                    </div>
                </div>
                <div class="card logo">
                    <a href="" class="navbar-brand logo">
                        <img src="{{asset('frontend/img/logo-rx.jpg')}}" class="img-fluid" alt="Logo">
                    </a>
                </div>

                <!-- Prescription Item -->
                <div class="card card-table" style="padding: 100px;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center">
                                <thead>
                                    <tr>
                                        <th style="min-width: 200px">Medicine Name</th>
                                        <th style="min-width: 80px;">Quantity</th>
                                        <th style="min-width: 80px">Days</th>
                                        <th style="min-width: 100px;">Time</th>
                                        <th style="min-width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $prescription_infos = json_decode($infos->prescription_info);
                                @endphp
                                @if(!empty($prescription_infos))
                                    @foreach($prescription_infos as $prescription_info)
                                        <tr>
                                            <td>
                                                {{$prescription_info->name}}
                                            </td>
                                            <td>
                                                {{$prescription_info->quantity}}
                                            </td>
                                            <td>
                                                {{$prescription_info->days}}
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" {{ $prescription_info->morning ? 'checked' : '' }}> Morning
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" {{ $prescription_info->afternoon ? 'checked' : '' }}> Afternoon
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" {{ $prescription_info->evening ? 'checked' : '' }}> Evening
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" {{ $prescription_info->night ? 'checked' : '' }}> Night
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                        <td>Follow Up Date</td>
                                        <td>
                                            {{$infos->follow_up_date}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Prescription Item -->

                <!-- Signature -->
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="signature-wrap">
    {{--                        <div class="signature">--}}
    {{--                            Click here to sign--}}
    {{--                        </div>--}}
                            <div class="sign-name">
                                <p class="mb-0">( {{$infos->name}} )</p>
                                <span class="text-muted">Signature</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Signature -->


            </div>
        </div>
        <!-- /Page Content -->
    </div>
</div>

<script type="text/javascript">

    function printDivSection() {
        var Contents_Section = document.getElementById("print_setion").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = Contents_Section;
        window.print();
        document.body.innerHTML = originalContents;
    }

    (function () {
        printDivSection()
    }());
</script>
