@extends('admin.master')
@section('content')
<!--    --><?php //dd(1); ?>
        <div class="box">
    <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th></th>
                @foreach( $odevler as  $odev  )
                <th>{{$odev->dosya_adi}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$asilOdev->dosya_adi}}</td>
            @foreach( $odevler as  $odev  )
                    <td>{{ isset($yuzdeler[$asilOdev->id][$odev->id ])? $yuzdeler[$asilOdev->id][$odev->id ]: '-'}}</td>
            @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    </div>
@endsection
@section('js')
    <script>
        $('#example2').DataTable();
    </script>
@endsection
