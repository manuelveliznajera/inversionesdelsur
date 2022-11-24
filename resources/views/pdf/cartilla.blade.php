<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 

  <title>Document</title>
</head>
<body class="bg-light border border-2 border-info p-3">
 
  <div class="d-flex flex-row ">
    <div class="col-6">
    
      <img src="{{public_path('img/salud.png')}}" width="60px" alt="">
    </div>
    <div class="col-6">
    
      <span class=" ">Dr. Mynor Centeno</span>
      <p>Documentacion para Registro de pacientes del Centro de Salud, San Juan Tecuaco, Santa Rosa </p>
      
    </div>
 <div class="container p-5">
 

   </div>
   <h3 class="alert alert-primary ">Listado de Pacientes</h3>
  
  <table class="table table-striped ">
    <thead class="alert alert-secondary">
        <tr class="border border-secondary">
          <th class="fs-6 border border-secondary">ID</th>
          <th class="fs-6 border border-secondary">NOMBRE COMPLETO</th>
          <th class="fs-6 border border-secondary">DPI</th>
          <th class="fs-6 border border-secondary">TELEFONO</th>
          {{-- <th class="fs-6 border border-secondary">EDAD</th> --}}
          <th class="fs-6 border border-secondary">COMUNIDAD</th>
          

        </tr>
    </thead>
    <tbody id="todos-list" name="todos-list">
        @foreach ($pacientes as $paciente)
        <tr id="todo{{$paciente->id}}">
          <td class="border border-secondary">{{$paciente->id}}</td>

            <td class="border border-secondary">{{$paciente->nombres}} - {{$paciente->apellidos}}</td>
            <td class="border border-secondary">{{$paciente->dpi}}</td>
            <td class="border border-secondary">{{$paciente->telefono}}</td>
            {{-- <td>{{$edad}}</td> --}}
            <td class="border border-secondary">{{$paciente->comunidad->comunidad}}</td>        
        </tr>
        @endforeach
    </tbody>
</table>

 </div>
    <span> Fecha de creacion Documento pdf: {{\Carbon\Carbon::now()->toDateString()}}</span>
 <h4 class=" ">Diseñado por: Keity</h4>

 
</body>
</html>



   <a class="btn btn-primary" href="{{ route('/paciente.crearpdf') }}">Export to PDF</a>

Route::get('/paciente/pdf', [PacienteController::class, 'createPDF'])->name('/paciente.crearpdf');

  public function createPDF() {
      //  dd('llamando pdf..');
        // // retreive all records from db
        $data = Paciente::all();
        // // share data to view
        view()->share('pacientes',$data);
        $pdf=Pdf::loadview('paciente.viewpdf',compact('data'));
         //$pdf = PDF::loadView('pdf_view', $data);
        // // download PDF file with download method
         return $pdf->download('pdf_file.pdf');
      }
