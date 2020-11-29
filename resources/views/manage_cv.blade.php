@extends("admin.admin_app")

@section("content")
    <div id="main">
        <div class="page-header">
            <h2>Saved CVs</h2>
            <a href="{{ URL::to('cv/create') }}" class="btn btn-primary" target="_blank"><i class="md md-exposure-plus-1"></i>Create New CV</a>

        </div>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr No. </th>
                        <th>User ID</th>
                        <th>File Name</th>
                        <th>Creation Date</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($all_CVs as $i => $cv)
                        <tr>
                            <td><a href="{{ URL::to('cv/view/'.$cv->name) }}">{{$i+1}}</a></td>
                            <td><a href="{{ URL::to('cv/view/'.$cv->name) }}">{{ $cv->userId }}</a></td>
                            <td><a href="{{ URL::to('cv/view/'.$cv->name) }}">{{ $cv->name }}</a></td>
                            <td><a href="{{ URL::to('cv/view/'.$cv->name) }}">{{ $cv->created_at }}</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>



@endsection
