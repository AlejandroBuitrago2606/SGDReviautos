<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'idDocumento'     => 'required|integer',
            'idProceso'       => 'required|integer',
            'idTipoDocumento' => 'required|integer',            
            'consecutivo'     => 'required|string|max:10',
            'nombreDocumento' => 'required|string|max:200',
            'fechaCreacion'   => 'required|date_format:Y-m-d',
            'fechaVersion'    => 'required|date_format:Y-m-d',
            'numeroVersion'   => 'required|integer', 
            'fechaRevision'   => 'required|date_format:Y-m-d',
            'numeroRevision'  => 'required|integer',
            'v_Actualizada'   => 'sometimes|nullable|integer',
            'numeral'         => 'nullable|string|max:20',
            'observaciones'   => 'nullable|string|max:1500',
            'responsable'     => 'required|string|max:50',
            'archivo'         => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:51200',
            'rutaArchivo'     => 'nullable|string|max:200'

        ];
    }
}
