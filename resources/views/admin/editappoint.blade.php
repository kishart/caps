<body>
    <div class="container" style="margin-top:20px">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit Booking</h2>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="post" action="{{url('admin/editappoint')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="fname" 
                        placeholder="Enter Name" value="{{$data->fname}}">
                        @error('fname')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="text" class="form-control" name="email" 
                        placeholder="Enter Email" value="{{$data->email}}">
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone:</label>
                        <input type="text" class="form-control" name="phone" 
                        placeholder="Enter Phone Number" value="{{$data->phone}}">
                        @error('phone')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date:</label>
                        <input type="date" class="form-control" name="date" 
                        placeholder="Enter your chosen date" value="{{$data->date}}">
                        @error('date')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Time:</label>
                        <input type="text" class="form-control" name="time" 
                        placeholder="Enter your chosen time" value="{{$data->time}}">
                        @error('time')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message:</label>
                        <textarea class="form-control" name="details" 
                        placeholder="Enter your message for another detail">{{$data->details}}</textarea>
                        @error('details')
                        <div class="alert alert-danger" role="alert">
                            {{($message)}}
                        </div>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('appointlist')}}" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
