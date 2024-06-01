@extends('parent')
@section('main')
<!-- Header End -->
<div class="container-fluid">
    <div class="col-lg-8 d-flex align-items-stretch">
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-6">
                <h5 class="card-title fw-semibold mb-4">Affecter coureur</h5>
                <div class="table-responsive">
                    <form method="POST" action="/affecterCoureur">
                        @csrf
                        @for ($i = 0; $i < $nbrCoureur; $i++)
                            <div class="mb-3">
                                <label for="coureur{{ $i }}" class="form-label">Coureur</label>
                                <select class="form-select" id="" aria-describedby="" name="idCoureurs[]">
                                    <option value="">Selectionner un coureur</option>
                                    @foreach ($coureurs as $coureur)
                                    <option value="{{ $coureur->idcoureur }}">{{ $coureur->nomcoureur }}</option>
                                    @endforeach
                                </select>
                            </div>                   
                        @endfor                        
                        <input type="hidden" name="idEtape" value="{{ $idEtape }}">

                        <button type="submit" id="submitBtn" class="btn btn-primary">Valider</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
