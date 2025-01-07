@extends('front.layouts.app')

@section('main')

<div class="container">
  <h2>form</h2>
    
    @include('front.layouts.message')
    <form action="" method="post" id="contactForm" name="contactForm">     
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="number">Contact Number:</label>
                    <input type="phone" class="form-control" id="phone" placeholder="Enter number" name="phone" value="{{ old('phone') }}">
                    @error('number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea type="text" class="form-control" id="message" placeholder="Enter message" name="message">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>        
      </tr>
    </thead>
    <tbody>
        @if($contacts->isNotEmpty())
            @foreach ($contacts as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
  </table>


</div>

@endsection

@section('customJs')
<script>
    $("#contactForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("contact.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true){
                    window.location.href="{{ route('home') }}"
                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                } else {
                    var errors = response['errors']
                    if(errors['name']){
                        $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                }

            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });
</script>
