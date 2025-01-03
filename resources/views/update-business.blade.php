@extends("layouts.app")
@section('title','Update Business')
@section('content')

    <!-- Inclure sub-header de la page -->
    @include('header-page')

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5">

                    <form action="#" class="p-5 bg-white" style="margin-top: -150px;">
                        
                        <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="fname">First Name</label>
                            <input type="text" id="fname" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="lname">Last Name</label>
                            <input type="text" id="lname" class="form-control">
                        </div>
                        </div>

                        <div class="row form-group">
                        
                        <div class="col-md-12">
                            <label class="text-black" for="email">Email</label> 
                            <input type="email" id="email" class="form-control">
                        </div>
                        </div>

                        <div class="row form-group">
                        
                        <div class="col-md-12">
                            <label class="text-black" for="pass1">Password</label> 
                            <input type="password" id="pass1" class="form-control">
                        </div>
                        </div>
                        
                        <div class="row form-group">
                        
                        <div class="col-md-12">
                            <label class="text-black" for="pass2">Re-type Password</label> 
                            <input type="password" id="pass2" class="form-control">
                        </div>
                        </div>
                        

                        <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Sign Up" class="btn btn-primary btn-md text-white">
                        </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection