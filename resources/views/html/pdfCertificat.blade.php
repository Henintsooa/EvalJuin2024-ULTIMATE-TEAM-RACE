@extends('parent')
@section('main')
    <!--  Header End -->
    <div class="container-fluid" style="background-image: url('../assets/images/backgrounds/certficat.jpg'); "> 
        
        <p>{{ $classementGenerale[0]->nomequipe }} {{ $classementGenerale[0]->totalpoints }} {{ $classementGenerale[0]->classementgeneral }}</p>
    </div>    
</html>
@endsection