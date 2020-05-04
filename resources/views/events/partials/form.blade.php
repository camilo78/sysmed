+
'<div class="row">' +
'<div class="form-group col-md-12">'+
  '<label>Paciente</label>' +
  '<select class="form-control patient_id " data-live-search="true title="Selecciona un paciente" id="patient_id" name="patient_id">' +
  	'<option>Selecione Paciente</option>' +
    @foreach($patients as $patient)
  	'<option value="{{ $patient->id }}">{{ $patient->surname1 }} {{ $patient->surname2 }} {{ $patient->name1 }} {{ $patient->name2 }}</option>' +
    @endforeach
  '</select>' +
'</div>'+
'<div class="form-group col-sm-6">'+
  '<label>Centro de Atención</label>' +
  '<select class="form-control setting_id" title="Seleccione Clínica" id="setting_id" name="setting_id">' +
    '<option>Seleccione Centro</option>' +
    @foreach($settings as $setting)
    '<option value="{{ $setting->id }}">{{ $setting->name }}</option>' +
    @endforeach
  '</select>' +
'</div>'+
'<div class="form-group col-sm-6">'+
  '<label>Color</label>' +
    '<select class="colorselector" id="colorselector">' +
      '<option value="#3788D8" data-color="#3788D8">Celeste</option>' +
      '<option value="#00BCD4" data-color="#00BCD4" >Cían</option>' +
      '<option value="#3F51B5" data-color="#3F51B5">Indigo</option>' +
      '<option value="#4CAF50" data-color="#4CAF50">Verde</option>' +
      '<option value="#FFEB3B" data-color="#FFEB3B">Amarillo</option>' +
      '<option value="#FF5722" data-color="#FF5722">Naranja</option>' +
      '<option value="#F44336" data-color="#F44336">Rojo</option>' +
'</select>' +
'</div>'+
'</div>'
