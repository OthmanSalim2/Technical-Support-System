@extends('front')

@section('page-title', 'Contact Page')
@section('root-title', 'Contact')
@section('large-title', 'Contact Page')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card-body row" style="margin: 0 10px;">
                <div class="col-5 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                        <h2>Technical Support System <strong>Department</strong></h2>
                        <p class="lead mb-5">KhanYouns, Gaza, Palestine<br>
                            Phone: +970 5612345
                        </p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" id="inputName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-Mail</label>
                        <input type="email" id="inputEmail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputSubject">Subject</label>
                        <input type="text" id="inputSubject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Send message">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
