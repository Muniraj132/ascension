@extends('backend.layouts.subpage')
@section('content')


<!--       <?php  
       foreach($data as $key=> $value){
      echo "<pre>";
       print_r($value->name);
       echo "</pre>";
}
    
    ?> -->



    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>name</th>
            <th>mass_intention</th>
            <th>mass_offered</th>
            <th>mass_time</th>
            <th>number_of_days</th>
            <th>email</th>
            <th>phone</th>
            <th>place</th>
            <th>Actions</th>
        </tr>
        @foreach ($data as $key=> $value)
            <tr>
                <td>{!! $value->links(nameāAāāāāāāāā) !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
                <td>{!! $value->links() !!}</td>
             
            </tr>
        @endforeach
    </table>

    {!! $products->links() !!}

@endsection
