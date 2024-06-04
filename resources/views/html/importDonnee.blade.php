  @extends('parent')

  @section('main')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Import csv</h5>
            <form action="{{ route('importCsv') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group mb-4">
                <label for="etapesFile">Etapes</label>
                <input class="form-control" type="file" accept=".csv" name="etapesFile" id="etapesFile">
                @error('etapesFile')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group mb-4">
                <label for="resultatFile">Résultat</label>
                <input class="form-control" type="file" accept=".csv" name="resultatFile" id="resultatFile">
                @error('resultatFile')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Valider</button>
              </div>
            </form>

            <form action="{{ route('importPoints') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group mb-4">
                <label for="pointsFile">Points</label>
                <input class="form-control" type="file" accept=".csv" name="pointsFile" id="pointsFile">
                @error('pointsFile')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Valider</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
