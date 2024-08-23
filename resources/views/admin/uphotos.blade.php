@extends('layouts.adminsidebar')

@section('content')
<style>
    .content{
        background-color: #F2C1A8;
        height: 100%;
        padding-left: 5%;
    }

    .post_title{
        font-size:30px;
        font-weight: bold;
        text-align: center;
        padding:30px;
        color: #854836;
    }
    .div_center{
        text-align: center;
        padding: 30px;
    }
    label{
        display:inline-block;
        width: 200px;
    }
</style>
<div class="content">
    @if(Session::has('success'))
    <div class="alert alert-success d-flex justify-content-center" role="alert">
        {{Session::get('success')}}
    </div>
    @endif

    <h1 class="post_title">Photos</h1>

    <div>
        <form action="{{ url('add_photo') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
           @csrf
            <div class="div_center">
                <label>Post Title</label>
                <input type="text" name="title" required>
            </div>
  
            <div class="div_center">
                <label>Image 1</label>
                <input type="file" name="image1" accept="image/*">
            </div>
            <div class="div_center">
                <label>Image 2</label>
                <input type="file" name="image2" accept="image/*">
            </div>
            <div class="div_center">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
    function validateForm() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let valid = true;

        fileInputs.forEach(input => {
            if (input.value !== '') {
                const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(input.value)) {
                    valid = false;
                }
            }
        });

        if (!valid) {
            alert('Please upload only image files (jpg, jpeg, png).');
            return false;
        }

        return true;
    }
</script>
@endsection
