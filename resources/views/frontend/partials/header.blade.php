
<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html"><h2>Sixteen <em>Clothing</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.html">Our Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                    </li>
                    <li class="nav-item">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Login / Registration
                        </button>
                    </li>
                    <li class="nav-item">
                        <a style="color:white" href="{{route('cart.view')}}">Cart ({{session()->has('cart')?count(session()->get('cart')):0}})</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Registration Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('customer.registration')}}" method="post">
                @csrf
            <div class="modal-body">
                    <div class="form-group">
                        <label for="">Enter Customer Name:</label>
                        <input class="form-control" type="text" required name="name" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Customer Email:</label>
                        <input class="form-control" type="email" required name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Customer Password:</label>
                        <input class="form-control" type="password" required name="password" placeholder="Enter Password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
