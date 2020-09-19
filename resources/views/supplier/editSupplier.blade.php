@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Supplier Management</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('supplier.update',['id'=>$supplier->id]) }}">
                        @csrf
                        {{method_field("PUT")}}
                        <div class="col-md-8 offset-2">
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

                                    <input type="text" class="form-control" name="supplier" id="supplier" value="{{ $supplier->supplier }}">

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

</div>
@push('scripts')
<script>
    sopt('country','{{ $supplier->country }}');
    sopt('category','{{ $supplier->category }}');
    function sopt(id,dbo) {
        var tempid="#"+id;
        var tempdbo=dbo;
        //var opt = jQuery(tempid).val();
        //alert(tempdbo)
        jQuery(''+tempid+' option[value="'+tempdbo+'"]').attr('selected', 'selected');
    }
</script>
@endpush


@endsection
