@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Supplier Management</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('supplier.store') }}">
                        @csrf
                        <div class="col-md-8 offset-2">
                            <div class="alert alert-danger" id='cdan' style="display: none;">
                                <ul>
                                    Record has been deleted;
                                </ul>

                            </div>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>

                        </div>
                        @endif

                        @if(session()->has('Message'))
                            <div class="alert alert alert-success">
                                <p>{{ session()->get('Message')}}</p>
                            </div>
                        @endif
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">Country:</label>

                            <div class="col-md-6">
                                <select name="country" class="form-control" id="country">
                                    <option value="">--selelct--</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Category:</label>

                            <div class="col-md-6">

                                    <select name="category" class="form-control" id="category">
                                        <option value="">--selelct--</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="supplier" class="col-md-4 col-form-label text-md-right">Supplier:</label>

                            <div class="col-md-6">

                                    <input type="text" class="form-control" name="supplier" id="supplier">

                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Supplier Managemen Details</div>


                    <table id="example1"  class="table table-bordered ">
                        <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Supplier</th>
                            <th>Category</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sl=1; @endphp
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$supplier->supplier}}</td>

                                <td>{{@$categoryArr[$supplier->category]}}</td>
                                <td>{{@$countryArr[$supplier->country]}}</td>

                                <td>
                                    <span style="font-size: 20px;">
                                        <a href="{{url("supplier/".$supplier->id."/edit")}}" class="text-black" title="Edit">Edit</a>

                                        <button   class="btn btn-danger del" onclick="return supDel(this.value,this);" title="Delete" value="{{ $supplier->id }}">Delete</button>
                                    </span>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

            </div>
        </div>
    </div>


</div>
@push('scripts')
<script>
function supDel(sid,th)
{
    $.ajax({
        type: "GET",
        url: "delRec/" +sid ,
        data: {'code':sid},
        dataType: "json",
        success: function(result){
            $('#cdan').hide();
            $('#cdan').show();
  }});

  $(th).closest("tr").remove();
}

</script>

@endpush
@endsection
