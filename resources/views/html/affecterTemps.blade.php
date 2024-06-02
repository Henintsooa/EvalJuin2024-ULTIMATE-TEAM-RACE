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
                <h5 class="card-title fw-semibold mb-4">Affecter temps</h5>
                <div class="table-responsive">
                    <form method="POST" action="/affecterTemps">
                        @csrf
                        <div class="mb-3">
                            <label for="coureur" class="form-label">Coureur</label>
                            <select class="form-select" id="" aria-describedby="" name="idCoureur">
                                <option value="">Selectionner un coureur</option>
                                @foreach ($coureurs as $coureur)
                                <option value="{{ $coureur->idcoureur }}">{{ $coureur->nomcoureur }}</option>
                                @endforeach
                            </select>
                        </div>                    
                        <div class="mb-3">
                            <label for="heureDepart" class="form-label">Heure Depart</label>
                            <input type="time" step="1" class="form-control" name="heureDepart" value="{{ old('heureDepart') }}">
                            @error('heureDepart')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="heureArrivee" class="form-label">Heure Arrivée</label>
                            <input type="time" step="1" class="form-control" name="heureArrivee" value="{{ old('heureArrivee') }}">
                            @error('heureArrivee')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> 
                        <input type="hidden" name="idEtape" value="{{ $idEtape }}">
                        {{-- <div class="mb-3">
                            <input class="form-check-input" type="radio" name="lendemain" value="1" {{ old('lendemain') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label">Lendemain</label>
                        </div>   --}}
                        <button type="submit" class="btn btn-primary">Valider</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
